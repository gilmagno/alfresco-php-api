<?php
require_once('Abstract.php');

class Alfresco_Rest_Service extends Alfresco_Rest_Abstract
{
	public function getResultFromUrl($url)
	{
		return $this->_getResultFromUrl($url);
	}	
}