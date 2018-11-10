<?php
/**
 * WordPress theme development library
 *
 * @author Habib Hadi <me@habibhadi.com>
 * @version 1.0.0
 */

namespace App\Theme;

class Core
{
    /**
     * Inject assets to theme
     *
     * @param array $array
     * @return this
     */
    public function injectAssets($array = [])
    {
        $asset = new Asset();

        if(isset($array['styles'])) {
            $asset->setStyles($array['styles'])->loadStyles();
        }
        else {
            $asset->loadStyles();
        }

        if(isset($array['js'])) {
            $asset->setJs($array['js'])->loadJs();
        }
        else {
            $asset->loadJs();
        }

        return $this;
    }

    /**
     * Add supports to theme
     *
     * @param array $array
     * @return $this|bool
     */
    public function addSupports($array = [])
    {
        if(count($array) == 0) {
            return false;
        }

        $support = new Support();

        if(in_array('menu', $array)) {
            $support->activeMenu();
        }

        if(in_array('post-thumbnails', $array)) {
            $support->activePostThumbnail();
        }

        if(in_array('html5', $array)) {
            $support->activateHtml5();
        }

        return $this;
    }

    /**
     * Add menu locations
     *
     * @param array $array
     * @return $this
     */
    public function addMenuLocations($array = [])
    {
        $menuLocation = new MenuLocation();
        $menuLocation->set($array)->register();

        return $this;
    }

    /**
     * Add custom post type
     *
     * @param array $array
     * @return $this
     */
    public function addCustomPostType($array = [])
    {
        $customPostType = new CustomPostType();
        $customPostType->set($array)->register();

        return $this;
    }

    /**
     * Add filters
     *
     * @param array $array
     * @return $this
     */
    public function addFilters($array = [])
    {
        $filter = new Filter();

        if(isset($array['excerpt_length'])) {
            $filter->excerptLength($array['excerpt_length']);
        }

        if(isset($array['remove_archive_title']) && $array['remove_archive_title'] == true) {
            $filter->removeArchiveTitle();
        }

        if(isset($array['send_yoast_to_bottom']) && $array['send_yoast_to_bottom'] == true) {
            $filter->fixYoast();
        }

        if(isset($array['next_prev_button_class'])) {
            $filter->addClassToNextPrev($array['next_prev_button_class']);
        }

        return $this;
    }

    /**
     * Add widgets
     *
     * @param array $array
     * @return $this
     */
    public function addWidgets($array = [])
    {
        $widget = new Widget();
        $widget->set($array)->register();

        return $this;
    }

    /**
     * Add theme settings page to admin
     *
     * @param array $settings
     * @return $this
     */
    public function addThemeSettings($settings = [])
    {
        $themeSettings = new ThemeSettings($settings);
        $themeSettings->createPage();

        return $this;
    }

    /**
     * Fix category 404 error
     *
     * @return $this
     */
    public function fixCategory404()
    {
        add_action('pre_get_posts', function($query){
            if ($query->is_main_query() && !$query->is_feed() && !is_admin() && is_category()) {
                $query->set('page_val', get_query_var('paged'));
                $query->set('paged', 0);
            }
        });

        return $this;
    }
}
