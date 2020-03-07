<?php

    if(!empty($_POST)) {
        if(isset($_POST['tolog'])) {
            $_SESSION["userCurrentRegister"] = 0;
            header("Location: /");
        }
        if(isset($_POST['name'])
            && isset($_POST['lastname'])
            && isset($_POST['email'])
            && isset($_POST['password'])) {

            $name = trim(htmlspecialchars($_POST['name']));
            $lastname = trim(htmlspecialchars($_POST['lastname']));
            $email = trim(htmlspecialchars($_POST['email']));
            $password = md5(trim(htmlspecialchars($_POST['password'])));
            $ip = $_SERVER['REMOTE_ADDR'];

            if ($result = $link->query("SELECT Id FROM users where email='$email' LIMIT 1")) {
                $row_cnt = $result->num_rows;
                if($row_cnt > 0) { }
                else {
                    if ($link->query("INSERT INTO users (email,password,name,lastname,ip) VALUES ('$email', '$password', '$name', '$lastname', '$ip')")) {
                        setcookie("userCurrentId", $link->insert_id, time()+60*60*24*30);
                        header("Location: /");
                    }
                }
            }

        }
    }

?>

<div id="block-register-form-reg">
    <form id="block-register-form-submit" method="POST">
        <p><input type="text" name="name" id="name" placeholder="Введите ваше имя:" required></p>
        <p><input type="text" name="lastname" id="lastname" placeholder="Введите вашу фамилию:" required></p>
        <p><input type="text" name="email" id="email"  placeholder="Введите ваш email адрес:" required></p>
        <p><input type="text" name="password" id="password"  placeholder="Введите ваш пароль:" required></p>
        <p> <input type="submit" id="submit_register" value="Зарегистрироваться"></p>
    </form>
    <div id="block-register-form-log-submit"> 
        <form method="POST">
            <p> <input type="submit" name="tolog" value="Перейти к авторизации"></p>
        </form>
    </div>
</div>