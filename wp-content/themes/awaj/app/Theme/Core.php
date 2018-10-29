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
}
