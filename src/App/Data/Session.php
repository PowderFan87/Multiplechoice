<?php
class App_Data_Session extends App_Data_Base
{
    const   VIEW_CLASS = 'viewSession';
    const   VIEW_PK    = 'UID';

    protected function _getEmpryarray() {
        return array(
            'dtmStart'               => '1900-01-01 00:00:00',
            'strName'                => '',
            'lngPoints'              => 0
        );
    }
}