<?php

//require_once("PostAdapterInterface.php");

class CurlClient_PostAdapters_JsonPostAdapter extends CurlClient_GetAdapters_JsonGetAdapter implements CurlClient_PostAdapters_Interface
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
