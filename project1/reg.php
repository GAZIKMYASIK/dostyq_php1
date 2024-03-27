<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>
<body>
    <form action="" method="post">
        <label for="zg">Имя пользователя</label><br>
        <input type="text" name="username"><br><br>
        <label for="tx">Электронная почта</label><br>
        <input type="text" name="email"><br><br>
        <label for="tx">Возраст</label><br>
        <input type="number" name="age"><br><br>
        <label for="tx">Пароль</label><br>
        <input type="password" name="password"><br><br>
        <label for="tx">Повторить пароль</label><br>
        <input type="password" name="password2"><br><br>
        <input type="submit" value="Добавить">
    </form>
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
                                $new_url = 'http://localhost/dos/dostyq_php1/project1/auth.php';
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
    ?>
</body>
</html>