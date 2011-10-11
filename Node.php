<?php
/**
 * @see Alfresco_Abstract
 */
require_once 'Abstract.php';

/**
 * Represents a Node from Alfresco
 * 
 * @author Bruno Cavalcante <brunofcavalcante@gmail.com>
 * @package alfresco-php-api
 */
class Alfresco_Node extends Alfresco_Abstract
{
    /**
     * @var string
     */
    protected $_id;
    
    /**
     * @var DateTime
     */
    protected $_published;
    
    /**
     * @var DateTime
     */
    protected $_updated;
    
    /**
     * @var string
     */
    protected $_summary;
    
    /**
     * @var string
     */
    protected $_name;
    
    /**
     * @var string
     */
    protected $_title;
    
    /**
     * @var string
     */
    protected $_author;
    
    /**
     * @var string
     */
    protected $_type;
    
    /**
     * @var string
     */
    protected $_parentId;
    
    /**
     * @var string
     */
    protected $_downloadUrl;
    
    /**
     * @var array
     */
    protected $_metadata = array();
    
    /**
     * @return string
     */
    public function getId()
    {
        return $this->_id;
    }
    
    /**
     * @param string $value
     */
    public function setId($value)
    {
        $this->_id = $value;
    }
    
    /**
     * @return Datetime
     */
    public function getPublished()
    {
        return $this->_published;
    }
    
    /**
     * @param Datetime $value
     */
    public function setPublished(Datetime $value)
    {
        $this->_published = $value;
    }
    
    /**
     * @return Datetime
     */
    public function getUpdated()
    {
        return $this->_updated;
    }
    
    /**
     * @param Datetime $value
     */
    public function setUpdated(Datetime $value)
    {
        $this->_updated = $value;
    }
    
    /**
     * @return string
     */
    public function getSummary()
    {
        return $this->_summary;
    }
    
    /**
     * @param string $value
     */
    public function setSummary($value)
    {
        $this->_summary = $value;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }
    
    /**
     * @param string $value
     */
    public function setName($value)
    {
        $this->_name = $value;
    }
    
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }
    
    /**
     * @param string $value
     */
    public function setTitle($value)
    {
        $this->_title = $value;
    }
    
    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->_author;
    }
    
    /**
     * @param string $value
     */
    public function setAuthor($value)
    {
        $this->_author = $value;
    }
    
    /**
     * @return string
     */
    public function getParentId()
    {
        return $this->_parentId;
    }
    
    /**
     * @param string $value
     */
    public function setParentId($value)
    {
        $this->_parentId = $value;
    }
    
    /**
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }
    
    /**
     * @param string $value
     */
    public function setType($value)
    {
        $this->_type = $value;
    }
    
    /**
     * @return string
     */
    public function getDownloadUrl()
    {
        return $this->_downloadUrl;
    }
    
    /**
     * @param string $value
     */
    public function setDownloadUrl($value)
    {
        $this->_downloadUrl = $value;
    }
    
    /**
     * @return Alfresco_Metadata[]
     */
    public function getMetadata()
    {
        return $this->_metadata;
    }
    
    /**
     * @param array $value array with Alfresco_Metadata objects
     */
    public function setMetadata(array $value)
    {
        $this->_metadata = $value;
    }
}
