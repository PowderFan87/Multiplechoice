<?php
class Command_Kategorien extends Core_Base_Command implements IHttpRequest
{
    public function getMain() {
        $this->getListe();
    }

    public function getListe() {
        $this->_objResponse->tplContent = 'Kategorien_GET_Liste';

        $this->_objResponse->arrCategories = viewCategory::getAllcategories(false);
    }

     public function getDetails() {
        $this->_objResponse->tplContent = 'Kategorien_GET_Details';

        $objCategory = viewCategory::getBypk($this->_objRequest->UID);

        $this->_fillTemplate($objCategory);
    }

    public function getNeu() {
        $this->_objResponse->tplContent = 'Kategorien_GET_Neu';

        $arrCategories  = viewCategory::getAlltopcategories(false);
        $txtCategories  = '';
        $arrSubs        = array();

        foreach($arrCategories as $arrCategory) {
            $arrSubs = viewCategory::getAllsubcategoriesbyparentid($arrCategory['UID'], false);

            if($arrSubs === NULL) {
                $txtCategories .= '<option value="' . $arrCategory['UID'] . '">' . $arrCategory['strName'] . '</option>';
            } else {
                $txtCategories .= '<optgroup label="' . $arrCategory['strName'] . '">';

                foreach($arrSubs as $arrSub) {
                    $txtCategories .= '<option value="' . $arrSub['UID'] . '">' . $arrSub['strName'] . '</option>';
                }

                $txtCategories .= '</optgroup>';
            }
        }

        $this->_objResponse->txtCategories      = $txtCategories;
    }

    public function getBearbeiten() {
        $this->_objResponse->tplContent = 'Kategorien_GET_Bearbeiten';

        $objCategory = viewCategory::getBypk($this->_objRequest->UID);

        $this->_fillTemplate($objCategory);
    }

    public function postNeu() {
        $this->_objResponse->tplContent = 'Kategorien_POST_Neu';
    }

    public function postBearbeiten() {
        $this->_objResponse->tplContent = 'Kategorien_POST_Bearbeiten';

        $objCategory = viewCategory::getBypk($this->_objRequest->UID);
    }

    private function _fillTemplate(App_Data_Category $objCategory) {
        //@TODO Werte setzen

        $this->_objResponse->arrCategories = $objCategory->getAllcategories();
    }

    protected function _doInit() {

    }
}