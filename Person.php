<?php
/**
 * @see Alfresco_Abstract
 */
require_once 'Abstract.php';

/**
 * Represents a Person from Alfresco
 * 
 * @author Bruno Cavalcante <brunofcavalcante@gmail.com>
 * @package Alfresco-PHP
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License 3
 */
class Alfresco_Person extends Alfresco_Abstract
{
    /**
     * @var string
     */
    protected $_url;
    
    /**
     * @var string
     */
    protected $_userName;
    
    /**
     * @var boolean
     */
    protected $_enabled;
    
    /**
     * @var string
     */
    protected $_firstName;
    
    /**
     * @var string
     */
    protected $_lastName;
    
    /**
     * @var string
     */
    protected $_jobtitle;
    
    /**
     * @var string
     */
    protected $_organization;
    
    /**
     * @var string
     */
    protected $_location;
    
    /**
     * @var string
     */
    protected $_telephone;
    
    /**
     * @var string
     */
    protected $_mobile;
    
    /**
     * @var string
     */
    protected $_email;
    
    /**
     * @var string
     */
    protected $_companyaddress1;
    
    /**
     * @var string
     */
    protected $_companyaddress2;
    
    /**
     * @var string
     */
    protected $_companyaddress3;
    
    /**
     * @var string
     */
    protected $_companyaddress4;
    
    /**
     * @var string
     */
    protected $_companytelephone;
    
    /**
     * @var string
     */
    protected $_companyfax;
    
    /**
     * @var string
     */
    protected $_companyemail;
    
    /**
     * @var string
     */
    protected $_companypostcode;
    
    /**
     * @var string
     */
    protected $_skype;
    
    /**
     * @var string
     */
    protected $_instantmsg;
    
    /**
     * @var string
     */
    protected $_userStatus;
    
    /**
     * @var string
     */
    protected $_userStatusTime;
    
    /**
     * @var string
     */
    protected $_googleusername;
    
    /**
     * @var string
     */
    protected $_quota;
    
    /**
     * @var string
     */
    protected $_sizeCurrent;
    
    /**
     * @var string
     */
    protected $_personDescription;
    
    /**
     * @var string
     */
    protected $_capabilities;
    
    public function getUrl()
    {
        return $this->_url;
    }
    
    public function setUrl($value)
    {
        $this->_url = $value;
    }
    
    public function getUserName()
    {
        return $this->_userName;
    }
    
    public function setUserName($value)
    {
        $this->_userName = $value;
    }
    
    public function getEnabled()
    {
        return $this->_enabled;
    }
    
    public function setEnabled($value)
    {
        $this->_enabled = $value;
    }
    
    public function getFirstName()
    {
        return $this->_firstName;
    }
    
    public function setFirstName($value)
    {
        $this->_firstName = $value;
    }
    
    public function getLastName()
    {
        return $this->_lastName;
    }
    
    public function setLastName($value)
    {
        $this->_lastName = $value;
    }
    
    public function getJobtitle()
    {
        return $this->_jobtitle;
    }
    
    public function setJobtitle($value)
    {
        $this->_jobtitle = $value;
    }
    
    public function getOrganization()
    {
        return $this->_organization;
    }
    
    public function setOrganization($value)
    {
        $this->_organization = $value;
    }
    
    public function getLocation()
    {
        return $this->_location;
    }
    
    public function setLocation($value)
    {
        $this->_location = $value;
    }
    
    public function getTelephone()
    {
        return $this->_telephone;
    }
    
    public function setTelephone($value)
    {
        $this->_telephone = $value;
    }
    
    public function getMobile()
    {
        return $this->_mobile;
    }
    
    public function setMobile($value)
    {
        $this->_mobile = $value;
    }
    
    public function getEmail()
    {
        return $this->_email;
    }
    
    public function setEmail($value)
    {
        $this->_email = $value;
    }
    
    public function getCompanyaddress1()
    {
        return $this->_companyaddress1;
    }
    
    public function setCompanyaddress1($value)
    {
        $this->_companyaddress1 = $value;
    }
    
    public function getCompanyaddress2()
    {
        return $this->_companyaddress2;
    }
    
    public function setCompanyaddress2($value)
    {
        $this->_companyaddress2 = $value;
    }
    
    public function getCompanyaddress3()
    {
        return $this->_companyaddress3;
    }
    
    public function setCompanyaddress3($value)
    {
        $this->_companyaddress3 = $value;
    }
    
    public function getCompanyaddress4()
    {
        return $this->_companyaddress4;
    }
    
    public function setCompanyaddress4($value)
    {
        $this->_companyaddress4 = $value;
    }
    
    public function getCompanytelephone()
    {
        return $this->_companytelephone;
    }
    
    public function setCompanytelephone($value)
    {
        $this->_companytelephone = $value;
    }
    
    public function getCompanyfax()
    {
        return $this->_companyfax;
    }
    
    public function setCompanyfax($value)
    {
        $this->_companyfax = $value;
    }
    
    public function getCompanyemail()
    {
        return $this->_companyemail;
    }
    
    public function setCompanyemail($value)
    {
        $this->_companyemail = $value;
    }
    
    public function getCompanypostcode()
    {
        return $this->_companypostcode;
    }
    
    public function setCompanypostcode($value)
    {
        $this->_companypostcode = $value;
    }
    
    public function getSkype()
    {
        return $this->_skype;
    }
    
    public function setSkype($value)
    {
        $this->_skype = $value;
    }
    
    public function getInstantmsg()
    {
        return $this->_instantmsg;
    }
    
    public function setInstantmsg($value)
    {
        $this->_instantmsg = $value;
    }
    
    public function getUserStatus()
    {
        return $this->_userStatus;
    }
    
    public function setUserStatus($value)
    {
        $this->_userStatus = $value;
    }
    
    public function getUserStatusTime()
    {
        return $this->_userStatusTime;
    }
    
    public function setUserStatusTime($value)
    {
        $this->_userStatusTime = $value;
    }
    
    public function getGoogleusername()
    {
        return $this->_googleusername;
    }
    
    public function setGoogleusername($value)
    {
        $this->_googleusername = $value;
    }
    
    public function getQuota()
    {
        return $this->_quota;
    }
    
    public function setQuota($value)
    {
        $this->_quota = $value;
    }
    
    public function getSizeCurrent()
    {
        return $this->_sizeCurrent;
    }
    
    public function setSizeCurrent($value)
    {
        $this->_sizeCurrent = $value;
    }
    
    public function getPersonDescription()
    {
        return $this->_personDescription;
    }
    
    public function setPersonDescription($value)
    {
        $this->_personDescription = $value;
    }
    
    public function getCapabilities()
    {
        return $this->_capabilities;
    }
    
    public function setCapabilities($value)
    {
        $this->_capabilities = $value;
    }
}
