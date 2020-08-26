<script type="text/javascript">
        function auditory_delete(id) {
            var ajax_function = "delete_auditory";
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
                            text: "Аудиторію не видалено з системи",
                            type: "error",
                        });
                    } else if (data == "OK") {
                        swal({
                            title: "Успіх",
                            text: "Аудиторію успішно видалено з системи",
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
    <div class="col-md-6">

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Список аудиторій<a class="heading-elements-toggle"><i class="icon-more"></i></a>
                </h5>
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
                    <li class="media-header">Аудиторії</li>
                    <?php
                    $query = getAuditories();
                    while ($auditory = mysqli_fetch_array($query)) {
                    ?>
                    <li class="media">
                        <div class="media-body">
                            <div class="media-heading text-semibold"><?php echo $auditory['name']; ?></div>
                            <span class="text-muted">CIST ID: <?php echo $auditory['cist_id']; ?></span>
                        </div>

                        <div class="media-right media-middle">
                            <ul class="icons-list text-nowrap">
                                <li onclick="auditory_delete(<?php echo $auditory['id'];?>);" class="icon-cancel-circle2 text-danger"
                                    data-popup="tooltip" title="" data-placement="bottom"
                                    data-original-title="Видалити"></li>
                            </ul>
                        </div>
                        <?php
                        }
                        ?>
                </ul>
            </div>
        </div>
    </div>
</div>