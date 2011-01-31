<?php

interface CurlClient_PostAdapters_Interface
{
    public function encode($data);
    public function updateOptions($options);
}