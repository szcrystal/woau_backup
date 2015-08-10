<?php
print_r($_FILES);
print_r($_POST);

$count = count($_FILES['files']['name']);
$i = 0;

echo $count;

while($i < $count) {

	$moveTo = 'images/upload/' . $_FILES['files']['name'][$i];

    if(! move_uploaded_file($_FILES['files']['tmp_name'][$i], $moveTo)) {
        echo ' Upload Failed';
    }
    
	$i++;
}



