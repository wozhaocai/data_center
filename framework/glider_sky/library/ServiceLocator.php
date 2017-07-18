<?php

/**
* Defines the methods any actual locators must implement
* @package ServiceLocator
* @author Chris Corbyn
*/
interface Locator
{
    /**
     * Inform of whether or not the given class can be found
     * @param string class
     * @return bool
     */
    public function canLocate($class);
    /**
     * Get the path to the class
     * @param string class
     * @return string
     */
    public function getPath($class);
}

/**
* The main service locator.
* Uses loosely coupled locators in order to operate
* @package ServiceLocator
* @author Chris Corbyn
*/
class ServiceLocator
{
    /**
     * Contains any attached service locators
     * @var array Locator
     */
    protected static $locators = array();
    
    /**
     * Attach a new type of locator
     * @param object Locator
     * @param string key
     */
    public static function attachLocator(Locator $locator, $key)
    {
        self::$locators[$key] = $locator;
    }
    /**
     * Remove a locator that's been added
     * @param string key
     * @return bool
     */
    public static function dropLocator($key)
    {
        if (self::isActiveLocator($key))
        {
            unset(self::$locators[$key]);
            return true;
        }
        else return false;
    }
    /**
     * Check if a locator is currently loaded
     * @param string key
     * @return bool
     */
    public static function isActiveLocator($key)
    {
        return array_key_exists($key, self::$locators);
    }
    /**
     * Load in the required service by asking all service locators
     * @param string class
     */
    public function load($class)
    {
        foreach (self::$locators as $key => $obj)
        {
            if ($obj->canLocate($class))
            {
                require_once $obj->getPath($class);
                if (class_exists($class)) return;
            }
        }
    }
}

/**
* PHPs default __autload
* Grabs an instance of ServiceLocator then runs it
* @package ServiceLocator
* @author Chris Corbyn
* @param string class
*/
function glider_sky_autoload($class)
{
    $locator = new ServiceLocator();
    $locator->load($class);
}

spl_autoload_register("glider_sky_autoload");
?>