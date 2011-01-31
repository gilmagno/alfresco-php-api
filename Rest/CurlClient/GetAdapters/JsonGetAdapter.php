<?php

//require_once('GetAdaptersInterface.php');

class CurlClient_GetAdapters_JsonGetAdapter implements CurlClient_GetAdapters_Interface
{
    public function decode($data, $assoc = false) {
        // FIXME fazer ou procurar função que valide json
        return json_decode($data, $assoc);
    }
}
