<?php

    include("connection.php");
    
    function isValidUser($id) {

        global $link;

        $result = mysqli_query($link, "SELECT Id FROM users WHERE Id='$id' LIMIT 1");
        if($result == FALSE) {
            return "";
        }

        $row_cnt = $result->num_rows;
                    
        if($row_cnt > 0) { 
            return TRUE;
        } 

        return FALSE;
    }

    function getNameFromId($id) {

        global $link;

        $result = mysqli_query($link, "SELECT name FROM users WHERE Id='$id' LIMIT 1");

        if($result == FALSE) {
            return "";
        }

        $row = $result->fetch_row();

        return $row[0];
    }
    

    function getLastNameFromId($id) {

        global $link;

        $result = mysqli_query($link, "SELECT lastname FROM users WHERE Id='$id' LIMIT 1");

        if($result == FALSE) {
            return "";
        }

        $row = $result->fetch_row();

        return $row[0];
    }

    function sendDialogMessage($sender, $dialogid, $message) {
        global $link;
        $link->query("INSERT INTO messages (dialogId, sender, msg) VALUES ('$dialogid', '$sender', '$message')");
    }

    function getUsersDialogId($user1, $user2) {

        global $link;

        $result = $link->query("SELECT * FROM dialogs WHERE (user1='$user1' AND user2='$user2') OR (user1='$user2' AND user2='$user1') LIMIT 1");
            
        if($result == FALSE) {
            return -1;
        }

        $row_cnt = $result->num_rows;
                    
        if($row_cnt > 0) { 
            return $result->fetch_assoc()["Id"];
        } 
    }

    function getUsersDialogIdOrCreate($user1, $user2) {

        global $link;

        if(isValidUser($user2) == FALSE)
            return -1;

        $result = $link->query("SELECT * FROM dialogs WHERE (user1='$user1' AND user2='$user2') OR (user1='$user2' AND user2='$user1') LIMIT 1");
            
        if($result == FALSE) {
            return -1;
        }

        $row_cnt = $result->num_rows;
                    
        if($row_cnt > 0) { 
            return $result->fetch_assoc()["Id"];
        } 
        else {
            $result2 = $link->query("INSERT INTO dialogs (user1,user2) VALUES ('$user1', '$user2')");
            if($result2 == FALSE) {
                return -1;
            }
            return $link->insert_id;
        }
    }

?>