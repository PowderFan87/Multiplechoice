<?php
class Command_Antworten extends Core_Base_Command implements IHttpRequest
{
    public function getListe() {
        $this->_objResponse->tplContent = 'Antworten_GET_Liste';

        $this->_objResponse->arrQuestions = viewQuestion::getAllanswers(false);
    }

    protected function _doInit() {

    }
}