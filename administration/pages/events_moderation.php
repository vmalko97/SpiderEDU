<script type="text/javascript">
    function accept_event(id) {
        var ajax_function = 'accept_event';
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
    function cancel_event(id) {
        var ajax_function = 'cancel_event';
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
</script>
<div class="row">
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title">Модерація подій</h6>
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
                <table class="table table-bordered">
                    <thead>
                    <tr class="bg bg-grey-800">
                        <th>Назва</th>
                        <th>Опис</th>
                        <th>Організатор</th>
                        <th>Дії</th>
                    </tr>
                    <?php
                    $mod_query = getUnmoderatedEvents();
                    while ($mod = mysqli_fetch_array($mod_query)) {
                        ?>
                        <tr>
                            <td><?php echo $mod['event_name']; ?></td>
                            <td><?php echo $mod['description']; ?></td>
                            <td><?php
                                if ($mod['owner'] != NULL) {
                                    echo $mod['owner'];
                                } else {
                                    echo "Адміністратор";
                                }
                                ?></td>
                            <td>
                                <a class="btn btn-info" data-toggle="modal"
                                   data-target="#moderate<?php echo $mod['id']; ?>"><span
                                            class="icon icon-info22"></span></a>
                            </td>
                        </tr>
                        <div id="moderate<?php echo $mod['id']; ?>" class="modal fade">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h5 class="modal-title">Інформація про подію</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-horizontal">
                                            <div class="form-group">
                                                <label class="control-label col-sm-3">ID події</label>
                                                <div class="col-sm-9">
                                                    <input type="text" value="<?php echo $mod['id']; ?>"
                                                           class="form-control" disabled/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3">Назва події</label>
                                                <div class="col-sm-9">
                                                    <input type="text" value="<?php echo $mod['event_name']; ?>"
                                                           class="form-control" disabled/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3">Опис</label>
                                                <div class="col-sm-9">
                                                    <textarea rows="5" cols="5" class="form-control"
                                                              disabled><?php echo $mod['description']; ?> </textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3">Тип</label>
                                                <div class="col-sm-9">
                                                    <input type="text" value="<?php  if ($mod['type'] == 'free') {
                                                        echo 'Безкоштовна';
                                                    } elseif($mod['type'] == 'pay') {
                                                        echo "Платна";
                                                    } ?>"
                                                           class="form-control" disabled/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3">Ціна</label>
                                                <div class="col-sm-9">
                                                    <input type="text" value="<?php echo $mod['price']; ?>"
                                                           class="form-control" disabled/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3">Організатор</label>
                                                <div class="col-sm-9">
                                                    <input type="text" value="<?php if ($mod['owner'] != NULL) {
                                                        echo $mod['owner'];
                                                    } else {
                                                        echo "Адміністратор";
                                                    }; ?>" class="form-control" disabled/>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-link" data-dismiss="modal">Закрити</button>
                                        <button type="button" class="btn btn-danger" onclick="cancel_event(<?php echo $mod['id']; ?>)">Відхилити</button>
                                        <button type="button" class="btn btn-success" onclick="accept_event(<?php echo $mod['id']; ?>)">Опублікувати</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </thead>
                </table>
            </fieldset>
        </div>
    </div>