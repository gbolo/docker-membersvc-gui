<?php

if (isset($_GET['view'])){
	switch($_GET['view'])
	{
		case 'tlsca_cert':
			$view = $_GET['view'];
			$view_title = 'TLS Certificates';
			break;
		case 'tlsca_user':
			$view = $_GET['view'];
			$view_title = 'TLS Users';
			break;
		case 'eca_user':
			$view = $_GET['view'];
			$view_title = 'Enrollment Users';
			break;
		case 'eca_cert':
			$view = $_GET['view'];
			$view_title = 'Enrollment Certificates';
			break;
		case 'tca_user':
			$view = $_GET['view'];
			$view_title = 'TCA Users';
			break;
		case 'tca_cert':
			$view = $_GET['view'];
			$view_title = 'TCA Certificates';
			break;
		case 'tca_tcert':
			$view = $_GET['view'];
			$view_title = 'TCA T Certificate Sets';
			break;
		default;
			$view = 'tlsca_cert';
			$view_title = 'TCA Certificates';
			break;
	}
}else{
	$view = 'tlsca_cert';
	$view_title = 'TLS Certificates';
}

function datatables_html($view){

	include("include/${view}.html");

}

?>
