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

        $objCDifficulty = viewDifficulty::getBypk($this->_objRequest->UID);

        $this->_fillTemplate($objDifficulty);
    }

    public function getNeu() {
        $this->_objResponse->tplContent = 'Schwierigkeiten_GET_Neu';
    }

    public function getBearbeiten() {
        $this->_objResponse->tplContent = 'Schwierigkeiten_GET_Bearbeiten';

        $objDifficulty = viewDifficulty::getBypk($this->_objRequest->UID);

        $this->_fillTemplate($objDifficulty);
    }

    public function postNeu() {
        $this->_objResponse->tplContent = 'Schwierigkeiten_POST_Neu';
    }

    public function postBearbeiten() {
        $this->_objResponse->tplContent = 'Schwierigkeiten_POST_Bearbeiten';

        $objDifficulty = viewDifficulty::getBypk($this->_objRequest->UID);
    }

    private function _fillTemplate(App_Data_Category $objDifficulty) {
        //@TODO Werte setzen

        $this->_objResponse->arrDifficulties = $objDifficulty->getAlldifficulties();
    }
    
    protected function _doInit() {

    }
}