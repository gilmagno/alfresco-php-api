<?php
/**
 * @see Alfresco_Rest_Abstract
 */
require_once 'Abstract.php';

/**
 * Groups service
 * 
 * @author Gil Magno <gilmagno@gmail.com>
 * @package alfresco-php-api
 */
class Alfresco_Rest_Groups extends Alfresco_Rest_Abstract
{
    /**
     * URL package name for the services (this will be added to the alfresco base services url)
     * 
     * @var string
     */
    private $_groupsBaseUrl = 'groups';
    
    /**
     * List groups
     * 
     * GET /alfresco/service/api/groups?shortNameFilter={shortNameFilter?}&zone={zone?}
     * 
     * @param string $shortNameFilter
     * @param string $zone
     * @return array
     */
    public function listGroups($shortNameFilter = null, $zone = null)
    {
        $url = $this->getBaseUrl() . "/api/" . $this->_groupsBaseUrl;
        
        if (isset($filter)) {
            $url .= "&shortNameFilter=" . $shortNameFilter;
        } else {
            $url .= "&shortNameFilter=*" . $shortNameFilter;
        }
        
        if (isset($zone)) {
            $url .= "&zone=" . $zone;
        }
        
        $result = $this->_doAuthenticatedGetRequest($url);
        
        //FIXME: Return a group object
        
        return $result['data'];
    }
    
    /**
     * Get the list of child authorities for a group
     * 
     * GET /alfresco/service/api/groups/{shortName}/parents?level={level?}
     * 
     * @param string $shortName
     * @param string $level
     * @return array
     */
    public function listParents($shortName, $level = 'ALL')
    {
        $url = $this->getBaseUrl() . "/api/" . $this->_groupsBaseUrl . "/" . $shortName . "/" . "parents";
        
        if (isset($level)) {
            $url .= "&level=" . $level;
        }
        
        $result = $this->_doAuthenticatedGetRequest($url);

        return $result['data']; // $result['data'][0]
    }
    
    /**
     * Get the list of child authorities for a group
     * 
     * GET /alfresco/service/api/groups/{shortName}/children?authorityType={authorityType?}
     * 
     * @param string $shortName
     * @param string $authorityType
     * @return array
     */
    public function listChildren($shortName, $authorityType = null)
    {
        $url = $this->getBaseUrl() . "/api/" . $this->_groupsBaseUrl . "/" . $shortName . "/" . "children";
        
        if (isset($authorityType)) {
            $url .= "&authorityType=" . $authorityType;
        }
        
        $result = $this->_doAuthenticatedGetRequest($url);

        return $result['data']; // $result['data'][0]
    }
    
    /**
     * Get details of a group
     * 
     * GET /alfresco/service/api/groups/{shortName}
     * 
     * @param string $shortName
     * @return array
     */
    public function getGroup($shortName)
    {
        $url = $this->getBaseUrl() . "/api/" . $this->_groupsBaseUrl . "/" . $shortName;
        $result = $this->_doAuthenticatedGetRequest($url);

        return $result['data']; // $result['data'][0]
    }
}