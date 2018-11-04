<?php
/**
 * WordPress theme development library
 *
 * @author Habib Hadi <me@habibhadi.com>
 * @version 1.0.0
 */

namespace App\Theme;

use Carbon\Carbon;

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
     * @param $arg1
     * @param $arg2
     * @param bool $data
     * @return include
     */
    public static function view($arg1, $arg2, $data = false)
    {
        $sep = '__';
        if (strstr($arg2, $sep)) {
            $temp = explode($sep, $arg2);
            $arg2 = $temp[1];
        }

        $prefix = self::dashesToCamelCase($arg2);

        if ($data) {
            set_query_var($prefix.'ModuleData', $data);
        }

        return get_template_part($arg1, $arg2);

        /*
        if ($data) {
            ${$arg2.'ModuleData'} = $data;
        }

        $file = $arg1.'-'.$arg2.'.php';
        $templateFile = locate_template($file, false, false);

        if (!$templateFile) {
            trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
        }

        require($templateFile);
        */
    }

    /**
     * Get a post link
     *
     * @param bool $id
     * @return string
     */
    public static function link($id = false)
    {
        if ($id) {
            return get_permalink($id);
        }

        return get_the_permalink();
    }

    public static function linkCustomPostType($postType)
    {
        return get_post_type_archive_link( $postType );
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

    /**
     * Slug to camel case
     *
     * @param $string
     * @param bool|false $capitalizeFirstCharacter
     * @return mixed|string
     */
    public static function dashesToCamelCase($string, $capitalizeFirstCharacter = false)
    {
        $str = str_replace('-', '', ucwords($string, '-'));

        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }

        return $str;
    }

    /**
     * Format date
     *
     * @param $date
     * @return string
     */
    public static function formatDate($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('l, M j, Y');
    }

    /**
     * Get custom field from acf
     *
     * @param $fieldName
     * @param bool|false $postId
     * @return mixed|null|void
     */
    public static function acfField($fieldName, $postId = false)
    {
        if ($postId) {
            $value = get_field($fieldName, $postId);
        } else {
            $value = get_field($fieldName);
        }

        if (strlen(trim($value)) > 0) {
            return $value;
        }

        return false;
    }

    /**
     * Get all acf fields of a object
     *
     * @param $postId
     * @return object
     */
    public static function acfFields($postId)
    {
        $result = [];
        $data = get_fields($postId);

        if (count($data) > 0) {
            foreach($data as $key => $value) {
                if (strlen(trim($value)) > 0) {
                    $result[$key] = $value;
                }
            }
        }

        return (object) $result;
    }

    /**
     * Determine whether if variable contains value or not
     *
     * @param $value
     * @return bool
     */
    public static function notNull($value)
    {
        return strlen(trim($value)) > 0;
    }

    /**
     * Group by result data
     *
     * @param $name
     * @param $object
     * @return array
     */
    public static function groupBy($name, $object)
    {
        $result = [];

        foreach($object as $key => $value) {
            if (strstr($key, $name)) {
                $result[] = $value;
            }
        }

        return $result;
    }

    /**
     * Get category id by name
     *
     * @param $name
     * @return int
     */
    public static function getCategoryIdByName($name)
    {
        return get_cat_ID($name);
    }

    /**
     * Get category link
     *
     * @param $arg
     * @return string
     */
    public static function getCategoryLink($arg)
    {
        if (is_numeric($arg)) {
            $categoryId = $arg;
        } else {
            $categoryId = self::getCategoryIdByName($arg);
        }

        return get_category_link($categoryId);
    }
}
