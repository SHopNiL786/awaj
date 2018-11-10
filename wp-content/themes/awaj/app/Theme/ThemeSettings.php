<?php
/**
 * WordPress theme development library
 *
 * @author Habib Hadi <me@habibhadi.com>
 * @version 1.0.0
 */

namespace App\Theme;

class ThemeSettings
{
    private $settings = [];
    private $themeSettingsPageKey = 'theme-settings-section';

    public function __construct($settings = [])
    {
        $this->settings = $settings;
    }

    /**
     * Create page
     *
     * @return bool
     */
    public function createPage()
    {
        if (count($this->settings) == 0) {
            return false;
        }

        add_action('admin_menu', [$this, 'addMenuItem']);
        add_action('admin_init', [$this, 'displayThemeFields']);
    }

    /**
     * Add menu item
     *
     * @return $this
     */
    public function addMenuItem()
    {
        add_menu_page('Theme settings', 'Theme settings', 'manage_options', 'theme-settings', [$this, 'themeSettingsPage'], null, 99);

        return $this;
    }

    /**
     * Theme settings page
     */
    public function themeSettingsPage()
    {
        echo '<div class="wrap">';
        echo '<h1>Theme Settings</h1>';
        echo '<form method="post" action="options.php">';

        settings_fields($this->themeSettingsPageKey);
        do_settings_sections($this->themeSettingsPageKey);
        submit_button();

        echo '</form>';
        echo '</div>';
    }

    /**
     * Display theme fields
     */
    public function displayThemeFields()
    {
        add_settings_section($this->themeSettingsPageKey, "All Settings", null, $this->themeSettingsPageKey);

        foreach($this->settings as $fieldKey => $field) {
            add_settings_field($fieldKey, $field['label'], function() use ($fieldKey, $field){

                if ($field['type'] == 'text') {
                    echo '<input type="text" name="'.$fieldKey.'" id="'.$fieldKey.'" value="'.get_option($fieldKey).'" class="regular-text">';
                } else if ($field['type'] == 'textarea') {
                    echo '<textarea name="'.$fieldKey.'" id="'.$fieldKey.'" rows="5" class="regular-text">'.get_option($fieldKey).'</textarea>';
                }

            }, $this->themeSettingsPageKey, $this->themeSettingsPageKey, ['label_for' => $fieldKey]);

            register_setting($this->themeSettingsPageKey, $fieldKey);
        }
    }

}