<?php
class App_Data_Answer extends App_Data_Base
{
    const   VIEW_CLASS = 'viewAnswer';
    const   VIEW_PK    = 'UID';

    protected function _getEmpryarray() {
        return array(
            'strAnswer'             => '',
            'lngCountshowed'        => 0,
            'lngCountselected'      => 0,
            'blnTrue'               => 0,
            'tblquestion_UID'       => NULL
        );
    }
}