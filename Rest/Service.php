<?php
/**
 * Basic Implementation for Alfresco_Rest_Abstract
 * 
 * @author Gil Magno <gilmagno@gmail.com>
 * @package alfresco-php-api
 */
class Alfresco_Rest_Service extends Alfresco_Rest_Abstract
{
    public function doPostRequest($url, $postData)
    {
    	return parent::_doPostRequest($url, $postData);
    }
    
    public function doPostFormDataRequest($url, $postData)
    {
    	return parent::_doPostFormDataRequest($url, $postData);
    }
    
    public function doGetRequest($url)
    {
    	return parent::_doGetRequest($url);
    }
    
    public function doGetStringRequest($url)
    {
    	return parent::_doGetStringRequest($url);
    }
}
