<?php

include('config/db_connect.php');

$file = 'data/data.json';
$item = [];
$jednostka = $typ = $dokument = $koordynaty = '';
$jst = $firma = $ngo = '';

if(isset($_POST['submit'])) {
    $typOption = $_POST['typ'];

    $jednostka = mysqli_real_escape_string($conn, $_POST['jednostka']);
    $typ = mysqli_real_escape_string($conn, $typOption);
    $dokument = mysqli_real_escape_string($conn, $_POST['dokument']);
    $koordynaty = mysqli_real_escape_string($conn, $_POST['koordynaty']);
    
  if(empty($koordynaty)) {
    echo 'Wprowadź wszystkie dane!';
  } else {
    $sql = "INSERT INTO mapa(jednostka, typ, dokument, koordynaty) VALUES('$jednostka','$typ','$dokument', '$koordynaty')";
    $sql2 = "INSERT INTO docs(doc_name, jed_name) VALUES('$dokument', '$jednostka')";
    
    if(mysqli_query($conn, $sql)){
      if(mysqli_query($conn, $sql2)){
				header('Location: index_db.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
  }
};






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
        <input type="text" name="jednostka" id="jednostka" value="<?php echo htmlspecialchars($jednostka) ?>" />
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
        <input type="text" name="dokument" id="dokument" value="<?php echo htmlspecialchars($dokument) ?>"/>
      </div>
      <div>
        <label for="koordynaty">Koordynaty</label>
        <input type="text" name="koordynaty" id="koordynaty" value="<?php echo htmlspecialchars($koordynaty) ?>" />
      </div>
      <input type="submit" value="Zapisz" name="submit">
    </form>
  </body>
</html>
