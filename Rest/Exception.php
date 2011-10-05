<?php
/**
 * Rest Exception Class
 * 
 * @author Bruno Cavalcante <brunofcavalcante@gmail.com>
 * @package Alfresco-PHP
 * @since 13/05/2010
 */
class Alfresco_Rest_Exception extends Exception
{
    const ERROR_CODE = 'AlfrescoApi';
    protected $code;
    protected $description;
    
    /**
     * Construct the exception
     *
     * @param string $msg
     * @param string $trace
     * @return void
     */
    public function __construct($msg = '', $description = null)
    {
        $this->code = self::ERROR_CODE;
        parent::__construct($msg);
        $this->description = $description;
    }
    
    public function hasDescription()
    {
        return $this->description;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
}