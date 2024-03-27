<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Мой блог</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <main>
    <?php
    require_once ("conn.php");
// Construct the SQL query with the search condition
$sql = "SELECT * FROM news WHERE id LIKE ". $_GET['title'];
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    while ($note = mysqli_fetch_array($result)) {
      echo "<h1>".$note['title']."</h1>";
      echo $note['text'], "<br>";
        
    }
} else {
    echo $search_query." деген ақпарат жоқ.";
}
    ?>
  </main>
  
  
</body>
</html>