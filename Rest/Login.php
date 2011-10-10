<?php
/**
 * @see Alfresco_Rest_Abstract
 */
require_once 'Abstract.php';

/**
 * Login/Logout service
 * 
 * @author Gil Magno <gilmagno@gmail.com>
 * @package alfresco-php-api
 */
class Alfresco_Rest_Login extends Alfresco_Rest_Abstract
{
    /**
     * URL package name for the services (this will be added to the alfresco base services url)
     * 
     * @var string
     */
    private $_loginBaseUrl = 'login';
    
    /**
     * URL param name for the ticket (this will be added to the loginBaseUrl)
     * 
     * @var string
     */
    private $_loginTicketUrl = 'ticket';
    
    /**
     * Basic authentication service
     * 
     * POST /alfresco/service/api/login
     * 
     * @param string $username
     * @param string $password
     * @return array array with the authentication ticket. Example: array('ticket' => 'ahq812GasLPlsmNMskneulasJsjak')
     */
    public function login($username, $password)
    {
        $url = "{$this->getBaseUrl()}/api/{$this->_loginBaseUrl}";
        
        $result = $this->_doPostRequest($url, array('username' => $username, 'password' => $password));
        
        if (!$result OR !isset($result['data'])) {
        	throw new Alfresco_Rest_Exception("Unable to connect to authentication service.");
        }
        
        return $result['data'];
    }

    /**
     * Logout
     * 
     * DELETE /alfresco/service/api/login/ticket/{ticket}
     * 
     * @param string $ticket
     * @return array service's response
     */
    public function logout($ticket)
    {
        $url = "{$this->getBaseUrl()}/api/{$this->_loginBaseUrl}/{$this->_loginTicketUrl}/$ticket";
        
        return $this->_doAuthenticatedDeleteRequest($url);
    }
    
    /**
     * Validates the specified ticket is still valid. 
     * The ticket may be invalid, or expired, or the user may have been locked out. 
     * For security reasons this script will not validate the ticket of another user.
     * 
     * GET /alfresco/service/api/login/ticket/<ticket>?alf_ticket=<ticket>
     * 
     * @return boolean
     */
    public function validate()
    {
        $url = "{$this->getBaseUrl()}/api/{$this->_loginBaseUrl}/{$this->_loginTicketUrl}/{$this->getTicket()}";
        $result = trim($this->_doAuthenticatedGetStringRequest($url));
        
        return (strpos($result, 'TICKET_') > -1);
    }
}
