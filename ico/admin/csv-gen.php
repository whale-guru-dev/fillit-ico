<?php

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=user-data.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('#', 'NAME', 'EMAIL','MOBILE','BALANCE'));

// fetch the data

$dbname = "filliteu_ico";
$dbhost = "localhost";
$dbuser = "filliteu_root";
$dbpass = "Fe5B{fS$}Cx9";


try{
$db =new PDO( "mysql:host=$dbhost; dbname=$dbname; charset=utf8", "$dbuser", "$dbpass");
} catch(Exception $e){
  echo "Problem with the database connection";
}

$ddaa = $db->query("SELECT id, firstname, lastname, mobile, email, mallu FROM users ORDER BY id");

// loop over the rows, outputting them
$i=1;
while ($data = $ddaa->fetch()) {
    $row=array($i ,$data[1].' '.$data[2],$data[4] , $data[3],$data[5].' '.'FILLIT');
    fputcsv($output, $row);
$i++;
}

fclose($output);
exit;
?>