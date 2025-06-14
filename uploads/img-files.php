<?php



if(isset($_GET['view_imag'])){

    $file=$_GET['view_imag'];
   // $file = '30450.jpg';

    header('Content-Type: image/jpeg');
    header('Content-Length: ' . filesize($file));
    echo file_get_contents($file);

}
