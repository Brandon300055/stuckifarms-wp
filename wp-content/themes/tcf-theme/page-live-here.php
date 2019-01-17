<?php
/*
 Template Name: Live Here Template
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/

// $terms = get_terms(array(
//     'taxonomy' => 'property_movein_cat',
//     'hide_empty' => false,
// ));



if (have_posts()){
	while (have_posts()){
		the_post();

		page_title_block('Live at Stucki Farms');

		$args = load_include('property-breadcrumb', ['page' => $post]);

		load_include('archive-property', ['page' => $args['activePage']]);
	}
}
