<?php 

if(empty($page) && !empty($property) ) {
    $terms = get_terms([
        'taxonomy' => 'property_cat',
        'hide_empty' => true,
        'object_ids' => [$property->ID],
    ]);

    if($terms){
        $category = reset($terms);

        $the_query = new WP_Query([
            'post_type' => 'page',
            'posts_per_page' => 1, 
            'meta_query' => array(                  
                'relation' => 'AND',                
                array(
                    'key' => 'page_category',                
                    'value' => $category->term_id,                
                    'compare' => '=',
                ),
            ),
        ]);

        if($the_query->have_posts()){
            $page = clone $the_query->posts[0];	
        }

        wp_reset_query();
    }
}	

$liveHerePages = get_pages([
    'parent' => get_page_by_path('live-here')->ID,
    'sort_column' => "menu_order",
    'sort_order' => 'ASC',
]);

$activePage = reset($liveHerePages);
foreach($liveHerePages as $p){
    if($p->ID == $page->ID){
        $activePage = $p;
        break;
    }
}

load_include('breadcrumbs-pages', [
    'active' => $activePage,
    'pages' => $liveHerePages,
]);

return ['activePage' => $activePage, 'liveHerepages' => $liveHerePages];