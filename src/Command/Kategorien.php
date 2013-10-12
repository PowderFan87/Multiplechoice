<?php
class Command_Kategorien extends Core_Base_Command implements IHttpRequest
{
    public function getListe() {
        $this->_objResponse->tplContent = 'Kategorien_GET_Liste';

        $this->_objResponse->arrQuestions = viewQuestion::getAllcategories(false);
    }

    protected function _doInit() {

    }
}