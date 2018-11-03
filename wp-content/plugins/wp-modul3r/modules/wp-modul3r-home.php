<?php
defined('WPMODUL3R') or die('Direct access not allowed!');

global $wpdb;
$tableName = $wpdb->prefix.'modul3r';
$modules = $wpdb->get_results("SELECT * FROM {$tableName} ORDER BY module_order");

$pageIdArray = [];
if(count($modules) > 0) {
    foreach ($modules as $m) {
        $pageIdArray[] = $m->page_id;
    }

    $pageIdArray = array_unique($pageIdArray);
    $pages = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE ID IN (".implode(',', $pageIdArray).") ORDER BY ID DESC");
}
?>

<div class="wrap">
    <h1 class="wp-heading-inline">All modules</h1>
    <a href="<?= admin_url('admin.php?page='.WPMODUL3R_SLUG.'-module-add') ?>" class="page-title-action">Add New</a>
    <hr class="wp-header-end">

    <?php if(count($modules) == 0) : ?>
        <p>No module found! Lets <a href="<?= admin_url('admin.php?page='.WPMODUL3R_SLUG.'-module-add') ?>">create new module</a></p>
    <?php else : ?>

        <?php foreach ($pages as $page) : ?>

            <h2><?= $page->post_title ?>'s modules</h2>
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
                <?php foreach($modules as $m) : if($m->page_id == $page->ID) : ?>
                    <tr>
                        <td><?= $m->state ? '<span class="dashicons dashicons-visibility wp-modul3r-color-success"></span>' : '<span class="dashicons dashicons-hidden wp-modul3r-color-danger"></span>' ?></td>
                        <td>
                            <a href="<?= admin_url('admin.php?page='.WPMODUL3R_SLUG.'&edit='.$m->id) ?>">
                                <?= $m->name ?>
                            </a>
                        </td>
                        <td><?= $m->theme_key ?></td>
                        <td align="center"><?= $m->module_order ?></td>
                        <td><?= human_time_diff(strtotime($m->created_at)) . ' ago' ?></td>
                        <td><?= human_time_diff(strtotime($m->updated_at)) . ' ago' ?></td>
                    </tr>
                <?php endif; endforeach; ?>
                </tbody>
            </table>
        <?php endforeach; ?>

    <?php endif; ?>
</div>