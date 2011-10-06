<?php
/**
 * Model class for alfresco's object
 * 
 * @author Bruno Cavalcante <brunofcavalcante@gmail.com>
 * @package alfresco-php-api
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License 3
 */
abstract class Alfresco_Abstract
{
    /**
     * Get Acessor
     * @param string $property
     * @return mixed
     */
    public function __get($property)
    {
        $methodName = 'get' . ucwords($property);
        return $this->$methodName();
    }
    
    /**
     * Set Acessor
     * @param string $property
     * @param mixed $value
     * @return mixed
     */
    public function __set($property, $value)
    {
        $methodName = 'set' . ucwords($property);
        return $this->$methodName($value);
    }
}
