<?php
class Alfresco_Rest_CurlClient_GetAdapters_AtomGetAdapter implements Alfresco_Rest_CurlClient_GetAdapters_Interface
{
    public function decode($data, $assoc = false) {
        $xml = DOMDocument::loadXML($data); 
        return $xml;
    }
}
