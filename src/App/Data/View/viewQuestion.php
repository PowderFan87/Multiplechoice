<?php
/**
 * Description of viewQuestion
 *
 * @author Holger Szüsz <hszuesz@live.com>
 */
class viewQuestion extends App_Data_View_Base
{
    const VIEW_NAME    = 'tblquestion';
    const VIEW_PK      = 'UID';
    const VIEW_ARCLASS = 'Question';

    public static function getAllquestions($blnObjects = true) {
        $strARClass = 'App_Data_' . self::VIEW_ARCLASS;
        $strQuery   = '
SELECT
    *
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
}