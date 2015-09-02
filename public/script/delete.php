<?php
//print_r($_FILES);
print_r($_POST);

$count = count($_POST['file_name']);
$i = 0;

//echo $count;

while($i < $count) {

	$name = $_POST['file_name'][$i];
	
    if(file_exists($name)) {
    	//$directory = 'images/upload/jobs/'; //directoryを事前に作る必要あり
        if(unlink($name)) {
        	echo "Done Delete";
        }
        else {
        	echo "No Delete";
        }
        
    }
    else {
    	echo "No Such File";
    }
    
//	$moveTo = $directory . $_FILES['files']['name'][$i];
//
//    if(! move_uploaded_file($_FILES['files']['tmp_name'][$i], $moveTo)) {
//        echo ' Upload Failed';
//    }
    
	$i++;
}



