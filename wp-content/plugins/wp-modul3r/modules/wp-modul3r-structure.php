<?php
defined('WPMODUL3R') or die('Direct access not allowed!');

global $wpdb;

$tableName = $wpdb->prefix.'modul3r_structure';

$structures = $wpdb->get_results("SELECT id, name, state, created_at, updated_at FROM {$tableName} ORDER BY id DESC");
?>

<div class="wrap">
    <h1 class="wp-heading-inline">All module structures</h1>
    <a href="<?= admin_url('admin.php?page='.WPMODUL3R_SLUG.'-structure-add') ?>" class="page-title-action">Add New</a>
    <hr class="wp-header-end">
    <br>

    <?php if(count($structures) == 0) : ?>
        <p>No module structure found! Lets <a href="<?= admin_url('admin.php?page='.WPMODUL3R_SLUG.'-structure-add') ?>">create new module structure</a></p>
    <?php else : ?>
        <table class="widefat striped">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Created</th>
                    <th>Updated</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($structures as $s) : ?>
                    <tr>
                        <td width="2%"><?= $s->state ? '<span class="dashicons dashicons-visibility wp-modul3r-color-success"></span>' : '<span class="dashicons dashicons-hidden wp-modul3r-color-danger"></span>' ?></td>
                        <td width="60%">
                            <a href="<?= admin_url('admin.php?page='.WPMODUL3R_SLUG.'-structure&edit='.$s->id) ?>">
                                <?= $s->name ?>
                            </a>
                        </td>
                        <td><?= human_time_diff(strtotime($s->created_at)) . ' ago' ?></td>
                        <td><?= human_time_diff(strtotime($s->updated_at)) . ' ago' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    
</div>