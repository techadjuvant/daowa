<?php
/**
 * Daowa functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Daowa
 * @since 1.0.0
 */

/**
 * Daowa only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

if ( ! function_exists( 'daowa_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function daowa_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Daowa, use a find and replace
		 * to change 'daowa' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'daowa', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'daowa' ),
				'footer' => __( 'Footer Menu', 'daowa' ),
				'social' => __( 'Social Links Menu', 'daowa' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 130,
				'width'       => 390,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'daowa' ),
					'shortName' => __( 'S', 'daowa' ),
					'size'      => 19.5,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'daowa' ),
					'shortName' => __( 'M', 'daowa' ),
					'size'      => 22,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'daowa' ),
					'shortName' => __( 'L', 'daowa' ),
					'size'      => 36.5,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'daowa' ),
					'shortName' => __( 'XL', 'daowa' ),
					'size'      => 49.5,
					'slug'      => 'huge',
				),
			)
		);

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Primary', 'daowa' ),
					'slug'  => 'primary',
					'color' => daowa_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 33 ),
				),
				array(
					'name'  => __( 'Secondary', 'daowa' ),
					'slug'  => 'secondary',
					'color' => daowa_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 23 ),
				),
				array(
					'name'  => __( 'Dark Gray', 'daowa' ),
					'slug'  => 'dark-gray',
					'color' => '#111',
				),
				array(
					'name'  => __( 'Light Gray', 'daowa' ),
					'slug'  => 'light-gray',
					'color' => '#767676',
				),
				array(
					'name'  => __( 'White', 'daowa' ),
					'slug'  => 'white',
					'color' => '#FFF',
				),
			)
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'daowa_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function daowa_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Footer', 'daowa' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'daowa' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'daowa_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function daowa_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'daowa_content_width', 640 );
}
add_action( 'after_setup_theme', 'daowa_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function daowa_scripts() {
	wp_enqueue_style( 'daowa-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

	wp_style_add_data( 'daowa-style', 'rtl', 'replace' );

	wp_enqueue_script( 'jquery', get_theme_file_uri( '/js/jquery.min.js' ), array(), '1.1', true );
	wp_enqueue_script( 'bootstrap', get_theme_file_uri( '/js/bootstrap.min.js' ), array(), '1.1', true );
	wp_enqueue_script( 'smooth-scroll', get_theme_file_uri( '/js/smooth-scroll.min.js' ), array(), '1.1', true );
	wp_enqueue_script( 'parallax', get_theme_file_uri( '/js/parallax.js' ), array(), '1.1', true );
	wp_enqueue_script( 'scripts', get_theme_file_uri( '/js/scripts.js' ), array(), '1.1', true );

	if ( has_nav_menu( 'menu-1' ) ) {
		wp_enqueue_script( 'daowa-priority-menu', get_theme_file_uri( '/js/priority-menu.js' ), array(), '1.1', true );
		wp_enqueue_script( 'daowa-touch-navigation', get_theme_file_uri( '/js/touch-keyboard-navigation.js' ), array(), '1.1', true );
	}

	wp_enqueue_style( 'daowa-print-style', get_template_directory_uri() . '/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'daowa_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function daowa_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'daowa_skip_link_focus_fix' );

/**
 * Enqueue supplemental block editor styles.
 */
function daowa_editor_customizer_styles() {

	wp_enqueue_style( 'daowa-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.1', 'all' );

	if ( 'custom' === get_theme_mod( 'primary_color' ) ) {
		// Include color patterns.
		require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
		wp_add_inline_style( 'daowa-editor-customizer-styles', daowa_custom_colors_css() );
	}
}
add_action( 'enqueue_block_editor_assets', 'daowa_editor_customizer_styles' );

/**
 * Display custom color CSS in customizer and on frontend.
 */
function daowa_colors_css_wrap() {

	// Only include custom colors in customizer or frontend.
	if ( ( ! is_customize_preview() && 'default' === get_theme_mod( 'primary_color', 'default' ) ) || is_admin() ) {
		return;
	}

	require_once get_parent_theme_file_path( '/inc/color-patterns.php' );

	$primary_color = 199;
	if ( 'default' !== get_theme_mod( 'primary_color', 'default' ) ) {
		$primary_color = get_theme_mod( 'primary_color_hue', 199 );
	}
	?>

	<style type="text/css" id="custom-theme-colors" <?php echo is_customize_preview() ? 'data-hue="' . absint( $primary_color ) . '"' : ''; ?>>
		<?php echo daowa_custom_colors_css(); ?>
	</style>
	<?php
}
add_action( 'wp_head', 'daowa_colors_css_wrap' );



// Add this to create Dropdown Menu	 
class CSS_Menu_Maker_Walker extends Walker {
	var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
    
	function start_lvl( &$output, $depth = 0, $args = array() ) {  
	  $indent = str_repeat("\t", $depth);  
	  $output .= "\n$indent<ul>\n";  
	}  
  
	function end_lvl( &$output, $depth = 0, $args = array() ) {  
	  $indent = str_repeat("\t", $depth);  
	  $output .= "$indent</ul>\n";  
	}
    
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    
	  global $wp_query;  
	  $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';  
	  $class_names = $value = '';          
	  $classes = empty( $item->classes ) ? array() : (array) $item->classes;  
  
	  /* Add active class */  
	  if(in_array('current-menu-item', $classes)) { 
		$classes[] = 'active';  
		unset($classes['current-menu-item']);  
	  }
   
	  /* Check for children */
  
	  $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));  
	  if (!empty($children)) {  
		$classes[] = 'has-sub';  
	  }
    
	  $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );  
	  $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
    
	  $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );  
	  $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
    
	  $output .= $indent . '<li' . $id . $value . $class_names .'>';
    
	  $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : ''; 
	  $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
	  $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';  
	  $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

	  $item_output = $args->before; 
	  $item_output .= '<a'. $attributes .'><span>';  
	  $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;  
	  $item_output .= '</span></a>';  
	  $item_output .= $args->after;  
	  $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );  
	}
    
	function end_el( &$output, $item, $depth = 0, $args = array() ) {  
	  $output .= "</li>\n";  
	}
  }

/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-daowa-svg-icons.php';

/**
 * Custom Comment Walker template.
 */
require get_template_directory() . '/classes/class-daowa-walker-comment.php';

/**
 * Enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
