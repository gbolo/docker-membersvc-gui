<?php

if (isset($_GET['view'])){
	switch($_GET['view'])
	{
		case 'cert':
			$view = $_GET['view'];
			$view_title = 'Certificates';
			break;
		case 'users':
			$view = $_GET['view'];
			$view_title = 'Users';
			break;
		case 'eca_user':
			$view = $_GET['view'];
			$view_title = 'Enrolment Users';
			break;
		case 'eca_cert':
			$view = $_GET['view'];
			$view_title = 'Enrolment Certificates';
			break;
		default;
			$view = 'cert';
			$view_title = 'Certificates';
			break;
	}
}else{
	$view = 'cert';
	$view_title = 'Certificates';
}

function datatables_html($view){

	include("include/${view}.html");

}

?>
