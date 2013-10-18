<?php
class viewSession extends App_Data_View_Base
{
    const VIEW_NAME    = 'tblsessions';
    const VIEW_PK      = 'UID';
    const VIEW_ARCLASS = 'Sessions';

    public static function getAllsessions($blnObjects = true) {
        $strARClass = 'App_Data_' . self::VIEW_ARCLASS;
        $strQuery   = '
SELECT
    tblcategory.strName, tblsessions.lngPoints
FROM
    ' . self::VIEW_NAME . ', tblcategory
WHERE 
    tblsessions.tblcategory_UID = tblcategory.UID';

        try {
            $arrData        = App_Factory_Resource::getResource()->read($strQuery, true);

            if($blnObjects) {
                $arrResponse    = array();

                foreach($arrData as $arrRow) {
                    $arrResponse[] = new $strARClass($arrRow);
                }

                return $arrResponse;
            } else {
                return $arrData;
            }
        } catch (Resource_Exception $e) {
            return NULL;
        }
    }
}