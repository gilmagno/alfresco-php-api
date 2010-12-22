<?php

require_once('GetAdaptersInterface.php');

class JsonGetAdapter implements getAdapter
{
    public function decode($data, $assoc = false) {
        // FIXME fazer ou procurar função que valide json
        return json_decode($data, $assoc);
    }
}
