<?php
class Command_Schwierigkeiten extends Core_Base_Command implements IHttpRequest, IRestricted
{
    public static function getRestriction() {
        return 'App_Web_Security::isAuthenticated';
    }

    public function getFallback() {
        $this->_objResponse->tplContent = 'Schwierigkeiten_GET_Fallback';

        $this->_objResponse->strFoo = 'You are not logged in';
        $this->_objResponse->strTitle .= ' - Not logged in';
    }

    public function getMain() {
        $this->getListe();
    }

    public function getListe() {
        $this->_objResponse->tplContent = 'Schwierigkeiten_GET_Liste';

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

            $this->_objResponse->arrDifficulties = viewDifficulty::getAlldifficulties(false, $arrOrder);
        } else {
            $this->_objResponse->arrDifficulties = viewDifficulty::getAlldifficulties(false);
        }
    }

    public function getDetails() {
        $this->_objResponse->tplContent = 'Schwierigkeiten_GET_Details';

        $objDifficulty = viewDifficulty::getBypk($this->_objRequest->UID);

        $this->_fillTemplate($objDifficulty);
    }

    public function getNeu() {
        $this->_objResponse->tplContent = 'Schwierigkeiten_GET_Neu';

        $this->_objResponse->lngTime = 0;
    }

    public function getBearbeiten() {
        $this->_objResponse->tplContent = 'Schwierigkeiten_GET_Bearbeiten';

        $objDifficulty = viewDifficulty::getBypk($this->_objRequest->UID);

        $this->_fillTemplate($objDifficulty);
    }

    public function postNeu() {
        $this->_objResponse->tplContent = 'Schwierigkeiten_POST_Neu';

        $arrErrors  = $this->_doValidate();

        if(!empty($arrErrors)) {
            $this->_objResponse->tplContent = 'Schwierigkeiten_GET_Neu';

            $this->_objResponse->executed = true;

            foreach($arrErrors as $strField => $blnError) {
                if(!$blnError) {
                    continue;
                }

                $strErrorvariable = 'ERROR_' . $strField;

                $this->_objResponse->$strErrorvariable = 'error';
            }

            $this->_objResponse->strName    = $this->_objRequest->strName;
            $this->_objResponse->lngTime    = $this->_objRequest->lngTime;
        } else {
            $objDifficulty = new App_Data_Difficulty();

            $objDifficulty->setstrName($this->_objRequest->strName);
            $objDifficulty->setlngTime($this->_objRequest->lngTime);

            if(!$objDifficulty->doInsert()) {
                $this->_objResponse->strMessage = 'FEHLER!!!';
            } else {
                header("Location: " . CFG_WEB_ROOT . "/Schwierigkeiten/Liste");
            }
        }
    }

    public function postBearbeiten() {
        $this->_objResponse->tplContent = 'Schwierigkeiten_POST_Bearbeiten';

        $arrErrors  = $this->_doValidate();

        if(!empty($arrErrors)) {
            $this->_objResponse->tplContent = 'Schwierigkeiten_GET_Bearbeiten';

            $this->_objResponse->executed = true;

            foreach($arrErrors as $strField => $blnError) {
                if(!$blnError) {
                    continue;
                }

                $strErrorvariable = 'ERROR_' . $strField;

                $this->_objResponse->$strErrorvariable = 'error';
            }

            $this->_objResponse->strName    = $this->_objRequest->strName;
            $this->_objResponse->lngTime    = $this->_objRequest->lngTime;
        } else {
            $objDifficulty = viewDifficulty::getBypk($this->_objRequest->UID);

            $objDifficulty->setstrName($this->_objRequest->strName);
            $objDifficulty->setlngTime($this->_objRequest->lngTime);

            if(!$objDifficulty->doFullupdate()) {
                $this->_objResponse->strMessage = 'FEHLER!!!';
            } else {
                header("Location: " . CFG_WEB_ROOT . "/Schwierigkeiten/Liste");
            }
        }
    }

    private function _fillTemplate(App_Data_Difficulty $objDifficulty) {
        $this->_objResponse->UID        = $objDifficulty->getUID();
        $this->_objResponse->strName    = $objDifficulty->getstrName();
        $this->_objResponse->lngTime    = $objDifficulty->getlngTime();
    }

    protected function _doInit() {

    }

    protected function _doValidate() {
        $arrErrors = array();

        if(!App_Tools_Validator::hasStringlength($this->_objRequest->strName, 256, 5)) {
            $arrErrors['strName'] = true;
        }

        if(!App_Tools_Validator::isLarger($this->_objRequest->lngTime, 5)) {
            $arrErrors['lngTime'] = true;
        }

        return $arrErrors;
    }
    
    public function getLoeschen() {
        $this->_objResponse->tplContent = 'Schwierigkeiten_GET_Loeschen';

        viewDifficulty::deleteBypk($this->_objRequest->uid);
        
        header("Location: " . CFG_WEB_ROOT . "/Schwierigkeiten/Liste");
    }
}