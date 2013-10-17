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
/*
        $objQuestion = viewQuestion::getBypk(1);
        $this->_objResponse->strQuestion = $objQuestion->getstrQuestion();

        $objAnswer = viewAnswer::getBypk(1);
        $this->_objResponse->strAnswer = $objAnswer->getstrAnswer();
        
        $objBackenduser = viewBackenduser::getBypk(1);
        $this->_objResponse->strBackenduser = $objQuestion->getstrBackenduser();
        
        $objQuestion = viewCategory::getBypk(1);
        $this->_objResponse->strCategory = $objQuestion->getstrCategory();
        
        $objQuestion = viewDifficulty::getBypk(1);
        $this->_objResponse->strDifficulty = $objQuestion->getstrDifficulty();
       */ 
//        $objQuestion->setstrQuestion('Ja das war ne Frage?');
//        $objQuestion->doFullupdate();
//
//        unset($objQuestion);
//
//        $objQuestion = viewQuestion::getBypk(1);
//
//        $this->_objResponse->strQuestion2 = $objQuestion->getstrQuestion();
//
//        $objNewquestion = new App_Data_Question();
//
//        $objNewquestion->setstrQuestion('Neue Frage oder?');
//        $objNewquestion->settbldifficulty_UID(1);
//        $objNewquestion->settblbackenduser_UID(1);
//
//        $objNewquestion->doInsert();
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

    /**
     * Basic init methode
     *
     */
    protected function _doInit() {
        $this->_objResponse->strTitle = 'Main';
    }
}