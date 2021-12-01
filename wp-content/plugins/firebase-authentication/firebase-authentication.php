<?php


/**
 *
 * @link              https://miniorange.com
 * @since             1.0.0
 * @package           Firebase_Authentication
 *
 * @wordpress-plugin
 * Plugin Name:       Firebase Authentication
 * Plugin URI:        firebase-authentication
 * Description:       This plugin allows login into Wordpress using Firebase as Identity provider.
 * Version:           1.5.2
 * Author:            miniOrange
 * Author URI:        https://miniorange.com
 * License:           MIT/Expat
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MO_FIREBASE_AUTHENTICATION_VERSION', '1.5.2' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-firebase-authentication-activator.php
 */
function mo_firebase_activate_firebase_authentication() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-firebase-authentication-activator.php';
	MO_Firebase_Authentication_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-firebase-authentication-deactivator.php
 */
function mo_firebase_deactivate_firebase_authentication() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-firebase-authentication-deactivator.php';
	MO_Firebase_Authentication_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'mo_firebase_activate_firebase_authentication' );
register_deactivation_hook( __FILE__, 'mo_firebase_deactivate_firebase_authentication' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-firebase-authentication.php';
require_once 'class-mo-firebase-config.php';
require('views/feedback_form.php');
require('class-contact-us.php');
require('admin/class-firebase-authentication-customer.php');


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function mo_firebase_run_firebase_authentication() {

	$plugin = new MO_Firebase_Authentication();
	$plugin->run();

}
mo_firebase_run_firebase_authentication();

function mo_firebase_authentication_is_customer_registered() {
	$email 			= get_option('mo_firebase_authentication_admin_email');
	// $phone 			= get_option('mo_firebase_authentication_admin_phone');
	$customerKey 	= get_option('mo_firebase_authentication_admin_customer_key');
	// if( ! $email || ! $phone || ! $customerKey || ! is_numeric( trim( $customerKey ) ) ) {
	if( ! $email || ! $customerKey || ! is_numeric( trim( $customerKey ) ) ) {
	
		return 0;
	} else {
		return 1;
	}
}
function mo_firebase_authentication_is_clv() {
	$licenseKey = get_option('mo_firebase_authentication_lk');
	$isverified = get_option('mo_firebase_authentication_lv');
	if($isverified)
		$isverified = mo_firebase_authentication_decrypt($isverified);

	if(!empty($licenseKey) && $isverified=="true") {
		return 1;
	}
	return 0;
}

function mo_firebase_authentication_encrypt($str){
   $pass = get_option("mo_firebase_authentication_customer_token");
   $pass = str_split(str_pad('', strlen($str), $pass, STR_PAD_RIGHT));
   $stra = str_split($str);
   foreach($stra as $k=>$v){
	 $tmp = ord($v)+ord($pass[$k]);
	 $stra[$k] = chr( $tmp > 255 ?($tmp-256):$tmp);
   }
   return base64_encode(join('', $stra));
}

function mo_firebase_authentication_decrypt($str){
   $str = base64_decode($str);
   $pass = get_option("mo_firebase_authentication_customer_token");
   $pass = str_split(str_pad('', strlen($str), $pass, STR_PAD_RIGHT));
   $stra = str_split($str);
   foreach($stra as $k=>$v){
	 $tmp = ord($v)-ord($pass[$k]);
	 $stra[$k] = chr( $tmp < 0 ?($tmp+256):$tmp);
   }
   return join('', $stra);
}


class mo_firebase_authentication_login {
	function __construct() {
    	add_action( 'init', array( $this, 'postResgiter' ) );
    	add_action( 'admin_init',  array( $this, 'mo_firebase_auth_deactivate' ) );
		if ( get_option( 'mo_enable_firebase_auth' ) == 1 ) {
			if ( strpos( $_SERVER['REQUEST_URI'], '/wp-json' ) === false ) {
				remove_filter( 'authenticate', 'wp_authenticate_username_password', 20, 3 );
				remove_filter( 'authenticate', 'wp_authenticate_email_password', 20, 3 );
				add_filter( 'authenticate', array( $this, 'mo_firebase_auth' ), 0, 3 );
			}
		}
		remove_action( 'admin_notices', array( $this, 'mo_firebase_auth_success_message') );
		remove_action( 'admin_notices', array( $this, 'mo_firebase_auth_error_message') );
		add_action( 'admin_footer', array( $this, 'mo_firebase_auth_feedback_request' ) );
		update_option( 'host_name', 'https://login.xecurify.com' );
    }

	function postResgiter() {
		if ( isset( $_POST['verify_user'] ) && isset( $_REQUEST['page'] ) && sanitize_text_field( wp_unslash( $_REQUEST['page'] ) ) == 'mo_firebase_authentication' && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['mo_firebase_auth_config_field'] ) ), 'mo_firebase_auth_config_form' ) ) {

			if( current_user_can( 'administrator' ) ) {
				update_option( 'mo_firebase_auth_disable_wordpress_login', isset( $_POST['disable_wordpress_login'] ) ? (int)filter_var( $_POST['disable_wordpress_login'], FILTER_SANITIZE_NUMBER_INT ) : 0 );

				update_option('mo_firebase_auth_enable_admin_wp_login', isset($_POST['mo_firebase_auth_enable_admin_wp_login']) ? $_POST['mo_firebase_auth_enable_admin_wp_login'] : 0);

				$project_id = isset( $_POST['projectid'] ) ? sanitize_text_field( $_POST['projectid'] ) : '';
				update_option( 'mo_firebase_auth_project_id', $project_id );
				
				$api_key = isset( $_POST['apikey'] ) ? sanitize_text_field( $_POST['apikey'] ) : '';
				update_option( 'mo_firebase_auth_api_key', $api_key );

				$this->mo_firebase_auth_store_certificates();
				update_option( 'mo_firebase_auth_message', 'Configurations saved successfully. Please <a href="' . admin_url( 'admin.php?page=mo_firebase_authentication&tab=config#test_authentication' ) .'">Test Authentication</a> before trying to Login.');
				$this->mo_firebase_auth_show_success_message();		
			}
		}
	}

	function mo_firebase_auth_store_certificates(){
		$response = wp_remote_get( 'https://www.googleapis.com/robot/v1/metadata/x509/securetoken@system.gserviceaccount.com' );
		if ( is_array( $response ) ) {
		  	$header = $response['headers']; // array of http header lines
		  	$body   = $response['body']; // use the content
			
		  	$split_result = explode( ":", $body );
		  	$count  = count( $split_result );
			$kid1   = substr( $split_result[0], 5, 40 );
		  	$s      = explode( ",", $split_result[1] );
		  	$c1     = substr( $s[0], 2, 1158 );
		  	$c1     = str_replace( '\n', '', $c1 );
		  	update_option( 'mo_firebase_auth_kid1', $kid1 );
			update_option( 'mo_firebase_auth_cert1', $c1 );
		  	if( $count == 3 ) {
		  		$kid2   = substr( $s[1], 4, 40 );
			  	$c2     = explode( "}", $split_result[2] );
				$c2[0]  = substr( $c2[0], 2, 1158 );			  	
				$c2[0] = str_replace( '\n', '', $c2[0] );
				update_option( 'mo_firebase_auth_kid2', $kid2 );
				update_option( 'mo_firebase_auth_cert2', $c2[0] );
		  	} else if ( $count > 3) {
		  		$kid2   = substr( $s[1], 4, 40 );
		  		$s2     = explode( ",", $split_result[2] );
			  	$c2     = substr( $s2[0], 2, 1158 );
			  	$kid3   = substr( $s2[1], 4, 40 );
				$c3     = explode( "}", $split_result[3] );
				$c3[0]  = substr( $c3[0], 2, 1158 );
				$c2     = str_replace( '\n', '', $c2 );
				update_option( 'mo_firebase_auth_kid2', $kid2 );
				update_option( 'mo_firebase_auth_cert2', $c2 );
				$c3[0] = str_replace( '\n', '', $c3[0] );
				update_option( 'mo_firebase_auth_kid3', $kid3 );
				update_option( 'mo_firebase_auth_cert3', $c3[0] );
		  	}
		} else {
			if ( is_wp_error( $response ) ) {
				$error_message = $response->get_error_message();
				echo "Something went wrong: $error_message";
				exit();
			}
		}
	}

	function mo_fb_clear_wp_login_errors($errors, $redirect_to){
		return new WP_Error();
	}


	function mo_firebase_auth( $user, $username, $password ) {

		if( "POST" !== sanitize_text_field( wp_unslash( $_SERVER['REQUEST_METHOD'] ) ) ) {
			add_filter( 'wp_login_errors', array( $this, 'mo_fb_clear_wp_login_errors' ), 0, 2 );
			return $user;
		}
		
		if ( empty( $username ) || empty ( $password ) ) {

			$error = new WP_Error();
			//create new error object and add errors to it.
			
		    if ( empty( $username ) ) { //No email
		        $error->add( 'empty_username', __( '<strong>ERROR</strong>: Email field is empty.' ) );
		    }

		    else if ( empty( $password ) ) { //No password
		        $error->add( 'empty_password', __( '<strong>ERROR</strong>: Password field is empty.' ) );
		    }
		    return $error;
		}

		$mo_firebase_config_obj = new Mo_Firebase_Config();
		$fb_user = $mo_firebase_config_obj->mo_firebase_authenticate_call($username, $password);
		$fb_user = json_decode($fb_user, true);
		
		if(isset($fb_user['idToken'])){
			$response = $mo_firebase_config_obj->mo_fb_login_user($fb_user['idToken']);
		}
		else{
			$error_message = $fb_user['error']['message'];
			if($error_message == 'INVALID_EMAIL' || $error_message == 'EMAIL_NOT_FOUND'){
				if ( get_option( 'mo_firebase_auth_disable_wordpress_login' )  == false ) {
					$user = get_user_by( "login", $username );
					if ( !$user ) {
						$user = get_user_by( "email", $username );
					}
					if ( $user && wp_check_password( $password, $user->data->user_pass, $user->ID ) ) {
						return $user;
					}
				}
				else if ( get_option( 'mo_firebase_auth_enable_admin_wp_login' ) ) {
		            $user = get_user_by( "login", $username );
	    	        if ( !$user ) {
						$user = get_user_by( "email", $username );
					}
		            if ( $user && $this->is_administrator_user( $user ) ) {
		                if ( wp_check_password( $password, $user->data->user_pass, $user->ID ) ) {
	    	                return $user;
						}
	    	        }
		        }
	    	}else{
	    		$error = new WP_Error();
	    		if($error_message == 'INVALID_PASSWORD'){
	    			$error_message = 'The password is invalid or the user does not have a password.';
	    		}
		    	$error->add('firebase_error', __( '<strong>ERROR</strong>: '.$error_message ));
		    	return $error;
	    	}
		}
	}

	function mo_firebase_auth_success_message() {
		$class = "error";
		$message = get_option('mo_firebase_auth_message');
		echo "<div class='" . $class . "'> <p>" . $message . "</p></div>";
	}

	function mo_firebase_auth_error_message() {
		$class = "updated";
		$message = get_option('mo_firebase_auth_message');
		echo "<div class='" . $class . "'><p>" . $message . "</p></div>";
	}

	function is_administrator_user( $user ) {
        $userRole = ( $user->roles );
        if ( ! is_null( $userRole ) && in_array( 'administrator' , $userRole ) ) {
            return true;
        }
        else {
            return false;
        }
    }

    private function mo_firebase_auth_show_success_message() {
		remove_action( 'admin_notices', array( $this, 'mo_firebase_auth_success_message') );
		add_action( 'admin_notices', array( $this, 'mo_firebase_auth_error_message') );
	}

	private function mo_firebase_auth_show_error_message() {
		remove_action( 'admin_notices', array( $this, 'mo_firebase_auth_error_message') );
		add_action( 'admin_notices', array( $this, 'mo_firebase_auth_success_message') );
	}

    function mo_firebase_auth_feedback_request() {
		mo_firebase_auth_display_feedback_form();
	}

	private function mo_firebase_authentication_check_empty_or_null( $value ) {
		if( ! isset( $value ) || empty( $value ) ) {
			return true;
		}
		return false;
	}

	function mo_firebase_auth_deactivate(){
		
		if ( isset( $_POST['option'] ) ) {

			if( sanitize_text_field( wp_unslash( $_POST['option'] ) ) == "mo_firebase_authentication_change_email" ) {
				//Adding back button
				update_option('mo_firebase_authentication_verify_customer', '');
				update_option('mo_firebase_authentication_registration_status','');
				update_option('mo_firebase_authentication_new_registration','true');
			}

			if ( sanitize_text_field( wp_unslash( $_POST['option'] ) ) == "change_miniorange" ) {
				require_once plugin_dir_path( __FILE__ ) . 'includes/class-firebase-authentication-deactivator.php';
				MO_Firebase_Authentication_Deactivator::deactivate();
				return;
			}

			if ( sanitize_text_field( wp_unslash( $_POST['option'] ) ) == "mo_firebase_authentication_register_customer" ) {	//register the admin to miniOrange
				//validation and sanitization
				$email = '';
				$phone = '';
				$password = '';
				$confirmPassword = '';
				$fname = '';
				$lname = '';
				$company = '';
				if ( $this->mo_firebase_authentication_check_empty_or_null( $_POST['email'] ) || $this->mo_firebase_authentication_check_empty_or_null( $_POST['password'] ) || $this->mo_firebase_authentication_check_empty_or_null( $_POST['confirmPassword'] ) ) {
					update_option( 'mo_firebase_auth_message', 'All the fields are required. Please enter valid entries.');
					$this->mo_firebase_auth_show_error_message();
					return;
				} else if ( strlen( $_POST['password'] ) < 8 || strlen( $_POST['confirmPassword'] ) < 8) {
					update_option( 'mo_firebase_auth_message', 'Choose a password with minimum length 8.');
					$this->mo_firebase_auth_show_error_message();
					return;
				} else {
					$email = sanitize_email( $_POST['email'] );
					$phone = stripslashes( $_POST['phone'] );
					$password = stripslashes( $_POST['password'] );
					$confirmPassword = stripslashes( $_POST['confirmPassword'] );
					$fname = stripslashes( $_POST['fname'] );
					$lname = stripslashes( $_POST['lname' ] );
					$company = stripslashes( $_POST['company'] );
				}

				update_option( 'mo_firebase_authentication_admin_email', $email );
				update_option( 'mo_firebase_authentication_admin_phone', $phone );
				update_option( 'mo_firebase_authentication_admin_fname', $fname );
				update_option( 'mo_firebase_authentication_admin_lname', $lname );
				update_option( 'mo_firebase_authentication_admin_company', $company );

				if ( strcmp( $password, $confirmPassword) == 0 ) {
					update_option( 'password', $password );
					$customer = new MO_Firebase_Customer();
					$email = get_option('mo_firebase_authentication_admin_email');
					$content = json_decode( $customer->check_customer(), true );

					if ( strcasecmp( $content['status'], 'CUSTOMER_NOT_FOUND') == 0 ) {
						$response = json_decode( $customer->create_customer(), true );
						if ( strcasecmp( $response['status'], 'SUCCESS' ) != 0 ) {
							update_option( 'mo_firebase_auth_message', 'Failed to create customer. Try again.' );
						}
						$this->mo_firebase_auth_show_success_message();
					} elseif ( strcasecmp( $content['status'], 'SUCCESS' ) == 0 ) {
						update_option( 'mo_firebase_auth_message', 'Account already exist. Please Login.' );
					} else {
						update_option( 'mo_firebase_auth_message', $content['status'] );
					}
					$this->mo_firebase_auth_show_success_message();
					
				} else {
					update_option( 'mo_firebase_auth_message', 'Passwords do not match.');
					delete_option('mo_firebase_authentication_verify_customer');
					$this->mo_firebase_auth_show_error_message();
				}

			} if( sanitize_text_field( wp_unslash( $_POST['option'] ) ) == "mo_firebase_authentication_goto_login" && isset( $_REQUEST['mo_firebase_authentication_goto_login_form_field'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['mo_firebase_authentication_goto_login_form_field'] ) ), 'mo_firebase_authentication_goto_login_form' )) {
				delete_option( 'mo_firebase_authentication_new_registration' );
				update_option( 'mo_firebase_authentication_verify_customer', 'true' );

			} if ( sanitize_text_field( wp_unslash( $_POST['option'] ) ) == 'mo_enable_firebase_auth' && wp_verify_nonce( $_REQUEST['mo_firebase_auth_enable_field'], 'mo_firebase_auth_enable_form' ) ){
				update_option( 'mo_enable_firebase_auth', isset( $_POST['mo_enable_firebase_auth'] ) ? (int)filter_var( $_POST['mo_enable_firebase_auth'], FILTER_SANITIZE_NUMBER_INT ) : 0 );

			} else if ( sanitize_text_field( wp_unslash( $_POST['option'] ) ) == 'mo_firebase_auth_contact_us' && isset($_REQUEST['mo_firebase_auth_contact_us_field']) && wp_verify_nonce( $_REQUEST['mo_firebase_auth_contact_us_field'], 'mo_firebase_auth_contact_us_form' ) ) {
				$email = isset( $_POST['mo_firebase_auth_contact_us_email'] ) ? sanitize_email( $_POST['mo_firebase_auth_contact_us_email'] ) : "";
				$phone = isset( $_POST['mo_firebase_auth_contact_us_phone'] ) ? "+ ".preg_replace( '/[^0-9]/', '', $_POST['mo_firebase_auth_contact_us_phone'] ) : "";
				//$phone = sanitize_textarea_field($_POST['mo_firebase_auth_contact_us_phone']);
				$query = isset( $_POST['mo_firebase_auth_contact_us_query'] ) ? sanitize_textarea_field( $_POST['mo_firebase_auth_contact_us_query'] ) : "";
				if ( $this->mo_firebase_authentication_check_empty_or_null( $email ) || $this->mo_firebase_authentication_check_empty_or_null( $query ) ) {
					echo '<br><b style=color:red>Please fill up Email and Query fields to submit your query.</b>';
				} else {
					$contact_us = new MO_Firebase_contact_us();
					$submited   = $contact_us->mo_firebase_auth_contact_us( $email, $phone, $query );
					if ( $submited == false ) {
						update_option( 'mo_firebase_auth_message', 'Your query could not be submitted. Please try again.' );
						$this->mo_firebase_auth_show_error_message();
					} else {
						update_option( 'mo_firebase_auth_message', 'Thanks for getting in touch! We shall get back to you shortly.' );
						$this->mo_firebase_auth_show_success_message();
					}
				}

			} else if( sanitize_text_field( wp_unslash( $_POST['option'] ) ) == "mo_firebase_authentication_verify_customer" ) {//register the admin to miniOrange
				//validation and sanitization
				$email = '';
				$password = '';
				if( $this->mo_firebase_authentication_check_empty_or_null( $_POST['email'] ) || $this->mo_firebase_authentication_check_empty_or_null( $_POST['password'] ) ) {
					update_option( 'mo_firebase_auth_message', 'All the fields are required. Please enter valid entries.');
					$this->mo_firebase_auth_show_error_message();
					return;
				} else{
					$email = sanitize_email( $_POST['email'] );
					$password = stripslashes( $_POST['password'] );
				}

				update_option( 'mo_firebase_authentication_admin_email', $email );
				update_option( 'password', $password );
				$customer = new MO_Firebase_Customer();
				$content = $customer->mo_firebase_auth_get_customer_key();
				$customerKey = json_decode( $content, true );
				if( json_last_error() == JSON_ERROR_NONE ) {
					update_option( 'mo_firebase_authentication_admin_customer_key', $customerKey['id'] );
					update_option( 'mo_firebase_authentication_admin_api_key', $customerKey['apiKey'] );
					update_option( 'mo_firebase_authentication_customer_token', $customerKey['token'] );
					if( isset( $customerKey['phone'] ) )
						update_option( 'mo_firebase_authentication_admin_phone', $customerKey['phone'] );
					delete_option( 'password' );
					update_option( 'mo_firebase_auth_message', 'Customer retrieved successfully');
					delete_option( 'mo_firebase_authentication_verify_customer' );
					$this->mo_firebase_auth_show_success_message();
				} else {
					update_option( 'mo_firebase_auth_message', 'Invalid username or password. Please try again.');
					$this->mo_firebase_auth_show_error_message();
				}
		
			} else if ( sanitize_text_field( wp_unslash( $_POST['option'] ) ) == 'mo_firebase_auth_skip_feedback' ) {
				deactivate_plugins( __FILE__ );
				update_option( 'mo_firebase_auth_message', 'Plugin deactivated successfully' );
				$this->mo_firebase_auth_show_success_message();

			} else if ( sanitize_text_field( wp_unslash( $_POST['option'] ) ) == 'mo_firebase_auth_feedback' && isset($_REQUEST['mo_firebase_auth_feedback_field']) && wp_verify_nonce( $_REQUEST['mo_firebase_auth_feedback_field'], 'mo_firebase_auth_feedback_form' ) ) {
				$user    = wp_get_current_user();
				$message = 'Plugin Deactivated:';
				$deactivate_reason         = array_key_exists( 'deactivate_reason_radio', $_POST ) ? $_POST['deactivate_reason_radio'] : false;
				$deactivate_reason_message = array_key_exists( 'query_feedback', $_POST ) ? $_POST['query_feedback'] : false;
				if ( $deactivate_reason ) {
					$message .= $deactivate_reason;
					if ( isset( $deactivate_reason_message ) ) {
						$message .= ':' . $deactivate_reason_message;
					}
					
					$email      = $user->user_email;
					$contact_us = new MO_Firebase_contact_us();
					$submited   = json_decode( $contact_us->mo_firebase_auth_send_email_alert( $email, $message, "Feedback: WordPress Firebase Authentication" ), true );
					deactivate_plugins( __FILE__ );
					update_option( 'mo_firebase_auth_message', 'Thank you for the feedback.' );
					$this->mo_firebase_auth_show_success_message();

				} else {
					update_option( 'mo_firebase_auth_message', 'Please Select one of the reasons ,if your reason is not mentioned please select Other Reasons' );
					$this->mo_firebase_auth_show_error_message();
				}
			}
		}
	}

}

$mo_firebase_authentication_obj = new mo_firebase_authentication_login();