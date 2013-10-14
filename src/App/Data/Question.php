<?php
class App_Data_Question extends App_Data_Base
{
    const   VIEW_CLASS = 'viewQuestion';
    const   VIEW_PK    = 'UID';

    public function getAllanswers() {
        //@TODO aufruf für antworten by frage id
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