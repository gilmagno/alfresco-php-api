<?php

require_once 'Metadata.php';

/**
 * Represents a Node from Alfresco
 * 
 * @author Bruno Cavalcante <brunofcavalcante@gmail.com>
 * @package Alfresco-PHP
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License 3
 */
class Alfresco_Node
{
    /**
     * @var string
     */
    public $id;
    
    /**
     * @var DateTime
     */
    public $published;
    
    /**
     * @var DateTime
     */
    public $updated;
    
    /**
     * @var string
     */
    public $summary;
    
    /**
     * @var string
     */
    public $title;
    
    /**
     * @var string
     */
    public $author;
    
    /**
     * @var type
     */
    public $type;
    
    /**
     * @var array
     */
    public $metadata = array();
}
