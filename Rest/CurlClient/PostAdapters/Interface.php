<?php

interface Alfresco_Rest_CurlClient_PostAdapters_Interface
{
    public function encode($data);
    public function updateOptions($options);
}