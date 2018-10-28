<?php
use App\Theme\Helper as _; ?>

    <!-- footer -->
    <footer class="footer theme--dark">
        <div class="container">
            <div class="row">
                <div class="columns large-2">
                    <a href="<?= _::baseUrl() ?>" class="logo footer__logo">
                        <img src="<?= _::url('/src/images/awaj-dark.svg') ?>" alt="<?= _::siteName() ?>">
                    </a>
                </div>
                <?php _::view('partial/footer', 'menu'); ?>
            </div>

            <?php _::view('partial/footer', 'claim'); ?>
        </div>
    </footer>
    <!-- footer -->

<?php wp_footer(); ?>
</body>
</html>
