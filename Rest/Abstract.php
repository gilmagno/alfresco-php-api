<?php
require_once('Exception.php');
require_once('CurlClient.php');

abstract class Alfresco_Rest_Abstract
{
    const DEFAULT_ADAPTER = 'json';
    
    private $_baseUrl;
    private $_ticket;
    
    public function __construct($url, $ticket = null)
    {
        $this->setBaseUrl($url);
        if (isset($ticket)) {
            $this->setTicket($ticket);
        }
    }
    
    public function getBaseUrl()
    {
        return $this->_alfrescoBaseUrl;
    }
    
    public function setBaseUrl($alfrescoBaseUrl)
    {
        $this->_alfrescoBaseUrl = $alfrescoBaseUrl;
    }
    
    public function getTicket()
    {
        return $this->_ticket;
    }
    
    public function setTicket($ticket)
    {
        $this->_ticket = $ticket;
    }
    
    /*
     * Put an "alf_ticket=<ticket>" on the given URL
     */
    public function addAlfTicketUrl($url)
    {
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
    
    public function isAlfrescoError($return)
    {
        if (is_array($return) && isset($return['exception'])) {
            return true;
        }
        return false;
    }
    
    public function getAlfrescoErrorMessage($return)
    {
        if ($this->isAlfrescoError($return)) {
            return $return['message'];
        }
    }
    
    protected function _getResultFromUrl($url)
    {
        $result = $this->_getCurlClient()->doGetRequest($url);
        
        if ($this->isAlfrescoError($result)) {
            throw new Exception($this->getAlfrescoErrorMessage($result));
        }
        
        return $result;
    }
    
    protected function _doPostRequest($url, $postData)
    {
    	$result = $this->_getCurlClient()->doPostRequest($url, $postData);
    	 
    	if ($this->isAlfrescoError($result)) {
    		throw new Alfresco_Rest_Exception($this->getAlfrescoErrorMessage($result));
    	}
    	 
    	return $result;
    }
    
    protected function _doPostFormDataRequest($url, $postData)
    {
    	$result = $this->_getCurlClient()->doPostRequest($url, $postData, 'formdata');
    
    	if ($this->isAlfrescoError($result)) {
    		throw new Alfresco_Rest_Exception($this->getAlfrescoErrorMessage($result));
    	}
    
    	return $result;
    }
    
    protected function _doGetRequest($url)
    {
    	$result = $this->_getCurlClient()->doGetRequest($url);
    	 
    	if ($this->isAlfrescoError($result)) {
    		throw new Alfresco_Rest_Exception($this->getAlfrescoErrorMessage($result));
    	}
    	 
    	return $result;
    }
    
	protected function _doGetStringRequest($url)
    {
    	$result = $this->_getCurlClient()->doGetRequest($url, Alfresco_Rest_CurlClient::FORMAT_STRING);
    	 
    	return $result;
    }
    
    protected function _doAuthenticatedPostRequest($url, $postData)
    {
    	$url = $this->addAlfTicketUrl($url);
    	return $this->_doPostRequest($url, $postData);
    }
    
    protected function _doAuthenticatedPostFormDataRequest($url, $postData)
    {
    	$url = $this->addAlfTicketUrl($url);
    	return $this->_doPostFormDataRequest($url, $postData);
    }
    
    protected function _doAuthenticatedGetRequest($url)
    {
    	$url = $this->addAlfTicketUrl($url);
    	return $this->_doGetRequest($url);
    }
    
    protected function _doAuthenticatedGetStringRequest($url)
    {
    	$url = $this->addAlfTicketUrl($url);
    	return $this->_doGetStringRequest($url);
    }
    
    protected function _getCurlClient()
    {
    	return new Alfresco_Rest_CurlClient();
    }
}