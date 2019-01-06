<?php
defined('WPMODUL3R') or die('Direct access not allowed!');

/**
 * Sanitize get varible
 *
 * @param $string
 * @return mixed
 */
function wpModul3rSanitizeGet($string) {
    return filter_var($string, FILTER_SANITIZE_STRING);
}

/**
 * Slug text to normal
 *
 * @param $string
 * @return string
 */
function wpModul3rSlugToText($string) {
    return ucwords(str_replace("-", " ", $string));
}

/**
 * Find single module data value by key
 *
 * @param $themeKey
 * @param $array
 * @return mixed
 */
function wpModul3rFindModuleValueByKey($themeKey, $array) {
    foreach ($array as $item) {
        if($themeKey == $item->field_key) {
            return $item->field_value;
        }
    }
}

/**
 * Get a single module of a page
 *
 * @param null $theme_key
 * @param null $page
 * @param bool $debug
 * @return stdClass|WP_Error
 */
function w3r_get_module($theme_key = null, $page = null, $debug = false) {
    global $wpdb;

    if(!$theme_key) {
        return new WP_Error( 405, 'Theme key is missing!' );
    }

    if(!$page) {
        return new WP_Error( 405, 'Page ID or slug is missing' );
    }

    if(!is_numeric($page)) {
        if ($page == 'frontpage' || $page == 'home') {
            $page = w3rGetFrontpageId();
        } else {
            $page = w3rGetIdBySlug($page);
        }
    }

    $data = new stdClass();
    $module = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}modul3r WHERE theme_key = '{$theme_key}' AND page_id = '{$page}'");

    if(count($module) > 0) {
        $module = $module[0];

        $s = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}modul3r_structure WHERE id = {$module->structure_id}");
        $s = $s[0];
        $structure = (array) json_decode($s->structure);

        $moduleData = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}modul3r_data WHERE module_id = '{$module->id}'");

        if(count($moduleData) > 0) {
            $data->module_id = $module->id;

            foreach ($moduleData as $mData) {
                $value = $mData->field_value;

                if(isset($structure[$mData->field_key])) {
                    if($structure[$mData->field_key] == 'image' || $structure[$mData->field_key] == 'image_multiple') {
                        $idArray = explode(",", $value);
                        $value = [];
                        foreach ($idArray as $id) {
                            $value[] = [
                                'url' => wp_get_attachment_image_src($id, 'full')[0],
                                'attachment_id' => $id
                            ];
                        }

                        if(count($value) == 1) {
                            $value = $value[0];
                        }
                    }
                    elseif($structure[$mData->field_key] == 'file' || $structure[$mData->field_key] == 'file_multiple') {
                        $idArray = explode(",", $value);
                        $value = [];
                        foreach ($idArray as $id) {
                            $value[] = [
                                'url' => wp_get_attachment_url($id),
                                'attachment_id' => $id
                            ];
                        }

                        if(count($value) == 1) {
                            $value = $value[0];
                        }
                    }
                }

                $data->{$mData->field_key} = $value;
            }
        }

        if($debug) {
            $data->_module = $module;
            $data->_module_data = $moduleData;
        }
    }

    return $data;
}

/**
 * Get all modules of a page
 *
 * @param  integer or string $page page slug or page id
 * @return array
 */
function w3r_get_modules($page = null) {
    global $wpdb;

    if(!$page) {
        return new WP_Error( 405, 'Page ID or slug is missing' );
    }

    if(!is_numeric($page)) {
        if ($page == 'frontpage' || $page == 'home') {
            $page = w3rGetFrontpageId();
        } else {
            $page = w3rGetIdBySlug($page);
        }
    }

    $data = [];
    $modules = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}modul3r WHERE page_id = '{$page}' ORDER BY module_order");

    if(count($modules) > 0) {
        foreach ($modules as $module) {
            $moduleIdArray[] = $module->id;
            $structureIdArray[] = $module->structure_id;
        }

        $moduleData = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}modul3r_data WHERE module_id IN (".implode(', ', $moduleIdArray).")");

        $structures = [];
        $rawStructures = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}modul3r_structure WHERE id IN (".implode(',', $structureIdArray).")");
        foreach ($rawStructures as $s) {
            $s->structure = (array) json_decode($s->structure);
            $structures[$s->id] = $s->structure;
        }

        foreach ($modules as $module) {
            $data[$module->theme_key] = new stdClass();
            $data[$module->theme_key]->module_id = $module->id;

            foreach ($moduleData as $mData) {
                if($mData->module_id == $module->id)
                {
                    $value = $mData->field_value;

                    if(isset($structures[$module->structure_id][$mData->field_key])) {
                        if($structures[$module->structure_id][$mData->field_key] == 'image' || $structures[$module->structure_id][$mData->field_key] == 'image_multiple') {
                            $idArray = explode(",", $value);
                            $value = [];
                            foreach ($idArray as $id) {
                                $value[] = [
                                    'url' => wp_get_attachment_image_src($id, 'full')[0],
                                    'attachment_id' => $id
                                ];
                            }

                            if(count($value) == 1) {
                                $value = $value[0];
                            }
                        }
                        elseif($structures[$module->structure_id][$mData->field_key] == 'file' || $structures[$module->structure_id][$mData->field_key] == 'file_multiple') {
                            $idArray = explode(",", $value);
                            $value = [];
                            foreach ($idArray as $id) {
                                $value[] = [
                                    'url' => wp_get_attachment_url($id),
                                    'attachment_id' => $id
                                ];
                            }

                            if(count($value) == 1) {
                                $value = $value[0];
                            }
                        }
                    }

                    $data[$module->theme_key]->{$mData->field_key} = $value;
                }
            }

        }
    }

    return $data;
}

/**
 * Get frontpage ID
 *
 * @return mixed|void
 * @throws Exception
 */
function w3rGetFrontpageId() {
    $frontpageId = get_option( 'page_on_front' );

    if ($frontpageId > 0) {
        return $frontpageId;
    }

    $frontpageIdForBlog = get_option( 'page_for_posts' );

    if ($frontpageIdForBlog) {
        return $frontpageIdForBlog;
    }

    throw new \Exception("No frontpage or home ID found!");
}

/**
 * Get page ID by page slug
 *
 * @param $page_slug
 * @return int|null
 */
function w3rGetIdBySlug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}

/**
 * Supply page id as array for search string
 *
 * @param $string
 * @return array
 */
function w3rGetSearchResult($string) {
    global $wpdb;

    $result = [];
    $string = strtolower(trim($string));
    $string = sanitize_text_field($string);

    $moduleIdArray = [];
    $moduleIds = $wpdb->get_results("SELECT module_id FROM {$wpdb->prefix}modul3r_data WHERE field_value LIKE '{$string}%' OR field_value LIKE '% {$string}%'");
    if(count($moduleIds) > 0) {
        foreach ($moduleIds as $m) {
            if(!in_array($m->module_id, $moduleIdArray)) {
                $moduleIdArray[] = $m->module_id;
            }
        }
    }

    if(count($moduleIdArray) > 0) {
        $pageIds = $wpdb->get_results("SELECT page_id FROM {$wpdb->prefix}modul3r WHERE id in (".implode(', ', $moduleIdArray).")");
        foreach ($pageIds as $p) {
            if(!in_array($p->page_id, $result)) {
                $result[] = $p->page_id;
            }
        }
    }

    return $result;
}

/**
 * Dev function
 *
 * @param $array
 */
function w3r_dd($array) {
    echo '<pre><code>';
    print_r($array);
    echo '</code></pre>';
}

/**
 * Adding module data to default WP search result
 *
 * @param $sql
 * @return string
 */
function w3r_search_filer($sql) {
    global $wpdb;

    if (!$sql) {
        return $sql;
    }

    $pageIdArray = w3rGetSearchResult(get_search_query());

    if(count($pageIdArray) == 0) {
        return $sql;
    }

    $pageIdString = implode(", ", $pageIdArray);

    $sqlr = "AND (({$wpdb->prefix}posts.ID in ($pageIdString)) or (1 = 1 $sql))";

    return $sqlr;
}
add_filter('posts_search', 'w3r_search_filer');


/**
 * Add meta box for add new page
 */
function w3r_show_page_modules() {
    global $wpdb;
    $tableName = $wpdb->prefix.'modul3r';

    $post_id = intval($_GET['post']);
    $modules = $wpdb->get_results("SELECT * FROM {$tableName} WHERE page_id = $post_id ORDER BY module_order");

    if (count($modules) > 0) :
    ?>

    <table class="widefat striped">
        <thead>
        <tr>
            <th width="2%"></th>
            <th width="40%">Name</th>
            <th width="18%">Theme key</th>
            <th style="text-align: center" width="10%">Order</th>
            <th width="10%">Created</th>
            <th width="10%">Updated</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($modules as $m) : ?>
            <tr>
                <td width="2%"><?= $m->state ? '<span class="dashicons dashicons-visibility wp-modul3r-color-success"></span>' : '<span class="dashicons dashicons-hidden wp-modul3r-color-danger"></span>' ?></td>
                <td width="40%">
                    <a href="<?= admin_url('admin.php?page='.WPMODUL3R_SLUG.'&edit='.$m->id) ?>">
                        <?= $m->name ?>
                    </a>
                </td>
                <td><?= $m->theme_key ?></td>
                <td align="center"><?= $m->module_order ?></td>
                <td><?= human_time_diff(strtotime($m->created_at)) . ' ago' ?></td>
                <td><?= human_time_diff(strtotime($m->updated_at)) . ' ago' ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <a href="<?= admin_url('admin.php?page='.WPMODUL3R_SLUG.'-module-add') ?>" class="button button-primary button-large">Add new module</a>

    <?php
    else :
        echo '<p>No module! <a href="'.admin_url('admin.php?page='.WPMODUL3R_SLUG.'-module-add').'" class="page-title-action">Create new module</a></p>';
    endif;

}

function add_w3r_meta_box() {
    if (isset($_GET['post'])) {
        add_meta_box('w3r-admin-meta-box', 'Page modules', 'w3r_show_page_modules', 'page', 'normal', 'high', null);
    }
}

add_action('add_meta_boxes', 'add_w3r_meta_box');
