<?php
class Alfresco_Rest_People extends Alfresco_Rest_Abstract
{
    private $_peopleBaseUrl = 'people';
    private $_peoplePreferencesUrl = 'preferences';
    private $_peopleSitesUrl = 'sites';
    
    /*
     * List users
     */
    public function listPeople($filter = null)
    {
        $url = $this->getBaseUrl() . "/api/" . $this->_peopleBaseUrl;
        $url = $this->addAlfTicketUrl($url);
        
        if (isset($filter)) {
            $url .= "&filter=" . $filter;
        }
        
        $result = $this->_doGetRequest($url);

        return $result['people']; // $result['people'][0]['firstName']
    }
    
    /*
     * Get person
     * GET /alfresco/service/api/people/{userName}
     * 
     * returns
     * Assoc array
     */
    public function getPerson($userName)
    {
        $url = $this->getBaseUrl() . "/api/" . $this->_peopleBaseUrl . "/" . $userName;
        $url = $this->addAlfTicketUrl($url);
        
        $result = $this->_doGetRequest($url);

        return $result;
    }
}