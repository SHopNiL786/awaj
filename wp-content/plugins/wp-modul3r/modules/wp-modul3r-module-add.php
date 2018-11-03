<?php
defined('WPMODUL3R') or die('Direct access not allowed!');

global $wpdb;
$message = null;

if(isset($_POST['submit'])) {
    if(!wp_verify_nonce($_POST['wp_modul3r_field'], 'wp_modul3r_action')) {
        wp_redirect($_POST['_wp_http_referer']);
        exit;
    }

    unset($_POST['_wp_http_referer']);

    $postedData = [];
    $postedData['page_id'] = intval($_POST['page_id']);
    $postedData['theme_key'] = wpModul3rSanitizeGet($_POST['theme_key']);
    $postedData['name'] = wpModul3rSanitizeGet($_POST['name']);
    $postedData['state'] = intval($_POST['state']);
    $postedData['module_order'] = intval($_POST['module_order']);
    $postedData['structure_id'] = intval($_POST['structure_id']);
    $postedData['created_at'] = current_time('mysql');
    $postedData['updated_at'] = current_time('mysql');

    $wpdb->insert($wpdb->prefix.'modul3r', $postedData);
    $module_id = $wpdb->insert_id;

    $postedAdditionalData = [];
    foreach ($_POST as $k => $v) {
        if($k[0] == '_') {
            $postedAdditionalData[ltrim($k, '_')] = $v;
        }
    }

    if($module_id) {
        if(count($postedAdditionalData) > 0) {
            foreach ($postedAdditionalData as $key => $value) {
                $additonalData = [];
                $additonalData['module_id'] = $module_id;
                $additonalData['field_key'] = $key;
                $additonalData['field_value'] = str_replace('\\', '', $value);

                $wpdb->insert($wpdb->prefix.'modul3r_data', $additonalData);
            }

            $message = ['status' => 'success', 'text' => $postedData['name'].' has been added!'];
        }
    }
    else {
        $message = ['status' => 'error', 'text' => 'Something went wrong'];
    }
}

$structures = $wpdb->get_results( "SELECT id, name FROM {$wpdb->prefix}modul3r_structure WHERE state = 1 ORDER BY name" );
$selectedModuleStructure = isset($_GET['structure']) ? intval($_GET['structure']) : null;
?>

<div class="wrap">
    <h1 class="wp-heading-inline">Add New Module</h1>
    <hr class="wp-header-end">

    <?php if($message) : ?>
        <div class="notice notice-<?= $message['status'] ?>"><p><?= $message['text'] ?></p></div>
    <?php endif; ?>

    <?php if(count($structures) == 0) : ?>
        <div class="notice notice-warning">
            <p>You don't have any module structure defined. Let's <a href="<?= admin_url('admin.php?page='.WPMODUL3R_SLUG.'-structure-add') ?>">create a module structure</a>!</p>

            <p><a href="<?= admin_url('admin.php?page='.WPMODUL3R_SLUG.'-structure-add') ?>" class="button button-primary">Add New Structure</a></p>  
        </div>
    <?php else : ?>
        <br>
        <form action="<?= admin_url('admin.php?page='.WPMODUL3R_SLUG.'-module-add') ?>" method="get">
            <input type="hidden" name="page" value="<?= WPMODUL3R_SLUG . '-module-add' ?>">
            Choose a module structure
            <select name="structure">
                <?php foreach ($structures as $s) : ?>
                    <option value="<?= $s->id ?>"<?= $s->id == $selectedModuleStructure ? ' selected' : '' ?>><?= $s->name ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" class="button" value="Go">
        </form>

        <?php
            if($selectedModuleStructure) {
                $formActionUrl = admin_url('admin.php?page='.WPMODUL3R_SLUG.'-module-add&structure='.$selectedModuleStructure);
                include WPMODUL3R_DIR . '/modules/wp-modul3r-module-form.php';
            }
        ?>
    <?php endif; ?>
</div>