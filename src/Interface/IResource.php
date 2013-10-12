<?php
interface IResource
{
    public function __construct();
    public function __destruct();
    public function exec($strQuery);
    public function read($strQuery, $blnArray = false);
    public function readSingle($strQuery);
    public function update($arrFieldList, $strView, $arrConditions = array());
    public function insert($arrFieldList, $strView);
}