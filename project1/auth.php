<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
</head>
<body>
    <form action="" method="post">
        <label for="zg">Имя пользователя</label><br>
        <input type="text" name="username"><br><br>
        <label for="tx">Пароль</label><br>
        <input type="password" name="password"><br><br>
        <input type="submit" value="Войти">
    </form>
    <?php
        require_once ("conn.php");
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT username, password FROM users WHERE username = '$username'";
        $result = $connect->query($sql);
        
        if ($result->num_rows == 0) {
            echo 'Такого пользователя не существует';
        }
        else {
            $note = mysqli_fetch_array($result);
            if ($note['password'] != $password) {
                echo 'Неверный пароль';
            }
            else {
                $new_url = 'http://localhost/dos/dostyq_php1/project1/blog.php';
                header('Location: '.$new_url);
            }
        }

        mysqli_close($connect);
    ?>
</body>
</html>