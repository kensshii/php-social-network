<?php 
// Подключаемся к комет серверу с логином и паролем для демо доступа (получить свои данные для подключения можно после регистрации на comet-server.ru )
// Логин 15
// Пароль lPXBFPqNg3f661JcegBY0N0dPXqUBdHXqj2cHf04PZgLHxT6z55e20ozojvMRvB8
// База данных CometQL_v1
$comet_link = mysqli_connect("app.comet-server.ru", "15", "lPXBFPqNg3f661JcegBY0N0dPXqUBdHXqj2cHf04PZgLHxT6z55e20ozojvMRvB8", "CometQL_v1");

$text = mysqli_real_escape_string($comet_link, htmlspecialchars($_POST['text']))
$chatName = mysqli_real_escape_string($comet_link, htmlspecialchars($_POST['chat']))


// Отправляем сообщение в канал
mysqli_query (  $comet_link, "INSERT INTO pipes_messages (name, event, message)VALUES('".$chatName."', '', '".$text."' );" );

?>