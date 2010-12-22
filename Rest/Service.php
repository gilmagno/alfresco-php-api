<?php
require_once('Base.php');

class Alfresco_Rest_Service extends Alfresco_Rest_Base
{
	public function getResultFromUrl($url)
	{
		return $this->_getResultFromUrl($url);
	}	
}