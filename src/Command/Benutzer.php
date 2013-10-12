<?php
class Command_Benutzer extends Core_Base_Command implements IHttpRequest
{
    public function getListe() {
        $this->_objResponse->tplContent = 'Benutzer_GET_Liste';

        $this->_objResponse->arrQuestions = viewQuestion::getAllbackendusers(false);
    }

    protected function _doInit() {

    }
}