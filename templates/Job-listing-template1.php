<?php
/**
 * Template Name: Example Page Template
 *
 * A template used to demonstrate how to include the template
 * using this plugin.
 *
 * @package PTE
 * @since 	1.0.0
 * @version	1.0.0
 */
?>

<?php

	$pte = Jp_Page_Template_Plugin::get_instance();
	$locale = $pte->get_locale();

?>
<?php get_header(); ?>

<div class="job-listing-heading">

<h2 align="center"><a href="#">Looking to get hired. Find jobs below.</a></h2>

</div>
<div class="jobs-main">
	<ul class="list-jobs">
	<?php
	/**
	 * query to display custom post type jobs data 
	 * display on first ten job ad post
	 */

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

		$args = array( 
			  	'post_type' => 'jobs',
			  	'showposts' => '10',
			  	'paged' 	=> $paged,
			  	 );
		//query for data from database
		$loop = new WP_Query( $args );
		if($loop->have_posts()) :
		//loop the accuired results
        while ( $loop->have_posts() ) : $loop->the_post();
	?>
		<li class="job-post">
		<a href="<?php the_permalink(); ?>">
			<div class="job-img">
			
			<?php
			/**
			*Displaying post thumnail image if exist
			*else display the default image
			*/
			$url="";
			if ( has_post_thumbnail($post->ID) ) {
                //getting the source of post image url
                $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); 
            ?>
            <img src="<?php echo $url; ?>" width="150" height="100">
            <?php
            }
            else{
            	?>
            	<span class="company-img"><img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) .'resources/img/Hiring2-600x300.jpg' ; ?>" width="150" height="100">
            	<?php
            }
			?>

			</div>
			<div class="job-meta">
				<ul>
					<li class="job-title gray"><strong><?php
					//displaying job title here
					$job_title= get_post_custom_values('job_title');
					  if(!empty($job_title)){
					  	echo $job_title[0];
					  					  }
					  else{
					  	echo "No Job Title ";
					  }
					?></strong></li>
					<li class="job-location">
					<span class="glyphicon glyphicon-map-marker gray"></span>
					<?php
					//displaying job loaction here
					$job_location= get_post_custom_values('job_loc');
					  if(!empty($job_location)){
					  	echo $job_location[0];
					  					  }
					  else{
					  	echo "No Location given";
					  }
					?>
					</li>
					<?php
					//displaying job type here
					$job_type= get_post_custom_values('job_type');?>
					<li class="job-nature label 
					<?php
					 if(!strcmp($job_type[0],'Full Time')){
					 	echo 'label-green';
					 }
					 if(!strcmp($job_type[0],'Contract Based')){
					 	echo 'label-orange';
					 }
					 if(!strcmp($job_type[0],'Part time')){
					 	echo 'label-blue';
					 }
					 if(!strcmp($job_type[0],'Internship')){
					 	echo 'label-meganta';
					 }
					if(!strcmp($job_type[0],'Freelancer Required')){
					 	echo 'label-sky-blue';
					 }					 
					 ?>"
					 >
					<?php
					  if(!empty($job_type)){
					  	echo $job_type[0];
					  					  }
					  else{
					  	echo "Full Time";
					  }
					?></li>
					<li class="btn-details"><span class="view-button button-blue"> View Details</span></li>
				</ul>
				<ul>
					<li class="comapny-name gray"><strong>
						<?php
							$company_name= get_post_custom_values('company_name');
							echo $company_name[0];
						?>
					</strong></li>
					<li class="job-exp">Exp Required 

						<?php
							$exp_req= get_post_custom_values('job_exp');
							echo $exp_req[0];
						?>

					</li>
					<li class="last-date">Last Date: 
						<?php
							$last_date= get_post_custom_values('job_last_date');
							echo $last_date[0];
						?>
							
					</li>
				</ul>
			</div>
		</a>
		<br>
		</li>
<br>
		<?php
		//ending while loop here
			endwhile;
			$total_pages = $loop->max_num_pages;

    if ($total_pages > 1){

        $current_page = max(1, get_query_var('paged'));

        echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => '/page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_text'    => __('« prev'),
            'next_text'    => __('next »'),
        ));
    }
		?>
		<?php else :?>
<h3><?php _e('404 Error&#58; Not Found', ''); ?></h3>
<?php endif; ?>
<?php wp_reset_postdata();?>
	</ul>
</div>
<?php get_footer(); ?>