
<?php 
   /* if(!empty($_POST)) {
        if(isset($_POST['userId']) && isset($_POST['message'])) {
            $receiver = $_POST['userId'];
            $sender = $_COOKIE["userCurrentId"];
            $message = $_POST['message'];
            if($sender != $receiver) {
                $currentDialogId = getUsersDialogIdOrCreate($sender, $receiver);
                sendDialogMessage($sender, $currentDialogId, $message);
            }
        }
    } */

    if(!empty($_POST)) {
        if(isset(array_values($_POST)[0]) && isset($_POST['gotodialog'])) {
            $dialogId = array_values($_POST)[0];
            $_SESSION["currentDialogId"] = $dialogId;
            echo '<script> CometServer().subscription("SimplePhpChat", function(event){
                console.log("Мы получили сообщение из канала SimplePhpChat",  event.data, event);
                $("#textHolder").html( $("#textHolder").html() +"<hr>"+event.data);
            })
         </script>';
            header("Location: /");
        }
        if(isset($_POST['message'])) {
            $message = $_POST['message'];
            $sender = $_COOKIE["userCurrentId"];
            $currentDialogId = $_SESSION["currentDialogId"];
            sendDialogMessage($sender, $currentDialogId, $message);
        }
    }
?>

    <?php 
        if (!isset($_SESSION["currentDialogId"]) || $_SESSION["currentDialogId"] < 1):
    ?>
        <div id = "block-messages-main">
        <div id = "block-messages-your-dialogs">
            <h3> Ваши диалоги: </h3>
        </div>
        <?php 
            $userId = $_COOKIE["userCurrentId"];
            $result = $link->query("SELECT * FROM dialogs WHERE user1='$userId' OR user2='$userId' ORDER BY Id");
            if($result != FALSE) {
                while ($row = $result->fetch_assoc()) {
                    $secondUserId = ($row["user1"] == $userId) ? $row["user2"] : $row["user1"];
                    $secondUserName = getNameFromId($secondUserId);
                    $dialogId = $row['Id'];
                    echo '<div id="block-messages-message">';
                        echo '<form id="dialogchoose" method="POST">';
                            echo '<input type="hidden" name='.$dialogId.' value='.$dialogId.'  />';
                            echo '<input type="submit" name="gotodialog" value='.$secondUserName.' />';
                        echo '</form>';
                    echo '</div>';
                }
            }
        ?>  
        </div> 
    <?php 
        else:
?>
        <div id = "block-messages-main">
        <?php 
            $currentDialogId = $_SESSION["currentDialogId"];
            if ($result2 = $link->query("SELECT * FROM messages WHERE dialogId='$currentDialogId' ORDER BY Id")) {
                while ($row2 = $result2->fetch_assoc()) {
                    $sender = $row2['sender'];
                    $senderName = getNameFromId($sender);
                    $text = $row2['msg'];
                    echo("<p> $senderName: $text </p>");
                }
            }
        ?>
        </div>
        <div id="block-messages-enter-message">
                <form method="POST">
                    <p> <input type="text" id="input_label" name="message" /> </p>
                    <p> <input type="submit" id="input_submit" /> </p>
                </form>
        </div>

        <?php endif; ?>
<!-- 
<div id = "messages-body-start-dialog">
    <form method="POST">
    <p><input type="text" name="userId"> </p>
        <p> <input type="text" name="message"> </p>
        <p><input type="submit"></p>
    </form>
</div>

<div id = "messages-body">
    <p>Мои диалоги: </p> -->
    <?php /*
        $userId = $_COOKIE["userCurrentId"];
        if ($result = $link->query("SELECT * FROM dialogs WHERE user1='$userId' OR user2='$userId' ORDER BY Id")) {
            while ($row = $result->fetch_assoc()) {
                if($row["user1"] == $userId) {
                    $secondUserId = $row["user2"];
                    echo("<p> $secondUserId </p>");
                    echo("<table border=\"1\" cellpadding=\"7\" cellspacing=\"0\"> <tr><td> ");
                    $dialogId = $row["Id"];
                    if ($result2 = $link->query("SELECT * FROM messages WHERE dialogId='$dialogId' ORDER BY Id")) {
                        while ($row2 = $result2->fetch_assoc()) {
                            $sender = $row2['sender'];
                            $senderName = getNameFromId($sender);
                            $text = $row2['msg'];
                            echo("<p> $senderName: $text </p>");
                        }
                    }
                    echo("</td></tr></table>");
                }
                else {
                    $secondUserId = $row["user1"];
                    echo("<p> $secondUserId </p>");
                    echo("<table border=\"1\" cellpadding=\"7\" cellspacing=\"0\"> <tr><td> ");
                    $dialogId = $row["Id"];
                    if ($result2 = $link->query("SELECT * FROM messages WHERE dialogId='$dialogId' ORDER BY Id")) {
                        while ($row2 = $result2->fetch_assoc()) {
                            $sender = $row2['sender'];
                            $senderName = getNameFromId($sender);
                            $text = $row2['msg'];
                            echo("<p> $senderName: $text </p>");
                        }
                    }
                    echo("</td></tr></table>");
                }
            }
        }*/
    ?>
<!-- </div> -->