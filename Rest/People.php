<?php
/**
 * @see Alfresco_Person
 */
require_once dirname(__FILE__) . '/../Person.php';

class Alfresco_Rest_People extends Alfresco_Rest_Abstract
{
    private $_peopleBaseUrl = 'people';
    private $_peoplePreferencesUrl = 'preferences';
    private $_peopleSitesUrl = 'sites';
    
    /**
     * List users
     * 
     * @param $filter
     * @return Alfresco_Person[]
     */
    public function listPeople($filter = null)
    {
        $url = $this->getBaseUrl() . "/api/" . $this->_peopleBaseUrl;
        
        if (isset($filter)) {
            $url .= "&filter=" . $filter;
        }
        
        $result = $this->_doAuthenticatedGetRequest($url);

        $people = array();
        foreach ($result['people'] as $personResult) {
            $person = new Alfresco_Person();
            foreach ($personResult as $key => $value) {
                $person->$key = $value;
            }
            $people[] = $person;
        }

        return $people;
    }
    
    /**
     * Get person details
     * 
     * GET /alfresco/service/api/people/{userName}
     * 
     * @return Alfresco_Person
     */
    public function getPerson($userName)
    {
        $url = $this->getBaseUrl() . "/api/" . $this->_peopleBaseUrl . "/" . $userName;
        $result = $this->_doAuthenticatedGetRequest($url);
        
        $person = new Alfresco_Person();
        foreach ($result as $key => $value) {
            $person->$key = $value;
        }
        
        return $person;
    }
}