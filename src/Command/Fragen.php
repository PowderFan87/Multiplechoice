<?php
/**
 * Description of Fragen
 *
 * @author Holger Szüsz <hszuesz@live.com>
 */
class Command_Fragen extends Core_Base_Command implements IHttpRequest
{
    public function getListe() {
        $this->_objResponse->tplContent = 'Fragen_GET_Liste';

        $this->_objResponse->arrQuestions = viewQuestion::getAllquestions(false);
    }

    protected function _doInit() {

    }
}