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
    <script>window.jQuery = window.$ = jQuery;</script>
</head>

<body <?php _::getBodyClass(); ?>>

	<!-- header -->
    <header class="header header--compact theme--dark header--hide header--fixed">
        <div class="container">
            <div class="row">
                <div class="columns small-12 large-2">
                    <h1 class="header__logo">
                        <span><?= _::siteName() ?></span>
                        <a href="<?= _::baseUrl() ?>">
                            <img src="<?= _::url('/src/images/awaj-dark.svg') ?>" alt="<?= _::siteName() ?>">
                        </a>
                    </h1>

                    <button class="header__hamburger hamburger hamburger--slider" type="button">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
                <div class="columns small-12 large-10">
                    <!-- nav -->
                    <div class="nav__wrapper header__nav"></div>
                    <!-- nav -->
                </div>
            </div>
        </div>
    </header>

    <header class="header" id="top">
        <div class="container">
            <div class="row">
                <div class="columns small-12 large-2">
                    <h1 class="header__logo" data-sal="slide-down">
                        <span><?= _::siteName() ?></span>
                        <a href="<?= _::baseUrl() ?>">
                            <img src="<?= _::url('/src/images/awaj-light.svg') ?>" alt="<?= _::siteName() ?>">
                        </a>
                    </h1>

                    <button class="header__hamburger hamburger hamburger--slider" type="button">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
                <div class="columns small-12 large-10">
                    <!-- nav -->
                    <div class="nav__wrapper header__nav" data-sal="slide-down" data-sal-delay="200">
                        <?php _::showMenu('primary-menu', ['menu_class' => 'nav']) ?>

                        <div class="nav__search">
                            <?= _::searchForm(); ?>
                        </div>
                    </div>
                    <!-- nav -->
                </div>
            </div>
        </div>
    </header>
    <!-- header -->
