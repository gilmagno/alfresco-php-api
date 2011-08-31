<?php

// TODO corrigir decodes entre a API do alfresco e o curl client

require_once('GetAdapters/JsonGetAdapter.php');
require_once('PostAdapters/JsonPostAdapter.php');

class CurlClient
{
    const FORMAT_STRING = 'string';
    const FORMAT_FORMDATA = 'formdata';
    const FORMAT_JSON = 'json';
    const DEFAULT_INPUT_FORMAT = self::FORMAT_JSON;
    const DEFAULT_RETURN_FORMAT = self::FORMAT_JSON;
    
    private function _doRequest($url, $options = array()) {
        $ch = curl_init();
        
        $options[CURLOPT_URL] = $url;
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_TRANSFERTEXT, true);

        curl_setopt_array($ch, $options);
        
        $result = curl_exec($ch);

        curl_close($ch);
        
        return $result;
    }

    public function doGetRequest($url, $returnFormat = self::DEFAULT_RETURN_FORMAT) {
        $options[CURLOPT_CUSTOMREQUEST] = 'GET';
        $result = $this->_doRequest($url, $options);
        
        if ($returnFormat == self::FORMAT_JSON) {
            $getAdapterObj = $this->getGetAdapter(self::FORMAT_JSON);
            $result = $getAdapterObj->decode($result, true);
        }
//        print '<pre>'; var_dump($result); print '</pre>'; exit;
        
        return $result;
    }

    public function doPostRequest(
        $url, $postData, $postDataFormat = self::DEFAULT_INPUT_FORMAT, $returnFormat = self::DEFAULT_RETURN_FORMAT
        ) {
        $options[CURLOPT_CUSTOMREQUEST] = 'POST';
        
        // Encoding
        if ($postDataFormat != self::FORMAT_FORMDATA) {
            $postAdapterObj = $this->getPostAdapter($postDataFormat);
            $postData = $postAdapterObj->encode($postData);
            $options = $postAdapterObj->updateOptions($options);
        }
        
        $options[CURLOPT_POSTFIELDS] = $postData;
        
        $result = $this->_doRequest($url, $options);
        
        // Decoding
        if ($returnFormat != self::FORMAT_FORMDATA) {
            $getAdapterObj = $this->getGetAdapter($returnFormat);
            $return = $getAdapterObj->decode($result, true);
        }
        
        return $return;
    }
    
    public function doDeleteRequest($url, $options = array()) {
        $options[CURLOPT_CUSTOMREQUEST] = 'DELETE';
        $result = $this->_doRequest($url, $options);
        return $result;
    }

    public function doPutRequest($url, $options = array()) {
        $options[CURLOPT_CUSTOMREQUEST] = 'PUT';
        $result = $this->_doRequest($url, $options);
        return $result;
    }

    public function getGetAdapter($adapterFormat = self::DEFAULT_INPUT_FORMAT) {
        $adapterFormat = ucfirst(strtolower($adapterFormat));
        $classname = "CurlClient_GetAdapters_" . $adapterFormat . "GetAdapter";
        
        $adapterObject = new $classname();
        
        return $adapterObject;
    }
    
    public function getPostAdapter($adapterFormat = self::DEFAULT_RETURN_FORMAT) {
        $adapterFormat = ucfirst(strtolower($adapterFormat));
        $classname = "CurlClient_PostAdapters_" . $adapterFormat . "PostAdapter";
        
        $adapterObject = new $classname();
        
        return $adapterObject;
    }
}
