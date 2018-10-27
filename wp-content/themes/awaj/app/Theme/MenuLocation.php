<?php
/**
 * WordPress theme development library
 *
 * @author Habib Hadi <me@habibhadi.com>
 * @version 1.0.0
 */

namespace App\Theme;

class MenuLocation
{
    /**
     * Menu Array
     *
     * @var array
     */
    public $menuArray = [];

    /**
     * Constructor
     *
     * @param array $array
     */
    public function __construct($array = [])
    {
        if(count($array) > 0) {
            $this->set($array);
        }
    }

    /**
     * Call wordpress hook
     *
     * @return $this
     */
    public function register()
    {
        add_action('init', [$this, 'themeMenuLocations']);

        return $this;
    }

    /**
     * Register menu loations
     *
     * @return $this
     */
    public function themeMenuLocations()
    {
        $menus = [];

        foreach ($this->menuArray as $key => $value) {
            $menus[$key] = __($value);
        }

        register_nav_menus($menus);

        return $this;
    }

    /**
     * Set menu locations array
     *
     * @param array $array
     */
    public function set($array = [])
    {
        $this->menuArray = $array;

        return $this;
    }
}
