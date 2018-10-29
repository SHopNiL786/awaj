<?php
defined('WPMODUL3R') or die('Direct access not allowed!');

global $wpdb;
$message = null;
$tableName = $wpdb->prefix.'modul3r_structure';
$id = isset($_GET['edit']) ? intval($_GET['edit']) : null;

if(!$id) {
    echo '<br><div class="notice notice-warning"><p>Module structure ID is missing</p></div>';
    exit();
}

$structure = $wpdb->get_results("SELECT * FROM {$tableName} WHERE id = {$id}");
if(count($structure) == 0) {
    echo '<br><div class="notice notice-error"><p>Module structure not exists!</p></div>';
    exit();
}
$structure = $structure[0];

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
    $data['updated_at'] = current_time( 'mysql' );

    $wpdb->update($tableName, $data, ['id' => $id]);

    $message = ['status' => 'success', 'text' => $data['name'].' module structure has been updated!'];
}
elseif(isset($_POST['delete'])) {
    $wpdb->delete($tableName, ['id' => $id]);

    echo '<script>window.location.href = "'.admin_url('admin.php?page='.WPMODUL3R_SLUG.'-structure').'";</script>';
    exit;
}

if($message) {
    $structure = $wpdb->get_results("SELECT * FROM {$tableName} WHERE id = {$id}");
    $structure = $structure[0];
}
?>

<div class="wrap">
    <h1 class="wp-heading-inline">Edit Module Structure</h1>
    <hr class="wp-header-end">

    <?php if($message) : ?>
        <div class="notice notice-<?= $message['status'] ?>"><p><?= $message['text'] ?></p></div>
    <?php endif; ?>

    <?php
        $formActionUrl = admin_url('admin.php?page='.WPMODUL3R_SLUG.'-structure&edit='.$id);

        include WPMODUL3R_DIR . '/modules/wp-modul3r-structure-form.php';
    ?>
</div>
