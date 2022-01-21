<?php 
		
		$file_name = "branch_manual.pdf";
		$full_path = "user-manual/".$file_name;
       
     header('Content-Type: application/pdf');
	 header("Content-Disposition: attachment; filename=\"$file_name\"");
	 readfile($file_name);


 ?>