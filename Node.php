<?php
/**
 * @see Alfresco_Abstract
 */
require_once 'Abstract.php';

/**
 * Represents a Node from Alfresco
 * 
 * @author Bruno Cavalcante <brunofcavalcante@gmail.com>
 * @package Alfresco-PHP
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License 3
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
    protected $_title;
    
    /**
     * @var string
     */
    protected $_author;
    
    /**
     * @var type
     */
    protected $_type;
    
    /**
     * @var array
     */
    protected $_metadata = array();
    
    public function getId()
    {
        return $this->_id;
    }
    
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
    
    public function setUpdated(Datetime $value)
    {
        $this->_updated = $value;
    }
    
    public function getSummary()
    {
        return $this->_summary;
    }
    
    public function setSummary($value)
    {
        $this->_summary = $value;
    }
    
    public function getTitle()
    {
        return $this->_title;
    }
    
    public function setTitle($value)
    {
        $this->_title = $value;
    }
    
    public function getAuthor()
    {
        return $this->_author;
    }
    
    public function setAuthor($value)
    {
        $this->_author = $value;
    }
    
    public function getType()
    {
        return $this->_type;
    }
    
    public function setType($value)
    {
        $this->_type = $value;
    }
    
    /**
     * @return Alfresco_Metadata[]
     */
    public function getMetadata()
    {
        return $this->_metadata;
    }
    
    public function setMetadata(array $value)
    {
        $this->_metadata = $value;
    }
}
