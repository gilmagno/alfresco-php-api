<?php
/**
 * @see Alfresco_Rest_Abstract
 */
require_once 'Abstract.php';
 
/**
 * @see Alfresco_Node
 */
require_once dirname(__FILE__) . '/../Node.php';

/**
 * @see Alfresco_Metadata
 */
require_once dirname(__FILE__) . '/../Metadata.php';

/**
 * Alfresco SpacesStore methods
 * 
 * @author Bruno Cavalcante <brunofcavalcante@gmail.com>
 * @package alfresco-php-api
 */
class Alfresco_Rest_SpacesStore extends Alfresco_Rest_Abstract
{
    /**
     * CMIS Property name for the Name
     */
    const PROPERTY_NAME = 'cmis:name';
    
    /**
     * CMIS Property name for the Node Type
     */
    const PROPERTY_OBJECT_TYPE = 'cmis:objectTypeId';
    
    /**
     * CMIS Property name for the Parent Id
     */
    const PROPERTY_PARENT_ID = 'cmis:parentId';
    
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
        
        $nodes = array();
        foreach ($result->getElementsByTagName('entry') as $entry) {
            $nodes[] = $this->_getNodeFromAtom($entry);
        }
        
        return $nodes;
    }
    
    /**
     * Extracts Alfresco_Node objects from a CMIS Atom Feed XML response
     * 
     * @param SimpleXmlElement $atomNode
     * @return Alfresco_Node
     */
    protected function _getNodeFromAtom($atomNode)
    {
        $node = new Alfresco_Node();
        $node->id = $this->_getIdFromAtomNode($atomNode);
        $node->published = new DateTime($atomNode->getElementsByTagName('published')->item(0)->nodeValue);
        $node->updated = new DateTime($atomNode->getElementsByTagName('updated')->item(0)->nodeValue);
        $node->summary = $atomNode->getElementsByTagName('summary')->item(0)->nodeValue;
        $node->title = $atomNode->getElementsByTagName('title')->item(0)->nodeValue;
        $node->author = $this->_getAuthorFromAtomNode($atomNode);
        
        //CMIS Properties
        $metadata = array();
        foreach ($this->_getCMISProperties($atomNode) as $property) {
            $propertyDefinitionId = $property->getAttribute('propertyDefinitionId');
            
            if ($propertyDefinitionId == self::PROPERTY_NAME) {
                $node->name = $property->nodeValue;
            } elseif ($propertyDefinitionId == self::PROPERTY_OBJECT_TYPE) {
                $node->type = $property->nodeValue;
            } elseif ($propertyDefinitionId == self::PROPERTY_PARENT_ID) {
                $node->parentId = $this->_getIdFromNodeRef($property->nodeValue);
            } elseif ($propertyDefinitionId && $this->_isCustomProperty($propertyDefinitionId)) {
                $metadata[] = $this->_getMetadataFromProperty($property);
            }
        }
        
        $node->metadata = $metadata;
        $node->downloadUrl = $this->_getDownloadUrlFromContentUrl(
            $node, 
            $atomNode->getElementsByTagName('content')->item(0)->getAttribute('src')
        );
        
        return $node;
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
     * Returns the atom node's author
     * 
     * @param DOMElement $atomNode
     * @return string
     */
    protected function _getAuthorFromAtomNode($atomNode)
    {
        return $atomNode->getElementsByTagName('author')->item(0)->getElementsByTagName('name')->item(0)->nodeValue;
    }

    /**
     * Returns the CMIS properties from an atom node
     * 
     * @param DOMElement $atomNode
     * @return DOMNodeList
     */
    protected function _getCMISProperties($atomNode)
    {
        return $atomNode->getElementsByTagName('object')->item(0)
                        ->getElementsByTagName('properties')->item(0)
                        ->getElementsByTagName('*');
    }
    
    /**
     * Returns the node-uuid from a nodeRef
     * 
     * A nodeRef is usually something like workspace://SpacesStore/{node-uuid}
     * 
     * @param string $nodeRef
     * @return string
     */
    protected function _getIdFromNodeRef($nodeRef)
    {
        return preg_replace('/.*\//', '', $nodeRef);
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
     * Returns the download url from the CMIS get content url
     * 
     * @param Alfresco_Node $node the node, so we can get it's name
     * @param string $contentUrl CMIS' content url
     * @return string
     */
    protected function _getDownloadUrlFromContentUrl(Alfresco_Node $node, $contentUrl)
    {
        return $this->addAlfTicketUrl("$contentUrl/$node->name?a=true");
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
        
        $nodes = array();
        foreach ($result->getElementsByTagName('entry') as $entry) {
            $nodes[] = $this->_getNodeFromAtom($entry);
        }
        
        return $nodes;
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
        
        foreach ($result->getElementsByTagName('entry') as $entry) {
            return $this->_getNodeFromAtom($entry);
        }
    }
}
