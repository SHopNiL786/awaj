<?php
/**
 * WordPress theme development library
 *
 * @author Habib Hadi <me@habibhadi.com>
 * @version 1.0.0
 */

namespace App\Theme;

class Widget
{
    public $widgets = [];

    public function set($array = [])
    {
        $this->widgets = $array;

        return $this;
    }

    public function register()
    {
        foreach ($this->widgets as $widget) {
            add_action('widgets_init', function() use($widget){
                register_sidebar($widget);
            });
        }

        return $this;
    }
}
