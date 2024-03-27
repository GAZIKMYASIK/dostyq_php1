<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мой блог</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Новости</h1>
  </header>
  <main>
  <form action="blog.php" method="GET">
    <input type="text" name="search_query" placeholder="Search articles">
    <br>
    <button type="sub">Найти</button>
  </form>
  <a href="newnote.php">Добавить запись</a><br>
  <a href="reg.php">Регистрация</a><br>
  <a href="auth.php">Авторизация</a><br><br>

  <br>
    <?php
    require_once ("conn.php");

    $search_query = ""; 
    

if (isset($_GET['search_query'])) {
    $search_query = mysqli_real_escape_string($connect, $_GET['search_query']);
}

$sql = "SELECT * FROM news";
if (!empty($search_query)) {
    $sql = $sql. " WHERE title LIKE '%$search_query%'";
}

$result = $connect->query($sql);

if ($result->num_rows > 0) {
    while ($note = mysqli_fetch_array($result)) {
        echo "<a href='article.php?title=" . $note['id'] . "'>" . $note['title'] . "</a>", "<br>";
        
    }
} else {
    echo $search_query." деген ақпарат жоқ.";
}
    ?>

  </main>
  
  
</body>
</html>