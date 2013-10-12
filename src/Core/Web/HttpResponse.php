<?php
class Core_Web_HttpResponse extends Core_Web_Response
{
    /**
     * Init response object and set widget templates
     *
     */
    public function __construct() {
        parent::__construct();

        $this->tplNavigation = "Widget_navigation";
    }
}