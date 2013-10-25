<?php
class Command_Fragen extends Core_Base_Command implements IHttpRequest, IRestricted
{
    public static function getRestriction() {
        return 'App_Web_Security::isAuthenticated';
    }

    public function getFallback() {
        $this->_objResponse->tplContent = 'Fragen_GET_Fallback';

        $this->_objResponse->strFoo = 'You are not logged in';
        $this->_objResponse->strTitle .= ' - Not logged in';
    }

    public function getMain() {
        $this->getListe();
    }

    public function getListe() {
        $this->_objResponse->tplContent = 'Fragen_GET_Liste';

        if($this->_objRequest->order != '') {
            if($this->_objRequest->order == 'reset') {
                unset($_SESSION['lastOrder']);
            } else if(isset($_SESSION['lastOrder']) && $_SESSION['lastOrder'][0] == $this->_objRequest->order) {
                $arrOrder = array(
                    $this->_objRequest->order,
                    ($_SESSION['lastOrder'][1] == 1)?0:1
                );
            } else {
                $arrOrder = array(
                    $this->_objRequest->order,
                    1
                );
            }

            $_SESSION['lastOrder'] = $arrOrder;
        }

        if($this->_objRequest->fcat != '') {
            $_SESSION['fcat'] = $this->_objRequest->fcat;
        } else {
            unset($_SESSION['fcat']);
        }

        $this->_buildCategoryselect(array($_SESSION['fcat']));

        $this->_objResponse->arrQuestions = viewQuestion::getAllquestionswithcategories(false, $_SESSION['lastOrder'], $_SESSION['fcat']);
    }

    public function getDetails() {
        $this->_objResponse->tplContent = 'Fragen_GET_Details';

        $objQuestion = viewQuestion::getBypk($this->_objRequest->UID);

        $this->_fillTemplate($objQuestion);
    }

    public function getNeu() {
        $this->_objResponse->tplContent             = 'Fragen_GET_Neu';

        $this->_objResponse->lngOpttime = 0;

        $this->_buildCategoryselect();
        $this->_buildDifficultyselect();
    }

    public function getBearbeiten() {
        $this->_objResponse->tplContent = 'Fragen_GET_Bearbeiten';

        $objQuestion = viewQuestion::getBypk($this->_objRequest->uid);

        $this->_fillTemplate($objQuestion);

        $this->_buildCategoryselect($objQuestion->getCategorymap());
        $this->_buildDifficultyselect($objQuestion->gettbldifficulty_UID());

        $this->_objResponse->antwortcount   = count($this->_objResponse->antwort)-1;
    }

    public function postNeu() {
        $this->_objResponse->tplContent = 'Fragen_POST_Neu';

        $arrErrors  = $this->_doValidate();

        if(!empty($arrErrors)) {
            $this->_objResponse->tplContent             = 'Fragen_GET_Neu';

            $this->_objResponse->executed = true;

            foreach($arrErrors as $strField => $blnError) {
                if(!$blnError) {
                    continue;
                }

                $strErrorvariable = 'ERROR_' . $strField;

                $this->_objResponse->$strErrorvariable = 'error';
            }

            $this->_objResponse->antwortcount   = count($this->_objRequest->antwort)-1;
            $this->_objResponse->antwort        = $this->_objRequest->antwort;
            $this->_objResponse->strQuestion    = $this->_objRequest->strQuestion;
            $this->_objResponse->lngOpttime     = $this->_objRequest->lngOpttime;

            $this->_buildCategoryselect();
            $this->_buildDifficultyselect();
        } else {
            $objUser        = App_Factory_Security::getSecurity()->getObjuser();
            $objQuestion    = new App_Data_Question();

            $objQuestion->setstrQuestion($this->_objRequest->strQuestion);
            $objQuestion->setlngOpttime($this->_objRequest->lngOpttime);
            $objQuestion->settbldifficulty_UID($this->_objRequest->difficulty);
            $objQuestion->settblbackenduser_UID($objUser->getUID());

            if(!$objQuestion->doInsert()) {
                //@TODO ERROR
            } else {
                foreach($this->_objRequest->antwort as $arrAnswer) {
                    if($arrAnswer['strAnswer'] == '') {
                        continue;
                    }

                    $objAnswer = new App_Data_Answer();

                    $objAnswer->setstrAnswer($arrAnswer['strAnswer']);
                    $objAnswer->setblnTrue((isset($arrAnswer['blnTrue']))?1:0);

                    $objQuestion->addAnswer($objAnswer);
                }

                foreach($this->_objRequest->category as $lngCategoryid) {
                    $objQuestion->addCategory($lngCategoryid);
                }

                $objQuestion->doFullupdate(true);

                header("Location: " . CFG_WEB_ROOT . "/Fragen/Liste");
            }
        }
    }

    public function postBearbeiten() {
        $this->_objResponse->tplContent = 'Fragen_POST_Bearbeiten';

        $objQuestion = viewQuestion::getBypk($this->_objRequest->UID);

        $arrErrors  = $this->_doValidate();

        if(!empty($arrErrors)) {
            $this->_objResponse->tplContent = 'Fragen_GET_Bearbeiten';

            foreach($arrErrors as $strField => $blnError) {
                if(!$blnError) {
                    continue;
                }

                $strErrorvariable = 'ERROR_' . $strField;

                $this->_objResponse->$strErrorvariable = 'error';
            }

            $this->_objResponse->UID            = $objQuestion->getUID();
            $this->_objResponse->antwortcount   = count($this->_objRequest->antwort)-1;
            $this->_objResponse->antwort        = $this->_objRequest->antwort;
            $this->_objResponse->strQuestion    = $this->_objRequest->strQuestion;
            $this->_objResponse->lngOpttime     = $this->_objRequest->lngOpttime;

            $this->_buildCategoryselect();
            $this->_buildDifficultyselect();
        } else {
            $objUser = App_Factory_Security::getSecurity()->getObjuser();

            $objQuestion->setstrQuestion($this->_objRequest->strQuestion);
            $objQuestion->setlngOpttime($this->_objRequest->lngOpttime);
            $objQuestion->settbldifficulty_UID($this->_objRequest->difficulty);
            $objQuestion->setlngCountshowed($this->_objRequest->lngCountshowed);
            $objQuestion->settblbackenduser_UID($objUser->getUID());

            if(!$objQuestion->doFullupdate()) {
                //@TODO ERROR
            } else {
                $arrAnswers = $this->_objRequest->antwort;

                foreach($objQuestion->getAllanswers() as $arrAnswer) {
                    if(!isset($arrAnswers[$arrAnswer['UID']])) {
                        viewAnswer::deleteBypk($arrAnswer['UID']);
                    }
                }

                foreach($arrAnswers as $arrAnswer) {
                    if(substr($arrAnswer['UID'], 0, 1) == 'n') {
                        $objAnswer = new App_Data_Answer();
                    } else {
                        $objAnswer = viewAnswer::getBypk($arrAnswer['UID']);
                    }

                    if($objAnswer instanceof App_Data_Answer) {
                        $objAnswer->setstrAnswer($arrAnswer['strAnswer']);
                        $objAnswer->setblnTrue((isset($arrAnswer['blnTrue']))?1:0);

                        $objQuestion->addAnswer($objAnswer);
                    }
                }

                $arrCategories = $objQuestion->getCategorymap();

                foreach($arrCategories as $lngCategoryid) {
                    if(!in_array($lngCategoryid, $this->_objRequest->category)) {
                        $objQuestion->removeCategory($lngCategoryid);
                    }
                }

                foreach($this->_objRequest->category as $lngCategoryid) {
                    if(!in_array($lngCategoryid, $arrCategories)) {
                        $objQuestion->addCategory($lngCategoryid);
                    }
                }

                $objQuestion->doFullupdate(true);

                header("Location: " . CFG_WEB_ROOT . "/Fragen/Liste");
            }
        }
    }

    protected function _doInit() {

    }

    private function _fillTemplate(App_Data_Question $objQuestion) {
        $this->_objResponse->UID            = $objQuestion->getUID();
        $this->_objResponse->strQuestion    = $objQuestion->getstrQuestion();
        $this->_objResponse->lngOpttime     = $objQuestion->getlngOpttime();
        $this->_objResponse->lngCountshowed = $objQuestion->getlngCountshowed();
        $this->_objResponse->antwort        = $objQuestion->getAllanswers();
    }

    private function _buildCategoryselect($arrSelected = NULL) {
        $arrCategories  = viewCategory::getAlltopcategories(false);
        $txtCategories  = '';
        $arrSubs        = array();

        if($arrSelected === NULL) {
            $arrSelected = $this->_objRequest->category;
        }

        if(!is_array($arrSelected)) {
            $arrSelected = array();
        }

        foreach($arrCategories as $arrCategory) {
            $strSelected    = '';
            $arrSubs        = viewCategory::getAllsubcategoriesbyparentid($arrCategory['UID'], false);

            if($arrSubs === NULL) {
                if(in_array($arrCategory['UID'], $arrSelected)) {
                    $strSelected = ' selected="selected"';
                }
                $txtCategories .= '<option' . $strSelected . ' value="' . $arrCategory['UID'] . '">' . $arrCategory['strName'] . '</option>';
            } else {
                $txtCategories .= '<optgroup label="' . $arrCategory['strName'] . '">';

                foreach($arrSubs as $arrSub) {
                    if(in_array($arrSub['UID'], $arrSelected)) {
                        $strSelected = ' selected="selected"';
                    } else {
                        $strSelected = '';
                    }
                    $txtCategories .= '<option' . $strSelected . ' value="' . $arrSub['UID'] . '">' . $arrSub['strName'] . '</option>';
                }

                $txtCategories .= '</optgroup>';
            }
        }

        $this->_objResponse->txtCategories      = $txtCategories;
    }

    private function _buildDifficultyselect($tbldifficulty_UID = NULL) {
        $arrDifficulties  = viewDifficulty::getAlldifficulties(false);
        $txtDifficulties  = '';

        if($tbldifficulty_UID === NULL) {
            $tbldifficulty_UID = $this->_objRequest->difficulty;
        }

        foreach($arrDifficulties as $arrDifficulty) {
            $strSelected    = '';

            if($arrDifficulty['UID'] == $tbldifficulty_UID) {
                $strSelected = ' selected="selected"';
            }

            $txtDifficulties .= '<option' . $strSelected . ' value="' . $arrDifficulty['UID'] . '">' . $arrDifficulty['strName'] . '</option>';
        }

        $this->_objResponse->txtDifficulties = $txtDifficulties;
    }

    /**
     * Validate request data for new game
     *
     * @return boolean
     */
    private function _doValidate() {
        $arrErrors = array();

        if(!App_Tools_Validator::hasStringlength($this->_objRequest->strQuestion, 256, 10)) {
            $arrErrors['strQuestion'] = true;
        }

        if(!App_Tools_Validator::notEmpty($this->_objRequest->category)) {
            $arrErrors['category'] = true;
        }

        if(!App_Tools_Validator::notEmpty($this->_objRequest->difficulty)) {
            $arrErrors['difficulty'] = true;
        }

        if(!App_Tools_Validator::hasEnoughanswers($this->_objRequest->antwort)) {
            $arrErrors['antwort'] = true;
        }

        if(!App_Tools_Validator::hasOnerightanswer($this->_objRequest->antwort)) {
            $arrErrors['antwort'] = true;
        }

        return $arrErrors;
    }

    public function getLoeschen() {
        $this->_objResponse->tplContent = 'Fragen_GET_Loeschen';

        viewQuestion::deleteByblndeleted($this->_objRequest->uid);

        header("Location: " . CFG_WEB_ROOT . "/Fragen/Liste");
    }
}

