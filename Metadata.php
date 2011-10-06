<?php
/**
 * @see Alfresco_Abstract
 */
require_once 'Abstract.php';

/**
 * Represents a Metadata from Alfresco
 * 
 * @author Bruno Cavalcante <brunofcavalcante@gmail.com>
 * @package alfresco-php-api
 */
class Alfresco_Metadata extends Alfresco_Abstract
{
    /**
     * @var string
     */
    protected $_name;
    
    /**
     * @var string
     */
    protected $_value;
    
    /**
     * @var string
     */
    protected $_displayName;
    
    public function getName()
    {
        return $this->_name;
    }
    
    public function setName($value)
    {
        $this->_name = $value;
    }
    
    public function getValue()
    {
        return $this->_value;
    }
    
    public function setValue($value)
    {
        $this->_value = $value;
    }
    
    public function getDisplayName()
    {
        return $this->_displayName;
    }
    
    public function setDisplayName($value)
    {
        $this->_displayName = $value;
    }
}
