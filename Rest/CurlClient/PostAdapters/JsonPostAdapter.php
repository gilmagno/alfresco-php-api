<?php

require_once("PostAdapterInterface.php");

class JsonPostAdapter extends JsonGetAdapter implements postAdapter
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
