<?php


add_filter('term_links-post_tag','limit_to_five_tags');
function limit_to_five_tags($terms) {
return array_slice($terms,0,3,true);
}

@ini_set( 'upload_max_size' , '64M' );

@ini_set( 'post_max_size', '64M');

@ini_set( 'max_execution_time', '300' );



/**

 * 

 * @Frederic Chien

 * 28/10/2015

 * Thumbs Imagens

 * 

 * */

add_theme_support( 'post-thumbnails' );

add_image_size( '281x66', 281, 66, true ); 

add_image_size( '65x65', 65, 65, true );

add_image_size( '480x360', 480, 360, true );

add_image_size( '830x300', 830, 300, true );

add_image_size( '1200x300', 830, 300, true );



/**

 *

 * @Frederic Chien

 * 28/10/2015

 * Habilitar resumo

 *

 * */

add_action('init', 'my_custom_init');

function my_custom_init() {

	add_post_type_support( 'page', 'excerpt' );

}



/**

 * 

 * @Frederic Chien

 * 28/10/2015

 * Paginação

 * 

 * */

function wp_pagination($pages = '', $range = 9)

{

	global $wp_query, $wp_rewrite;

	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

	$pagination = array(

			'base' => @add_query_arg('page','%#%'),

			'format' => '',

			'total' => $wp_query->max_num_pages,

			'current' => $current,

			'show_all' => true,

			'type' => 'plain'

	);

	if ( $wp_rewrite->using_permalinks() ) $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

	if ( !empty($wp_query->query_vars['s']) ) $pagination['add_args'] = array( 's' => get_query_var( 's' ) );

	echo '<ul class="pag">'.paginate_links( $pagination ).'</ul>';

}



/**

 *

 * @Frederic Chien

 * 28/10/2015

 * Breadcrum

 *

 * */

function wp_custom_breadcrumbs() {



	$showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show

	$delimiter = '&raquo;'; // delimiter between crumbs

	$home = 'Inicio'; // text for the 'Home' link

	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show

	$before = '<span class="current" itemprop="title">'; // tag before the current crumb

	$after = '</span>'; // tag after the current crumb



	global $post;

	$homeLink = get_bloginfo('url');



	if (is_home() || is_front_page()) {



		if ($showOnHome == 1) echo '<a href="' . $homeLink . '" itemprop="url">' . $home . '</a>';



	} else {



		echo '<a href="' . $homeLink . '" itemprop="url">' . $home . '</a> ' . $delimiter . ' ';



		if ( is_category() ) {

			$thisCat = get_category(get_query_var('cat'), false);

			if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');

			echo $before . 'categoria "' . single_cat_title('', false) . '"' . $after;



		} elseif ( is_search() ) {

			echo $before . 'Search results for "' . get_search_query() . '"' . $after;



		} elseif ( is_day() ) {

			echo '<a href="' . get_year_link(get_the_time('Y')) . '" itemprop="url">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';

			echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '" itemprop="url">' . get_the_time('F') . '</a> ' . $delimiter . ' ';

			echo $before . get_the_time('d') . $after;



		} elseif ( is_month() ) {

			echo '<a href="' . get_year_link(get_the_time('Y')) . '" itemprop="url">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';

			echo $before . get_the_time('F') . $after;



		} elseif ( is_year() ) {

			echo $before . get_the_time('Y') . $after;



		} elseif ( is_single() && !is_attachment() ) {

			if ( get_post_type() != 'post' ) {

				$post_type = get_post_type_object(get_post_type());

				$slug = $post_type->rewrite;

				echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/" itemprop="url">' . $post_type->labels->singular_name . '</a>';

				if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

			} else {

				$cat = get_the_category(); $cat = $cat[0];

				$cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');

				if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);

				echo $cats;

				if ($showCurrent == 1) echo $before . get_the_title() . $after;

			}



		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {

			$post_type = get_post_type_object(get_post_type());

			echo $before . $post_type->labels->singular_name . $after;



		} elseif ( is_attachment() ) {

			$parent = get_post($post->post_parent);

			$cat = get_the_category($parent->ID); $cat = $cat[0];

			echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');

			echo '<a href="' . get_permalink($parent) . '" itemprop="url">' . $parent->post_title . '</a>';

			if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;



		} elseif ( is_page() && !$post->post_parent ) {

			if ($showCurrent == 1) echo $before . get_the_title() . $after;



		} elseif ( is_page() && $post->post_parent ) {

			$parent_id  = $post->post_parent;

			$breadcrumbs = array();

			while ($parent_id) {

				$page = get_page($parent_id);

				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '" itemprop="url">' . get_the_title($page->ID) . '</a>';

				$parent_id  = $page->post_parent;

			}

			$breadcrumbs = array_reverse($breadcrumbs);

			for ($i = 0; $i < count($breadcrumbs); $i++) {

				echo $breadcrumbs[$i];

				if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';

			}

			if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;



		} elseif ( is_tag() ) {

			echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;



		} elseif ( is_author() ) {

			global $author;

			$userdata = get_userdata($author);

			echo $before . 'Articles posted by ' . $userdata->display_name . $after;



		} elseif ( is_404() ) {

			echo $before . 'Error 404' . $after;

		}



		if ( get_query_var('paged') ) {

			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';

			echo __('Page') . ' ' . get_query_var('paged');

			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';

		}



		echo '';



	}

}



/**

 *

 * @Frederic Chien

 * 02/03/2016

 * Criando sidebar

 *

 * */

function theme_widgets_init() {

	register_sidebar( array (

			'name' => 'Sidebar',

			'id' => 'sidebar',

			'before_widget' => '<aside class="widget %1$s">',

			'after_widget' => "</aside>",

			'before_title' => '<h3 class="widget-title">',

			'after_title' => '</h3>',

	) );

} // end theme_widgets_init



add_action( 'init', 'theme_widgets_init' );



/**

 *

 * @Frederic Chien

 * 02/03/2016

 * Criando sidebar footer

 *

 * */

function sidebar_footer() {

	register_sidebar( array (

			'name' => 'Sidebar Footer',

			'id' => 'sidebar_footer',

			'before_widget' => '<div id="footer-col1" class="widget-area one_fourth"><aside class="widget %1$s">',

			'after_widget' => "</aside></div>",

			'before_title' => '<h3 class="footer-widget-title">',

			'after_title' => '</h3>',

	) );

} // end sidebar_footer



add_action( 'init', 'sidebar_footer' );



/**

 * 

 * @Frederic Chien

 * 28/10/2015

 * Estilizando footer admin

 * 

 * */

function wpmidia_change_footer_admin () {

	echo "<strong>Competizione</strong>";

}



add_filter('admin_footer_text', 'wpmidia_change_footer_admin');





/**

 * 

 * @Frederic Chien

 * 28/10/2015

 * Aplicando css no login admin

 * 

 * */

add_action( 'login_head', 'wpmidia_custom_login' );

function wpmidia_custom_login() {

	echo '<link media="all" type="text/css" href="'.get_template_directory_uri().'/login-style.css" rel="stylesheet">';

}



/**

 *

 * @Frederic Chien

 * 28/10/2015

 * Ao clicar na logo, enviar para pagina inicial

 *

 * */

add_filter('login_headerurl', 'wpmidia_custom_wp_login_url');

function wpmidia_custom_wp_login_url() {

	return home_url();

}



/**

 *

 * @Frederic Chien

 * 28/10/2015

 * Adicionar alt

 *

 * */

add_filter('login_headertitle', 'wpmidia_custom_wp_login_title');

function wpmidia_custom_wp_login_title() {

	return get_option('blogname');

}



/**

 *

 * @Frederic Chien

 * 28/10/2015

 * Pegando a slug da pagina/post

 *

 * */

function the_slug($echo=true){

	$slug = basename(get_permalink());

	do_action('before_slug', $slug);

	$slug = apply_filters('slug_filter', $slug);

	if( $echo ) echo $slug;

	do_action('after_slug', $slug);

	return $slug;

}



/**

 *

 * @Frederic Chien

 * 28/10/2015

 * Criando o menu da header

 *

 * */

if ( function_exists( 'register_nav_menu' ) ) {

	register_nav_menu( 'menu_header', 'Este é menu header' );

}



/**

 *

 * @Frederic Chien

 * 02/03/2016

 * Criando o menu da footer

 *

 * */

if ( function_exists( 'register_nav_menu' ) ) {

	register_nav_menu( 'menu_footer', 'Este é menu footer' );

}





/**

 *

 * @Frederic Chien

 * 28/10/2015

 * Opçoes de tela desativada

 *

 * */

function wpmidia_remove_screen_options(){

	return false;

}

add_filter('screen_options_show_screen', 'wpmidia_remove_screen_options');


/**

 *

 * @Frederic Chien

 * 28/10/2015

 * Removendo metabox

 *

 * */

add_action('wp_dashboard_setup', 'wpmidia_remove_dashboard_widgets' );



function wpmidia_remove_dashboard_widgets() {

	global $wp_meta_boxes;



	// Remove o widget "Links de entrada" (Incomming links)

	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);

	// remove o widget "Plugins"

	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);

	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);

	unset($wp_meta_boxes['dashboard']['side']['core']['wpdm_dashboard_widget']);

	// remove o widget "Rascunhos recentes" (Recent drafts)

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);

	// remove o widget "QuickPress"

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);

	// remove o widget "Agora" (Right now)

	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);

	// remove o widget "Blog do WordPress" (Primary)

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);

	// remove o widget "Outras notícias do WordPress" (Secondary)

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

}



/**

 *

 * @Frederic Chien

 * 28/10/2015

 * Adicionando Metabox

 *

 * */

add_action('wp_dashboard_setup', 'wpmidia_custom_dashboard_widgets');

function wpmidia_custom_dashboard_widgets() {

	global $wp_meta_boxes;

	wp_add_dashboard_widget('custom_help_widget', 'Suporte', 'wpmidia_custom_dashboard_help');

}



function wpmidia_custom_dashboard_help() {

	echo 'Se você tiver qualquer dúvida ou precisar de ajuda, por favor, entre em contato.';

}



/**

 *

 * @Frederic Chien

 * 28/10/2015

 * Removendo itens do menu

 *

 * */

function remove_menus(){

	

	//remove_menu_page('edit.php'); //Posts

	//remove_menu_page('edit-comments.php'); //Comments

	remove_menu_page('themepunch-google-fonts');

	//remove_menu_page('themes.php'); //Appearance

	//remove_menu_page('plugins.php'); //Plugins

	//remove_menu_page('users.php'); //Users

	//remove_menu_page('tools.php'); //Tools

	//remove_menu_page('options-general.php'); //Settings

}



add_action('admin_menu', 'remove_menus');



if( function_exists('acf_add_options_page') ) {



	$page = acf_add_options_page(array(

			'page_title' 	=> 'Gerenciamento de conteúdo home',

			'menu_title' 	=> 'Gerenciamento de conteúdo home',

			'menu_slug' 	=> 'gerenciamento-de-conteudo',

			'capability' 	=> 'edit_posts',

			'redirect' 	=> false

	));

	

}



/**

 *

 * @Frederic Chien

 * 28/10/2015

 * Custom Posts Types

 *

 * */

if( function_exists('acf_add_local_field_group') ):



acf_add_local_field_group(array (

	'key' => 'group_56d78acc2be45',

	'title' => 'Gerenciamento de conteúdo home',

	'fields' => array (

		array (

			'key' => 'field_56d78ad3aebef',

			'label' => 'Call to action',

			'name' => '',

			'type' => 'tab',

			'instructions' => '',

			'required' => 0,

			'conditional_logic' => 0,

			'wrapper' => array (

				'width' => '',

				'class' => '',

				'id' => '',

			),

			'placement' => 'top',

			'endpoint' => 0,

		),

		array (

			'key' => 'field_56d78b6caebf0',

			'label' => 'Titulo_call',

			'name' => 'titulo_call',

			'type' => 'text',

			'instructions' => '',

			'required' => 0,

			'conditional_logic' => 0,

			'wrapper' => array (

				'width' => '',

				'class' => '',

				'id' => '',

			),

			'default_value' => '',

			'placeholder' => '',

			'prepend' => '',

			'append' => '',

			'maxlength' => '',

			'readonly' => 0,

			'disabled' => 0,

		),

		array (

			'key' => 'field_56d78b80aebf1',

			'label' => 'Subtitulo call',

			'name' => 'subtitulo_call',

			'type' => 'text',

			'instructions' => '',

			'required' => 0,

			'conditional_logic' => 0,

			'wrapper' => array (

				'width' => '',

				'class' => '',

				'id' => '',

			),

			'default_value' => '',

			'placeholder' => '',

			'prepend' => '',

			'append' => '',

			'maxlength' => '',

			'readonly' => 0,

			'disabled' => 0,

		),

		array (

			'key' => 'field_56d78b8baebf2',

			'label' => 'Label Botao',

			'name' => 'label_botao',

			'type' => 'text',

			'instructions' => '',

			'required' => 0,

			'conditional_logic' => 0,

			'wrapper' => array (

				'width' => '',

				'class' => '',

				'id' => '',

			),

			'default_value' => '',

			'placeholder' => '',

			'prepend' => '',

			'append' => '',

			'maxlength' => '',

			'readonly' => 0,

			'disabled' => 0,

		),

		array (

			'key' => 'field_56d78b95aebf3',

			'label' => 'Url botao',

			'name' => 'url_botao',

			'type' => 'url',

			'instructions' => '',

			'required' => 0,

			'conditional_logic' => 0,

			'wrapper' => array (

				'width' => '',

				'class' => '',

				'id' => '',

			),

			'default_value' => '',

			'placeholder' => '',

		),

		array (

			'key' => 'field_56d78c66aebf4',

			'label' => 'Feature Box',

			'name' => '',

			'type' => 'tab',

			'instructions' => '',

			'required' => 0,

			'conditional_logic' => 0,

			'wrapper' => array (

				'width' => '',

				'class' => '',

				'id' => '',

			),

			'placement' => 'top',

			'endpoint' => 0,

		),

		array (

			'key' => 'field_56d78c79aebf5',

			'label' => 'Imagem Box',

			'name' => 'imagem_box',

			'type' => 'image',

			'instructions' => '',

			'required' => 0,

			'conditional_logic' => 0,

			'wrapper' => array (

				'width' => '',

				'class' => '',

				'id' => '',

			),

			'return_format' => 'url',

			'preview_size' => '281x66',

			'library' => 'all',

			'min_width' => '',

			'min_height' => '',

			'min_size' => '',

			'max_width' => '',

			'max_height' => '',

			'max_size' => '',

			'mime_types' => '',

		),

		array (

			'key' => 'field_56d78cb2aebf6',

			'label' => 'Titulo Box',

			'name' => 'titulo_box',

			'type' => 'text',

			'instructions' => '',

			'required' => 0,

			'conditional_logic' => 0,

			'wrapper' => array (

				'width' => '',

				'class' => '',

				'id' => '',

			),

			'default_value' => '',

			'placeholder' => '',

			'prepend' => '',

			'append' => '',

			'maxlength' => '',

			'readonly' => 0,

			'disabled' => 0,

		),

		array (

			'key' => 'field_56d78cc0aebf7',

			'label' => 'Resumo box',

			'name' => 'resumo_box',

			'type' => 'textarea',

			'instructions' => '',

			'required' => 0,

			'conditional_logic' => 0,

			'wrapper' => array (

				'width' => '',

				'class' => '',

				'id' => '',

			),

			'default_value' => '',

			'placeholder' => '',

			'maxlength' => '',

			'rows' => '',

			'new_lines' => 'wpautop',

			'readonly' => 0,

			'disabled' => 0,

		),

		array (

			'key' => 'field_56d78cd1aebf8',

			'label' => 'Label Botao Box',

			'name' => 'label_botao_box',

			'type' => 'text',

			'instructions' => '',

			'required' => 0,

			'conditional_logic' => 0,

			'wrapper' => array (

				'width' => '',

				'class' => '',

				'id' => '',

			),

			'default_value' => '',

			'placeholder' => '',

			'prepend' => '',

			'append' => '',

			'maxlength' => '',

			'readonly' => 0,

			'disabled' => 0,

		),

		array (

			'key' => 'field_56d78cddaebf9',

			'label' => 'Url botao box',

			'name' => 'url_botao_box',

			'type' => 'url',

			'instructions' => '',

			'required' => 0,

			'conditional_logic' => 0,

			'wrapper' => array (

				'width' => '',

				'class' => '',

				'id' => '',

			),

			'default_value' => '',

			'placeholder' => '',

		),

		array (

			'key' => 'field_56d78d0baebfb',

			'label' => 'Feature Box 2',

			'name' => '',

			'type' => 'tab',

			'instructions' => '',

			'required' => 0,

			'conditional_logic' => 0,

			'wrapper' => array (

				'width' => '',

				'class' => '',

				'id' => '',

			),

			'placement' => 'top',

			'endpoint' => 0,

		),

		array (

			'key' => 'field_56d78d1daebfd',

			'label' => 'Imagem Box',

			'name' => 'imagem_box_2',

			'type' => 'image',

			'instructions' => '',

			'required' => 0,

			'conditional_logic' => 0,

			'wrapper' => array (

				'width' => '',

				'class' => '',

				'id' => '',

			),

			'return_format' => 'url',

			'preview_size' => '281x66',

			'library' => 'all',

			'min_width' => '',

			'min_height' => '',

			'min_size' => '',

			'max_width' => '',

			'max_height' => '',

			'max_size' => '',

			'mime_types' => '',

		),

		array (

			'key' => 'field_56d78d40aebfe',

			'label' => 'Titulo Box',

			'name' => 'titulo_box_2',

			'type' => 'text',

			'instructions' => '',

			'required' => 0,

			'conditional_logic' => 0,

			'wrapper' => array (

				'width' => '',

				'class' => '',

				'id' => '',

			),

			'default_value' => '',

			'placeholder' => '',

			'prepend' => '',

			'append' => '',

			'maxlength' => '',

			'readonly' => 0,

			'disabled' => 0,

		),

		array (

			'key' => 'field_56d78d53aebff',

			'label' => 'Resumo box',

			'name' => 'resumo_box_2',

			'type' => 'textarea',

			'instructions' => '',

			'required' => 0,

			'conditional_logic' => 0,

			'wrapper' => array (

				'width' => '',

				'class' => '',

				'id' => '',

			),

			'default_value' => '',

			'placeholder' => '',

			'maxlength' => '',

			'rows' => '',

			'new_lines' => 'wpautop',

			'readonly' => 0,

			'disabled' => 0,

		),

		array (

			'key' => 'field_56d78d68aec00',

			'label' => 'Label Botao Box',

			'name' => 'label_botao_box_2',

			'type' => 'text',

			'instructions' => '',

			'required' => 0,

			'conditional_logic' => 0,

			'wrapper' => array (

				'width' => '',

				'class' => '',

				'id' => '',

			),

			'default_value' => '',

			'placeholder' => '',

			'prepend' => '',

			'append' => '',

			'maxlength' => '',

			'readonly' => 0,

			'disabled' => 0,

		),

		array (

			'key' => 'field_56d78d81aec01',

			'label' => 'Url botao box',

			'name' => 'url_botao_box_2',

			'type' => 'url',

			'instructions' => '',

			'required' => 0,

			'conditional_logic' => 0,

			'wrapper' => array (

				'width' => '',

				'class' => '',

				'id' => '',

			),

			'default_value' => '',

			'placeholder' => '',

		),

		array (

			'key' => 'field_56d78d94aec02',

			'label' => 'Feature Box 3',

			'name' => '',

			'type' => 'tab',

			'instructions' => '',

			'required' => 0,

			'conditional_logic' => 0,

			'wrapper' => array (

				'width' => '',

				'class' => '',

				'id' => '',

			),

			'placement' => 'top',

			'endpoint' => 0,

		),

		array (

			'key' => 'field_56d78d1daebfc',

			'label' => 'Imagem Box',

			'name' => 'imagem_box_3',

			'type' => 'image',

			'instructions' => '',

			'required' => 0,

			'conditional_logic' => 0,

			'wrapper' => array (

				'width' => '',

				'class' => '',

				'id' => '',

			),

			'return_format' => 'url',

			'preview_size' => '281x66',

			'library' => 'all',

			'min_width' => '',

			'min_height' => '',

			'min_size' => '',

			'max_width' => '',

			'max_height' => '',

			'max_size' => '',

			'mime_types' => '',

		),

		array (

			'key' => 'field_56d78db9aec03',

			'label' => 'Titulo Box',

			'name' => 'titulo_box_3',

			'type' => 'text',

			'instructions' => '',

			'required' => 0,

			'conditional_logic' => 0,

			'wrapper' => array (

				'width' => '',

				'class' => '',

				'id' => '',

			),

			'default_value' => '',

			'placeholder' => '',

			'prepend' => '',

			'append' => '',

			'maxlength' => '',

			'readonly' => 0,

			'disabled' => 0,

		),

		array (

			'key' => 'field_56d78dc8aec04',

			'label' => 'Resumo box',

			'name' => 'resumo_box_3',

			'type' => 'textarea',

			'instructions' => '',

			'required' => 0,

			'conditional_logic' => 0,

			'wrapper' => array (

				'width' => '',

				'class' => '',

				'id' => '',

			),

			'default_value' => '',

			'placeholder' => '',

			'maxlength' => '',

			'rows' => '',

			'new_lines' => 'wpautop',

			'readonly' => 0,

			'disabled' => 0,

		),

		array (

			'key' => 'field_56d78ddaaec05',

			'label' => 'Label Botao Box',

			'name' => 'label_botao_box_3',

			'type' => 'text',

			'instructions' => '',

			'required' => 0,

			'conditional_logic' => 0,

			'wrapper' => array (

				'width' => '',

				'class' => '',

				'id' => '',

			),

			'default_value' => '',

			'placeholder' => '',

			'prepend' => '',

			'append' => '',

			'maxlength' => '',

			'readonly' => 0,

			'disabled' => 0,

		),

		array (

			'key' => 'field_56d78decaec06',

			'label' => 'Url botao box',

			'name' => 'url_botao_box_3',

			'type' => 'url',

			'instructions' => '',

			'required' => 0,

			'conditional_logic' => 0,

			'wrapper' => array (

				'width' => '',

				'class' => '',

				'id' => '',

			),

			'default_value' => '',

			'placeholder' => '',

		),

	),

	'location' => array (

		array (

			array (

				'param' => 'options_page',

				'operator' => '==',

				'value' => 'gerenciamento-de-conteudo',

			),

		),

	),

	'menu_order' => 0,

	'position' => 'normal',

	'style' => 'default',

	'label_placement' => 'top',

	'instruction_placement' => 'label',

	'hide_on_screen' => array (

		0 => 'the_content',

		1 => 'excerpt',

		2 => 'featured_image',

		3 => 'categories',

		4 => 'tags',

	),

	'active' => 1,

	'description' => '',

));



endif;

function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


?>


