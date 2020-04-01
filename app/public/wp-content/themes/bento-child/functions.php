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
