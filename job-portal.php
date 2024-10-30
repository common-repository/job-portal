<?php
/**
	*Plugin Name: Job portal
	*Plugin URI: https://mondayblogger.com
	*Description: Job portal allow admin of site to publish new jobs on wordpress site. Add new job, update job data, remove any job when data is over.
	*Author: Danish Iftikhar
	*Author URI: http://www.linkedin.com/in/danish-iftikhar-736845b3
	*Version: 0.0.1
	*License: GPLv2 or Later
*/
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ){
	
	exit;

}
define( 'JOB_PORTAL', '0.0.1' );

	require_once( plugin_dir_path(__FILE__) . 'admin/jobs_function.php' );
	/**Job Portal widget file loads below*/
	require_once( plugin_dir_path(__FILE__) . 'wp_job_portal_widget.php');
	require_once( plugin_dir_path( __FILE__ ) . 'class-page-template-jobs.php' );
	
add_action( 'plugins_loaded', array( 'Jp_Page_Template_Plugin', 'get_instance' ) );

function jp_widget_style(){
	//Loading widget css to main web site
	wp_enqueue_style('main-job-portal-styles', plugins_url( '/resources/css/job_portal_style2_main_web.css', __FILE__ )); 
	wp_enqueue_style('main-job-portal-bootstrap-styles', plugins_url( '/resources/bootstrap-3.3.7-dist/css/bootstrap.min.css', __FILE__ )); 

	
}
add_action('wp_enqueue_scripts','jp_widget_style');
/**
===================================================================================
Function hook to job portal single page template
===================================================================================
.*/
function jp_job_portal_single_page($original_template){
	//check post type to job portal single page

	if(get_query_var( 'post_type' ) !== 'jobs'){

		return $original_template;

	}
	elseif(is_single('jobs')){
	//check if file exit of single job page template
		if(file_exists(file_exists( get_stylesheet_directory(). '/single-jobs.php' ))){

			return get_stylesheet_directory() . '/single-jobs.php';
		
		}
		else{

			return plugin_dir_path( __FILE__ ) . 'templates/single-jobs.php';
		}
	}
	else{
		return plugin_dir_path( __FILE__ ) . 'templates/single-jobs.php';

    }
    //return orginal theme sinle page template
    return $original_template;
}
add_action('template_include','jp_job_portal_single_page');
