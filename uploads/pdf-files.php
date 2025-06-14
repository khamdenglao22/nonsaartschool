<html>
<head>
    <meta charset="utf-8">
    <title>Display the pdf file using php</title>
</head>
<body>
<?php

if(isset($_GET['view_pdf'])){

    $file=$_GET['view_pdf'];
   // $file = 'Cover Letter.pdf';
    $filename =$_GET['view_pdf'];
    header('Content-type: application/pdf');
    header('Content-Disposition: inline; filename="' . $filename . '"');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . filesize($file));
    header('Accept-Ranges: bytes');
    header('Expires: 0');
    header('Cache-Control: public, must-revalidate, max-age=0');
    @readfile($file);
}


?>

</body>
</html>