<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
        }
        .fo {
            margin-left: auto;
            margin-right: auto;
            width: 250px;
            height: 350px;
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
            <span>Зарегистрироваться</span>
        </div>
        <div class="lab">
            <span>Имя пользователя</span>
            <input type="text" name="username">
        </div>
        <div class="lab">
            <span>Электронная почта</span>
            <input type="text" name="email">
        </div>
        <div class="lab">
            <span>Возраст</span>
            <input type="number" name="age">
        </div>
        <div class="lab">
            <span>Пароль</span>
            <input type="password" name="password">
        </div>
        <div class="lab">
            <span>Повторить пароль</span>
            <input type="password" name="password2">
        </div>
        <div class="lab1">
            <input type="submit" value="Дальше">
        </div>
    </form>
    <br><br><br>
    <center>
        <a href="http://localhost/dostyq_php1/project1/auth.php">Есть аккаунт?</a>
        <div class="cen">
        <?php
            if (count($_POST) == 0) {}
            else {
                require_once ("conn.php");
                $username = $_POST['username'];
                $email = $_POST['email'];
                $age = $_POST['age'];
                $password = $_POST['password'];
                $password2 = $_POST['password2'];
                $email_names = array('gmail', 'mail', 'yahoo');
                $email_domens = array('com', 'ru', 'kz', 'uk');
                if (in_array('', $_POST)) {
                    echo "Введите все значения для продолжения";
                }
                else {
                    $sql = "SELECT username, password FROM users WHERE username = '$username'";
                $result = $connect->query($sql);
                if ($result->num_rows != 0) {
                    echo "Пользователь с таким именем уже существует";
                }
                else {
                    if ($password != $password2) {
                        echo 'Пароли не совпадают';
                    }
                    else if (strlen($password) < 8) {
                        echo 'Пароль должен иметь больше 7 символов';
                    }
                    else if ($age < 16) {
                        echo 'Вы неудостоверенная личность';
                    }
                    else {
                        $cur_pass = strrev($password);
                        if (strpos($email, '@') == false) {
                            echo 'email is not correct';
                        }
                        else {
                            $two_em = explode('@', $email);
                            if (strpos($two_em[1], '.') == false) {
                                echo 'email is not correct';
                            }
                            else {
                                $sec_em = explode('.', $two_em[1]);
                                if (in_array($sec_em[0], $email_names) == false or in_array($sec_em[1], $email_domens) == false) {
                                    echo 'email is not correct';
                                }
                                else {
                                    $sql = "INSERT INTO users (username, email, age, password) VALUES ('$username', '$email', $age, '$cur_pass')";
                                    if (mysqli_query($connect, $sql)) {
                                        $new_url = 'http://localhost/dostyq_php1/project1/auth.php';
                                        header('Location: '.$new_url);
                                    } 
                                    else {
                                        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
                                    }
                                }
        
                            }
                        }
                    }
                    mysqli_close($connect);
                }
                }
            }
        ?>
        </div>
    </center>
</body>
</html>