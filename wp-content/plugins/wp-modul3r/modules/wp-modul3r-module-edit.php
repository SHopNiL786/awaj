<?php
defined('WPMODUL3R') or die('Direct access not allowed!');

global $wpdb;
$message = null;
$id = isset($_GET['edit']) ? intval($_GET['edit']) : null;

if(!$id) {
    echo '<br><div class="notice notice-warning"><p>Module ID is missing</p></div>';
    exit();
}

$module = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}modul3r WHERE id = {$id}");
if(count($module) == 0) {
    echo '<br><div class="notice notice-error"><p>Module not exists!</p></div>';
    exit();
}
$module = $module[0];

$moduleData = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}modul3r_data WHERE module_id = {$id}");

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
    $postedData['updated_at'] = current_time('mysql');

    $wpdb->update($wpdb->prefix.'modul3r', $postedData, ['id' => $id]);

    $postedAdditionalData = [];
    foreach ($_POST as $k => $v) {
        if($k[0] == '_') {
            $postedAdditionalData[ltrim($k, '_')] = $v;
        }
    }

    if(count($postedAdditionalData) > 0) {
        foreach ($postedAdditionalData as $key => $value) {
            $additonalData = [];
            $additonalData['module_id'] = $id;
            $additonalData['field_key'] = $key;
            $additonalData['field_value'] = str_replace('\\', '', $value);

            $mData = $wpdb->get_results("SELECT id FROM {$wpdb->prefix}modul3r_data WHERE module_id = {$id} AND field_key = '{$key}'");
            if(count($mData) == 0) {
                $wpdb->insert($wpdb->prefix.'modul3r_data', $additonalData);
            }
            else {
                $wpdb->update($wpdb->prefix.'modul3r_data', $additonalData, ['module_id' => $id, 'field_key' => $key]);
            }
        }

        $message = ['status' => 'success', 'text' => $postedData['name'].' has been updated!'];
    }
}
elseif(isset($_POST['delete'])) {
    $wpdb->delete($wpdb->prefix.'modul3r', ['id' => $id]);
    $wpdb->delete($wpdb->prefix.'modul3r_data', ['module_id' => $id]);

    echo '<script>window.location.href = "'.admin_url('admin.php?page='.WPMODUL3R_SLUG).'";</script>';
    exit;
}

if($message) {
    $module = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}modul3r WHERE id = {$id}");
    $module = $module[0];

    $moduleData = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}modul3r_data WHERE module_id = {$id}");
}

$structures = $wpdb->get_results( "SELECT id, name FROM {$wpdb->prefix}modul3r_structure WHERE state = 1 ORDER BY name" );
$selectedModuleStructure = $module->structure_id;
?>

<div class="wrap">
    <h1 class="wp-heading-inline">Edit Module: <?= $module->name ?></h1>
    <a href="<?= admin_url('post.php?post='.$module->page_id.'&action=edit') ?>" class="page-title-action">Back to page "<?= get_the_title($module->page_id) ?>"</a>
    <hr class="wp-header-end">

    <?php if($message) : ?>
        <div class="notice notice-<?= $message['status'] ?>"><p><?= $message['text'] ?></p></div>
    <?php endif; ?>

    <?php
        if($selectedModuleStructure) {
            $formActionUrl = admin_url('admin.php?page='.WPMODUL3R_SLUG.'&edit='.$id);
            include WPMODUL3R_DIR . '/modules/wp-modul3r-module-form.php';
        }
    ?>
</div>
