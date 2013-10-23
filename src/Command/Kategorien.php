<?php
class Command_Kategorien extends Core_Base_Command implements IHttpRequest, IRestricted
{
    public static function getRestriction() {
        return 'App_Web_Security::isAuthenticated';
    }

    public function getFallback() {
        $this->_objResponse->tplContent = 'Kategorien_GET_Fallback';

        $this->_objResponse->strFoo = 'You are not logged in';
        $this->_objResponse->strTitle .= ' - Not logged in';
    }

    public function getMain() {
        $this->getListe();
    }

    public function getListe() {
        $this->_objResponse->tplContent = 'Kategorien_GET_Liste';

        if($this->_objRequest->order != '') {
            if(isset($_SESSION['lastOrder']) && $_SESSION['lastOrder'][0] == $this->_objRequest->order) {
                $arrOrder = array(
                    $this->_objRequest->order,
                    ($_SESSION['lastOrder'][1] == 1)?0:1
                );
            } else {
                $arrOrder = array(
                    $this->_objRequest->order,
                    1
                );
            }

            $_SESSION['lastOrder'] = $arrOrder;

            $this->_objResponse->arrCategories = viewCategory::getAllcategories(false, $arrOrder);
        } else {
            $this->_objResponse->arrCategories = viewCategory::getAllcategories(false);
        }
    }

     public function getDetails() {
        $this->_objResponse->tplContent = 'Kategorien_GET_Details';

        $objCategory = viewCategory::getBypk($this->_objRequest->uid);

        $this->_fillTemplate($objCategory);
    }

    public function getNeu() {
        $this->_objResponse->tplContent = 'Kategorien_GET_Neu';

        $arrCategories  = viewCategory::getAlltopcategories(false);
        $txtCategories  = '';

        foreach($arrCategories as $arrCategory) {
           $txtCategories .= '<option value="' . $arrCategory['UID'] . '">' . $arrCategory['strName'] . '</option>';
        }

        $this->_objResponse->txtCategories      = $txtCategories;
    }

    public function getBearbeiten() {
        $this->_objResponse->tplContent = 'Kategorien_GET_Bearbeiten';

        $objCategory = viewCategory::getBypk($this->_objRequest->uid);

        $this->_fillTemplate($objCategory);
    }

    public function postNeu() {
        $this->_objResponse->tplContent = 'Kategorien_POST_Neu';

        $arrErrors  = $this->_doValidate();

        if(!empty($arrErrors)) {
            $this->_objResponse->tplContent = 'Kategorien_GET_Neu';

            $this->_objResponse->executed = true;

            foreach($arrErrors as $strField => $blnError) {
                if(!$blnError) {
                    continue;
                }

                $strErrorvariable = 'ERROR_' . $strField;

                $this->_objResponse->$strErrorvariable = 'error';
            }

            $this->_objResponse->strName        = $this->_objRequest->strName;
            $this->_objResponse->lngParentid    = $this->_objRequest->lngParentid;

            $arrCategories  = viewCategory::getAlltopcategories(false);
            $txtCategories  = '';

            foreach($arrCategories as $arrCategory) {
               $txtCategories .= '<option value="' . $arrCategory['UID'] . '">' . $arrCategory['strName'] . '</option>';
            }

            $this->_objResponse->txtCategories = $txtCategories;
        } else {
            $objCategory = new App_Data_Category();

            $objCategory->setstrName($this->_objRequest->strName);
            if($this->_objRequest->lngParentid > 0) {
                $objCategory->setlngParentid($this->_objRequest->lngParentid);
            } else {
                $objCategory->setlngParentid(NULL);
            }

            $objCategory->doInsert();
        }
    }

    public function postBearbeiten() {
        $this->_objResponse->tplContent = 'Kategorien_POST_Bearbeiten';

        $objCategory = viewCategory::getBypk($this->_objRequest->UID);

        $arrErrors  = $this->_doValidate();

        if(!empty($arrErrors)) {
            $this->_objResponse->tplContent = 'Kategorien_GET_Bearbeiten';

            foreach($arrErrors as $strField => $blnError) {
                if(!$blnError) {
                    continue;
                }

                $strErrorvariable = 'ERROR_' . $strField;

                $this->_objResponse->$strErrorvariable = 'error';
            }

            $this->_objResponse->UID            = $objCategory->getUID();
            $this->_objResponse->strName        = $this->_objRequest->strName;
            $this->_objResponse->lngParentid    = $this->_objRequest->lngParentid;

            $arrCategories  = viewCategory::getAlltopcategories(false);
            $txtCategories  = '';

            foreach($arrCategories as $arrCategory) {
               $txtCategories .= '<option value="' . $arrCategory['UID'] . '">' . $arrCategory['strName'] . '</option>';
            }

            $this->_objResponse->txtCategories = $txtCategories;
        } else {
            $objCategory->setstrName($this->_objRequest->strName);
            $objCategory->setlngOpttime($this->_objRequest->lngOpttime);

            $objCategory->doFullupdate(true);
        }
    }

    private function _fillTemplate(App_Data_Category $objCategory) {
        $this->_objResponse->UID            = $objCategory->getUID();
        $this->_objResponse->strName        = $objCategory->getstrName();

        $arrCategories  = viewCategory::getAlltopcategories(false);
        $txtCategories  = '';

        foreach($arrCategories as $arrCategory) {
            $strSelected = '';

            if($arrCategory['UID'] === $objCategory->getlngParentid()) {
                $strSelected = ' selected="selected"';
            }

            $txtCategories .= '<option value="' . $arrCategory['UID'] . '"' . $strSelected . '>' . $arrCategory['strName'] . '</option>';
        }

        $this->_objResponse->txtCategories = $txtCategories;
    }

    protected function _doInit() {

    }

    private function _doValidate() {
        $arrErrors = array();

        if(!App_Tools_Validator::notEmpty($this->_objRequest->strName)) {
            $arrErrors['strName'] = true;
        }

        return $arrErrors;
    }

    public function getLoeschen() {
        $this->_objResponse->tplContent = 'Kategorien_GET_Loeschen';

        viewBackenduser::deleteBypk($this->_objRequest->uid);

        header("Location: " . CFG_WEB_ROOT . "/Kategorien/Liste");
    }
}