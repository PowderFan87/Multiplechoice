<?php
class App_Data_Question extends App_Data_Base
{
    const   VIEW_CLASS = 'viewQuestion';
    const   VIEW_PK    = 'UID';

    protected function getEmpryarray() {
        return array(
            'strQuestion'           => '',
            'lngCountshowed'        => 0,
            'lngOpttime'            => 0,
            'tbldifficulty_UID'     => NULL,
            'tblbackenduser_UID'    => NULL
        );
    }
}