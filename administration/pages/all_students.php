<script type="text/javascript">
    function student_delete(id) {
        var ajax_function = "delete_student";
        $.ajax({
            url: '../resources/system/ajax_functions.php',
            type: "POST",
            data: {
                ajax_function: ajax_function,
                id: id
            },
            success: function (data) {
                if (data == "ERROR") {
                    swal({
                        title: "Помилка",
                        text: "Студента не видалено з системи",
                        type: "error",
                    });
                } else if (data == "OK") {
                    swal({
                        title: "Успіх",
                        text: "Студента успішно видалено з системи",
                        type: "success",
                    });
                } else {
                    swal({
                        title: "Hacking attempt!",
                        type: "error",
                    });
                }
            }
        });
    }
</script>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Студенти<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <ul class="media-list">
                    <li class="media-header">Студенти</li>
                    <?php
                    $students_query = getStudents();

                    while ($students = mysqli_fetch_array($students_query)){
                    ?>
                    <li class="media">
                        <div class="media-left media-middle">
                            <a href="#">
                                <img src="../../resources/assets/images/placeholder.jpg" class="img-circle img-md"
                                     alt="">
                            </a>
                        </div>

                        <div class="media-body">
                            <div class="media-heading text-semibold"><?php echo $students['full_name']; ?></div>
                            <span class="text-muted"><?php echo $students['study_place']; ?></span>
                        </div>

                        <div class="media-right media-middle">
                            <ul class="icons-list text-nowrap">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                                class="icon-menu9"></i></a>

                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="?page=messages&chat=<?php echo $students['id'].'@'.$students['status']; ?>"><i
                                                        class="icon-comment"></i> Розпочати чат</a></li>
                                        <li>
                                            <a href="?page=edit_student&id=<?php echo $students['id']; ?>"><i
                                                        class="icon-pencil3"></i> Редагувати</a></li>
                                        <li>
                                            <a onclick="student_delete(<?php echo $students['id']; ?>)"><i
                                                        class="icon-cancel-circle2"></i> Видалити</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <?php } ?>

                </ul>
            </div>
        </div>


    </div>


</div>