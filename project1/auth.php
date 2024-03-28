<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
        }
        .fo {
            margin-left: auto;
            margin-right: auto;
            width: 250px;
            height: 200px;
            border: 1px solid black;
            border-radius: 20px;
            display: flex;
            justify-content: space-around;
            flex-direction: column;
            padding-top: 10px;
        }
        .lab {
            width: 100%;
            height: 45px;
            box-sizing: border-box;
            display: flex;
            justify-content: space-around;
            flex-direction: column;
            padding: 0 20px 0 20px;
        }
        .lab0 {
            width: 100%;
            height: 45px;
            box-sizing: border-box;
            display: flex;
            justify-content: space-around;
            flex-direction: column;
            padding: 0 20px 0 20px;
        }
        .lab1 {
            width: 100%;
            height: 45px;
            box-sizing: border-box;
            display: flex;
            justify-content: space-around;
            flex-direction: column;
            padding: 0 20px 0 20px;
        }
        .lab0 span {
            font-size: 20px;
        }
        .lab span {
            margin-left: 10px;
            font-size: 15px;
        }
        .lab1 input {
            width: 100px;
            margin-left: auto;
            border-radius: 20px;
            font-weight: bold;
        }
        .cen {
            width: 300px;
        }
    </style>
</head>
<body>
    <form action="" method="post" class="fo">
        <div class="lab0">
            <span>Авторизироваться</span>
        </div>
        <div class="lab">
            <span>Имя пользователя</span>
            <input type="text" name="username">
        </div>
        <div class="lab">
            <span>Пароль</span>
            <input type="password" name="password">
        </div>
        <div class="lab1">
            <input type="submit" value="Войти">
        </div>
    </form>
    <br><br>   
    <center>
        <a href="http://localhost/dos/dostyq_php1/project1/reg.php">Нет аккаунта?</a>
        <div class="cen">
            <?php
            if (count($_POST) == 0) {}
            else {
                if (in_array('', $_POST)) {
                    echo "Введите все значения для продолжения";
                }
                else {
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
                        if (strrev($note['password']) != $password) {
                            echo 'Неверный пароль';
                        }
                        else {
                            $new_url = 'http://localhost/dos/dostyq_php1/project1/blog.php';
                            header('Location: ' . $new_url);
                        }
                    }
                    mysqli_close($connect);
                }
            }
            ?>
        </div>
    </center>
</body>
</html>