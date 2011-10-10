<?php
/**
 * @see Alfresco_Rest_CurlClient_GetAdapters_Interface
 */
require_once 'Interface.php';

class Alfresco_Rest_CurlClient_GetAdapters_JsonGetAdapter implements Alfresco_Rest_CurlClient_GetAdapters_Interface
{
    public function decode($data, $assoc = false) {
        // FIXME fazer ou procurar função que valide json
        return json_decode($data, $assoc);
    }
}
