<?php

/**
This class extend WP_Widget class with 4 functins.
widget name: Job portal Widget
Description: This displays job published in widget area. 
*/

class jp_job_portal_widget extends WP_Widget {

function __construct() {
	parent::__construct(
	// Base ID of your widget
	'wpb_widget',
	// Widget name will appear in UI
	__('Job Portal', 'wpb_widget_domain'),

	// Widget description

	array( 'description' => __( 'Job Portal Widget for Side bar', 'wpb_widget_domain' ), ));

}

// Creating widget front-end

// This is where the action happens

public function widget( $args, $instance ) {

		/**
		 * Job portal Widget shows 5 variable per job
		 * Job title
		 * Company Name
		 * Job Nature
		 * Total Postion Avalible
		 * Experience Reuired for Job
		 */
	    extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$count = $instance['job_count_show'];
		echo $before_widget;
		echo "<h1>".$title."</h1>";?>
		<div id="jobs-widget" class="job-widget">
			<ul class="job-list">
			<!--Job list avalible-->
			 <?php
			 /**query custom post type form worpdress data base*/
			  $args = array( 
			  	'post_type' => 'jobs',
			  	'showposts' => $count
			  	 );
                    $loop = new WP_Query( $args );
                    while ( $loop->have_posts() ) : $loop->the_post();
                 ?>
					<li>
						
							<div class="job-title">
								<strong>
								<?php $job_title =  get_post_custom_values('job_title'); 
			                    echo $job_title[0];
			                     ?>
                     			</strong>
							</div>
							<ul class="job-meta">
							 	<li><?php $comp_name =  get_post_custom_values('company_name'); 
                    echo $comp_name[0];
                     ?></li>
                     <?php $job_nature =  get_post_custom_values('job_type'); 
                     ?>
							 	<li class=" label							 	<?php
					 if(!strcmp($job_nature[0],'Full Time')){
					 	echo 'label-green';
					 }
					 if(!strcmp($job_nature[0],'Contract Based')){
					 	echo 'label-orange';
					 }
					 if(!strcmp($job_nature[0],'Part time')){
					 	echo 'label-blue';
					 }
					 if(!strcmp($job_nature[0],'Internship')){
					 	echo 'label-meganta';
					 }
					if(!strcmp($job_nature[0],'Freelancer Required')){
					 	echo 'label-sky-blue';
					 }					 
					 ?>"

							 	"><?php 
                    echo $job_nature[0];
                     ?></li>
							</ul>
							<br>
							<br>
							<ul class="job-meta">
							 	<li><b>Positions: </b> <?php $job_pos =  get_post_custom_values('job_pos'); 
                    echo $job_pos[0];
                     ?> </li>
							 	<li><b>Exp Req: </b> <?php $job_exp =  get_post_custom_values('job_exp'); 
                    echo $job_exp[0];
                     ?></li>
							</ul>

							<ul>
								<li><a href="<?php the_permalink(); ?>"><div class="widget-button button-blue"> <b>View Job</b></div></a></li>
							</ul>
							
					</li>
			<?php endwhile; ?>
			</ul>

		</div>
		
		<?php
		echo $after_widget;
}

// Widget Backend

public function form( $instance ) {

		/*  Backend form
		*   Take only two varaible value form widget setting form
		*	Widget Name 
		*	Total Jobs Shown on Widget
		*/
		
		  $title = ! empty( $instance['title'] ) ? $instance['title'] : ''; 
		  $job_count_show= ! empty( $instance['job_count_show'] ) ? $instance['job_count_show'] : ''; 
		  ?>
 		 <p>
		    <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		    <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" /><br>
		    <label for="<?php echo $this->get_field_id( 'job_count_show' ); ?>">Job Count:</label>
		    <input type="number" id="<?php echo $this->get_field_id( 'job_count_show' ); ?>" name="<?php echo $this->get_field_name( 'job_count_show' ); ?>" value="<?php echo esc_attr( $job_count_show ); ?>" />
		 </p> 

		<?php

}
  
// Updating widget replacing old instances with new

public function update( $new_instance, $old_instance ) {

	$instance = $old_instance;
	$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
  	$instance[ 'job_count_show' ] = strip_tags( $new_instance[ 'job_count_show' ] );
  	return $instance;
	

}

} // Class wpb_widget ends here

// Register and load the widget

function wpb_load_widget() {

    register_widget( 'jp_job_portal_widget' );

}

add_action( 'widgets_init', 'wpb_load_widget' );
