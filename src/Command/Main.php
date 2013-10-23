<?php
class Command_Main extends Core_Base_Command implements IHttpRequest
{
    /**
     * Main action for application
     *
     */
    public function getMain() {
        $this->_objResponse->tplContent     = 'Main_GET_Main';

        $this->_objResponse->strTitle       .= ' - Home';
        $this->_objResponse->strWellcome    = 'Willkommen im Verwaltungstool der Multiple Choice-Prüfungssoftware';
    }

    /**
     * 404 fallback action for application
     *
     */
    public function get404() {
        $this->_objResponse->tplContent    = 'Main_GET_404';

        $this->_objResponse->strTitle       .= ' - 404';
        $this->_objResponse->strWellcome    = 'Oops! Seite ist nicht vorhanden ...';
    }

    public function getLogout() {
        App_Factory_Security::getSecurity()->doDestroysession();
        
        header("Location: " . CFG_WEB_ROOT . "/Main");
    }

    public function postLogin() {
        $this->_objResponse->tplContent    = 'Main_POST_Login';

        if(!App_Factory_Security::getSecurity()->tryLogin($this->_objRequest->strName)) {
            $this->_objResponse->strMessage = "Nicht eingeloggt!";
        } else {
            $this->_objResponse->strMessage = "Eingeloggt!";
            
            header("Location: " . CFG_WEB_ROOT . "/Fragen/Liste");
        }
    }

    /**
     * Basic init methode
     *
     */
    protected function _doInit() {
        $this->_objResponse->strTitle = 'Main';
    }
}