<?php
class App_Data_Difficulty extends App_Data_Base
{
    const   VIEW_CLASS = 'viewDifficulty';
    const   VIEW_PK    = 'UID';

    protected function getEmpryarray() {
        return array(
            'strName'               => '',
            'lngTime'               => 0
        );
    }
}