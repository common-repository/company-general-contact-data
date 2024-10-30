<?php

/*
Plugin Name: Contact Data
Plugin URI: http://www.cuadric.com/plugins/contact-data
Description: Manage all your contact information from a single admin page and recover it with one single function.
Tags: Contact information, Contact data, Contact admin page, Social networks
Author URI: http://www.cuadric.com/
Author: Gonzalo Sanchez
Contributors: Gonzalo Sanchez
Donate link: http://www.cuadric.com/plugins/contact-data
Requires at least: 3.0
Tested up to: 3.5
Stable tag: 0.2
Version: 0.2
License: GPLv2 or later
*/

// ==============================================================================================================================================================

// Creamos una página de configuración DATOS DE LA EMRESA en el menú Ajustes !!!!! :)

// ==============================================================================================================================================================

/**
*	Al activar el plugin creamos la option en la la tabla wp_options si aún no existe
*/
function contact_data_on_activate() {

    $deprecated = ' ';
    $autoload = 'no';
	if ( !get_option( 'cd_contact_data' ) )  {
		add_option( 'cd_contact_data', '', $deprecated, $autoload );
	}

}
register_activation_hook( __FILE__, 'contact_data_on_activate' );

// ==============================================================================================================================================================

/**
*	Creamos la página de administración dentro del menú lateral "Settings" (Ajustes).
*	'Settings' -> 'Contact Data'
*/
function cd_contact_data_create_settings_page() {

	// add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);

	$cd_options_page = add_options_page('Contact Data', 'Contact Data', 'manage_options', 'cd-contact-data', 'create_cd_contact_data_settings_page'); 

	add_action('admin_print_styles-' . $cd_options_page, 'cd_contact_data_enqueque');

	load_plugin_textdomain('contact-data', false, basename( dirname( __FILE__ ) ) . '/languages' );

}
add_action('admin_menu', 'cd_contact_data_create_settings_page'); // --> http://codex.wordpress.org/Administration_Menus

// ==============================================================================================================================================================

/**
*	Cargamos los CSS y Javascript necesarios para la página de administración. No la web
*/
function cd_contact_data_enqueque (){

	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-tabs' );

	wp_register_script('cd_admin_page_scripts', plugins_url('js/cd_admin_page.js', __FILE__), array(), '0.1', true);
	wp_enqueue_script('cd_admin_page_scripts');

	wp_register_style('cd_admin_page_styles', plugins_url('css/cd_admin_page.css', __FILE__), array(), '0.1', 'all');
	wp_enqueue_style('cd_admin_page_styles');

}

// ==============================================================================================================================================================

/**
*	Función principal para obtener todos los datos de contacto.
*	- Si se llama sin parámetros devuelve un array con toooodos los campos.
*	- Si se le pasa el nombre de un Campo devuelve solo ese valor
*/
function get_contact_data( $field = NULL ) {

	$all_contact_data = get_option( 'cd_contact_data' );

	if ( $field == NULL ) :

		return maybe_unserialize( $all_contact_data );

	else:

		//$all_contact_data = maybe_unserialize( $all_contact_data );
		return stripslashes( html_entity_decode( $all_contact_data[$field]) );

	endif;

}

// ==============================================================================================================================================================


/**
*	Ahoa creamos la página de administración con el formulario.
*/
function create_cd_contact_data_settings_page() {

	//primero chequeamos que el user tenga la capability necesaria
	if (!current_user_can('manage_options')):
		wp_die( __('You do not have sufficient permissions to access this page.') );
	endif;


	$hidden_field_name = 'submit_hidden';
		
		// --------------------------------------------------------------------------------------------------------

		// Si el usuario le ha dado a 'Guardar cambios' entonces el hidden field traerá este valor. Entonces guardamos los datos en la DB.

		if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) : 

							$data = array(); // vaciamos el array;

							$data['name'] =  	htmlspecialchars( $_POST['contact_data_name'] );
							$data['url'] = 		htmlspecialchars( $_POST['contact_data_url'] );
							$data['dir'] = 		htmlspecialchars( $_POST['contact_data_dir'] );
							$data['dir_2'] = 	htmlspecialchars( $_POST['contact_data_dir_2'] );
							$data['email'] = 	htmlspecialchars( $_POST['contact_data_email'] );
							$data['tel'] = 		htmlspecialchars( $_POST['contact_data_tel'] );
							$data['fax'] = 		htmlspecialchars( $_POST['contact_data_fax'] );
							$data['map'] = 		htmlspecialchars( $_POST['contact_data_map']) ;

							$data['facebook'] = htmlspecialchars( $_POST['contact_data_facebook'] );
							$data['twitter'] = 	htmlspecialchars( $_POST['contact_data_twitter'] );
							$data['linkedin'] = htmlspecialchars( $_POST['contact_data_linkedin'] );
							$data['googleplus'] = htmlspecialchars( $_POST['contact_data_googleplus'] );
							$data['youtube'] = 	htmlspecialchars( $_POST['contact_data_youtube'] );
							$data['vimeo'] = 	htmlspecialchars( $_POST['contact_data_vimeo'] );
							$data['rss'] = 		htmlspecialchars( $_POST['contact_data_rss'] );


							update_option( 'cd_contact_data', $data );


			?>

			<div class="updated">
				<p><strong><?php _e('Contact data saved.') ?></strong></p>
			</div>

			<?php
			
		endif;

		// --------------------------------------------------------------------------------------------------------

		$data = get_contact_data(); // obtenemos todos los campos de contacto en un array.
		
		?>


		<div class="wrap">

			<div id="icon-index" class="icon32"><br></div>
			
			<h2>Contact Data</h2>

			<div id="tabs">

				<h2 class="nav-tab-wrapper">
					<ul class="tabNavigation">
						<li><a href="#tab1" class="nav-tab"><?php _e('The data', 'contact_data') ?></a></li>
						<li><a href="#tab2" class="nav-tab"><?php _e('Usage', 'contact_data') ?></a></li>
					</ul>
				</h2>


				<div id="tab1">

					<?php include ('data-form.php'); ?>

				</div><!-- #tab1 -->


				<div id="tab2">

					<?php include ('data-usage.php'); ?>

				</div><!-- #tab2 -->


			</div>

		</div>
						
<?php
}

// ==============================================================================================================================================================


/**
 * Social Icons widget class
 */
class WP_Widget_Follow_Me_Icons extends WP_Widget {

        function __construct() {
                $widget_ops = array('classname' => 'widget_follow_me_icons', 'description' => __( "Displays the 'Follow Me' buttons of those social networks you defined") );
                parent::__construct('follow_me_icons', __('Follow Me Icons'), $widget_ops);
        }

        function widget( $args, $instance ) {

                extract($args);

                $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
	
				$data = get_contact_data();

                echo $before_widget;
                if ( $title )
                        echo $before_title . $title . $after_title;
                // ------------------------------------------------------------
				
				follow_me_icons();

                // ------------------------------------------------------------
                echo $after_widget;
        }

        function update( $new_instance, $old_instance ) {
                $instance = $old_instance;
                $new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
                $instance['title'] = strip_tags($new_instance['title']);
                return $instance;
        }

        function form( $instance ) {
                $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
                $title = $instance['title'];
		?>
                <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<?php
        }
}

add_action( 'widgets_init', create_function('', 'return register_widget("WP_Widget_Follow_Me_Icons");') );



// ==============================================================================================================================================================


function follow_me_icons( $echo = true ){
	
	wp_register_style( 'cd_front_end_styles', plugins_url('css/cd_contact_data.css', __FILE__), array(), '0.1', 'all' );
	wp_enqueue_style( 'cd_front_end_styles' );
	
	$data = get_contact_data();
	$salida = '';

	$salida .= '<div class="follow_me_icons_container">';

		$salida .= '<ul>';

			if ( $data['facebook'] ) :
				$salida .= '<li class="social facebook">	<a href="' . $data['facebook'] . '" target="_blank" title="Facebook" rel="author"></a></li>';
			endif;
			if ( $data['twitter'] ) :
				$salida .= '<li class="social twitter">		<a href="' . $data['twitter'] . '" target="_blank" title="Twitter" rel="author"></a></li>';
			endif;
			if ( $data['googleplus'] ) :
				$salida .= '<li class="social googleplus">	<a href="' . $data['googleplus'] . '" target="_blank" title="Google+" rel="author"></a></li>';
			endif;
			if ( $data['linkedin'] ) :
				$salida .= '<li class="social linkedin">	<a href="' . $data['linkedin'] . '" target="_blank" title="LinkedIn" rel="author"></a></li>';
			endif;
			if ( $data['youtube'] ) :
				$salida .= '<li class="social youtube">		<a href="' . $data['youtube'] . '" target="_blank" title="YouTube"></a></li>';
			endif;
			if ( $data['vimeo'] ) :
				$salida .= '<li class="social vimeo">		<a href="' . $data['vimeo'] . '" target="_blank" title="Vimeo"></a></li>';
			endif;
			if ( $data['rss'] ) :
				$salida .= '<li class="social rss">			<a href="' . $data['rss'] . '" target="_blank" title="RSS"></a></li>';
			endif;
		$salida .= '</ul>';

	$salida .= '</div>';

	if ( $echo ) :
		echo $salida; // para usar con el shortcode [follow-me-icons]
	else:
		return $salida; // para usar mediante la función follow_me_icons();
	endif;
}


// ==============================================================================================================================================================


function do_contact_data($atts) {
	extract(shortcode_atts(array(
		'field' => NULL
	), $atts));

	if (! $field ) return;

	return get_contact_data($field);
}
add_shortcode('contact-data', 'do_contact_data');

function do_follow_me_icons($atts) {
	extract(shortcode_atts(array(
		'field' => NULL
	), $atts));

	return follow_me_icons(false);
}
add_shortcode('follow-me-icons', 'do_follow_me_icons');