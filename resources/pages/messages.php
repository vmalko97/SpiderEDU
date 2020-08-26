<script type="text/javascript">
    var currentchat = "";
    function chat(data) {
        window.currentchat = data;
        var ajax_function = "get_companion_name";
        $.ajax({
            url: '../resources/system/ajax_functions.php',
            type: "POST",
            data: {
                ajax_function: ajax_function,
                current_chat: currentchat
            },
            success: function (companion) {
                $('span[id=currentchat]').html(companion);
            }
        });

    }
    function refresh_messages() {
        var chat_function = "refresh_chat";
        var from = currentchat;
        var to = "<?php echo $_SESSION['uid'] . '@' . $_SESSION['status'];?>";
        $.ajax({
            url: '../resources/system/ajax_chat.php',
            type: "POST",
            data: {
                chat_function: chat_function,
                from: from,
                to: to
            },
            success: function (data) {
                $('#chat').html(data);
            }
        });
    }

    $(function () {
        $('#send').click(function () {
            var chat_function = "send_message";
            var to = currentchat;
            var from = "<?php echo $_SESSION['uid'] . '@' . $_SESSION['status'];?>";
            var message = $("textarea[id=message]").val();
            $.ajax({
                url: '../resources/system/ajax_chat.php',
                type: "POST",
                data: {
                    chat_function: chat_function,
                    from: from,
                    to: to,
                    message: message
                },
                success: function () {
                    setTimeout('$("textarea[id=message]").val("")', 1000);
                }
            });
        });
    });
    function search_user() {
        var chat_function = "search_user";
        var query = $('input[id=search]').val();
        $.ajax({
            url: '../resources/system/ajax_chat.php',
            type: "POST",
            data: {
                chat_function: chat_function,
                query: query
            },
            success: function (data) {
                $('#search_result').html(data);
            }
        });
    }
</script>
<div class="row">
    <div class="col-sm-9">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Повідомлення  <span id="currentchat"></span> <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                </h6>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <ul class="media-list chat-list content-group" id="chat">
                    Чат...
                    <script type="text/javascript">setInterval(refresh_messages, 1000)</script>
                </ul>

                <textarea name="enter-message" id="message" class="form-control content-group" rows="3" cols="1"
                          placeholder="Введіть повідомлення..."></textarea>

                <div class="row">
                    <div class="col-xs-6">
                    </div>

                    <div class="col-xs-6 text-right">
                        <button type="button" id="send" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i
                                        class="icon-circle-right2"></i></b>Надіслати
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="sidebar-secondary sidebar-default">
            <div class="sidebar-content">

                <div class="sidebar-category">
                    <div class="category-title">
                        <span>Пошук користувача</span>
                        <ul class="icons-list">
                            <li><a href="#" data-action="collapse"></a></li>
                        </ul>
                    </div>

                    <div class="category-content">
                        <form action="#">
                            <div class="has-feedback has-feedback-left">
                                <input type="search" onkeyup="search_user();" id="search" class="form-control" placeholder="Пошук користувача">
                                <div class="form-control-feedback">
                                    <i class="icon-search4 text-size-base text-muted"></i>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <ul class="media-list media-list-linked" id="search_result">

                </ul>
                <div class="sidebar-category">
                    <div class="category-title">
                        <span>Чати</span>
                        <ul class="icons-list">
                            <li><a href="#" data-action="collapse"></a></li>
                        </ul>
                    </div>

                    <div class="category-content no-padding">
                        <ul class="media-list media-list-linked">
                            <?php
                            $all_chats = getAllChats($_SESSION['uid'] . '@' . $_SESSION['status']);
                            while ($chats = mysqli_fetch_array($all_chats)) {
                                $status = explode('@', $chats['user_from']);
                                ?>
                                <li class="media">
                                    <a href="#" onclick="chat('<?php echo $chats['user_from']; ?>')" class="media-link">
                                        <div class="media-left"><img src="../assets/images/placeholder.jpg"
                                                                     class="img-circle img-md" alt=""></div>
                                        <div class="media-body">
                                            <span class="media-heading text-semibold"><?php
                                                if($status[1] == "super_administrator"){
                                                    echo "<span class='text-danger'>Адміністратор</span>";
                                                }else {
                                                    echo $chats['full_name'];
                                                }
                                                ?></span>
                                            <span class="text-size-small text-muted display-block"><?php
                                                switch ($status[1]) {
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
                                                ?></span>
                                        </div>
                                        <div class="media-right media-middle">
                                            <span class="status-mark bg-success"></span>
                                        </div>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>