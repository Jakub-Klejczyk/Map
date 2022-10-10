<?php

$file = 'data/data.json';
$item = [];

if(isset($_POST['submit'])) {
    $jednostka = filter_input(INPUT_POST, 'jednostka', FILTER_SANITIZE_SPECIAL_CHARS);
    $typ = filter_input(INPUT_POST, 'typ', FILTER_SANITIZE_SPECIAL_CHARS);
    $dokument = filter_input(INPUT_POST, 'dokument', FILTER_SANITIZE_SPECIAL_CHARS);
    $koordynaty = filter_input(INPUT_POST, 'koordynaty', FILTER_SANITIZE_SPECIAL_CHARS);
    
    if(!empty($koordynaty)) {

      $i = explode(" ", $koordynaty);
      $x = $i[1];
      $y = $i[0];


      $item = array(
        'type' => $typ,
        'properties' => array(
          'f1' => $jednostka,
          'f2' => $dokument
        ),
        'geometry' => array(
          'type' => 'Point',
          'coordinates' => array(
            0 => $x,
            1 => $y
          )
        )
    );
    } 
};

function convertToJson($data) {
  $json = json_encode($data, JSON_PRETTY_PRINT);
  return $json;
}

$itemJson = convertToJson($item);



function saveJson($item, $file2) {
  $file = fopen($file2, 'a');
  fwrite($file, $item);
  fclose($file);
};

if(!empty($koordynaty)) {
  saveJson($itemJson, $file);
} else {
  echo 'Wprowadź wszystkie dane!';
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formularz</title>
  </head>
  <body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <div>
        <label for="jednostka">Nazwa jednostki</label>
        <input type="text" name="jednostka" id="jednostka" />
      </div>
      <div>
        <label for="typ">Typ jednostki</label>
        <select name="typ" id="">
          <option value="jst">JST</option>
          <option value="firma">Firma</option>
          <option value="ngo">NGO</option>
        </select>
      </div>
      <div>
        <label for="dokument">Nazwa dokumentu</label>
        <input type="text" name="dokument" id="dokument" />
      </div>
      <div>
        <label for="koordynaty">Koordynaty</label>
        <input type="text" name="koordynaty" id="koordynaty" />
      </div>
      <input type="submit" value="Zapisz" name="submit">
    </form>
  </body>
</html>
