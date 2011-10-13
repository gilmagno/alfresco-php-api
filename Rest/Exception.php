<?php
/**
 * Rest Exception Class
 * 
 * @author Bruno Cavalcante <brunofcavalcante@gmail.com>
 * @package alfresco-php-api
 */
class Alfresco_Rest_Exception extends Exception
{
    const ERROR_CODE = 'AlfrescoApi';
    
    protected $code;
    protected $description;
    
    /**
     * Class Constructor
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
    
    /**
     * @return boolean
     */
    public function hasDescription()
    {
        return ($this->description);
    }
    
    /**
     * Returns the error description
     * 
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
