<?php
class Core_Web_Template_Subtemplate extends Core_Web_Template
{
    /**
     * Init subtemplate by template string and response object
     * 
     * @param string $strTemplate
     * @param Core_Web_Response $objResponse
     */
    public function __construct($strTemplate, $objResponse) {
        parent::__construct($objResponse);

        if(file_exists(TEMPLATE_DIR . str_replace('_', DIRECTORY_SEPARATOR, $strTemplate) . '.html')) {
            $this->_txtOutput = file_get_contents(TEMPLATE_DIR . str_replace('_', DIRECTORY_SEPARATOR, $strTemplate) . '.html');
        } else {
            var_dump('Can\'t find template "' . TEMPLATE_DIR . str_replace('_', DIRECTORY_SEPARATOR, $strTemplate) . '.html' . '"');
        }
    }
}