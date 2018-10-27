<?php
use App\Theme\Helper as _;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?= _::getMetaCharset() ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= _::getPageTitle() ?></title>
	<?php wp_head(); ?>
</head>

<body <?php _::getBodyClass(); ?>>

	header html here
