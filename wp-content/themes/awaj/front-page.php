<?php
/* Template Name: Frontpage template */
use App\Theme\Helper as _;

get_header();

$modules = w3r_get_modules('66');

if (count($modules) > 0) {
    foreach($modules as $moduleName => $moduleData) {
        if (isset($modules[$moduleName])) {
            _::view('modules/module', $moduleName, $moduleData);
        }
    }
}

get_footer();