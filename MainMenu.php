<?php 
	if ($_GET) {
		switch ($_GET['menu']) {
			case 'change-pass':
				if(!file_exists ("change-pass.php")) die ("Empty Main Page!"); 
				include "change-pass.php";					break;
			case 'logout':
				if(!file_exists ("logout.php")) die ("Empty Main Page!"); 
				include "logout.php";							break;

			# INPUT DATA
			case 'product':
				if(!file_exists ("Inputan/product.php")) die ("Empty Main Page!"); 
				include "Inputan/product.php";			break;
			case 'setting':
				if(!file_exists ("Inputan/setting.php")) die ("Empty Main Page!"); 
				include "Inputan/setting.php";			break;
			

			default:
				if(!file_exists ("dashboard.php")) die ("Empty Main Page!"); 
				include "dashboard.php";					break;
		}
	}
	
