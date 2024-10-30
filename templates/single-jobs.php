 <?php
/**
 * The template for displaying jobs details
 *
 * @package WordPress
 * @subpackage 
 * @since 
 */
?>


<?php get_header(); ?>

<?php 

	$job_fetch_meta = get_post_meta( get_the_ID() ); 
?>
		<div class="job-box">
			<h2><strong><a><?php echo the_title(); ?></a></strong></h2>
		<div class="job-meta-details">
			<ul class="meta-list">
				<li class="meta-job-details"><span class="label
				<?php
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
					 ?>

				"><?php echo $job_fetch_meta['job_type'][0];?></span></li>
				<li class="meta-job-location"><span class="glyphicon glyphicon-map-marker gray"><a href="#"><strong><?php echo $job_fetch_meta['job_loc'][0];?></strong></a></span></li>
				<li class="meta-job-positions"><span><strong>Total-Position: </strong></span><?php echo $job_fetch_meta['job_pos'][0];?></li>
				<li class="meta-job-date"><span class="glyphicon glyphicon-calendar gray"><strong>Apply Till:  </strong></span> <?php echo $job_fetch_meta['job_last_date'][0];?></li>
			</ul>
		</div>
		<div class="job-company-info">
		<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); ?>
		<?php

				if(!empty($url)){
					?>
						<span class="company-img"><img src="<?php echo $url; ?>" width="80" height="70">
				</span>
					<?php
				}
				else{

					?>
					<span class="company-img"><img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) .'resources/img/Hiring2-600x300.jpg' ; ?>" width="80" height="70">
				</span>
					<?php
				}
		?>
				<div class="company-meta">
					<span class="company-email"><b>Apply at:</b>  <?php echo $job_fetch_meta['company_email'][0];?></span>
					<span class="company-job-exp"><b>Experience: </b> <?php echo $job_fetch_meta['job_exp'][0];?></span>
					<span class="company-salary">
						<b>Salary Package: </b>25000-40000 RS
					</span>
					<span class="view-button button-gray"><a href="mailto:<?php echo $job_fetch_meta['company_email'][0];?>?Subject=Job Application">Apply Now</a></span>
				</div>
				<div class="company-name"><h2><strong><a><?php echo $job_fetch_meta['company_name'][0];?></a></strong></h2>
				</div>
		</div>
		<div class="more-details">
		<h3>Job Details</h3>
			<p>
			<?php echo $job_fetch_meta['job_details'][0];?>
			</p>
		</div>

	</div>
<?php get_footer(); ?>