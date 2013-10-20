<?php
class Command_Statistiken extends Core_Base_Command implements IHttpRequest, IRestricted
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
        $this->_objResponse->tplContent = 'Statistiken_GET_Liste';

        $this->_objResponse->arrSessions = viewSession::getAllsessions(false);

        $this->_objResponse->arrStatsessions = viewSession::getAllsessionsgroupbycategory(false);;
    }

    public function getDetails() {
        $this->_objResponse->tplContent = 'Statistiken_GET_Details';

        $objSession = viewSession::getBypk($this->_objRequest->UID);

        $this->_fillTemplate($objSession);
    }

    public function getBearbeiten() {
        $this->_objResponse->tplContent = 'Statistiken_GET_Bearbeiten';

        $objSession = viewSession::getBypk($this->_objRequest->UID);

        $this->_fillTemplate($objSession);
    }

    private function _fillTemplate(App_Data_Session $objSession) {
        $this->_objResponse->UID        = $objSession->getUID();
        $this->_objResponse->dtmStart    = $objSession->getdtmStart();
        $this->_objResponse->lngPoints  = $objSession->getlngPoints();
        $this->_objResponse->tblcategory_UID    = $objSession->gettblcategory_UID();
    }

    protected function _doInit() {

    }

    protected function _doValidate() {
        $arrErrors = array();

        return $arrErrors;
    }
}