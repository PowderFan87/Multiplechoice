<?php
class Command_Schwierigkeiten extends Core_Base_Command implements IHttpRequest
{
    public function getMain() {
        $this->getListe();
    }

    public function getListe() {
        $this->_objResponse->tplContent = 'Schwierigkeiten_GET_Liste';

        $this->_objResponse->arrDifficulties = viewDifficulty::getAlldifficulties(false);
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
}