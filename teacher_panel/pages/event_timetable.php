<?php
if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id');
    ?>
    <script type="text/javascript">
        function create_digital_journal() {
            var ajax_function = 'create_digital_journal';
            var id = "<?php echo $id; ?>";
            var date = $("input[name=date]").val();
            var theme = $("textarea[name=theme]").val();
            var period_number = $("input[name=period_number]").val();
            var auditory_id = $("select[name=auditory_id]").val();
            $.ajax({
                url: '../resources/system/ajax_functions.php',
                type: "POST",
                data: {
                    ajax_function: ajax_function,
                    id: id,
                    date: date,
                    period_number:period_number,
                    auditory_id:auditory_id,
                    teacher_id: <?php echo $_SESSION['t_uid'];?>,
                    theme: theme
                },
                success: function (data) {
                    alert(data);
                }
            });
        }

        function delete_digital_journal(date) {
            var ajax_function = 'delete_digital_journal';
            var id = "<?php echo $id; ?>";
            $.ajax({
                url: '../resources/system/ajax_functions.php',
                type: "POST",
                data: {
                    ajax_function: ajax_function,
                    id: id,
                    date: date
                },
                success: function (data) {
                    alert(data);
                }
            });
        }
    </script>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h6 class="panel-title">Розклад занять</h6>
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
                        <tr class="bg-grey-800">
                            <th width="50%">Тема</th>
                            <th width="20%">Дата</th>
                            <th width="30%">Дії</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $timetable_query = getEventDates($id);
                        while ($timetable = mysqli_fetch_array($timetable_query)) {
                            ?>
                            <tr>
                                <td>
                                    <a href="?page=marks&event_id=<?php echo $id; ?>&date=<?php echo $timetable['date']; ?>"><?php echo $timetable['theme']; ?>
                                </td>
                                <td><?php echo $timetable['date']; ?></td>
                                <td align="center">
                                    <button class="btn btn-danger"
                                            onclick="delete_digital_journal('<?php echo $timetable["date"]; ?>')">
                                        Видалити
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h6 class="panel-title">Управління розкладом</h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <button class="btn btn-block btn-primary" data-toggle="modal"
                            data-target="#add_lesson">Додати заняття
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div id="add_lesson" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Інформація про подію</h5>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-3">Дата заняття</label>
                            <div class="col-sm-9">
                                <input type="date" value="" name="date"
                                       class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Аудиторія</label>
                            <div class="col-sm-9">
                            <?php
                            $aud_query = getAuditories();
                            echo "<select class='form-control' name='auditory_id'>";
                            while ($auditory = mysqli_fetch_array($aud_query)) {
                            echo "<option value='".$auditory['id']."'>".$auditory['name']."</option>";
                            }
                            echo "</select>"
                            ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Пара</label>
                            <div class="col-sm-9">
                                <input type="text" value="" name="period_number"
                                       class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Тема заняття</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="theme"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Закрити</button>
                    <button type="button" class="btn btn-success" onclick="create_digital_journal()">Додати</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>