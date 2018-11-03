<?php
/* Template Name: Donors and partners template */
use App\Theme\Helper as _;

get_header();

$post = get_post();

$data = [
    'post' => $post,
];

_::view('partial/inner', 'header-plain', $data);

$modules = w3r_get_modules($post->ID);

if (count($modules) > 0) {
    foreach($modules as $moduleName => $moduleData) {
        if (isset($modules[$moduleName])) {
            _::view('modules/module', $moduleName, $moduleData);
        }
    }
}

$data = w3r_get_module("partner", "frontpage");
$data->theme = 'theme--white';

_::view('modules/module', 'partner', $data);
?>

    <div class="spacer-100"></div>

<?php
get_footer('dark');
