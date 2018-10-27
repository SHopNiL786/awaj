<?php
defined('WPMODUL3R') or die('Direct access not allowed!');

global $wpdb;
$message = null;
$tableName = $wpdb->prefix.'modul3r_structure';

if(isset($_POST['submit'])) {
    if(!wp_verify_nonce($_POST['wpmodul3r_field'], 'wpmodul3r_action')) {
        wp_redirect($_POST['_wp_http_referer']);
        exit;
    }

    $data = [];
    $data['name'] = sanitize_text_field($_POST['name']);

    $data['structure'] = [];
    for($i = 0; $i < count($_POST['structure']['key']); $i++) {
        $key = trim($_POST['structure']['key'][$i]);
        $type = trim($_POST['structure']['type'][$i]);

        if(strlen($key) > 0) {
            $data['structure'][$key] = $type;
        }
    }

    $data['structure'] = json_encode($data['structure']);
    $data['state'] = intval($_POST['state']);
    $data['created_at'] = current_time( 'mysql' );
    $data['updated_at'] = current_time( 'mysql' );

    $wpdb->insert($tableName, $data);

    if($wpdb->insert_id > 0) {
        $message = ['status' => 'success', 'text' => $data['name'].' module structure has been added!'];
    }
    else {
        $message = ['status' => 'error', 'text' => 'Something went wrong'];
    }
}
?>

<div class="wrap">
    <h1 class="wp-heading-inline">Add New Module Structure</h1>
    <hr class="wp-header-end">

    <?php if($message) : ?>
        <div class="notice notice-<?= $message['status'] ?>"><p><?= $message['text'] ?></p></div>
    <?php endif; ?>

    <?php
        $formActionUrl = admin_url('admin.php?page='.WPMODUL3R_SLUG.'-structure-add');

        include WPMODUL3R_DIR . '/modules/wp-modul3r-structure-form.php';
    ?>
</div>