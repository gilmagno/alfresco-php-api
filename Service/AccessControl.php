<?php

require_once 'WebService/WebServiceFactory.php';
require_once 'BaseObject.php';
class AlfAccessControl extends AlfBaseObject
{
    private $_connectionUrl;
    private $_ticket;
    private $_accessControlService;
    
    public function __construct($connectionUrl="http://localhost:8080/alfresco/api", $ticket)
    {
        $this->_connectionUrl = $connectionUrl;
        $this->_ticket = $ticket;
        $this->_accessControlService = AlfWebServiceFactory::getAccessControlService($this->_connectionUrl, $this->_ticket);
    }
    
    public function getAuthorities()
    {
        $result = $this->_accessControlService->getAuthorities();
        return $this->createAuthoritiesResultArray($result);
    }
    
    protected function createAuthoritiesResultArray($result)
    {
        $authorities = array();
        foreach ($result->results as $authority) {
            $authorities[] = $authority;
        }
        return $authorities;
    }
}
?>