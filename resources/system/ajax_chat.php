<?php

require_once 'db_config.php';

switch ($_POST['chat_function']) {
    case 'refresh_chat':
        if (isset($_POST['from']) && isset($_POST['to']) && $_POST['to'] != "") {
            $from = $_POST['from'];
            $to = $_POST['to'];
            mysqli_query($connection, "UPDATE `messages` SET `status` = '0' WHERE `messages`.`user_to` = '$to' AND user_from = '$from'");
            $query = mysqli_query($connection, "SELECT * FROM messages WHERE (user_to = '" . $to . "' AND user_from = '" . $from . "') OR (user_to = '" . $from . "' AND user_from = '" . $to . "')", MYSQLI_ASSOC);
            while ($mail = mysqli_fetch_array($query)) {

                if ($mail['user_from'] == $from) {
                    echo '<li class="media">
                        <div class="media-left">
                            <a href="../../resources/assets/images/placeholder.jpg">
                                <img src="../../resources/assets/images/placeholder.jpg" class="img-circle img-md" alt="">
                            </a>
                        </div>

                        <div class="media-body">
                            <div class="media-content">' . $mail["message"] . '
                            </div>
                            <span class="media-annotation display-block mt-10"> - ' . $mail["time"] . ' </span>
                        </div>
                    </li>';

                } else if ($mail['user_from'] == $to) {
                    echo '<li class="media reversed">
                        <div class="media-body">
                            <div class="media-content">' . $mail["message"] . '
                            </div>
                            <span class="media-annotation display-block mt-10">Ви - ' . $mail["time"] . ' </span>
                        </div>

                        <div class="media-right">
                            <a href="../../resources/assets/images/placeholder.jpg">
                                <img src="../../resources/assets/images/placeholder.jpg" class="img-circle img-md" alt="">
                            </a>
                        </div>
                    </li>';

                } else {
                    echo "ERROR";
                }
            }
        } else {
            echo 'Виберіть чат';
        }
        break;
    case 'send_message':
        if (isset($_POST['to']) && isset($_POST['message']) && $_POST['message'] != "") {
            $from = $_POST['from'];
            $to = $_POST['to'];
            $message = htmlspecialchars($_POST['message']);
            $time = date('d.m.y H:i:s');
            mysqli_query($connection, "INSERT INTO messages (message, user_from, user_to, status, time) VALUES ('$message','$from','$to','1','$time')", MYSQLI_ASSOC);
        }
        break;
    case 'search_user':
        $search_query = $_POST['query'];
        if ($search_query != "") {
            $query = mysqli_query($connection, "(SELECT id,full_name,status FROM teachers WHERE full_name LIKE '%".$search_query."%') UNION (SELECT id,full_name,status FROM students WHERE full_name LIKE '%".$search_query."%')", MYSQLI_ASSOC);
            while ($chat = mysqli_fetch_array($query)) {
                echo '<li class="media">
                        <a href="#" onclick="chat(\'' . $chat['id'] . '@' . $chat['status'] . '\')" class="media-link">
                            <div class="media-left"><img src="../resources/assets/images/placeholder.jpg"
                                                         class="img-circle img-md" alt=""></div>
                            <div class="media-body">
                                <span class="media-heading text-semibold">' . $chat['full_name'] . '</span>
                                <span class="text-size-small text-muted display-block">';
                switch ($chat['status']) {
                    case 'student':
                        echo 'Студент';
                        break;
                    case 'teacher':
                        echo 'Викладач';
                        break;
                    case 'it_professional':
                        echo 'IT-Професіонал';
                        break;
                    case 'super_administrator':
                        echo 'Адміністратор';
                        break;
                }
                echo '</span>
                            </div>
                            <div class="media-right media-middle">
                                <span class="status-mark bg-success"></span>
                            </div>
                        </a>
                    </li>';
            }
        }
        break;
}