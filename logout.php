<?php
	require_once("includes/application_startup.php");

	_set_session_unregister_("session_userid");
	_set_session_unregister_("session_username");
	_set_session_destroy_();
	
	_set_location_(_set_link_(def_application_home));
?>