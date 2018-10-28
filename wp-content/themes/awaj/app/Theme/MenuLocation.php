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

        $this->submenuFilter();
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
     * @return $this
     */
    public function set($array = [])
    {
        $this->menuArray = $array;

        return $this;
    }

    /**
     * Allow showing submneu item of a menu location
     *
     * @usage _::showMenu('primary-menu', ['submenu' => 'About us']);
     */
    private function submenuFilter() {
        add_filter( 'wp_nav_menu_objects', [$this, 'submenuLimit'], 10, 2 );
    }

    public function submenuLimit( $items, $args )
    {
        if ( empty( $args->submenu ) ) {
            return $items;
        }

        $ids       = wp_filter_object_list( $items, array( 'title' => $args->submenu ), 'and', 'ID' );
        $parent_id = array_pop( $ids );
        $children  = $this->submenuGetChildrenIds( $parent_id, $items );

        foreach ( $items as $key => $item ) {

            if ( ! in_array( $item->ID, $children ) ) {
                unset( $items[$key] );
            }
        }

        return $items;
    }

    private function submenuGetChildrenIds( $id, $items )
    {
        $ids = wp_filter_object_list( $items, array( 'menu_item_parent' => $id ), 'and', 'ID' );

        foreach ( $ids as $id ) {
            $ids = array_merge( $ids, $this->submenuGetChildrenIds( $id, $items ) );
        }

        return $ids;
    }
}
