<?php
    if(!empty($_POST)) {
        if(isset($_POST['toreg'])) {
            $_SESSION["userCurrentRegister"] = 1;
            header("Location: /");
        }
        if(isset($_POST['email'])
            && isset($_POST['password'])) {

            $email = trim(htmlspecialchars($_POST['email']));
            $password = md5(trim(htmlspecialchars($_POST['password'])));

            if ($result = $link->query("SELECT Id FROM users where email='$email' AND password='$password' LIMIT 1")) {
                $row_cnt = $result->num_rows;
                if($row_cnt > 0) { 
                    $row = $result->fetch_assoc();  
                    setcookie("userCurrentId", $row["Id"], time()+60*60*24*30);
                    header("Location: /");
                }
            }
        }
    }
?>

<div id="block-login-form">
    <form id="block-login-form-submit" method="POST">
        <p> <input type="text" name="email" id="email"   placeholder="Введите ваш email адрес:" required> </p>
        <p> <input type="text" name="password" id="password" placeholder="Введите ваш пароль:" required></p>
        <p> <input type="submit" class="submit_login" id="submit_login" value="Авторизоваться"></p>
    </form>
    <p> 
        <div id="block-login-form-reg"> 
           <!-- <form method="POST">
                <p> <input type="submit" name="toreg" class="gotoreg" id="gotoreg" value="Перейти к регистрации"></p>
            </form> -->
            <form id="block-login-form-reg-submit" method="POST">
                <b>Еще не зарегистрированы? </b>
                <input type="submit" name="toreg" value="Зарегистрироваться">
            </form>
        </div> 
    </p>
</div>