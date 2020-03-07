<?php

    // echo $_COOKIE["userCurrentId"];

    require 'messages/body.php';

    

?>

<div id="block-main">
    <div id="block-main-column">
        <div id="block-main-column-ava">
            <img src="../pages/files/male.png" alt="" />
        </div>
        <div id="block-main-column-name">
            <?php 
                echo getNameFromId($_COOKIE["userCurrentId"])." "; 
                echo getLastNameFromId($_COOKIE["userCurrentId"]); 
            ?>
        </div>
        <div id="block-main-column-logout">
            <button id="block-main-column-logout-btn">Выйти</button>
        </div>
    </div>
</div>