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
            $url .= (strstr($url, '?')) ? '&' : '?';
            $url .= "alf_ticket=" . $ticket;
        }
        
        return $url;
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
    
    protected function _doPostRequest($url, $postData) {
    	$result = $this->_getCurlClient()->doPostRequest($url, $postData);
    	 
    	if ($this->isAlfrescoError($result)) {
    		throw new Alfresco_Rest_Exception($this->getAlfrescoErrorMessage($result));
    	}
    	 
    	return $result;
    }
    
    protected function _doPostFormDataRequest($url, $postData) {
    	$result = $this->_getCurlClient()->doPostRequest($url, $postData, Alfresco_Rest_CurlClient::FORMAT_FORMDATA);
    
    	if ($this->isAlfrescoError($result)) {
    		throw new Alfresco_Rest_Exception($this->getAlfrescoErrorMessage($result));
    	}
    
    	return $result;
    }
    
    protected function _doGetRequest($url) {
    	$result = $this->_getCurlClient()->doGetRequest($url);
    	 
    	if ($this->isAlfrescoError($result)) {
    		throw new Alfresco_Rest_Exception($this->getAlfrescoErrorMessage($result));
    	}
    	 
    	return $result;
    }
    
	protected function _doGetStringRequest($url) {
    	return $this->_getCurlClient()->doGetRequest($url, Alfresco_Rest_CurlClient::FORMAT_STRING);
    }
    
    protected function _doAuthenticatedPostRequest($url, $postData) {
    	return $this->_doPostRequest($this->addAlfTicketUrl($url), $postData);
    }
    
    protected function _doAuthenticatedPostFormDataRequest($url, $postData) {
    	return $this->_doPostFormDataRequest($this->addAlfTicketUrl($url), $postData);
    }
    
    protected function _doAuthenticatedGetRequest($url) {
    	return $this->_doGetRequest($this->addAlfTicketUrl($url));
    }
    
    protected function _doAuthenticatedGetStringRequest($url) {
    	return $this->_doGetStringRequest($this->addAlfTicketUrl($url));
    }
    
    protected function _getCurlClient() {
    	return new Alfresco_Rest_CurlClient();
    }
}