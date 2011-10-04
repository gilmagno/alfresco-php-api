<?php
/**
 * @see Alfresco_Rest_Exception
 */
require_once 'Exception.php';

/**
 * @see Alfresco_Rest_CurlClient
 */
require_once 'CurlClient.php';

/**
 * Base class for the REST services
 * 
 * @author Gil Magno <gilmagno@gmail.com>
 * @package Alfresco-PHP
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License 3
 */
abstract class Alfresco_Rest_Abstract
{
    /**
     * @var string
     */
    private $_baseUrl;
    
    /**
     * @var string
     */
    private $_ticket;
    
    public function __construct($url, $ticket = null) {
        $this->setBaseUrl($url);
        if (isset($ticket)) {
            $this->setTicket($ticket);
        }
    }
    
    /**
     * Alfresco Base Service URL
     * 
     * example: http://localhost:8080/alfresco/service/
     * 
     * @return string
     */
    public function getBaseUrl() {
        return $this->_alfrescoBaseUrl;
    }
    
    /**
     * @param $alfrescoBaseUrl string
     */
    public function setBaseUrl($alfrescoBaseUrl) {
        $this->_alfrescoBaseUrl = $alfrescoBaseUrl;
    }
    
    /**
     * Returns the logged user's auth ticket
     * 
     * @return string
     */
    public function getTicket() {
        return $this->_ticket;
    }
    
    /**
     * @param $ticket string
     */
    public function setTicket($ticket) {
        $this->_ticket = $ticket;
    }
    
    /**
     * Adds an "alf_ticket=<ticket>" on the given URL
     * 
     * @return string
     */
    public function addAlfTicketUrl($url) {
        $ticket = $this->getTicket();
        if (isset($ticket)) {
            $url .= (strstr($url, '?')) ? '&' : '?';
            $url .= "alf_ticket=" . $ticket;
        }
        
        return $url;
    }
    
    /**
     * Verifies if the specified $return hash is an Alfresco REST Exception hash
     * 
     * @param $return $return service's return hash
     * @return boolean;
     */
    public function isAlfrescoError($return) {
        if (is_array($return) && isset($return['exception'])) {
            return true;
        }
        
        return false;
    }
    
    /**
     * Returns the error message from an Alfresco REST Exception hash
     * 
     * @param $return service's response hash
     * @return string|null
     */
    public function getAlfrescoErrorMessage($return) {
        if ($this->isAlfrescoError($return)) {
            return $return['message'];
        }
    }
    
    /**
     * Makes a POST request for the given Alfresco service's URL
     * 
     * @param $url service's url
     * @param $postData hash with the postdata. Example: array('key' => 'value', 'key2' => 'value2')
     * @return array the service's response
     */
    protected function _doPostRequest($url, $postData) {
    	$result = $this->_getCurlClient()->doPostRequest($url, $postData);
    	 
    	if ($this->isAlfrescoError($result)) {
    		throw new Alfresco_Rest_Exception($this->getAlfrescoErrorMessage($result));
    	}
    	 
    	return $result;
    }
    
    /**
     * Makes a formdata POST request for the given Alfresco service's URL
     * 
     * @param $url service's url
     * @param $postData hash with the postdata. Example: array('key' => 'value', 'key2' => 'value2')
     * @return array the service's response
     */
    protected function _doPostFormDataRequest($url, $postData) {
    	$result = $this->_getCurlClient()->doPostRequest($url, $postData, Alfresco_Rest_CurlClient::FORMAT_FORMDATA);
    
    	if ($this->isAlfrescoError($result)) {
    		throw new Alfresco_Rest_Exception($this->getAlfrescoErrorMessage($result));
    	}
    
    	return $result;
    }
    
    /**
     * Makes a GET request for the given Alfresco service's URL
     * 
     * @param $url service's url
     * @return array the service's response
     */
    protected function _doGetRequest($url) {
    	$result = $this->_getCurlClient()->doGetRequest($url);
    	 
    	if ($this->isAlfrescoError($result)) {
    		throw new Alfresco_Rest_Exception($this->getAlfrescoErrorMessage($result));
    	}
    	 
    	return $result;
    }
    
    /**
     * Makes a GET request for the given Alfresco service's URL, but gets the response as STRING
     * 
     * @param $url service's url
     * @return string the service's response
     */
	protected function _doGetStringRequest($url) {
    	return $this->_getCurlClient()->doGetRequest($url, Alfresco_Rest_CurlClient::FORMAT_STRING);
    }
    
    /**
     * Makes a DELETE request for the given Alfresco service's URL
     * 
     * @param $url service's url
     * @return array the service's response
     */
    protected function _doDeleteRequest($url) {
        $result = $this->_getCurlClient()->doDeleteRequest($url);
         
        if ($this->isAlfrescoError($result)) {
            throw new Alfresco_Rest_Exception($this->getAlfrescoErrorMessage($result));
        }
         
        return $result;
    }
    
    /**
     * Makes an authenticated formdata POST request for the given Alfresco service's URL
     * 
     * @param $url service's url
     * @return array the service's response
     */
    protected function _doAuthenticatedPostRequest($url, $postData) {
    	return $this->_doPostRequest($this->addAlfTicketUrl($url), $postData);
    }
    
    /**
     * Makes an authenticated POST request for the given Alfresco service's URL
     * 
     * @param $url service's url
     * @return array the service's response
     */
    protected function _doAuthenticatedPostFormDataRequest($url, $postData) {
    	return $this->_doPostFormDataRequest($this->addAlfTicketUrl($url), $postData);
    }
    
    /**
     * Makes an authenticated GET request for the given Alfresco service's URL
     * 
     * @param $url service's url
     * @return array the service's response
     */
    protected function _doAuthenticatedGetRequest($url) {
    	return $this->_doGetRequest($this->addAlfTicketUrl($url));
    }
    
    /**
     * Makes an authenticated GET request for the given Alfresco service's URL
     * 
     * @param $url service's url
     * @return array the service's response
     */
    protected function _doAuthenticatedGetAtomRequest($url) {
        return $this->_getCurlClient()->doGetRequest($this->addAlfTicketUrl($url), Alfresco_Rest_CurlClient::FORMAT_ATOM);
    }
    
    /**
     * Makes an authenticated GET request for the given Alfresco service's URL, but gets the response as STRING
     * 
     * @param $url service's url
     * @return string the service's response
     */
    protected function _doAuthenticatedGetStringRequest($url) {
    	return $this->_doGetStringRequest($this->addAlfTicketUrl($url));
    }
    
    /**
     * Makes an authenticated DELETE request for the given Alfresco service's URL
     * 
     * @param $url service's url
     * @return string the service's response
     */
    protected function _doAuthenticatedDeleteRequest($url) {
        return $this->_doDeleteRequest($this->addAlfTicketUrl($url));
    }
    
    /**
     * Return the Curl Client
     * 
     * @return Alfresco_Rest_CurlClient
     */
    protected function _getCurlClient() {
    	return new Alfresco_Rest_CurlClient();
    }
}