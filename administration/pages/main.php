<script type="text/javascript">
    function edit_notes() {
        var ajax_function = "edit_notes";
        var notes = $("textarea[name=notes]").val()
        $.ajax({
            url: '../resources/system/ajax_functions.php',
            type: "POST",
            data: {
                ajax_function: ajax_function,
                notes: notes
            }
        });
    }
</script>

<div class="alert alert-success" role="alert">
    <h5>Ласкаво просимо до панелі управління</h5>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Загальльна інформація<a class="heading-elements-toggle"><i
                                class="icon-more"></i></a></h6>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <div class="tabbable">
                    <ul class="nav nav-tabs nav-tabs-highlight">
                        <li class="active"><a href="#label-tab1" data-toggle="tab" aria-expanded="true">Основна
                                інформація</a></li>
                        <li class=""><a href="#label-tab2" data-toggle="tab" aria-expanded="false">Нотатки</span></a>
                        </li>
                        <li class=""><a href="#label-tab3" data-toggle="tab" aria-expanded="false">Системна
                                інформація</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="label-tab1">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <td>Дата останнього оновлення розкладу</td>
                                    <td><?php echo getCistTimetableUpdateTime(); ?></td>
                                </tr>
                                <tr>
                                    <td>Кількість зареєстрованих викладачів</td>
                                    <td><?php echo getTeachersCount(); ?></td>
                                </tr>
                                <tr>
                                    <td>Кількість зареєстрованих IT-професіоналів</td>
                                    <td><?php echo getITProfessionalCount(); ?></td>
                                </tr>
                                <tr>
                                    <td>Кількість зареєстрованих студентів</td>
                                    <td><?php echo getStudentsCount(); ?></td>
                                </tr>
                            </table>
                        </div>

                        <div class="tab-pane" id="label-tab2">
                            <textarea maxlength="500" rows="5" cols="5" name="notes" onkeyup="edit_notes()" class="form-control" placeholder="Нотатки"><?php echo getNotes(); ?></textarea>
                        </div>

                        <div class="tab-pane" id="label-tab3">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <td>Назва додатку</td>
                                    <td><?php echo getAppName(); ?></td>
                                </tr>
                                <tr>
                                    <td>Версія PHP</td>
                                    <td><?php echo phpversion(); ?></td>
                                </tr>
                                <tr>
                                    <td>Операційна система</td>
                                    <td><?php echo php_uname(); ?></td>
                                </tr>
                                <tr>
                                    <td>Вільне місце</td>
                                    <td><?php
                                        $bytes = disk_free_space(".");
                                        $bytes_1 = disk_total_space(".");
                                        $si_prefix = array('B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB');
                                        $base = 1024;
                                        $class = min((int)log($bytes, $base), count($si_prefix) - 1);
                                        $class_1 = min((int)log($bytes_1, $base), count($si_prefix) - 1);
                                        echo sprintf('%1.2f', $bytes / pow($base, $class)) . ' ' . $si_prefix[$class] . '&nbsp;із&nbsp;'.sprintf('%1.2f', $bytes_1 / pow($base, $class_1)) . ' ' . $si_prefix[$class_1]; ?>
                                    </td>

                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>