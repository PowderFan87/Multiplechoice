<?php
class Command_Antworten extends Core_Base_Command implements IHttpRequest
{
    public function getMain() {
        $this->getListe();
    }
    
    public function getListe() {
        $this->_objResponse->tplContent = 'Antworten_GET_Liste';

        $this->_objResponse->arrAnswers= viewAnswer::getAllanswers(false);
    }

    public function getDetails() {
        $this->_objResponse->tplContent = 'Antworten_GET_Details';

        $objAnswer = viewAnswer::getBypk($this->_objRequest->UID);

        $this->_fillTemplate($objAnswer);
    }

    public function getNeu() {
        $this->_objResponse->tplContent = 'Antworten_GET_Neu';
    }

    public function getBearbeiten() {
        $this->_objResponse->tplContent = 'Antworten_GET_Bearbeiten';

        $objAnswer = viewAnswer::getBypk($this->_objRequest->UID);

        $this->_fillTemplate($objAnswer);
    }

    public function postNeu() {
        $this->_objResponse->tplContent = 'Antworten_POST_Neu';
    }

    public function postBearbeiten() {
        $this->_objResponse->tplContent = 'Antworten_POST_Bearbeiten';

        $objAnswer = viewAnswer::getBypk($this->_objRequest->UID);
    }

    private function _fillTemplate(App_Data_Answer $objAnswer) {
        //@TODO Werte setzen

        $this->_objResponse->arrAnswers = $objAnswer->getAllanswers();
    }
    
    protected function _doInit() {

    }
}