<?php
defined('WPMODUL3R') or die('Direct access not allowed!');

if(isset($structure)) {
    $structureData = json_decode($structure->structure);
}
?>

<form action="<?= $formActionUrl ?>" method="post">
    <table class="form-table">
        <tbody>
            <tr>
                <th><label for="name">Name</label></th>
                <td><input type="text" name="name" id="name" placeholder="Module name" value="<?= isset($structure) ? $structure->name : '' ?>" required></td>
            </tr>
            <tr>
                <th><label>Field</label></th>
                <td>
                    <div class="wp-modul3r-form-repeater">
                        <div class="wp-modul3r-form-repeater-content">
                            <?php
                                if(isset($structure)) :
                                foreach($structureData as $sKey => $sData) :
                            ?>
                                <div class="wp-modul3r-form-repeater-content-row">
                                    <span class="dashicons dashicons-editor-justify"></span>
                                    <input type="text" name="structure[key][]" placeholder="Field key" value="<?= $sKey ?>" required>
                                    <select name="structure[type][]">
                                        <option value="text"<?= $sData == 'text' ? ' selected' : '' ?>>Text</option>
                                        <option value="textarea"<?= $sData == 'textarea' ? ' selected' : '' ?>>Textarea</option>
                                        <option value="html"<?= $sData == 'html' ? ' selected' : '' ?>>HTML editor</option>
                                        <option value="image"<?= $sData == 'image' ? ' selected' : '' ?>>Image uploader</option>
                                        <option value="image_multiple"<?= $sData == 'image_multiple' ? ' selected' : '' ?>>Multiple image uploader</option>
                                        <option value="file"<?= $sData == 'file' ? ' selected' : '' ?>>File uploader</option>
                                        <option value="file_multiple"<?= $sData == 'file_multiple' ? ' selected' : '' ?>>Multiple file uploader</option>
                                    </select>
                                    <a href="javascript:void(0)" class="button">Remove</a>
                                </div>
                            <?php
                                endforeach;
                                endif;
                            ?>
                        </div>

                        <a href="javascript:void(0)" class="button wp-modul3r-form-repeater-add-cta">Add new field</a>
                    </div>
                </td>
            </tr>
            <tr>
                <th><label>Publish</label></th>
                <td>
                    <?php if(isset($structure)) : ?>
                        <label><input type="radio" name="state" value="1" <?= $structure->state == 1 ? 'checked' : '' ?>> Yes, show it</label> &nbsp;
                        <label><input type="radio" name="state" value="0" <?= $structure->state == 0 ? 'checked' : '' ?>> No, i will publish later</label>
                    <?php else : ?>
                        <label><input type="radio" name="state" value="1" checked> Yes, show it</label> &nbsp;
                        <label><input type="radio" name="state" value="0"> No, i will publish later</label>
                    <?php endif; ?>
                </td>
            </tr>
        </tbody>
    </table>

    <?php
        wp_nonce_field('wpmodul3r_action','wpmodul3r_field');
    ?>

    <div style="float: left">
        <?php submit_button(); ?>
    </div>

    <?php if(isset($structure)) : ?>
    <div style="float: right">
        <?php submit_button('Delete this sucker', 'secondary', 'delete'); ?>
    </div>
    <?php endif; ?>
</form>

<template id="template-field">
    <div class="wp-modul3r-form-repeater-content-row">
        <span class="dashicons dashicons-editor-justify"></span>
        <input type="text" name="structure[key][]" placeholder="Field key" required>
        <select name="structure[type][]">
            <option value="text">Text</option>
            <option value="textarea">Textarea</option>
            <option value="html">HTML editor</option>
            <option value="image">Image uploader</option>
            <option value="image_multiple">Multiple image uploader</option>
            <option value="file">File uploader</option>
            <option value="file_multiple">Multiple file uploader</option>
        </select>
        <a href="javascript:void(0)" class="button">Remove</a>
    </div>
</template>
