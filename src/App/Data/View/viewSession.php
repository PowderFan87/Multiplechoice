<?php
class viewSession extends App_Data_View_Base
{
    const VIEW_NAME    = 'tblsessions';
    const VIEW_PK      = 'UID';
    const VIEW_ARCLASS = 'Sessions';

    public static function getAllsessions($blnObjects = true, $arrOrderby = NULL) {
        $strARClass = 'App_Data_' . self::VIEW_ARCLASS;
        $strQuery   = '
SELECT
    tblsessions.UID, tblsessions.dtmStart, tblcategory.strName, tblsessions.lngPoints
FROM
    ' . self::VIEW_NAME . ', tblcategory
WHERE
    tblsessions.tblcategory_UID = tblcategory.UID
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

    public static function getAllsessionsgroupbycategory($blnObjects = true) {
        $strARClass = 'App_Data_' . self::VIEW_ARCLASS;
        $strQuery   = '
SELECT
    tblcategory.strName, COUNT(tblsessions.UID) As "lngPoints"
FROM
    ' . self::VIEW_NAME . ', tblcategory
WHERE
    tblsessions.tblcategory_UID = tblcategory.UID
GROUP BY tblcategory.strName';

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
    
    public static function getCountsessions($blnObjects = true) {
        $strARClass = 'App_Data_' . self::VIEW_ARCLASS;
        $strQuery   = '
SELECT
    COUNT(UID) As lngPoints
FROM
    ' . self::VIEW_NAME;

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
    
    public static function getCountsessionsbypoints($blnObjects = true) {
        $strARClass = 'App_Data_' . self::VIEW_ARCLASS;
        $strQuery   = '
SELECT
    COUNT(UID) As lngPoints
FROM
    ' . self::VIEW_NAME . '
WHERE
    lngPoints > "84"';

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
    
    public static function getSessionsbydate($blnObjects = true) {
        $strARClass = 'App_Data_' . self::VIEW_ARCLASS;
        $strQuery   = '
SELECT
    COUNT(UID) As Anzahl, dtmStart
FROM
    ' . self::VIEW_NAME . '
GROUP BY
    dtmStart';

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