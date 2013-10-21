<?php
class App_Data_Question extends App_Data_Base
{
    const   VIEW_CLASS  = 'viewQuestion';
    const   VIEW_PK     = 'UID';

    private $_arrDependencies   = array();

    public function getAllanswers() {
        $arrAnswers = viewAnswer::getAllAnswersByQuestionUID($this->getUID(), false);

        foreach($arrAnswers as $lngKey => $arrAnswer) {
            if($arrAnswer['blnTrue']) {
                $arrAnswers[$lngKey]['blnTrue'] = 'checked';
            } else {
                $arrAnswers[$lngKey]['blnTrue'] = '';
            }
        }

        return $arrAnswers;
    }

    public function addAnswer(App_Data_Answer $objAnswer) {
        $objAnswer->settblquestion_UID($this->getUID());

        $this->_arrDependencies[] = $objAnswer;
    }

    public function getCategorymap($blnString = false) {
        $arrReturn  = array();
        if(!$blnString) {
            $strQuery   = 'SELECT tblcategory_UID FROM tblquestion_has_tblcategory WHERE tblquestion_UID = ' . $this->getUID();
        } else {
            $strQuery   = '
SELECT tblcategory.strName AS strName
FROM tblquestion_has_tblcategory
LEFT JOIN tblcategory ON ( tblcategory.UID = tblquestion_has_tblcategory.tblcategory_UID )
WHERE tblquestion_UID = ' . $this->getUID();
        }

        try {
            $arrCategories = App_Factory_Resource::getResource()->read($strQuery, true);

            foreach($arrCategories as $arrCategory) {
                if(!$blnString) {
                    $arrReturn[] = $arrCategory['tblcategory_UID'];
                } else {
                    $arrReturn[] = $arrCategory['strName'];
                }
            }

            return $arrReturn;
        } catch (Exception $e) {
            return array();
        }
    }

    public function addCategory($lngCategoryid) {
        $arrData = array(
            'tblquestion_UID' => $this->getUID(),
            'tblcategory_UID' => $lngCategoryid
        );

        App_Factory_Resource::getResource()->insert($arrData, 'tblquestion_has_tblcategory');
    }

    public function removeCategory($lngCategoryid) {
        $strQuery = 'DELETE FROM tblquestion_has_tblcategory WHERE tblcategory_UID = ' . $lngCategoryid;

        App_Factory_Resource::getResource()->exec($strQuery);
    }

    public function doFullupdate($blnDependencies = false) {
        if($blnDependencies) {
            foreach($this->_arrDependencies as $objDependence) {
                if(!$objDependence->getUID()) {
                    $objDependence->doInsert();
                } else {
                    $objDependence->doFullupdate();
                }
            }
        }

        return parent::doFullupdate();
    }

    protected function _getEmpryarray() {
        return array(
            'strQuestion'           => '',
            'lngCountshowed'        => 0,
            'lngOpttime'            => 0,
            'tbldifficulty_UID'     => NULL,
            'tblbackenduser_UID'    => NULL
        );
    }
}