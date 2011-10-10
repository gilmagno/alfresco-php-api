<?php
/**
 * @see Alfresco_Rest_CurlClient_GetAdapters_Interface
 */
require_once 'Interface.php';

class Alfresco_Rest_CurlClient_PostAdapters_JsonPostAdapter 
	extends Alfresco_Rest_CurlClient_GetAdapters_JsonGetAdapter 
	implements Alfresco_Rest_CurlClient_PostAdapters_Interface
{
    public function encode($data) {
        $json = json_encode($data);
        return $json;
    }
    
    public function updateOptions($options) {
        $options[CURLOPT_HTTPHEADER] = array('Content-Type: application/json');
        return $options;
    }
}
