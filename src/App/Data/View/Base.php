<?php
abstract class App_Data_View_Base
{
    const VIEW_NAME    = 'undefined';
    const VIEW_PK      = 'undefined';
    const VIEW_ARCLASS = 'undefined';

    /**
     * Update AR-Object values into Database
     *
     * @param App_Data_Base $objEntity
     * @return boolean true or false depending on update result
     */
    public static function doUpdateallbypk($objEntity) {
        $strClass   = get_called_class();
        $strPkget   = 'get' . $strClass::VIEW_PK;

        $arrConditions[$strClass::VIEW_PK] = array(
            'operator'  => '=',
            'value'     => $objEntity->$strPkget()
        );

        try {
            return App_Factory_Resource::getResource()->update($objEntity->getArrdata(), $strClass::VIEW_NAME, $arrConditions);
        } catch(Resource_Exception $e) {
            var_dump($e);
        }

        return false;
    }

    /**
     * Insert new row into DB based on AR-Class object values
     *
     * @param App_Data_Base $objEntity
     * @return boolean
     */
    public static function doInsert($objEntity) {
        $strClass   = get_called_class();

        try {
            return App_Factory_Resource::getResource()->insert($objEntity->getArrdata(), $strClass::VIEW_NAME);
        } catch(Resource_Exception $e) {
            var_dump($e);
        }

        return false;
    }

    /**
     * Get entry from table by PK and return false if none is found or an instance
     * of AR-Class regarding the called table.
     *
     * @param integer $lngPk
     * @return App_Data_Base|boolean
     */
    public static function getBypk($lngPk, $flgNodeleted = false) {
        try {
            $strClass   = get_called_class();
            $strARClass = 'App_Data_' . $strClass::VIEW_ARCLASS;

            $strQuery = '
SELECT
    *
FROM
    ' . $strClass::VIEW_NAME . '
WHERE
    ' . $strClass::VIEW_PK . ' = ' . $lngPk . '
' . (($flgNodeleted)?'AND blnDeleted = 0':'');

            $arrData = App_Factory_Resource::getResource()->readSingle($strQuery);

            return new $strARClass($arrData);
        } catch(App_Factory_Exception $e) {
            var_dump($e);
        } catch(Resource_Exception $e) {
            var_dump($e);
        }

        return false;
    }

    public static function deleteBypk($lngPk) {
        try {
            $strClass   = get_called_class();

            $strQuery = '
DELETE FROM
    ' . $strClass::VIEW_NAME . '
WHERE
    ' . $strClass::VIEW_PK . ' = ' . $lngPk . '
';

            if(App_Factory_Resource::getResource()->exec($strQuery)) {
                return $lngPk;
            }
        } catch(App_Factory_Exception $e) {
            var_dump($e);
        } catch(Resource_Exception $e) {
            var_dump($e);
        }

        return false;
    }

    public static function deleteByblndeleted($lngPk) {
        try {
            $strClass   = get_called_class();
            $objARClass = $strClass::getBypk($lngPk);

            $objARClass->setblnDeleted(1);

            if(!$objARClass->doFullupdate()) {
                return false;
            }

            return $lngPk;
        } catch(App_Factory_Exception $e) {
            var_dump($e);
        } catch(Resource_Exception $e) {
            var_dump($e);
        }

        return false;
    }
}