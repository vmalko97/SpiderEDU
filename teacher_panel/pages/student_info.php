<?php
if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id');
    $query = getStudentDataById($id);
    ?>
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title">Інформація про студента</h6>
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
                        <?php while ($student = mysqli_fetch_array($query)){?>
                        <div class="form-group">
                            <label class="control-label">ПІБ студента</label>
                            <input type="text" name="full_name" class="form-control" value="<?php echo $student['full_name']?>"
                                   placeholder="ПІБ студента" disabled/>
                            <label class="control-label">Місце навчання</label>
                            <input type="text" name="study_place" class="form-control" value="<?php echo $student['study_place']?>"
                                   placeholder="Місце навчання" disabled/>
                            <label class="control-label">Місце роботи</label>
                            <input type="text" name="working_place" class="form-control" value="<?php echo htmlspecialchars($student['working_place'])?>"
                                   placeholder="Місце роботи" disabled/>
                            <label class="control-label">Телефон в міжнародному форматі (без "+")</label>
                            <input type="text" name="telephone" class="form-control" value="<?php echo $student['telephone']?>"
                                   placeholder="Телефон" disabled/>
                            <label class="control-label">E-Mail</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $student['email']?>"
                                   placeholder="E-Mail" disabled/>
                            <label class="control-label">Skype</label>
                            <input type="text" name="skype" class="form-control" value="<?php echo $student['skype']?>"
                                   placeholder="Skype" disabled/>
                            <label class="control-label">Telegram</label>
                            <input type="text" name="telegram" class="form-control" value="<?php echo $student['telegram']?>"
                                   placeholder="Telegram" disabled/>
                            <label class="control-label">Адреса</label>
                            <input type="text" name="address" class="form-control" value="<?php echo $student['address']?>"
                                   placeholder="Адреса" disabled/>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
<?php } ?>