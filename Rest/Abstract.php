<?php
require_once('Exception.php');
require_once('CurlClient/CurlClient.php');

abstract class Alfresco_Rest_Abstract
{
    const DEFAULT_ADAPTER = 'json';
    
    private $_baseUrl;
    private $_ticket;
    
    public function __construct($url, $ticket = null) {
        $this->setBaseUrl($url);
        if (isset($ticket)) {
            $this->setTicket($ticket);
        }
    }
    
    public function getBaseUrl() {
        return $this->_alfrescoBaseUrl;
    }
    
    public function setBaseUrl($alfrescoBaseUrl) {
        $this->_alfrescoBaseUrl = $alfrescoBaseUrl;
    }
    
    public function getTicket() {
        return $this->_ticket;
    }
    
    public function setTicket($ticket) {
        $this->_ticket = $ticket;
    }
    
    /*
     * Put an "alf_ticket=<ticket>" on the given URL
     */
    public function addAlfTicketUrl($url) {
        $ticket = $this->getTicket();
        if (isset($ticket)) {
            if (strstr($url, '?')) {
                $url .= "&alf_ticket=" . $ticket;
            } else {
                $url .= "?alf_ticket=" . $ticket;
            }
        }
        return $url;
    }
    
    /*
     * Desuso por causa do Adapter
     */
    public function postToJson($postArgs) {
        $json  = "{";
        $json .= "\"name\" : \"" . $postArgs['name'] . "\",";
        $json .= "}";
        
        return $json;
    }
    
    public function isAlfrescoError($return) {
        if (is_array($return) && isset($return['exception'])) {
            return true;
        }
        return false;
    }
    
    public function getAlfrescoErrorMessage($return) {
        if ($this->isAlfrescoError($return)) {
            return $return['message'];
        }
    }
    
    protected function _getResultFromUrl($url)
    {
        $curlObj = new CurlClient();
        $resultJson = $curlObj->doGetRequest($url);
        $result = json_decode($resultJson, true);
        
        if ($this->isAlfrescoError($result)) {
            throw new Exception($this->getAlfrescoErrorMessage($result));
        }
        
        return $result;
    }
}