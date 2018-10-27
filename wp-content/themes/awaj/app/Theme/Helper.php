<?php
/**
 * WordPress theme development library
 *
 * @author Habib Hadi <me@habibhadi.com>
 * @version 1.0.0
 */

namespace App\Theme;

class Helper
{
    /**
     * Show menu
     * @param  string $menuLocation
     * @param  array  $extra
     * @return null
     */
    public static function showMenu($menuLocation, $extra = [])
    {
        $array = [
            'theme_location' => $menuLocation,
            'container' => false
        ];

        wp_nav_menu(array_merge($array, $extra));

        return new static;
    }

    /**
     * Get wordpress base url
     *
     * @return string
     */
    public static function baseUrl()
    {
        return get_home_url();
    }

    /**
     * Theme url
     *
     * @param  $path string
     * @return string
     */
    public static function url($path = null)
    {
        return get_stylesheet_directory_uri().$path;
    }

    /**
     * Get site name
     *
     * @return string
     */
    public static function siteName()
    {
        return get_bloginfo('name');
    }

    /**
     * Search form of wp
     *
     * @param  $arg argument
     * @return string
     */
    public static function searchForm($arg = null)
    {
        return get_search_form($arg);
    }

    /**
     * Wordpress get template part
     *
     * @return include
     */
    public static function view($arg1, $arg2)
    {
        return get_template_part($arg1, $arg2);
    }

    /**
     * Get a post link
     *
     * @return string
     */
    public static function link()
    {
        return get_the_permalink();
    }

    /**
     * Get featured image url
     *
     * @param  post id $id
     * @param  string $size
     * @return string
     */
    public static function getFeaturedImageUrl($size = 'full', $id = null)
    {
        if(!$id) {
            $id = get_the_ID();
        }

        return get_the_post_thumbnail_url($id, $size);
    }

    /**
     * Get post title
     *
     * @return string
     */
    public static function title()
    {
        return get_the_title();
    }

    /**
     * Get post content
     *
     * @return string
     */
    public static function content()
    {
        return get_the_content();
    }

    /**
     * Get custom field
     *
     * @param  array or string $argument
     * @return string
     */
    public static function getField($argument)
    {
        if(is_array($argument)) {
            $id = $argument['id'];
            $fieldName = $argument['name'];
        }
        else {
            $id = get_the_ID();
            $fieldName = $argument;
        }

        return get_post_meta($id, $fieldName, true);
    }

    /**
     * Get page by it's slug
     *
     * @param  string $slug page slug
     * @return object
     */
    public static function getPage($slug)
    {
        return get_page_by_path($slug);
    }

    /**
     * Generate page title
     *
     * @return string
     */
    public static function getPageTitle()
    {
        $string = wp_title(' ', false);
        if($string) {
            $string .= ' &raquo; ';
        }

        $string .= get_bloginfo('name');

        return $string;
    }

    /**
     * Get meta charset of WordPress
     *
     * @return string
     */
    public static function getMetaCharset()
    {
        return get_bloginfo('charset');
    }

    /**
     * Wordpress get body class
     * 
     * @param  string $class
     * @return string
     */
    public static function getBodyClass($class = null)
    {
        return get_body_class($class);
    }
}
