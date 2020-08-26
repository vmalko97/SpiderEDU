<script type="text/javascript">
    function telegram_accept(id) {
        var ajax_function = 'telegram_accept';
        $.ajax({
            url: '../resources/system/ajax_functions.php',
            type: "POST",
            data: {
                ajax_function: ajax_function,
                id: id
            },
            success: function (data) {
                location.reload();
            }
        });
    }
    function telegram_cancel(id) {
        var ajax_function = 'telegram_cancel';
        $.ajax({
            url: '../resources/system/ajax_functions.php',
            type: "POST",
            data: {
                ajax_function: ajax_function,
                id: id
            },
            success: function (data) {
                alert(data);
                location.reload();
            }
        });
    }
</script>
<div class="panel panel-white">
    <div class="panel-heading">
        <h6 class="panel-title">Модерація груп/каналів Telegram</h6>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <fieldset class="content-group">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr class="bg bg-grey-800">
                            <th>Назва</th>
                            <th>ID чату</th>
                            <th>Тип</th>
                            <th width="30%">Дії</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $tg_mod_query = TelegramGetUnmoderatedGroupAndChannels();
                        while ($telegram = mysqli_fetch_array($tg_mod_query)) {
                            ?>
                            <tr>
                                <td><?php echo $telegram['title'];?></td>
                                <td><?php echo $telegram['chat_id'];?></td>
                                <td><?php switch ($telegram['type']){
                                        case 'channel':
                                            echo "Канал";
                                            break;
                                        case 'group':
                                            echo "Група";
                                            break;
                                        case  'supergroup':
                                            echo "Супергрупа";
                                            break;
                                    }?></td>
                                <td align="center">
                                    <button class="btn btn-success" onclick="telegram_accept(<?php echo $telegram['id']?>)">Прийняти</button>
                                    <button class="btn btn-danger" onclick="telegram_cancel(<?php echo $telegram['id']?>)">Відхилити</button>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </fieldset>
    </div>
</div>