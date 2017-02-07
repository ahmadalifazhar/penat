<?php
switch (strtolower($includefile))
{
	case 'article':
	case 'add/edit':
	case 'mosque':
	case 'notfound':
	case 'functions':
	case 'searchmap':
	case 'activityprintcpd':
	case 'activityprintletter1':
	case 'activityprintletter2':
	case 'activityprintletter2list':
	case 'config':
	case 'activityedit':
	case 'activitycpd':
	case 'activityform':
	case 'accdb':
	case 'faq/manage_faq':
	case 'faq/addfaq':
	case 'faq/calendar_form':
	case 'faq/process_delete_post':
	case 'faq/process_update_post':
	case 'faq/processfaq':
	case 'faq/update_post':
	case 'faq/view_post':
	case 'greet':
	case 'file':
	case 'template':
		$includefile = "error";
		break;
	default:
		break;
	}
switch (strtolower($includefile))
{
	case 'setting':
	case 'friends':
	case 'messages':
	case 'inbox':
	case 'profile':
		include "modules/pages/account/".$includefile.".php";
		break;
	default:
		include "modules/include.php";
		break;
}
?>