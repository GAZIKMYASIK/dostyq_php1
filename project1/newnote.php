<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить запись</title>
</head>
<body>
    <form action="" method="post">
        <label for="zg">Заголовок</label><br>
        <input type="text" id="zg" name="title"><br>
        <label for="tx">Текст</label><br>
        <input type="text" id="tx" name="text"><br><br>
        <input type="submit" value="Добавить">
    </form>
    <?php
        require_once ("conn.php");
        $title = $connect->real_escape_string($_POST['title']);
        $text = $connect->real_escape_string($_POST['text']);
        $sql = "INSERT INTO news (title, text) VALUES ('$title', '$text')";
        if (isset($_POST["title"]) && isset($_POST["text"])){
            if (mysqli_query($connect, $sql)) {
                $new_url = 'http://localhost/dos/dostyq_php1/project1/blog.php';
                header('Location: '.$new_url);
            } 
        }
        
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }
        mysqli_close($connect);
    ?>
</body>
</html>