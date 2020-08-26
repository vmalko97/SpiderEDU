<div class="row">
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title">Список подій</h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                <tr class="bg bg-grey-800">
                    <th width="10%">ID</th>
                    <th width="25%">Назва</th>
                    <th width="35%">Опис</th>
                    <th width="10%">Статус</th>
                </tr>
                </thead>
                <?php
                $events_query = getTeachersEvents($_SESSION['t_uid']);

                while ($events = mysqli_fetch_array($events_query)) {
                    ?>
                    <tr>
                        <td align="center"><?php echo $events['id']; ?></td>
                        <td align="center"><?php echo $events['event_name']; ?>
                            <hr/>
                            <div class="btn-group btn-group-justified">
                                <div class="btn-group">
                                    <a href="?page=event_moderation&id=<?php echo $events['id'];?>" class="btn btn-xs bg-slate-700">Модерація</a>
                                </div>

                                <div class="btn-group">
                                    <a href="?page=event_timetable&id=<?php echo $events['id'];?>" class="btn btn-xs bg-slate-700">Розклад</a>
                                </div>
                            </div>
                            <hr/>
                            <div class="btn-group btn-group-justified">
                                <div class="btn-group">
                                    <a href="?page=digital_journal&event_id=<?php echo $events['id'];?>" class="btn btn-xs btn-primary">Електронний журнал</a>
                                </div>
                            </div>
                        </td>
                        <td><?php echo $events['description']; ?></td>
                        <td align="center"><?php
                            switch ($events['status']) {
                                case 'moderated':
                                    echo "<span class='label label-success'>Активна</span>";
                                    break;
                                case 'unmoderated':
                                    echo "<span class='label label-warning'>На модераціїї</span>";
                                    break;
                                case 'canceled':
                                    echo "<span class='label label-danger'>Відхилена</span>";
                                    break;
                            }
                            ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>