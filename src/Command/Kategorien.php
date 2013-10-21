<?php
class Command_Kategorien extends Core_Base_Command implements IHttpRequest, IRestricted
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
        $this->_objResponse->tplContent = 'Kategorien_GET_Liste';

        if($this->_objRequest->order != '') {
            if(isset($_SESSION['lastOrder']) && $_SESSION['lastOrder'][0] == $this->_objRequest->order) {
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

            $this->_objResponse->arrCategories = viewCategory::getAllcategories(false, $arrOrder);
        } else {
            $this->_objResponse->arrCategories = viewCategory::getAllcategories(false);
        }
    }

     public function getDetails() {
        $this->_objResponse->tplContent = 'Kategorien_GET_Details';

        $objCategory = viewCategory::getBypk($this->_objRequest->UID);

        $this->_fillTemplate($objCategory);
    }

    public function getNeu() {
        $this->_objResponse->tplContent = 'Kategorien_GET_Neu';

        $arrCategories  = viewCategory::getAlltopcategories(false);
        $txtCategories  = '';
        $arrSubs        = array();

        foreach($arrCategories as $arrCategory) {
            $arrSubs = viewCategory::getAllsubcategoriesbyparentid($arrCategory['UID'], false);

            if($arrSubs === NULL) {
                $txtCategories .= '<option value="' . $arrCategory['UID'] . '">' . $arrCategory['strName'] . '</option>';
            } else {
                $txtCategories .= '<optgroup label="' . $arrCategory['strName'] . '">';

                foreach($arrSubs as $arrSub) {
                    $txtCategories .= '<option value="' . $arrSub['UID'] . '">' . $arrSub['strName'] . '</option>';
                }

                $txtCategories .= '</optgroup>';
            }
        }

        $this->_objResponse->txtCategories      = $txtCategories;
    }

    public function getBearbeiten() {
        $this->_objResponse->tplContent = 'Kategorien_GET_Bearbeiten';

        $objCategory = viewCategory::getBypk($this->_objRequest->UID);

        $this->_fillTemplate($objCategory);
    }

    public function postNeu() {
        $this->_objResponse->tplContent = 'Kategorien_POST_Neu';

        $arrErrors  = $this->_doValidate();

        if(!empty($arrErrors)) {
            $this->_objResponse->tplContent             = 'Kategorien_GET_Neu';

            $this->_objResponse->executed = true;

            foreach($arrErrors as $strField => $blnError) {
                if(!$blnError) {
                    continue;
                }

                $strErrorvariable = 'ERROR_' . $strField;

                $this->_objResponse->$strErrorvariable = 'error';
            }

            $this->_objResponse->strName        = $this->_objRequest->strName;
            $this->_objResponse->lngParentid    = $this->_objRequest->lngParentid;

            $this->_buildCategoryselect();
        } else {
            $objQuestion = new App_Data_Category();

            $objQuestion->setstrName($this->_objRequest->strName);
            $objQuestion->setlngParentid($this->_objRequest->lngParentid);
/*
            //STATIC PART!!!
            $objQuestion->settblbackenduser_UID(1);
            //CHANGE!!!

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
*/
                $objQuestion->doFullupdate(true);
            
        }
    }

    public function postBearbeiten() {
        $this->_objResponse->tplContent = 'Kategorien_POST_Bearbeiten';

        $objCategory = viewCategory::getBypk($this->_objRequest->UID);

        $arrErrors  = $this->_doValidate();

        if(!empty($arrErrors)) {
            $this->_objResponse->tplContent = 'Kategorien_GET_Bearbeiten';

            foreach($arrErrors as $strField => $blnError) {
                if(!$blnError) {
                    continue;
                }

                $strErrorvariable = 'ERROR_' . $strField;

                $this->_objResponse->$strErrorvariable = 'error';
            }

            $this->_objResponse->UID            = $objCategory->getUID();
            $this->_objResponse->strName        = $this->_objRequest->strName;
            $this->_objResponse->lngParentid    = $this->_objRequest->lngParentid;

            $this->_buildCategoryselect();
        } else {
            $objCategory->setstrQuestion($this->_objRequest->strQuestion);
            $objCategory->setlngOpttime($this->_objRequest->lngOpttime);
/*
            //STATIC PART!!!
            $objQuestion->settblbackenduser_UID(1);
            //CHANGE!!!

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
*/
                $objQuestion->doFullupdate(true);
            
        }
    }

    private function _fillTemplate(App_Data_Category $objCategory) {
        $this->_objResponse->UID            = $objQuestion->getUID();
        $this->_objResponse->strName        = $objQuestion->getstrName();
        $this->_objResponse->lngParentid    = $objQuestion->getlngParentid();
    }

    protected function _doInit() {

    }
    
    private function _doValidate() {
        $arrErrors = array();

        if(!App_Tools_Validator::notEmpty($this->_objRequest->strName)) {
            $arrErrors['strName'] = true;
        }

        return $arrErrors;
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
}