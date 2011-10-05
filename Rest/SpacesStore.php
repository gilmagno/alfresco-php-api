<?php
/**
 * @see Alfresco_Node
 */
require_once dirname(__FILE__) . '/../Node.php';

/**
 * Alfresco SpacesStore methods
 * 
 * @author Bruno Cavalcante <brunofcavalcante@gmail.com>
 * @package Alfresco-PHP
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License 3
 */
class Alfresco_Rest_SpacesStore extends Alfresco_Rest_Abstract
{
    /**
     * CMIS Property name for the Node Type
     */
    const PROPERTY_OBJECT_TYPE = 'cmis:objectTypeId';
    
    /**
     * Return the ROOT folders from alfresco SpacesStore (children from app:company_home)
     * 
     * GET /cmis/p/children
     * 
     * @return Alfresco_Node[]
     */
    public function getRootFolders()
    {
        $url = "{$this->getBaseUrl()}/cmis/p/children";
        $result = $this->_doAuthenticatedGetAtomRequest($url);
        
        $folders = array();
        foreach ($result->getElementsByTagName('entry') as $entry) {
            $folders[] = $this->_getNodeFromAtom($entry);
        }
        
        return $folders;
    }
    
    /**
     * Extracts Alfresco_Node objects from a CMIS Atom Feed XML response
     * 
     * @param SimpleXmlElement $atomNode
     * @return Alfresco_Node
     */
    protected function _getNodeFromAtom($atomNode)
    {
        $folder = new Alfresco_Node();
        $folder->id = $this->_getIdFromAtomNode($atomNode);
        $folder->published = new DateTime($atomNode->getElementsByTagName('published')->item(0)->nodeValue);
        $folder->updated = new DateTime($atomNode->getElementsByTagName('updated')->item(0)->nodeValue);
        $folder->summary = $atomNode->getElementsByTagName('summary')->item(0)->nodeValue;
        $folder->title = $atomNode->getElementsByTagName('title')->item(0)->nodeValue;
        $folder->author = $this->_getAuthorFromAtomNode($atomNode);
        
        //CMIS Properties
        foreach ($this->_getCMISProperties($atomNode) as $property) {
            $propertyDefinitionId = $property->getAttribute('propertyDefinitionId');
            
            if ($propertyDefinitionId == self::PROPERTY_OBJECT_TYPE) {
                $folder->type = $property->nodeValue;
            } elseif ($propertyDefinitionId && $this->_isCustomProperty($propertyDefinitionId)) {
                $folder->metadata[] = $this->_getMetadataFromProperty($property);
            }
        }
        
        return $folder;
    }

    /**
     * Returns the atom node's author
     * 
     * @param DOMElement $atomNode
     * @return string
     */
    protected function _getAuthorFromAtomNode(DOMElement $atomNode)
    {
        return $atomNode->getElementsByTagName('author')->item(0)->getElementsByTagName('name')->item(0)->nodeValue;
    }

    /**
     * Returns the CMIS properties from an atom node
     * 
     * @param DOMElement $atomNode
     * @return DOMNodeList
     */
    protected function _getCMISProperties(DOMElement $atomNode)
    {
        return $atomNode->getElementsByTagName('object')->item(0)
                        ->getElementsByTagName('properties')->item(0)
                        ->getElementsByTagName('*');
    }
    
    /**
     * Returns an Alfresco_Metadata object from a DOMElement CMIS Property
     * 
     * @param DOMElement $property CMIS property
     * @return Alfresco_Metadata
     */
    protected function _getMetadataFromProperty(DOMElement $property)
    {
        $metadata = new Alfresco_Metadata();
        $metadata->name = $property->getAttribute('propertyDefinitionId');
        $metadata->value = $property->nodeValue;
        $metadata->displayName = $property->getAttribute('displayName');
        
        return $metadata;
    }

    /**
     * Returns true if the property is not from CMIS or Alfresco
     * 
     * This method is intended to return true if the property is user-defined.
     * 
     * @param string $property property name
     * @return boolean
     */
    protected function _isCustomProperty($property)
    {
        return strpos($property, 'cmis:') !== 0 && strpos($property, 'cm:') !== 0 && strpos($property, 'app:') !== 0;
    }
    
    /**
     * Extracts the ID from the atom object describing a node.
     * 
     * The ID field from the atom response comes in the following format: 
     * urn:uuid:54e17769-43d2-41ea-ae0a-7b66533eca34
     * So we just extract everything up to the last ":" character in order to get the actual ID.
     * 
     * @param SimpleXmlElement $atomNode
     * @return string
     */
    protected function _getIdFromAtomNode($atomNode)
    {
        return preg_replace('/.*:/', '', (string) $atomNode->getElementsByTagName('id')->item(0)->nodeValue);
    }
    
    /**
     * Return the children from a specified folder
     * 
     * GET /cmis/s/workspace:SpacesStore/i/$id/children
     * 
     * @param string $id parent folder id
     * @return Alfresco_Node[]
     */
    public function getChildren($id)
    {
        $url = "{$this->getBaseUrl()}/cmis/s/workspace:SpacesStore/i/$id/children";
        $result = $this->_doAuthenticatedGetAtomRequest($url);
        
        $folders = array();
        foreach ($result->getElementsByTagName('entry') as $entry) {
            $folders[] = $this->_getNodeFromAtom($entry);
        }
        
        return $folders;
    }
    
    /**
     * Return the children from a specified folder
     * 
     * GET /cmis/s/workspace:SpacesStore/i/$id/children
     * 
     * @param string $id parent folder id
     * @return Alfresco_Node[]
     */
    public function getNode($id)
    {
        $url = "{$this->getBaseUrl()}/cmis/s/workspace:SpacesStore/i/$id/self";
        $result = $this->_doAuthenticatedGetAtomRequest($url);
        
        return $this->_getNodeFromAtom($result);
    }
}
