
			
			<div class="meta-row">
				<div class="meta-th">
					<label for="project_type" class="dwp-row-title"><b>Job Title (Manager, software Engineer, Accountant etc..)</b><span class="label-required">*</span></label>
				</div>
				<div class="meta-td">
					<input type="text" required="true" class="input-large" name="job_title" id="job_title" value="<?php if(!empty($dwwp_stored_meta['job_title'])) echo $dwwp_stored_meta['job_title'][0]; ?>">	
				</div>

				<div class="meta-th">
					<label for="company_name" class="dwp-row-title"><b>Company Name</b><span class="label-required">*</span></label>
				</div>
				<div class="meta-td">
					<input type="text" required="true" class="input-large" name="company_name" id="company_name" value="<?php if(!empty($dwwp_stored_meta['company_name'])) echo $dwwp_stored_meta['company_name'][0]; ?>">
				</div>

				<div class="meta-th">
					<label for="company_email" class="dwp-row-title"><b>Company Email</b><span class="label-required">*</span></label>
				</div>
				<div class="meta-td">
					<input type="Email" required="true" class="input-large" name="company_email" id="company_email" value="<?php if(!empty($dwwp_stored_meta['company_email'])) echo $dwwp_stored_meta['company_email'][0]; ?>">
				</div>

				<div class="meta-th">
					<label for="job_nature" class="dwp-row-title"><b>Job Type </b><span class="label-required">*</span></label>
				</div>
				<div class="meta-td">
				<?php $selected = get_post_meta($post->ID, 'job_type', true); ?>
					<select class="input-large" required="true" name="job_type" id="job_type">
						<option value="Full Time" <?php selected( $selected, 'Full Time' ); ?>>Full Time</option>
						<option value="Part Time" <?php selected( $selected, 'Part Time' ); ?>>Part Time</option>
						<option value="Contract Based" <?php selected( $selected, 'Contract Based' ); ?>>Contract Based</option>
						<option value="Internship" <?php selected( $selected, 'Internship' ); ?>>Internship</option>
						<option value="Freelancer Required" <?php selected( $selected, 'Freelancer Required' ); ?>>Freelancer Required</option>
					</select>	
				</div>
				<div class="meta-th">
					<label for="job_loc" class="dwp-row-title"><b>Job Location (City/Country etc.)</b><span class="label-required">*</span></label>
				</div>
				<div class="meta-td">
					<input type="text" required="true" class="input-large" name="job_loc" id="job_loc" value="<?php if(!empty($dwwp_stored_meta['job_loc'])) echo $dwwp_stored_meta['job_loc'][0]; ?>">
				</div>
				<div class="meta-th">
					<label for="job_pos" class="dwp-row-title"><b>Total Positions</b><span class="label-required">*</span></label>
				</div>
				<div class="meta-td">
					<input type="number" required="true" class="input-large" name="job_pos" id="job_pos" value="<?php if(!empty($dwwp_stored_meta['job_pos'])) echo $dwwp_stored_meta['job_pos'][0]; ?>">
				</div>

				<div class="meta-th">
					<label for="job_exp" class="dwp-row-title"><b>Experience Required (0-2 years etc)</b><span class="label-required">*</span></label>
				</div>
				<div class="meta-td">
					<input type="text" required="true" class="input-large" name="job_exp" id="job_exp" value="<?php if(!empty($dwwp_stored_meta['job_exp'])) echo $dwwp_stored_meta['job_exp'][0]; ?>">
				</div>

				<div class="meta-th">
					<label for="job_salary" class="dwp-row-title"><b>Expected Salary (10,000 RS -25,000 RS etc)</b><span class="label-required">*</span></label>
				</div>
				<div class="meta-td">
					<input type="text" required="true" class="input-large" name="job_salary" id="job_salary" value="<?php if(!empty($dwwp_stored_meta['job_salary'])) echo $dwwp_stored_meta['job_salary'][0]; ?>">
				</div>

				<div class="meta-th">
					<label for="job_last_date" class="dwp-row-title"><b>Last Date to Apply</b><span class="label-required">*</span></label>
				</div>
				<div class="meta-td">
					<input type="Date" required="true" name="job_last_date" id="job_last_date" value="<?php if(!empty($dwwp_stored_meta['job_last_date'])) echo $dwwp_stored_meta['job_last_date'][0]; ?>">
				</div>
				
				<div class="meta-th">
					<label for="More Details" class="dwp-row-title"><b>Job More Details</b></label>
				</div>
				<?php
						$content= get_post_meta($post -> ID, 'job_details', true);
						$editor = 'job_details';
						$settings = array('textarea_rows' => 8,
							'media_button' => true,
							);
						wp_editor($content, $editor, $settings);

					?>

			</div>