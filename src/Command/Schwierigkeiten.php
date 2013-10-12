<?php
class Command_Schwierigkeiten extends Core_Base_Command implements IHttpRequest
{
    public function getListe() {
        $this->_objResponse->tplContent = 'Schwierigkeiten_GET_Liste';

        $this->_objResponse->arrQuestions = viewQuestion::getAlldifficulties(false);
    }

    protected function _doInit() {

    }
}