<?php
$id = filter_input(INPUT_GET, 'event_id');
$event_name = getEventNameById($id);
?>
<div class="col-md-6">
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title">Успішність</h6>
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
                        <div class="alert alert-primary">
                            <span class="text text-black">Подія: </span><span
                                    class="text text-primary"><b><?php echo $event_name; ?></b></span>
                        </div>
                        <table class="table table-bordered">
                            <thead class="bg-grey-800">
                            <tr>
                                <th width="70%">Тема заняття</th>
                                <th width="70%">Дата</th>
                                <th width="30%">Відмітка</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = getStudentEventDigitalJournal($_SESSION['uid'], $id);
                            while ($digital_journal = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td align="center"><?php echo $digital_journal['theme']?></td>
                                    <td align="center"><?php echo $digital_journal['date']?></td>
                                    <td align="center"><?php echo $digital_journal['mark']?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>