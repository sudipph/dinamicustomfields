<?php

if ( wellexpo_select_is_timetable_installed() ) {
	include_once SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/timetable/timetable-functions.php';
	include_once SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/timetable/admin/meta-boxes/timetable-meta-boxes.php';
}