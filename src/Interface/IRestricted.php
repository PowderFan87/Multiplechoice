<?php
interface IRestricted
{
    public static function getRestriction();
    public function getFallback();
}