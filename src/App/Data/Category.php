<?php
class App_Data_Category extends App_Data_Base
{
    const   VIEW_CLASS = 'viewCategory';
    const   VIEW_PK    = 'UID';

    protected function _getEmpryarray() {
        return array(
            'lngParentid'   => NULL,
            'strName'       => ''
        );
    }
}