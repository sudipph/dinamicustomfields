<?php
			wp_enqueue_script('event_manager_admin_js');
		wp_register_script( 'jquery-ui', EVENT_MANAGER_PLUGIN_URL . '/assets/js/jquery-ui/jquery-ui.js', array('jquery'), EVENT_MANAGER_VERSION, true);
		wp_enqueue_script( 'jquery-ui');