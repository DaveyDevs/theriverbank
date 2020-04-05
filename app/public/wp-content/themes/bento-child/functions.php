<?php
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
function my_theme_enqueue_styles()
{

    $parent_style = 'bento-style'; //Put bento here, see if that's right. It might be: 'bento-theme-styles'

    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style(
        'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array($parent_style),
        wp_get_theme()->get('Version')
    );
}


// Sorting by event start date
/** You need to put code in theme functions.php **/

function theme_name_custom_orderby($query_args)
{

    $query_args['orderby'] = 'meta_value'; //orderby will be according to data stored inside the particular meta key

    $query_args['order'] = 'ASC';

    return $query_args;
}


add_filter('event_manager_get_listings_args', 'theme_name_custom_orderby', 99);


function theme_name_custom_orderby_query_args($query_args)
{

    $query_args['meta_key'] = '_event_start_date'; //here you can change your meta key

    return $query_args;
}


add_filter('get_event_listings_query_args', 'theme_name_custom_orderby_query_args', 99);


// This should delete expired events, it checks for them every hour. So check it at 8:30pm

add_filter('event_manager_delete_expired_events_days', function () {
    return 0;
});


// Getting links from custom fields

// Website

function get_website_link($post = null)
{
    $post = get_post($post);

    if ($post->post_type !== 'event_listing')
        return;
    return apply_filters('display_website_link', $post->_website_link, $post);
}

function display_website_link($before = '', $after = '', $echo = true, $post = null)
{
    $event_website_link = get_website_link($post);

    if (strlen($event_website_link) == 0)
        return;

    $event_website_link = esc_attr(strip_tags($event_website_link));

    $event_website_link = $before . $event_website_link . $after;

    if ($echo)
        echo $event_website_link;
    else
        return $event_website_link;
}

// YouTube

function get_youtube_link($post = null)
{
    $post = get_post($post);

    if ($post->post_type !== 'event_listing')
        return;
    return apply_filters('display_youtube_link', $post->_youtube_link, $post);
}

function display_youtube_link($before = '', $after = '', $echo = true, $post = null)
{
    $event_youtube_link = get_youtube_link($post);

    if (strlen($event_youtube_link) == 0)
        return;

    $event_youtube_link = esc_attr(strip_tags($event_youtube_link));

    $event_youtube_link = $before . $event_youtube_link . $after;

    if ($echo)
        echo $event_youtube_link;
    else
        return $event_youtube_link;
}


//Facebook

function get_facebook_link($post = null)
{
    $post = get_post($post);

    if ($post->post_type !== 'event_listing')
        return;
    return apply_filters('display_facebook_link', $post->_facebook_link, $post);
}

function display_facebook_link($before = '', $after = '', $echo = true, $post = null)
{
    $event_facebook_link = get_facebook_link($post);

    if (strlen($event_facebook_link) == 0)
        return;

    $event_facebook_link = esc_attr(strip_tags($event_facebook_link));

    $event_facebook_link = $before . $event_facebook_link . $after;

    if ($echo)
        echo $event_facebook_link;
    else
        return $event_facebook_link;
}

//Instagram

function get_instagram_link($post = null)
{
    $post = get_post($post);

    if ($post->post_type !== 'event_listing')
        return;
    return apply_filters('display_instagram_link', $post->_instagram_link, $post);
}

function display_instagram_link($before = '', $after = '', $echo = true, $post = null)
{
    $event_instagram_link = get_instagram_link($post);

    if (strlen($event_instagram_link) == 0)
        return;

    $event_instagram_link = esc_attr(strip_tags($event_instagram_link));

    $event_instagram_link = $before . $event_instagram_link . $after;

    if ($echo)
        echo $event_instagram_link;
    else
        return $event_instagram_link;
}

//Twitter

function get_twitter_link($post = null)
{
    $post = get_post($post);

    if ($post->post_type !== 'event_listing')
        return;
    return apply_filters('display_twitter_link', $post->_twitter_link, $post);
}

function display_twitter_link($before = '', $after = '', $echo = true, $post = null)
{
    $event_twitter_link = get_twitter_link($post);

    if (strlen($event_twitter_link) == 0)
        return;

    $event_twitter_link = esc_attr(strip_tags($event_twitter_link));

    $event_twitter_link = $before . $event_twitter_link . $after;

    if ($echo)
        echo $event_twitter_link;
    else
        return $event_twitter_link;
}
