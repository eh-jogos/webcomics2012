<?php
/**
 *Fucntions file for the child theme "Twenty Twelve Webcomics", a child theme of Wordpress default theme "Twenty Twelve"
**/

/** CSS Files Enqueue
 * Enqueue styles for the child theme, in the way the codex recomends at https://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme
 */
function webcomics2012_enqueue_styles() {
	global $wp_styles;
	
	wp_enqueue_style('parent-style', get_template_directory_uri().'/style.css');
	
	wp_enqueue_style('child-font', 'http://fonts.googleapis.com/css?family=Raleway:500,700&subset=latin,latin-ext');
	
	wp_enqueue_style("child-rtl", 
		get_stylesheet_directory_uri()."/rtl.css", 
		array("parent-style","parent-ie","child-style")
	);
	$wp_styles->add_data( 'parent-ie', 'conditional', 'lt IE 9',"child-style", "child-rtl" );
}
add_action("wp_enqueue_scripts", "webcomics2012_enqueue_styles");

// END Of CSS Files Enqueue

// Add custom pagination function
// Based on original work at http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin


function twentytwelve_content_nav()
{  
	// Sets how many pages to show (leave it alone)
	$pages = '';
	// Sets how many buttons you want to show in the pagination area
	$range = 3;
	

	$showitems = ($range * 2)+1;  

	global $paged;
	if(empty($paged)) $paged = 1;

	if($pages == '')
	{
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages)
		{
			$pages = 1;
		}
	}   

	if(1 != $pages)
	{
		echo '<ul class="pagination">';
		if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo '<li><a href="'.get_pagenum_link(1).'">&laquo;</a></li>';
		if($paged > 1 && $showitems < $pages) echo '<li>' . previous_posts_link('&laquo; Previous Entries') . '</li>';

		for ($i=1; $i <= $pages; $i++)
		{
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			{
				echo ($paged == $i)? '<li class="current">'.$i.'</li>':'<li><a href="'.get_pagenum_link($i).'" class="inactive" >'.$i.'</a></li>';
			}
		}

		if ($paged < $pages && $showitems < $pages) echo '<li>' . next_posts_link('Next &raquo;','') . '</li>';  
		if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo '<li><a href="'.get_pagenum_link($pages).'">&raquo;</a></li>';
		echo '</ul>';
	}
}

// END pagination

// META INFO FUNCTION
function twentytwelve_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentytwelve' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentytwelve' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'Veja todos os posts de %s', 'twentytwelve' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'Publicado na categoria %1$s e classificado com as tags %2$s em %3$s<span class="by-author"> por %4$s</span>.', 'twentytwelve' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'Publicado na categoria %1$s em %3$s<span class="by-author"> por %4$s</span>.', 'twentytwelve' );
	} else {
		$utility_text = __( 'Publicado em %3$s<span class="by-author"> por %4$s</span>.', 'twentytwelve' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
 // META for post titles
function webcomic2012_title_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentytwelve' ) );
	
	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'Veja todos os posts de %s', 'twentytwelve' ), get_the_author() ) ),
		get_the_author()
	);
	
	$collection_list = WebcomicTag::get_the_webcomic_collection_list(0, '<span class="webcomic-collections">', __(', ', 'twentytwelve'), '</span>');
	
	// Translators: used between list items, there is a space after the comma.
	$storyline_list = WebcomicTag::get_the_webcomic_term_list(0, 'storyline', '<span class="webcomic-storylines">', __(', ', 'twentytwelve'), '</span>');
	
	// Translators: 1 is category, 2 is date, 3 is the author and 4 is collection 5 is storyline.
	if ( $categories_list ) {
		$utility_text = __( 'Publicado em %2$s<span class="by-author"> por %3$s</span>. Categoria: %1$s.', 'twentytwelve' );
	} elseif ( $collection_list && $storyline_list  ) {
		$utility_text = __( 'Publicado em %2$s<span class="by-author"> por %3$s</span>, em %4$s>%5$s.', 'twentytwelve' );
	} else {
		$utility_text = __( 'Publicado em %2$s<span class="by-author"> por %3$s</span>.', 'twentytwelve' );
	}
	
	printf(
		$utility_text,
		$categories_list,
		$date,
		$author,
		$collection_list,
		$storyline_list
		
	);
}
 //META for webcomic posts
function webcomic2012_webcomic_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = WebcomicTag::get_the_webcomic_term_list(0, 'storyline', '<span class="webcomic-storylines">', __(', ', 'twentytwelve'), '</span>');
	
	// Translators: used between list items, there is a space after the comma.
	$tag_list = WebcomicTag::get_the_webcomic_term_list(0, 'character', '<span class="webcomic-characters">', __(', ', 'twentytwelve'), '</span>');
	
	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'Veja todos os posts de %s', 'twentytwelve' ), get_the_author() ) ),
		get_the_author()
	);
	
	$collection_list = WebcomicTag::get_the_webcomic_collection_list(0, '<span class="webcomic-collections">', __(', ', 'twentytwelve'), '</span>');

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'Esta página possui roteiro e arte de %2$s para a história %1$s do %5$s. Publicada em %3$s<span class="by-author"> por %4$s</span>.', 'twentytwelve' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'Esta página faz parte da história %1$s do %5$s. Publicada em %3$s<span class="by-author"> por %4$s</span>.', 'twentytwelve' );
	} else {
		$utility_text = __( 'Publicado em %3$s<span class="by-author"> por %4$s</span>.', 'twentytwelve' );
	}
	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author,
		$collection_list
	);
}

 // META for products in the store page
function webcomic2012_loja_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentytwelve' ) );
	
	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	// Translators: 1 is category, 2 is date.
	$utility_text = __( 'Publicado em %2$s<span class="by-author"> na categoria: %1$s.', 'twentytwelve' );
	
	printf(
		$utility_text,
		$categories_list,
		$date	
	);
}

// END OF META INFO FUNCTION

//WEBCOMICS 2012 SETUP
function webcomic2012_setup() {
	// This theme adds a new footer menu
	register_nav_menu( 'footer-menu', __( 'Footer Menu', 'twentytwelve' ) );
}
add_action( 'after_setup_theme', 'webcomic2012_setup',11 ); 
// END OF WEBCOMICS 2012 SETUP

// READ MORE TRANSLATION
add_filter( 'the_content_more_link', 'webcomics2012_read_more_link' );
function webcomics2012_read_more_link() {
return '<a class="more-link" href="' . get_permalink() . '">...leia mais!</a>';
}


// JETPACK RELATED POSTS
/*
* Customize the Headline of the Related Posts
* http://jetpack.me/support/related-posts/customize-related-posts/#headline
*/ 
function jetpackme_related_posts_headline( $headline ) {
$headline = sprintf(
            '<h3 class="jp-relatedposts-headline"><em>%s</em></h3>',
            esc_html( 'Veja também esses posts relacionados!' )
            );
return $headline;
}
add_filter( 'jetpack_relatedposts_filter_headline', 'jetpackme_related_posts_headline' );

/*
* Exclude a category from the related posts
* http://jetpack.me/support/related-posts/customize-related-posts/#exclude-cats
*/ 
function jetpackme_filter_exclude_category( $filters ) {
    $filters[] = array( 'not' =>
      array( 'term' => array( 'category.slug' => 'produto' ) )
    );
    return $filters;
}
add_filter( 'jetpack_relatedposts_filter_filters', 'jetpackme_filter_exclude_category' );

/*
* Exclude the related posts from appearing in specific posts
* http://jetpack.me/support/related-posts/customize-related-posts/#disable
*/ 

function jetpackme_no_related_posts( $options ) {
	$catObj = get_category_by_slug("produto");
	$catID = $catObj->term_id;
	if ( is_webcomic() || in_category( $catID ) ) {
        $options['enabled'] = false;
    }
    return $options;
}
add_filter( 'jetpack_relatedposts_filter_options', 'jetpackme_no_related_posts' );

// END OF JETPACK RELATED POSTS

?>