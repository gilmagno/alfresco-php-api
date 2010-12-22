<?php

require_once 'WebService/WebServiceFactory.php';
require_once 'BaseObject.php';

class AlfAdministration extends AlfBaseObject
{
private $_connectionUrl;
private $_ticket;
private $_administrationService;

public function __construct($connectionUrl="http://localhost:8080/alfresco/api", $ticket)
{
$this->_connectionUrl = $connectionUrl;
$this->_ticket = $ticket;
$this->_administrationService = AlfWebServiceFactory::getAdministrationService($this->_connectionUrl, $this->_ticket);
}

public function changePassword($username, $old_password, $new_password)
{
$this->_administrationService->changePassword(array (
"userName" => $username,
"oldPassword" => $old_password,
"newPassword" => $new_password
));
}

public function getUser($username)
{
$result = $this->_administrationService->getUser(array("userName" => $username));
return UserDetails::createUserDetails($result->result);
}

public function get_allUsers()
{
$result = $this->_administrationService->queryUsers();
return UserQueryResult::createUserQueryResult($result->result);
}
}

class UserQueryResult
{
public $query_session = null;
public $users = array();

public static function createUserQueryResult($web_service_result)
{
$user_query_result = new UserQueryresult();
$user_query_result->query_session = $web_service_result->querySession;

foreach($web_service_result->userDetails as $web_service_user_details)
{
$user_query_result->users[] = UserDetails::createUserDetails($web_service_user_details);
}

return $user_query_result;
}
}

class UserDetails
{
public $name = null;
public $user_name = null;
public $first_name = null;
public $last_name = null;
public $email = null;
public $home_folder = null;
public $organization_id = null;
public $password = null; // Only set if these are the details of a new user

public static function createUserDetails($web_service_user_details)
{
$user_details = new UserDetails();
$user_details->user_name = $web_service_user_details->userName;

foreach($web_service_user_details->properties as $property)
{
if ($property->name == "{http://www.alfresco.org/model/content/1.0}name")
{
$user_details->name = $property->value;
}
else if ($property->name == "{http://www.alfresco.org/model/content/1.0}firstName")
{
$user_details->first_name = $property->value;
}
else if ($property->name == "{http://www.alfresco.org/model/content/1.0}lastName")
{
$user_details->last_name = $property->value;
}
else if ($property->name == "{http://www.alfresco.org/model/content/1.0}email")
{
$user_details->email = $property->value;
}
else if ($property->name == "{http://www.alfresco.org/model/content/1.0}organizationId")
{
$user_details->organization_id = $property->value;
}
else if ($property->name == "{http://www.alfresco.org/model/content/1.0}homeFolder")
{
$user_details->home_folder = $property->value;
}
}

return $user_details;
}
}

?>