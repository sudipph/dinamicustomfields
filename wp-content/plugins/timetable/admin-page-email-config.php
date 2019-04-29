<div class="wrap timetable_settings_section first">
	<h2><?php _e("Email configuration", "timetable"); ?></h2>
</div>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" id="timetable_settings" class="email_config">
	<input type="hidden" name="action" value="save" />
	<div id="timetable_configuration_tabs" class="tt_hide">
		<ul class="nav-tabs">
			<li class="nav-tab">
				<a href="#tab-admin-email">
					<?php _e('Admin email', 'timetable'); ?>
				</a>
			</li>
			<li class="nav-tab">
				<a href="#tab-admin-smtp">
					<?php _e('Admin SMTP (optional)', 'timetable'); ?>
				</a>
			</li>
			<li class="nav-tab">
				<a href="#tab-email-template-client">
					<?php _e('Email template for client', 'timetable'); ?>
				</a>
			</li>
			<li class="nav-tab">
				<a href="#tab-email-template-admin">
					<?php _e('Email template for admin', 'timetable'); ?>
				</a>
			</li>
		</ul>
		<div id="tab-admin-email">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row">
							<label for="admin_name">
								<?php _e("Name", "timetable"); ?>
							</label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($timetable_contact_form_options["admin_name"]); ?>" id="admin_name" name="admin_name">
						</td>
						<td>
							<span class="description"></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="admin_email">
								<?php _e("Email", "timetable"); ?>
							</label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($timetable_contact_form_options["admin_email"]); ?>" id="admin_email" name="admin_email">
						</td>
						<td>
							<span class="description"></span>
						</td>
					</tr>
					<tr valign="top" class="no-border">
						<th colspan="3">
							<input type="submit" value="Save Options" class="button-primary" name="Submit">
						</th>
					</tr>
				</tbody>
			</table>			
		</div>
		<div id="tab-admin-smtp">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row">
							<label for="smtp_host">
								<?php _e("Host", "timetable"); ?>
							</label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($timetable_contact_form_options["smtp_host"]); ?>" id="smtp_host" name="smtp_host">
						</td>
						<td>
							<span class="description"></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="smtp_username">
								<?php _e("Username", "timetable"); ?>
							</label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($timetable_contact_form_options["smtp_username"]); ?>" id="smtp_username" name="smtp_username">
						</td>
						<td>
							<span class="description"></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="smtp_password">
								<?php _e("Password", "timetable"); ?>
							</label>
						</th>
						<td>
							<input type="password" class="regular-text" value="<?php echo esc_attr($timetable_contact_form_options["smtp_password"]); ?>" id="smtp_password" name="smtp_password">
						</td>
						<td>
							<span class="description"></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="smtp_port">
								<?php _e("Port", "timetable"); ?>
							</label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($timetable_contact_form_options["smtp_port"]); ?>" id="smtp_port" name="smtp_port">
						</td>
						<td>
							<span class="description"></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="smtp_secure">
								<?php _e("SMTP Secure", "timetable"); ?>
							</label>
						</th>
						<td>
							<select name="smtp_secure" id="smtp_secure">
								<option value="">-</option>
								<option value="ssl" <?php echo ($timetable_contact_form_options["smtp_secure"]=="ssl" ? "selected='selected'" : "") ?>><?php _e("ssl", "timetable"); ?></option>
								<option value="tls" <?php echo ($timetable_contact_form_options["smtp_secure"]=="tls" ? "selected='selected'" : "") ?>><?php _e("tls", "timetable"); ?></option>
							</select>
						</td>
						<td>
							<span class="description"></span>
						</td>
					</tr>
					<tr valign="top" class="no-border">
						<th colspan="3">
							<input type="submit" value="Save Options" class="button-primary" name="Submit">
						</th>
					</tr>
				</tbody>
			</table>			
		</div>
		<div id="tab-email-template-client">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row">
							<label for="email_subject_client">
								<?php _e("Email subject", "timetable"); ?>
							</label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($timetable_contact_form_options["email_subject_client"]); ?>" id="email_subject_client" name="email_subject_client">
						</td>
						<td>
							<span class="description"></span>
						</td>
					</tr>
					<tr valign="top" class="no-border">
						<td colspan="3">
							<?php _e("Available placeholders:", 'timetable'); ?>
							<br />
							<strong>{event_title} {column_title} {event_start} {event_end} {event_description_1} {event_description_2} {booking_datetime} {user_name} {user_email} {cancel_booking}</strong>
						</td>
					</tr>
					<tr valign="top">
						<td colspan="3">
							<?php wp_editor($timetable_contact_form_options["template_client"], "template_client", array("editor_height" => 250));?>
						</td>
					</tr>
					<tr valign="top" class="no-border">
						<th colspan="3">
							<input type="submit" value="Save Options" class="button-primary" name="Submit">
						</th>
					</tr>
				</tbody>
			</table>			
		</div>
		<div id="tab-email-template-admin">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row">
							<label for="email_subject_admin">
								<?php _e("Email subject", "timetable"); ?>
							</label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($timetable_contact_form_options["email_subject_admin"]); ?>" id="email_subject_admin" name="email_subject_admin">
						</td>
						<td>
							<span class="description"></span>
						</td>
					</tr>
					<tr valign="top" class="no-border">
						<td colspan="3">
							<?php _e("Available placeholders:", 'timetable'); ?>
							<br>
							<strong>{event_title} {column_title} {event_start} {event_end} {event_description_1} {event_description_2} {booking_datetime} {user_name} {user_email} {cancel_booking}</strong>
						</td>
					</tr>
					<tr valign="top">
						<td colspan="3">
							<?php wp_editor($timetable_contact_form_options["template_admin"], "template_admin", array("editor_height" => 250));?>
						</td>
					</tr>
					<tr valign="top" class="no-border">
						<th colspan="3">
							<input type="submit" value="Save Options" class="button-primary" name="Submit">
						</th>
					</tr>
				</tbody>
			</table>			
		</div>
	</div>
</form>