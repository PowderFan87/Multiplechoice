<?php
class Command_Fragen extends Core_Base_Command implements IHttpRequest
{
    public function getMain() {
        $this->getListe();
    }

    public function getListe() {
        $this->_objResponse->tplContent = 'Fragen_GET_Liste';

        $this->_objResponse->arrQuestions = viewQuestion::getAllquestions(false);
    }

    public function getDetails() {
        $this->_objResponse->tplContent = 'Fragen_GET_Details';

        $objQuestion = viewQuestion::getBypk($this->_objRequest->UID);

        $this->_fillTemplate($objQuestion);
    }

    public function getNeu() {
        $this->_objResponse->tplContent = 'Fragen_GET_Neu';
    }

    public function getBearbeiten() {
        $this->_objResponse->tplContent = 'Fragen_GET_Bearbeiten';

        $objQuestion = viewQuestion::getBypk($this->_objRequest->UID);

        $this->_fillTemplate($objQuestion);
    }

    public function postNeu() {
        $this->_objResponse->tplContent = 'Fragen_POST_Neu';
    }

    public function postBearbeiten() {
        $this->_objResponse->tplContent = 'Fragen_POST_Bearbeiten';

        $objQuestion = viewQuestion::getBypk($this->_objRequest->UID);
    }

    private function _fillTemplate(App_Data_Question $objQuestion) {
        //@TODO Werte setzen

        $this->_objResponse->arrAnswers = $objQuestion->getAllanswers();
    }

    protected function _doInit() {

    }
}