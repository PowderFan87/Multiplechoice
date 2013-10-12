<?php
class App_Data_Backenduser extends App_Data_Base
{
    const   VIEW_CLASS = 'viewBackenduser';
    const   VIEW_PK    = 'UID';

    protected function getEmpryarray() {
        return array(
            'strName'           => ''
        );
    }
}