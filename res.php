<?php

include('config/db_connect.php');

$sql = 'SELECT id, jednostka, typ, koordynaty FROM mapa';

$result = mysqli_query($conn, $sql);

$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);



$sql2 = 'SELECT mapa.jednostka, docs.doc_name
FROM mapa
JOIN docs
ON mapa.jednostka = docs.jed_name';

$result2 = mysqli_query($conn, $sql2);

$data2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);

mysqli_free_result($result2);

mysqli_close($conn);

header('Content-Type: application/json');

$res = array('0' => $data, '1' => $data2);

print_r(json_encode($res));
