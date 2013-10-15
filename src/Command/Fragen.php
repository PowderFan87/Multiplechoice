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

        $arrErrors  = $this->_doValidate();

        if(!empty($arrErrors)) {
            $this->_objResponse->tplContent = 'Fragen_GET_Neu';

            foreach($arrErrors as $strField => $blnError) {
                if(!$blnError) {
                    continue;
                }

                $strErrorvariable = 'ERROR_' . $strField;

                $this->_objResponse->$strErrorvariable = 'error';
            }
        } else {
            //@TODO create new question
        }
    }

    public function postBearbeiten() {
        $this->_objResponse->tplContent = 'Fragen_POST_Bearbeiten';

        $objQuestion = viewQuestion::getBypk($this->_objRequest->UID);
    }

    private function _fillTemplate(App_Data_Question $objQuestion) {

        $this->_objResponse->UID            = $objQuestion->getUID();
        $this->_objResponse->strQuestion    = $objQuestion->getstrQuestion();
        $this->_objResponse->lngOpttime     = $objQuestion->getlngOpttime();

        //@TODO set values for diff, and category

        $this->_objResponse->arrQuestions = $objQuestion->getAllquestions();
    }

    protected function _doInit() {

    }

    /**
     * Validate request data for new game
     *
     * @return boolean
     */
    private function _doValidate() {
        $arrErrors = array();

        if(!App_Tools_Validator::hasStringlength($this->_objRequest->strQuestion, 256, 20)) {
            $arrErrors['strName'] = true;
        }

        return $arrErrors;
    }
}
