<?php
/**
 * WordPress theme development library
 *
 * @author Habib Hadi <me@habibhadi.com>
 * @version 1.0.0
 */

namespace App\Theme;

class Filter
{

    /**
     * Custom excerpt length
     * @param  integer $value
     *
     * @return $this
     */
    public function excerptLength($value)
    {
        add_filter('excerpt_length', function() use($value) {
            return $value;
        }, 999);

        return $this;
    }

    /**
     * Remove archive title prefix
     *
     * @return $this
     */
    public function removeArchiveTitle()
    {
        add_filter( 'get_the_archive_title', function($title){
            if ( is_category() ) {
                $title = single_cat_title( '', false );
            } elseif ( is_tag() ) {
                $title = single_tag_title( '', false );
            } elseif ( is_author() ) {
                $title = '<span class="vcard">' . get_the_author() . '</span>';
            } elseif ( is_post_type_archive() ) {
                $title = post_type_archive_title( '', false );
            } elseif ( is_tax() ) {
                $title = single_term_title( '', false );
            }

            return $title;
        });

        return $this;
    }

    /**
     * Send yoast to bottom
     *
     * @return $this
     */
    public function fixYoast()
    {
        add_filter( 'wpseo_metabox_prio', function(){
            return 'low';
        });

        return $this;
    }

    /**
     * Add class to next and prev button
     *
     * @param array $classArray
     * @return $this
     */
    public function addClassToNextPrev($classArray = [])
    {
        add_filter('next_posts_link_attributes', function() use ($classArray) {
            return 'class="'.$classArray['next'].'"';
        });

        add_filter('previous_posts_link_attributes', function() use ($classArray) {
            return 'class="'.$classArray['prev'].'"';
        });

        return $this;
    }
}
