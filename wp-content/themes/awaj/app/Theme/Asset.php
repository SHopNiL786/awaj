<?php
/**
 * WordPress theme development library
 *
 * @author Habib Hadi <me@habibhadi.com>
 * @version 1.0.0
 */

namespace App\Theme;

class Asset
{
    /**
     * style sheets
     *
     * @var array | null
     */
    public $styles = null;

    /**
     * js
     *
     * @var array | null
     */
    public $js = null;

    /**
     * Call wordpress hook for styles
     *
     * @return $this
     */
    public function loadStyles()
    {
        add_action( 'wp_enqueue_scripts', [$this, 'enqueueStyle'] );

        return $this;
    }

    /**
     * Call wordpress hook for js
     *
     * @return $this
     */
    public function loadJs()
    {
        add_action( 'wp_enqueue_scripts', [$this, 'enqueueJs'] );

        return $this;
    }

    /**
     * Enqueue styles
     *
     * @return $this
     */
    public function enqueueStyle()
    {
        wp_enqueue_style( 'style', get_stylesheet_uri(), '', '1.0' );

        if($this->styles) {
            foreach ($this->styles as $key => $style) {
                $styleArray = explode('@', $style);

                wp_enqueue_style( $key, get_template_directory_uri().$styleArray[0], '', $styleArray[1] );
            }
        }
        else {
            wp_enqueue_style( 'app-style', get_template_directory_uri().'/dist/app.css', '', '1.0' );
        }

        return $this;
    }

    /**
     * Enqueue js
     *
     * @return $this
     */
    public function enqueueJs()
    {
        if($this->js) {
            foreach ($this->js as $key => $js) {
                $jsArray = explode('@', $js);

                wp_enqueue_script( $key, get_template_directory_uri().$jsArray[0], array('jquery'), $jsArray[1], true );
            }
        }
        else {
            wp_enqueue_script( 'js', get_template_directory_uri().'/dist/app.js', array('jquery'), '1.0', true );
        }

        return $this;
    }

    /**
     * Set styles
     *
     * @param array $array
     */
    public function setStyles($array)
    {
        $this->styles = $array;

        return $this;
    }

    /**
     * Set js
     *
     * @param array $array
     */
    public function setJs($array)
    {
        $this->js = $array;

        return $this;
    }
}
