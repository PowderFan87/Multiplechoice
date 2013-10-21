<?php
class viewBackenduser extends App_Data_View_Base
{
    const VIEW_NAME    = 'tblbackenduser';
    const VIEW_PK      = 'UID';
    const VIEW_ARCLASS = 'Backenduser';

    public static function getAllbackendusers($blnObjects = true, $arrOrderby = NULL) {
        $strARClass = 'App_Data_' . self::VIEW_ARCLASS;
        $strQuery   = '
SELECT
    *
FROM
    ' . self::VIEW_NAME . '
';

        if(is_array($arrOrderby)) {
            $strQuery .= 'ORDER BY ' . $arrOrderby[0] . ' ' . (($arrOrderby[1] === 1)?'ASC':'DESC');
        }

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

    public static function getUserbystrname($strName) {
        $strARClass = 'App_Data_' . self::VIEW_ARCLASS;
        $strQuery   = '
SELECT
    *
FROM
    ' . self::VIEW_NAME . '
WHERE
    strName = \'' . $strName . '\'';

        try {
            $arrData = App_Factory_Resource::getResource()->readSingle($strQuery);

            if(empty($arrData)) {
                return NULL;
            }

            return new $strARClass($arrData);
        } catch (Resource_Exception $e) {
            return NULL;
        }
    }
    
    public static function deleteUserbyuid($UID) {
        $strARClass = 'App_Data_' . self::VIEW_ARCLASS;
        $strQuery   = '
DELETE
    *
FROM
    ' . self::VIEW_NAME . '
WHERE
    UID = \'' . $UID . '\'';

        try {
            $arrData = App_Factory_Resource::getResource()->readSingle($strQuery);

            if(empty($arrData)) {
                return NULL;
            }

            return new $strARClass($arrData);
        } catch (Resource_Exception $e) {
            return NULL;
        }
    }
}