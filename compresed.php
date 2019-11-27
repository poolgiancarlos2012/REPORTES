<?php


// $filename = "mi_archivo.zip";
// $zip = new ZipArchive();
// if ($zip->open($filename, ZipArchive::CREATE) !== TRUE) {
// exit("cannot open <$filename>\n");
// }
// $zip->addFile("/public/files/archivo.pdf", "archivo.pdf");
// $zip->addFile("/public/files/archivo.docx", "word/archivo.docx");
// $zip->close();

$directorio = '/587edc3ea472a';
$ficheros1  = scandir($directorio);
$ficheros2  = scandir($directorio, 1);
 
print_r($ficheros1);
print_r($ficheros2);


?>