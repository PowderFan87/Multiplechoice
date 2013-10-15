<?php
class Command_Benutzer extends Core_Base_Command implements IHttpRequest
{
    public function getMain() {
        $this->getListe();
    }
    
    public function getListe() {
        $this->_objResponse->tplContent = 'Benutzer_GET_Liste';

        $this->_objResponse->arrBackendusers = viewBackenduser::getAllbackendusers(false);
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
    }

    public function postBearbeiten() {
        $this->_objResponse->tplContent = 'Benutzer_POST_Bearbeiten';

        $objBackenduser = viewBackenduser::getBypk($this->_objRequest->UID);
    }

    private function _fillTemplate(App_Data_Category $objBackenduser) {
        //@TODO Werte setzen

        $this->_objResponse->arrBackendusers = $objBackenduser->getAllbackendusers();
    }
    
    protected function _doInit() {

    }
}