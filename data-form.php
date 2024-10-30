
<form name="form1" method="post" action="">	

	<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
	
	<p>&nbsp;</p>
	<h3><?php _e('Contact information', 'contact_data') ?></h3>
	
	<table class="form-table">

					<tr valign="top">
						<th scope="row">
							<label for="contact_data_name"><?php _e('Business Name', 'contact_data') ?></label>
						</th>
						<td>
							<input type="text" name="contact_data_name" id="contact_data_name" value="<?php echo stripslashes( $data['name'] ) ?>" class="regular-text">
						</td>
					</tr>
		
		<tr valign="top">
			<th scope="row">
				<label for="contact_data_url"><?php _e('Website', 'contact_data') ?></label>
			</th>
			<td>
				<input type="text" name="contact_data_url" id="contact_data_url" value="<?php echo stripslashes( $data['url'] ) ?>" class="regular-text">
				<span class="description"><?php _e('URL of the corporate Website . e.g. www.mysite.com', 'contact_data') ?></span>
			</td>
		</tr>
					
					<tr valign="top">
						<th scope="row">
							<label for="contact_data_dir"><?php _e('Address', 'contact_data') ?></label>
						</th>
						<td>
							<input type="text" name="contact_data_dir" id="contact_data_dir" value="<?php echo stripslashes( $data['dir'] ) ?>" class="regular-text">
							<span class="description"><?php _e('Street, number, town, building, etc.', 'contact_data') ?></span>
						</td>
					</tr>
		
		<tr valign="top">
			<th scope="row">
				<label for="contact_data_dir_2"><?php _e('Address (cont.)', 'contact_data') ?></label>
			</th>
			<td>
				<input type="text" name="contact_data_dir_2" id="contact_data_dir_2" value="<?php echo stripslashes( $data['dir_2'] ) ?>" class="regular-text">
				<span class="description"><?php _e('Postal code, city, state, etc.', 'contact_data') ?></span>
			</td>
		</tr>
		
					<tr valign="top">
						<th scope="row">
							<label for="contact_data_email"><?php _e('eMail', 'contact_data') ?></label>
						</th>
						<td>
							<input type="text" name="contact_data_email" id="contact_data_email" value="<?php echo stripslashes( $data['email'] ) ?>" class="regular-text">
						</td>
					</tr>
		
		<tr valign="top">
			<th scope="row">
				<label for="contact_data_tel"><?php _e('Phone number', 'contact_data') ?></label>
			</th>
			<td>
				<input type="text" name="contact_data_tel" id="contact_data_tel" value="<?php echo stripslashes( $data['tel'] ) ?>" class="regular-text">
			</td>
		</tr>
		
					<tr valign="top">
						<th scope="row">
							<label for="contact_data_fax"><?php _e('Fax', 'contact_data') ?></label>
						</th>
						<td>
							<input type="text" name="contact_data_fax" id="contact_data_fax" value="<?php echo stripslashes( $data['fax'] ) ?>" class="regular-text">
						</td>
					</tr>
		
		<tr valign="top">
			<th scope="row">
				<label for="contact_data_map"><?php _e('Google Map', 'contact_data') ?></label>
			</th>
			<td>
				<textarea name="contact_data_map" id="contact_data_map" class="textarea"><?php echo stripslashes( $data['map'] ) ?></textarea>
			</td>
		</tr>

	</table>


	


	<p>&nbsp;</p>
	<h3><?php _e('Social Networks', 'contact_data') ?></h3>
	
	<table class="form-table">
		
		<tr valign="top">
			<th scope="row">
				<label for="contact_data_facebook"><?php _e('Facebook', 'contact_data') ?></label>
			</th>
			<td>
				<input type="text" name="contact_data_facebook" id="contact_data_facebook" value="<?php echo stripslashes( $data['facebook'] ) ?>" class="regular-text">
			</td>
		</tr>
		
					<tr valign="top">
						<th scope="row">
							<label for="contact_data_twitter"><?php _e('Twitter', 'contact_data') ?></label>
						</th>
						<td>
							<input type="text" name="contact_data_twitter" id="contact_data_twitter" value="<?php echo stripslashes( $data['twitter'] ) ?>" class="regular-text">
						</td>
					</tr>
		
		<tr valign="top">
			<th scope="row">
				<label for="contact_data_linkedin"><?php _e('LinkedIn', 'contact_data') ?></label>
			</th>
			<td>
				<input type="text" name="contact_data_linkedin" id="contact_data_linkedin" value="<?php echo stripslashes( $data['linkedin'] ) ?>" class="regular-text">
			</td>
		</tr>
		
					<tr valign="top">
						<th scope="row">
							<label for="contact_data_googleplus"><?php _e('Google Plus', 'contact_data') ?></label>
						</th>
						<td>
							<input type="text" name="contact_data_googleplus" id="contact_data_googleplus" value="<?php echo stripslashes( $data['googleplus'] ) ?>" class="regular-text">
						</td>
					</tr>
		
		<tr valign="top">
			<th scope="row">
				<label for="contact_data_youtube"><?php _e('YouTube', 'contact_data') ?></label>
			</th>
			<td>
				<input type="text" name="contact_data_youtube" id="contact_data_youtube" value="<?php echo stripslashes( $data['youtube'] ) ?>" class="regular-text">
			</td>
		</tr>
		
					<tr valign="top">
						<th scope="row">
							<label for="contact_data_vimeo"><?php _e('Vimeo', 'contact_data') ?></label>
						</th>
						<td>
							<input type="text" name="contact_data_vimeo" id="contact_data_vimeo" value="<?php echo stripslashes( $data['vimeo'] ) ?>" class="regular-text">
						</td>
					</tr>	
		
		<tr valign="top">
			<th scope="row">
				<label for="contact_data_youtube"><?php _e('RSS', 'contact_data') ?></label>
			</th>
			<td>
				<input type="text" name="contact_data_rss" id="contact_data_rss" value="<?php echo stripslashes( $data['rss'] ) ?>" class="regular-text">
			</td>
		</tr>
		
	</table>


	<p class="submit">
		<input type="submit" name="submit" id="submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
	</p>

	<p>Social networks buttons preview:</p>
	<div class="follow_me_preview" style="float:left;">
		<?php follow_me_icons() ?>
	</div>
				
</form>