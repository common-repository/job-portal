
<?php
/**
===================================================================================
Custom post type jobs showing custom colum in admin dash board
===================================================================================
.*/
//ONLY JOB CUSTOM POST TYPE
add_filter('manage_jobs_posts_columns', 'jp_ST4_columns_head_only_jobs', 10);
add_action('manage_jobs_posts_custom_column', 'jp_ST4_columns_content_only_jobs', 10, 2);
// CREATE TWO FUNCTIONS TO HANDLE THE COLUMN
function jp_ST4_columns_head_only_jobs($defaults) {
    $defaults['job_title'] = 'Job Title';
    $defaults['job_type'] = 'Job Type' ;
    $defaults['job_pos'] = 'Total Positions';
    $defaults['job_exp'] = 'Experience Req';
    $defaults['job_last_date'] = 'Last Date';
    $defaults['job_status'] = 'Job Status';
    $defaults['jobs_post_thumbs'] = 'Featured Image';
    return $defaults;
}
function jp_ST4_columns_content_only_jobs($column_name, $post_ID) {
    if ($column_name == 'job_title') {
        // show content of 'job_title' column
       echo  get_post_meta( $post_ID, 'job_title', true );
    }
    if($column_name == 'job_type'){
    	//show content of  'job_type' column
     echo  get_post_meta( $post_ID, 'job_type', true );
    }
    if($column_name == 'job_pos'){
    	//show content of  'job_pos' column
     echo  get_post_meta( $post_ID, 'job_pos', true );
    }
    if($column_name == 'job_exp'){
    	//show content of  'job_exp' column
     echo  get_post_meta( $post_ID, 'job_exp', true ).' Years';
    }
     if($column_name == 'job_last_date'){
    	//show content of  'last_date_to_apply' column
     echo  get_post_meta( $post_ID, 'job_last_date', true );
    }
    if($column_name == 'job_status'){
    	//show buttons depeding status of job
    	if(get_post_meta( $post_ID, 'job_status', true ) == 1)
    	{
    		echo "<b>Active</b>";
    	}
    	else{
    		echo "<b>Un Active</b>";	
    	}

    }
    if($column_name == 'jobs_post_thumbs'){
    	//showing job post logo
        echo the_post_thumbnail(array(80,80)); //size of the thumbnail 

    }
}
/**
===================================================================================
Custom post type jobs adding meta box to add details
===================================================================================
.*/

function jp_show_job_meta_feilds(){

    add_meta_box(
    	'dwwp_meta_job',
    	'Jobs Details',
    	'service_custom_callback_function',
    	'jobs',
    	'normal',
    	'core'
    	);
}
add_action('add_meta_boxes','jp_show_job_meta_feilds');
/**
===================================================================================
Custom post type jobs call back function
===================================================================================
.*/
//meta boxe call back function
function service_custom_callback_function( ){
	global $post;
	//data submitting actually come from your forms.
	wp_nonce_field(basename( __FILE__ ), 'dwwp_job_nonce');
	$dwwp_stored_meta = get_post_meta( $post->ID);
	
	// instead of writing HTML here, lets do require to include desired html form to take inputs
	require_once( plugin_dir_path(__FILE__) . 'jobs_meta.php' );
}
/**
===================================================================================
Save jobs post custom fields when ever save/auto save event is triggered on the form 
===================================================================================
.*/
//save your custom fields from meta box
function jp_save_meta_fields_jobs( $post_id ){
	$is_autosave = wp_is_post_autosave($post_id);
	$is_revision = wp_is_post_revision($post_id);
	$is_valid_nonce =  ( isset( $_POST['dwwp_job_nonce']) && wp_verify_nonce( $_POST['dwwp_job_nonce'], basename( __FILE__ ) ) )? 'true' : 'false' ;
	
	if ($is_autosave || $is_revision ||!$is_valid_nonce ) {
		# code...
		return;
	}
	//saving custom fields of job post type 
	if( isset( $_POST['job_title'])) {
		//saving job title
		update_post_meta( $post_id, 'job_title', sanitize_text_field($_POST['job_title']));
	}
	if( isset( $_POST['company_email'])) {
		//saving company email to apply
		update_post_meta( $post_id, 'company_email', sanitize_text_field($_POST['company_email']));
	}
	if( isset( $_POST['job_type'])) {
		//getting job nature from form  permanant or parttime like others
        update_post_meta($post_id, 'job_type', sanitize_text_field($_POST['job_type']));
	}
	if( isset( $_POST['job_pos'])) {
		//getting total job position posted by admin
		update_post_meta( $post_id, 'job_pos', sanitize_text_field($_POST['job_pos']));
	}
	if( isset( $_POST['job_exp'])) {
		//getting job experience required
		update_post_meta( $post_id, 'job_exp', sanitize_text_field($_POST['job_exp']));
	}
	if( isset( $_POST['job_salary'])) {
		//getting job salary mentined by user 
		update_post_meta( $post_id, 'job_salary', sanitize_text_field($_POST['job_salary']));
	}
	if( isset( $_POST['job_last_date'])) {
		//getting job last date to apply
		update_post_meta( $post_id, 'job_last_date', sanitize_text_field($_POST['job_last_date']));
	}
	if( isset( $_POST['job_details'])) {
		//saving more details about job
		update_post_meta( $post_id, 'job_details', $_POST['job_details']);
		//saving job status meta data to active
		update_post_meta( $post_id, 'job_status', 1);
	}
	if(isset($_POST['company_name'])){
		update_post_meta( $post_id, 'company_name', sanitize_text_field($_POST['company_name']));
	}
	if(isset($_POST['job_loc'])){
		update_post_meta( $post_id, 'job_loc', sanitize_text_field($_POST['job_loc']));
	}
		
}
add_action( 'save_post', 'jp_save_meta_fields_jobs' );
/**
===================================================================================
Custom post type jobs listing for website
===================================================================================
.*/
function jp_register_post_type() {

    $singular = __( 'Job' );
    $plural = __( 'Jobs' );
        //Used for the rewrite slug below.
        $plural_slug = str_replace( ' ', '_', $plural );

        //Setup all the labels to accurately reflect this post type.
    $labels = array(
        'name'                  => $plural,
        'singular_name'         => $singular,
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New ' . $singular,
        'edit'                  => 'Edit',
        'edit_item'             => 'Edit ' . $singular,
        'new_item'              => 'New ' . $singular,
        'view'                  => 'View ' . $singular,
        'view_item'             => 'View ' . $singular,
        'search_term'           => 'Search ' . $plural,
        'parent'                => 'Parent ' . $singular,
        'not_found'             => 'No ' . $plural .' found',
        'not_found_in_trash'    => 'No ' . $plural .' in Trash'
    );

        //Define all the arguments for this post type.
    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'show_in_nav_menus'   => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-id',
        'can_export'          => true,
        'delete_with_user'    => false,
        'hierarchical'        => true,
        'has_archive'         => true,
        'query_var'           => true,
        'capability_type'     => 'post',
        'map_meta_cap'        => true,
        'rewrite'             => array( 
            'slug' => 'job',
            'with_front' => false,
        ),
        'supports'            => array( 
            'title', 'thumbnail'
        )
    );
        //Create the post type using the above two varaiables.
    register_post_type( 'jobs', $args);
}
add_action( 'init', 'jp_register_post_type' );

function jp_register_taxonomy() {

    $plural = __( 'Job Category' );
    $singular = __( 'Category' );


    $labels = array(
        'name'                       => $plural,
        'singular_name'              => $singular,
        'search_items'               => 'Search ' . $plural,
        'popular_items'              => 'Popular ' . $plural,
        'all_items'                  => 'All ' . $plural,
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => 'Edit ' . $singular,
        'update_item'                => 'Update ' . $singular,
        'add_new_item'               => 'Add New ' . $singular,
        'new_item_name'              => 'New ' . $singular . ' Name',
        'separate_items_with_commas' => 'Separate ' . $plural . ' with commas',
        'add_or_remove_items'        => 'Add or remove ' . $plural,
        'choose_from_most_used'      => 'Choose from the most used ' . $plural,
        'not_found'                  => 'No ' . $plural . ' found.',
        'menu_name'                  => $plural,
    );

    $args = array(
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 
            'with_front'    => false,
            'slug'          => strtolower( $singular )
             ),
    );

    register_taxonomy( strtolower( $singular ), 'jobs', $args );

}
add_action( 'init', 'jp_register_taxonomy' );

/**
===================================================================================
Function hook to load css and js file for admin dash board plugin operations
===================================================================================
.*/
function jp_add_job_portal_script(){

  
        wp_enqueue_style('job-portal-styles', plugins_url('job-portal/resources/css/job_portal_style1.css'));
}
add_action('admin_enqueue_scripts','jp_add_job_portal_script');
