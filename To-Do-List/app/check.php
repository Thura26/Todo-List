<?php

if (isset($_POST['id'])) {

    require '../db_conn.php';

    $id = $_POST['id'];

    if (empty($id)) {

        echo 'error';
    } else {

        $todo_list = $conn->prepare("SELECT id, checked FROM todo_list WHERE id=?");

        $todo_list->execute([$id]);

        $todo = $todo_list->fetch();

        $uId = $todo['id'];

        $checked = $todo['checked'];

        $uChecked = $checked ? 0 : 1;

        $res = $conn->query("UPDATE todo_list SET checked=$uChecked WHERE id=$uId");

        if ($res) {

            echo $checked;
        } else {

            echo "error";
        }

        $conn = null;

        exit();
    }
} else {

    header("Location: ../index.php?mess=error");
}
