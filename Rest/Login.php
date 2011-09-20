<?php
class Alfresco_Rest_Login extends Alfresco_Rest_Abstract
{
    private $_loginBaseUrl = 'login';
    private $_loginTicketUrl = 'ticket';
    
    public function __construct($url)
    {
       $this->setBaseUrl($url);
    }
    
    public function login($username, $password)
    {
        $url = $this->getBaseUrl() . "/api/" . $this->_loginBaseUrl;
        
        $postData['username'] = $username;
        $postData['password'] = $password;
        
        $result = $this->_doPostRequest($url, $postData);
        
        if (!$result) {
        	throw new Alfresco_Rest_Exception("Unable to connect to authentication service.");
        }
        
        $ticket = $result['data']['ticket'];
        
        return array('ticket' => $ticket);
    }

    /*
     * Logout
     * DELETE /alfresco/service/api/login/ticket/{ticket}
     */
    public function logout($ticket)
    {
        $url = $this->getBaseUrl() . "/api/" . $this->_loginBaseUrl . "/" . $this->_loginTicketUrl . "/" . $ticket;
        $url = $this->addAlfTicketUrl($url);
        
        $result = $this->_getCurlClient()->doDeleteRequest($url);
        
        return $result;
        // TODO configurar retorno
    }
    
    /*
     * Validates the specified ticket is still valid. 
     * The ticket may be invalid, or expired, or the user may have been locked out. 
     * For security reasons this script will not validate the ticket of another user.
     * GET /alfresco/service/api/login/ticket/<ticket>?alf_ticket=<ticket>
     * 
     * returns
     * If the ticket is valid retuns, STATUS_SUCCESS (200)
     * If the ticket is not valid return, STATUS_NOT_FOUND (404)
     * If the ticket does not belong to the current user, STATUS_NOT_FOUND (404)
     */
    public function validate()
    {
        $url = "{$this->getBaseUrl()}/api/{$this->_loginBaseUrl}/{$this->_loginTicketUrl}/{$this->getTicket()}";
        $result = trim($this->_doAuthenticatedGetStringRequest($url));
        
        return (strpos($result, 'TICKET_') > -1);
    }
}
