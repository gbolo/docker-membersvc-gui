<?php

if (isset($_GET['view'])){
	switch($_GET['view'])
	{
		case 'ca_cert':
			$view = $_GET['view'];
			$view_title = 'Certificates';
			break;
		case 'ca_user':
			$view = $_GET['view'];
			$view_title = 'Users';
			break;
		case 'ca_affil':
			$view = $_GET['view'];
			$view_title = 'Affiliations';
			break;
		default;
			$view = 'ca_cert';
			$view_title = 'Certificates';
			break;
	}
}else{
	$view = 'ca_cert';
	$view_title = 'Certificates';
}

function datatables_html($view){

	include("include/${view}.html");

}

?>
