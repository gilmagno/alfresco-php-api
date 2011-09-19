<?php
class Alfresco_Rest_Service extends Alfresco_Rest_Abstract
{
    public function getResultFromUrl($url)
    {
        return $this->_getResultFromUrl($url);
    }
    
    public function doPostRequest($url, $postData)
    {
    	return parent::_doPostRequest($url, $postData);
    }
    
    public function doGetRequest($url)
    {
    	return parent::_doGetRequest($url);
    }
}