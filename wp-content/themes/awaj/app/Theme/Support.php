<?php
/**
 * WordPress theme development library
 *
 * @author Habib Hadi <me@habibhadi.com>
 * @version 1.0.0
 */

namespace App\Theme;

class Support
{
    /**
     * Activate menu
     *
     * @return $this
     */
    public function activeMenu()
    {
        add_theme_support( 'menus' );

        return $this;
    }

    /**
     * Activate post thumbnails
     *
     * @return $this
     */
    public function activePostThumbnail()
    {
        add_theme_support( 'post-thumbnails' );

        return $this;
    }

    public function activateHtml5()
    {
        add_theme_support( 'html5', ['comment-list', 'comment-form', 'search-form', 'gallery', 'caption']);

        return $this;
    }
}
