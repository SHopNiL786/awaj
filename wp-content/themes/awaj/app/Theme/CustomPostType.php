<?php
/**
 * WordPress theme development library
 *
 * @author Habib Hadi <me@habibhadi.com>
 * @version 1.0.0
 */

namespace App\Theme;

class CustomPostType
{
    public $customPostTypes;

    /**
     * Set custom post type array
     *
     * @param array $array
     * @return $this
     * @internal param $this
     */
    public function set($array = [])
    {
        $this->customPostTypes = $array;

        return $this;
    }

    /**
     * Register custom post type
     *
     * @return $this|bool @this
     */
    public function register()
    {
        if(count($this->customPostTypes) == 0) {
            return false;
        }

        foreach ($this->customPostTypes as $key => $value) {
            add_action( 'init', function() use($key, $value){
                $defaultArguments = [
                    'labels' => [
                        'name' => __( $value['name'] ),
                        'singular_name' => __( $value['singular_name'] )
                    ],
                    'public' => true,
                    'has_archive' => true,
                ];

                if(isset($value['arguments'])) {
                    $this->registerPostType($key, array_merge($defaultArguments, $value['arguments']));
                }
                else {
                    $this->registerPostType($key, $defaultArguments);
                }
            });
        }

        return $this;
    }

    /**
     * Wp hook for register custom post type
     *
     * @param  [string] $key
     * @param  [array] $arguments
     * @return $this
     */
    public function registerPostType($key, $arguments)
    {
        register_post_type($key, $arguments);

        return $this;
    }
}
