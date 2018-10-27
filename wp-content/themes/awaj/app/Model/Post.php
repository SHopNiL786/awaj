<?php
namespace App\Model;

/**
 * See usage at bottom
 */

class Post
{
    protected $arg;
    protected $result;

    public function get($resetPostData = true)
    {
        $this->result = new \Wp_query($this->arg);

        if($resetPostData) {
            wp_reset_postdata();
        }

        return $this;
    }

    public static function where($arg)
    {
        $post = new Post();
        $post->arg = $arg;

        return $post;
    }

    public static function reset()
    {
        wp_reset_postdata();
    }

    public function hasPost()
    {
        return $this->result->have_posts();
    }

    public function each($func)
    {
        foreach ($this->result->posts as $key => $post) {
            call_user_func($func, $post, $key);
        }
    }

    public static function fetch($arg)
    {
        $post = new Post();
        $post->arg = $arg;
        $post->get(false);

        return $post->result;
    }
}


/*
// ===============================================================
// custom use
// ===============================================================
$topChartedPosts = Post::where(['post_type' => 'post', 'posts_per_page' => 4, 'category_name' => 'top-chart'])->get();
$topChartedPosts->each(function($post, $index){
    dd($post);
});

// ===============================================================
// default use
// ===============================================================
$the_query = Post::fetch(['post_type' => 'post', 'posts_per_page' => 4]);
if ($the_query->have_posts()) :
    while ( $the_query->have_posts() ) : $the_query->the_post();
        _::view('partial/module', 'grid');
    endwhile;
    Post::reset();
endif;
 */
