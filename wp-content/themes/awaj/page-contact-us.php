<?php
/* Template Name: Contact us template */
use App\Theme\Helper as _;

get_header();

$post = get_post();
$featuredImage = _::getFeaturedImageUrl('full', $post->ID);

if ($featuredImage) {
    $data = [
        'post' => $post,
        'featuredImage' => $featuredImage,
    ];

    _::view('partial/inner', 'header', $data);
} else {
    $data = [
        'post' => $post,
    ];

    _::view('partial/inner', 'header-plain', $data);
}
?>

    <!-- general -->
    <section class="general">
        <div class="container">
            <div class="row">
                <div class="columns large-8">

                    <article class="article">
                        <?= apply_filters('the_content', $post->post_content) ?>
                    </article>

                </div>
                <div class="columns large-3 large-offset-1">

                    <aside class="general__aside" data-sal="fade" data-sal-delay="200">
                        <h6 class="general__aside__hl">
                            <i class="icon">
                                <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.1863 15.525C18.4398 14.7785 16.6473 13.6563 15.7637 13.2348C14.7379 12.7422 14.3621 12.7523 13.6359 13.2754C13.0316 13.7121 12.6406 14.1184 11.9449 13.966C11.2492 13.8188 9.87811 12.7777 8.54764 11.4523C7.21717 10.1219 6.18124 8.75078 6.03397 8.05508C5.88671 7.35429 6.29296 6.96836 6.7246 6.36406C7.24764 5.63789 7.26288 5.26211 6.76522 4.23632C6.34374 3.34765 5.22655 1.56015 4.47499 0.813665C3.7285 0.0671805 3.56092 0.229681 3.1496 0.376946C3.1496 0.376946 2.54022 0.620696 1.93592 1.02187C1.18944 1.51953 0.773034 1.93593 0.478503 2.56054C0.18905 3.18515 -0.146106 4.34804 1.56014 7.38476C2.93632 9.8375 4.2871 11.6961 6.29296 13.6969L6.29803 13.702L6.30311 13.707C8.30897 15.7129 10.1625 17.0637 12.6152 18.4399C15.6519 20.1461 16.8148 19.8109 17.4394 19.5215C18.0641 19.232 18.4805 18.8156 18.9781 18.0641C19.3793 17.4598 19.623 16.8504 19.623 16.8504C19.7703 16.4391 19.9379 16.2715 19.1863 15.525Z"/>
                                </svg>
                            </i>
                            <?= _::themeSettingsValue('contact_number') ?>
                        </h6>

                        <div class="general__aside__social">
                            <p>You can follow us on</p>

                            <ul>
                                <li><a href="<?= _::themeSettingsValue('facebook_url') ?>" target="_blank"><i class="icon"><svg class="no--fill" xmlns="http://www.w3.org/2000/svg" fill="#3b5998" viewBox="0 0 512 512"><path d="M426.8 64H85.2C73.5 64 64 73.5 64 85.2v341.6c0 11.7 9.5 21.2 21.2 21.2H256V296h-45.9v-56H256v-41.4c0-49.6 34.4-76.6 78.7-76.6 21.2 0 44 1.6 49.3 2.3v51.8h-35.3c-24.1 0-28.7 11.4-28.7 28.2V240h57.4l-7.5 56H320v152h106.8c11.7 0 21.2-9.5 21.2-21.2V85.2c0-11.7-9.5-21.2-21.2-21.2z" /></svg></i> @<?= _::themeSettingsValue('facebook_name') ?></a></li>
                                <li><a href="<?= _::themeSettingsValue('twitter_url') ?>" target="_blank"><i class="icon"><svg class="no--fill" xmlns="http://www.w3.org/2000/svg" fill="#1da1f2" viewBox="0 0 512 512"><path d="M492 109.5c-17.4 7.7-36 12.9-55.6 15.3 20-12 35.4-31 42.6-53.6-18.7 11.1-39.4 19.2-61.5 23.5C399.8 75.8 374.6 64 346.8 64c-53.5 0-96.8 43.4-96.8 96.9 0 7.6.8 15 2.5 22.1-80.5-4-151.9-42.6-199.6-101.3-8.3 14.3-13.1 31-13.1 48.7 0 33.6 17.2 63.3 43.2 80.7-16-.4-31-4.8-44-12.1v1.2c0 47 33.4 86.1 77.7 95-8.1 2.2-16.7 3.4-25.5 3.4-6.2 0-12.3-.6-18.2-1.8 12.3 38.5 48.1 66.5 90.5 67.3-33.1 26-74.9 41.5-120.3 41.5-7.8 0-15.5-.5-23.1-1.4C62.8 432 113.7 448 168.3 448 346.6 448 444 300.3 444 172.2c0-4.2-.1-8.4-.3-12.5C462.6 146 479 129 492 109.5z" /></svg></i> @<?= _::themeSettingsValue('twitter_name') ?></a></li>
                            </ul>
                        </div>
                    </aside>

                </div>
            </div>
        </div>
    </section>
    <!-- general -->

    <!-- map -->
    <div id="gmap" class="gmap"></div>

    <script src="http://maps.google.com/maps/api/js?key=<?= _::themeSettingsValue('google_map_api_key') ?>"></script>
    <script>
        var mapSettings = {
            zoom: 15,
            lat: <?= _::themeSettingsValue('google_map_lat') ?>,
            lan: <?= _::themeSettingsValue('google_map_lon') ?>,
            disableUi: false,
            selector: 'gmap',
            marker: '<?= _::url('/src/images/maps-and-flags.svg') ?>'
        };

        var gMap_init = function(mapSettings){
            var mapOptions = {
                zoom: mapSettings.zoom,
                center: new google.maps.LatLng(mapSettings.lat, mapSettings.lan),
                disableDefaultUI: mapSettings.disableUi,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            var map = new google.maps.Map(document.getElementById(mapSettings.selector), mapOptions);
            var image = mapSettings.marker;
            var myLatLng = new google.maps.LatLng(mapSettings.lat, mapSettings.lan);

            var beachMarker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                icon: image,
                title: 'Awaj Foundation',
                animation: google.maps.Animation.DROP
            });

            var infowindow = new google.maps.InfoWindow({
                content: '<div class="gmap__text"><h6 class="gmap__text__hl"><?= _::themeSettingsValue('company_name') ?></h6><p class="gmap__text__primary"><?= preg_replace( "/\r|\n/", "", _::themeSettingsValue('company_address') ) ?></p></div>'
            });

            google.maps.event.addListener(beachMarker, 'click', (function () {
                infowindow.open(map, beachMarker);
            }));

        };

        gMap_init(mapSettings);
    </script>
    <!-- map -->

<?php
get_footer('dark');
