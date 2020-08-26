<div class="panel panel-white">
    <div class="panel-heading">
        <h6 class="panel-title">Мої події</h6>
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
                        <thead class="bg-grey-800">
                        <tr>
                            <th width="70%">Подія</th>
                            <th width="30%">Елекронний журнал</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = getStudentAcceptedEvents($_SESSION['uid']);
                        while ($event = mysqli_fetch_array($query)){ ?>
                        <tr>
                            <td align="center"><?php echo $event['event_name']; ?></td>
                            <td><a href="?page=digital_journal&event_id=<?php echo $event['event_id']; ?>" class="btn btn-block btn-primary">Електронний журнал</a></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </fieldset>
    </div>
</div>
