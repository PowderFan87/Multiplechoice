<?php
class Command_Benutzer extends Core_Base_Command implements IHttpRequest, IRestricted
{
    public static function getRestriction() {
        return 'App_Web_Security::isAuthenticated';
    }

    public function getFallback() {
        $this->_objResponse->tplContent = 'Benutzer_GET_Fallback';

        $this->_objResponse->strFoo = 'You are not logged in';
        $this->_objResponse->strTitle .= ' - Not logged in';
    }

    public function getMain() {
        $this->getListe();
    }

    public function getListe() {
        $this->_objResponse->tplContent = 'Benutzer_GET_Liste';

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

            $this->_objResponse->arrBackendusers = viewBackenduser::getAllbackendusers(false, $arrOrder);
        } else {
            $this->_objResponse->arrBackendusers = viewBackenduser::getAllbackendusers(false);
        }
    }

    public function getDetails() {
        $this->_objResponse->tplContent = 'Benutzer_GET_Details';

        $objBackenduser = viewBackenduser::getBypk($this->_objRequest->UID);

        $this->_fillTemplate($objBackenduser);
    }

    public function getNeu() {
        $this->_objResponse->tplContent = 'Benutzer_GET_Neu';
    }

    public function getBearbeiten() {
        $this->_objResponse->tplContent = 'Benutzer_GET_Bearbeiten';

        $objBackenduser = viewBackenduser::getBypk($this->_objRequest->UID);

        $this->_fillTemplate($objBackenduser);
    }

    public function postNeu() {
        $this->_objResponse->tplContent = 'Benutzer_POST_Neu';

        $arrErrors  = $this->_doValidate();

        if(!empty($arrErrors)) {
            $this->_objResponse->tplContent = 'Benutzer_GET_Neu';

            $this->_objResponse->executed = true;

            foreach($arrErrors as $strField => $blnError) {
                if(!$blnError) {
                    continue;
                }

                $strErrorvariable = 'ERROR_' . $strField;

                $this->_objResponse->$strErrorvariable = 'error';
            }

            $this->_objResponse->strName    = $this->_objRequest->strName;
        } else {
            $objBackenduser = new App_Data_Backenduser();

            $objBackenduser->setstrName($this->_objRequest->strName);

            if(!$objBackenduser->doInsert()) {
                $this->_objResponse->strMessage = 'FEHLER!!!';
            } else {
                header("Location: " . CFG_WEB_ROOT . "/Benutzer/Liste");
            }
        }
    }

    public function postBearbeiten() {
        $this->_objResponse->tplContent = 'Benutzer_POST_Bearbeiten';

        $arrErrors  = $this->_doValidate();

        if(!empty($arrErrors)) {
            $this->_objResponse->tplContent = 'Benutzer_GET_Bearbeiten';

            $this->_objResponse->executed = true;

            foreach($arrErrors as $strField => $blnError) {
                if(!$blnError) {
                    continue;
                }

                $strErrorvariable = 'ERROR_' . $strField;

                $this->_objResponse->$strErrorvariable = 'error';
            }

            $this->_objResponse->strName    = $this->_objRequest->strName;
        } else {
            $objBackenduser = viewBackenduser::getBypk($this->_objRequest->UID);

            $objBackenduser->setstrName($this->_objRequest->strName);

            if(!$objBackenduser->doFullupdate()) {
                $this->_objResponse->strMessage = 'FEHLER!!!';
            } else {
                header("Location: " . CFG_WEB_ROOT . "/Benutzer/Liste");
            }
        }
    }

    private function _fillTemplate(App_Data_Backenduser $objBackenduser) {
        $this->_objResponse->UID        = $objBackenduser->getUID();
        $this->_objResponse->strName    = $objBackenduser->getstrName();
    }

    protected function _doInit() {

    }

     protected function _doValidate() {
        $arrErrors = array();

        if(!App_Tools_Validator::hasStringlength($this->_objRequest->strName, 256, 5)) {
            $arrErrors['strName'] = true;
        }

        return $arrErrors;
    }
    
    public function getLoeschen() {
        $this->_objResponse->tplContent = 'Benutzer_GET_Loeschen';

        viewBackenduser::deleteBypk($this->_objRequest->uid);
        
        header("Location: " . CFG_WEB_ROOT . "/Benutzer/Liste");
    }
}