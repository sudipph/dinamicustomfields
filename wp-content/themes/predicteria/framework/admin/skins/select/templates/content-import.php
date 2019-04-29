<div class="qodef-tabs-content">
	<div class="tab-content">
		<div class="tab-pane fade in active" id="import">
			<div class="qodef-tab-content">
				<h2 class="qodef-page-title"><?php esc_html_e('Import', 'wellexpo'); ?></h2>
				<form method="post" class="qodef_ajax_form qodef-import-page-holder" data-confirm-message="<?php esc_attr_e('Are you sure, you want to import Demo Data now?', 'wellexpo'); ?>">
					<div class="qodef-page-form">
						<div class="qodef-page-form-section-holder">
							<h3 class="qodef-page-section-title"><?php esc_html_e('Import Demo Content', 'wellexpo'); ?></h3>
							<div class="qodef-page-form-section">
								<div class="qodef-field-desc">
									<h4><?php esc_html_e('Import', 'wellexpo'); ?></h4>
									<p><?php esc_html_e('Choose demo content you want to import', 'wellexpo'); ?></p>
								</div>
								<div class="qodef-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-3">
												<select name="import_example" id="import_example" class="form-control qodef-form-element dependence">
													<option value="wellexpo"><?php esc_html_e('WellExpo Demo', 'wellexpo'); ?></option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="qodef-page-form-section">
								<div class="qodef-field-desc">
									<h4><?php esc_html_e('Import Type', 'wellexpo'); ?></h4>
									<p><?php esc_html_e('Import Type', 'wellexpo'); ?></p>
								</div>
								<div class="qodef-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-3">
												<select name="import_option" id="import_option" class="form-control qodef-form-element">
													<option value=""><?php esc_html_e('Please Select', 'wellexpo'); ?></option>
													<option value="complete_content"><?php esc_html_e('All', 'wellexpo'); ?></option>
													<option value="content"><?php esc_html_e('Content', 'wellexpo'); ?></option>
													<option value="widgets"><?php esc_html_e('Widgets', 'wellexpo'); ?></option>
													<option value="options"><?php esc_html_e('Options', 'wellexpo'); ?></option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="qodef-page-form-section">
								<div class="qodef-field-desc">
									<h4><?php esc_html_e('Import attachments', 'wellexpo'); ?></h4>
									<p><?php esc_html_e('Do you want to import media files?', 'wellexpo'); ?></p>
								</div>
								<div class="qodef-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<p class="field switch">
													<label class="cb-enable dependence"><span><?php esc_html_e('Yes', 'wellexpo'); ?></span></label>
													<label class="cb-disable selected dependence"><span><?php esc_html_e('No', 'wellexpo'); ?></span></label>
													<input type="checkbox" id="import_attachments" class="checkbox" name="import_attachments" value="1">
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="qodef-page-form-section">
								<div class="qodef-field-desc">
									<input type="submit" class="btn btn-primary btn-sm " value="<?php esc_attr_e('Import', 'wellexpo'); ?>" name="import" id="qodef-import-demo-data" />
								</div>
								<div class="qodef-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<div class="qodef-import-load"><span><?php esc_html_e('The import process may take some time. Please be patient.', 'wellexpo') ?> </span><br />
													<div class="qodef-progress-bar-wrapper html5-progress-bar">
														<div class="progress-bar-wrapper">
															<progress id="progressbar" value="0" max="100"></progress>
														</div>
														<div class="progress-value">0%</div>
														<div class="progress-bar-message">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="qodef-page-form-section qodef-import-button-wrapper">
								<div class="alert alert-warning">
									<strong><?php esc_html_e('Important notes:', 'wellexpo') ?></strong>
									<ul>
										<li><?php esc_html_e('Please note that import process will take time needed to download all attachments from demo web site.', 'wellexpo'); ?></li>
										<li> <?php esc_html_e('If you plan to use shop, please install WooCommerce before you run import.', 'wellexpo')?></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>