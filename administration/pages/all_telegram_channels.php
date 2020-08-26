<div class="panel panel-white">
    <div class="panel-heading">
        <h6 class="panel-title">Всі Telegram канали/групи</h6>
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
                            <th width="30%">Статус</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $tg_mod_query = TelegramGetListAllGroupsAndChannels();
                        while ($telegram = mysqli_fetch_array($tg_mod_query)) {
                            ?>
                            <tr>
                                <td><b><?php echo $telegram['title'];?></b></td>
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
                                    <?php switch ($telegram['verified']){
                                        case 0:
                                            echo "<span class='label label-warning'>На модерації</span>";
                                            break;
                                        case 1:
                                            echo "<span class='label label-success'>Активно</span>";
                                            break;
                                        case  2:
                                            echo "<span class='label label-danger'>Відхилено</span>";
                                            break;
                                    }?>
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