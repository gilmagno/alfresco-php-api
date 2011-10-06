<?php
/**
 * @see Alfresco_Abstract
 */
require_once 'Abstract.php';

/**
 * Represents a Person from Alfresco
 * 
 * @author Bruno Cavalcante <brunofcavalcante@gmail.com>
 * @package alfresco-php-api
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
    
    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->_url;
    }
    
    /**
     * @param string $value
     */
    public function setUrl($value)
    {
        $this->_url = $value;
    }
    
    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->_userName;
    }
    
    /**
     * @param string $value
     */
    public function setUserName($value)
    {
        $this->_userName = $value;
    }
    
    /**
     * @return string
     */
    public function getEnabled()
    {
        return $this->_enabled;
    }
    
    /**
     * @param string $value
     */
    public function setEnabled($value)
    {
        $this->_enabled = $value;
    }
    
    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->_firstName;
    }
    
    /**
     * @param string $value
     */
    public function setFirstName($value)
    {
        $this->_firstName = $value;
    }
    
    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->_lastName;
    }
    
    /**
     * @param string $value
     */
    public function setLastName($value)
    {
        $this->_lastName = $value;
    }
    
    /**
     * @return string
     */
    public function getJobtitle()
    {
        return $this->_jobtitle;
    }
    
    /**
     * @param string $value
     */
    public function setJobtitle($value)
    {
        $this->_jobtitle = $value;
    }
    
    /**
     * @return string
     */
    public function getOrganization()
    {
        return $this->_organization;
    }
    
    /**
     * @param string $value
     */
    public function setOrganization($value)
    {
        $this->_organization = $value;
    }
    
    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->_location;
    }
    
    /**
     * @param string $value
     */
    public function setLocation($value)
    {
        $this->_location = $value;
    }
    
    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->_telephone;
    }
    
    /**
     * @param string $value
     */
    public function setTelephone($value)
    {
        $this->_telephone = $value;
    }
    
    /**
     * @return string
     */
    public function getMobile()
    {
        return $this->_mobile;
    }
    
    /**
     * @param string $value
     */
    public function setMobile($value)
    {
        $this->_mobile = $value;
    }
    
    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }
    
    /**
     * @param string $value
     */
    public function setEmail($value)
    {
        $this->_email = $value;
    }
    
    /**
     * @return string
     */
    public function getCompanyaddress1()
    {
        return $this->_companyaddress1;
    }
    
    /**
     * @param string $value
     */
    public function setCompanyaddress1($value)
    {
        $this->_companyaddress1 = $value;
    }
    
    /**
     * @return string
     */
    public function getCompanyaddress2()
    {
        return $this->_companyaddress2;
    }
    
    /**
     * @param string $value
     */
    public function setCompanyaddress2($value)
    {
        $this->_companyaddress2 = $value;
    }
    
    /**
     * @return string
     */
    public function getCompanyaddress3()
    {
        return $this->_companyaddress3;
    }
    
    /**
     * @param string $value
     */
    public function setCompanyaddress3($value)
    {
        $this->_companyaddress3 = $value;
    }
    
    /**
     * @return string
     */
    public function getCompanyaddress4()
    {
        return $this->_companyaddress4;
    }
    
    /**
     * @param string $value
     */
    public function setCompanyaddress4($value)
    {
        $this->_companyaddress4 = $value;
    }
    
    /**
     * @return string
     */
    public function getCompanytelephone()
    {
        return $this->_companytelephone;
    }
    
    /**
     * @param string $value
     */
    public function setCompanytelephone($value)
    {
        $this->_companytelephone = $value;
    }
    
    /**
     * @return string
     */
    public function getCompanyfax()
    {
        return $this->_companyfax;
    }
    
    /**
     * @param string $value
     */
    public function setCompanyfax($value)
    {
        $this->_companyfax = $value;
    }
    
    /**
     * @return string
     */
    public function getCompanyemail()
    {
        return $this->_companyemail;
    }
    
    /**
     * @param string $value
     */
    public function setCompanyemail($value)
    {
        $this->_companyemail = $value;
    }
    
    /**
     * @return string
     */
    public function getCompanypostcode()
    {
        return $this->_companypostcode;
    }
    
    /**
     * @param string $value
     */
    public function setCompanypostcode($value)
    {
        $this->_companypostcode = $value;
    }
    
    /**
     * @return string
     */
    public function getSkype()
    {
        return $this->_skype;
    }
    
    /**
     * @param string $value
     */
    public function setSkype($value)
    {
        $this->_skype = $value;
    }
    
    /**
     * @return string
     */
    public function getInstantmsg()
    {
        return $this->_instantmsg;
    }
    
    /**
     * @param string $value
     */
    public function setInstantmsg($value)
    {
        $this->_instantmsg = $value;
    }
    
    /**
     * @return string
     */
    public function getUserStatus()
    {
        return $this->_userStatus;
    }
    
    /**
     * @param string $value
     */
    public function setUserStatus($value)
    {
        $this->_userStatus = $value;
    }
    
    /**
     * @return string
     */
    public function getUserStatusTime()
    {
        return $this->_userStatusTime;
    }
    
    /**
     * @param string $value
     */
    public function setUserStatusTime($value)
    {
        $this->_userStatusTime = $value;
    }
    
    /**
     * @return string
     */
    public function getGoogleusername()
    {
        return $this->_googleusername;
    }
    
    /**
     * @param string $value
     */
    public function setGoogleusername($value)
    {
        $this->_googleusername = $value;
    }
    
    /**
     * @return string
     */
    public function getQuota()
    {
        return $this->_quota;
    }
    
    /**
     * @param string $value
     */
    public function setQuota($value)
    {
        $this->_quota = $value;
    }
    
    /**
     * @return string
     */
    public function getSizeCurrent()
    {
        return $this->_sizeCurrent;
    }
    
    /**
     * @param string $value
     */
    public function setSizeCurrent($value)
    {
        $this->_sizeCurrent = $value;
    }
    
    /**
     * @return string
     */
    public function getPersonDescription()
    {
        return $this->_personDescription;
    }
    
    /**
     * @param string $value
     */
    public function setPersonDescription($value)
    {
        $this->_personDescription = $value;
    }
    
    /**
     * @return string
     */
    public function getCapabilities()
    {
        return $this->_capabilities;
    }
    
    /**
     * @param string $value
     */
    public function setCapabilities($value)
    {
        $this->_capabilities = $value;
    }
}
