<?php
defined('WPMODUL3R') or die('Direct access not allowed!');

global $wpdb;

$moduleStructure = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}modul3r_structure WHERE id = {$selectedModuleStructure}");
$moduleStructure = $moduleStructure[0];
$moduleStructure->structure = json_decode($moduleStructure->structure);

$pages = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_type = 'page' AND post_status != 'auto-draft' ORDER by ID DESC");
?>

<?php if(!isset($module)) : ?>
    <p>Let add a new module for a page!</p>
<?php endif; ?>

<form action="<?= $formActionUrl ?>" method="post">
    <input type="hidden" name="structure_id" value="<?= $selectedModuleStructure ?>">
    <table class="form-table">
        <tbody>
        <tr>
            <th><label for="page_id">Select page</label></th>
            <td>
                <select name="page_id" id="page_id" required>
                    <option value="">Select</option>
                    <?php foreach ($pages as $page) : ?>
                        <option value="<?= $page->ID ?>" <?= (isset($module) && $module->page_id == $page->ID) ? 'selected' : '' ?>><?= $page->post_title ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="theme_key">Theme key</label></th>
            <td>
                <?php
                    if(isset($module)) {
                        $theme_key = $module->theme_key;
                    }
                    else {
                        $theme_key = sanitize_title_with_dashes($moduleStructure->name);
                    }
                ?>
                <input type="text" name="theme_key" id="theme_key" value="<?= $theme_key ?>" required>
                <?php if ($theme_key && $module) : ?>
                    <span class="description">This must be unique. So in theme you can use <code>w3r_get_module("<?= $theme_key ?>", "<?= sanitize_title_with_dashes(get_the_title($module->page_id)) ?>")</code></span>
                <?php else : ?>
                    <span class="description">This must be unique. So in theme you can use <code>w3r_get_module("theme_key", "page_id")</code></span>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th><label for="name">Name</label></th>
            <td><input type="text" name="name" id="name" placeholder="Mask name for indentify module" value="<?= isset($module) ? $module->name : $moduleStructure->name ?>" style="width: 50%" required></td>
        </tr>

        <?php foreach ($moduleStructure->structure as $fieldKey => $fieldType) : ?>
            <tr>
                <th><label for="<?= $fieldKey ?>"><?= wpModul3rSlugToText($fieldKey) ?></label></th>
                <td>
                    <?php
                        if($fieldType == 'text') {
                            $value = isset($module) ? wpModul3rFindModuleValueByKey($fieldKey, $moduleData) : null;
                            echo '<input type="text" name="_'.$fieldKey.'" id="'.$fieldKey.'" value="'.$value.'" class="wp-modul3r-input-full-width">';
                        }
                        elseif($fieldType == 'image' || $fieldType == 'image_multiple' || $fieldType == 'file' || $fieldType == 'file_multiple') {
                            $multipleImage = ($fieldType == 'image_multiple' || $fieldType == 'file_multiple') ? 'data-rel="multiple"' : null;
                            $isFileUploader = ($fieldType == 'file' || $fieldType == 'file_multiple') ? 'data-file-upload="true"' : null;
                            $value = isset($module) ? wpModul3rFindModuleValueByKey($fieldKey, $moduleData) : null;

                            echo '<div class="wp-modul3r-field-media" data-title="'.wpModul3rSlugToText($fieldKey).'" '.$multipleImage.' '.$isFileUploader.'>';
                            echo '<div class="wp-modul3r-field-media-preview">';
                            if($value) {
                                $idArray = explode(",", $value);
                                foreach ($idArray as $a_id) {
                                    echo wp_get_attachment_image($a_id) ? wp_get_attachment_image($a_id) : wp_get_attachment_link($a_id);
                                }
                            }
                            echo '</div>';
                            echo '<input type="hidden" name="_'.$fieldKey.'" class="wp-modul3r-field-media-input" value="'.$value.'">';
                            echo '<input type="button" class="button wp-modul3r-field-media-opener" value="Upload or Select '.wpModul3rSlugToText($fieldKey).'">';
                            echo ' <input type="button" class="button wp-modul3r-field-media-reset" value="Clear">';
                            echo '</div>';
                        }
                        elseif($fieldType == 'html') {
                            $content = isset($module) ? wpModul3rFindModuleValueByKey($fieldKey, $moduleData) : '';
                            wp_editor( $content, '_'.$fieldKey );
                        }
                        elseif($fieldType == 'textarea') {
                            $value = isset($module) ? wpModul3rFindModuleValueByKey($fieldKey, $moduleData) : null;
                            echo '<textarea id="'.$fieldKey.'" name="_'.$fieldKey.'" class="wp-modul3r-textarea">'.$value.'</textarea>';
                        }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <th><label>Publish</label></th>
            <td>
                <?php if(isset($module)) : ?>
                    <label><input type="radio" name="state" value="1" <?= $module->state == 1 ? 'checked' : '' ?>> Yes, show it</label> &nbsp;
                    <label><input type="radio" name="state" value="0" <?= $module->state == 0 ? 'checked' : '' ?>> No, i will publish later</label>
                <?php else : ?>
                    <label><input type="radio" name="state" value="1" checked> Yes, show it</label> &nbsp;
                    <label><input type="radio" name="state" value="0"> No, i will publish later</label>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th><label for="module_order">Order</label></th>
            <td><input type="number" name="module_order" id="module_order" value="<?= isset($module) ? $module->module_order : null ?>"></td>
        </tr>
        <tr>
            <th></th>
            <td>
                <?php
                    wp_nonce_field('wp_modul3r_action','wp_modul3r_field');
                ?>

                <div style="float: left">
                    <?php submit_button(); ?>
                </div>

                <?php if(isset($module)) : ?>
                <div style="float: right">
                    <?php submit_button('Delete this sucker', 'secondary', 'delete'); ?>
                </div>
                <?php endif; ?>
            </td>
        </tr>
        </tbody>
    </table>
</form>
