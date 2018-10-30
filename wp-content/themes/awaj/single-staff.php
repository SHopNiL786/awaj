<?php
/* Template Name: Article full width template */
use App\Theme\Helper as _;

get_header();

$post = get_post();
$featuredImage = _::getFeaturedImageUrl('full', $post->ID);

$data = [
    'post' => $post,
];

_::view('partial/inner', 'header-plain', $data);
?>



<?php
get_footer('dark');
