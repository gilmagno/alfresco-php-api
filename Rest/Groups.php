<?php
class Alfresco_Rest_Groups extends Alfresco_Rest_Abstract
{
    private $_groupsBaseUrl = 'groups';
    
    /*
     * List groups
     * GET /alfresco/service/api/groups?shortNameFilter={shortNameFilter?}&zone={zone?}
     */
    public function listGroups($shortNameFilter = null, $zone = null) {
        $url =
            $this->getBaseUrl() . "/api/" .
            $this->_groupsBaseUrl;
        
        $url = $this->addAlfTicketUrl($url);
        
        if (isset($filter)) {
            $url .= "&shortNameFilter=" . $shortNameFilter;
        } else {
            $url .= "&shortNameFilter=*" . $shortNameFilter;
        }
        
        if (isset($zone)) {
            $url .= "&zone=" . $zone;
        }
        
        $curlObj = new CurlClient();
        $resultJson = $curlObj->doGetRequest($url);
        $result = json_decode($resultJson, true);
        return $result['data']; // $result['data'][0]['shortName']
    }
    
    /*
     * Get the list of child authorities for a group
     * GET /alfresco/service/api/groups/{shortName}/parents?level={level?}
     */
    public function listParents($shortName, $level = 'ALL') {
        $url =
            $this->getBaseUrl() . "/api/" .
            $this->_groupsBaseUrl . "/" .
            $shortName . "/" .
            "parents";
       
        $url = $this->addAlfTicketUrl($url);
        
        if (isset($level)) {
            $url .= "&level=" . $level;
        }
        
        $curlObj = new CurlClient();
        $resultJson = $curlObj->doGetRequest($url);
        $result = json_decode($resultJson, true);
        return $result['data']; // $result['data'][0]
    }
    
    /*
     * Get the list of child authorities for a group
     * GET /alfresco/service/api/groups/{shortName}/children?authorityType={authorityType?}
     */
    public function listChildren($shortName, $authorityType = null) {
        $url =
            $this->getBaseUrl() . "/api/" .
            $this->_groupsBaseUrl . "/" .
            $shortName . "/" .
            "children";
       
        $url = $this->addAlfTicketUrl($url);
        
        if (isset($authorityType)) {
            $url .= "&authorityType=" . $authorityType;
        }
        
        $curlObj = new CurlClient();
        $resultJson = $curlObj->doGetRequest($url);
        $result = json_decode($resultJson, true);
        return $result['data']; // $result['data'][0]
    }
    
    /*
     * Get details of a group
     * GET /alfresco/service/api/groups/{shortName}
     */
    public function getGroup($shortName) {
        $url =
            $this->getBaseUrl() . "/api/" .
            $this->_groupsBaseUrl . "/" .
            $shortName;
       
        $url = $this->addAlfTicketUrl($url);
       
        $curlObj = new CurlClient();
        $resultJson = $curlObj->doGetRequest($url);
        $result = json_decode($resultJson, true);
        return $result['data']; // $result['data'][0]
    }
}