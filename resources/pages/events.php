<script type="text/javascript">
    function signup(event_id, student_id) {
        var ajax_function = "sign_up_to_event";
        $.ajax({
            url: '../resources/system/ajax_functions.php',
            type: "POST",
            data: {
                ajax_function: ajax_function,
                event_id: event_id,
                student_id: student_id
            },
            success: function (data) {
                if (data == "ERROR") {
                    swal({
                        title: "Помилка",
                        text: "Ви не не записалися на подію, спробуйте ще раз",
                        type: "error",
                    });
                } else if (data == "OK") {
                    swal({
                        title: "Успіх",
                        text: "Ви успішно записалися на подію, очікуйте підтверждення від викладача",
                        type: "success",
                    });
                }else if (data == "RECORDED"){
                    swal({
                        title: "Помилка",
                        text: "Ви уже записались на цю подію.",
                        type: "error",
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
    <ul class="media-list content-group">
        <?php
        $query = getModeratedEvents();
        while ($event = mysqli_fetch_array($query)) {
            ?>
            <li class="media panel panel-body stack-media-on-mobile">
                <div class="media-left">
                    <a href="#">
                        <img src="../../resources/assets/images/placeholder.jpg" class="img-rounded img-lg"
                             alt="">
                    </a>
                </div>

                <div class="media-body">
                    <h6 class="media-heading text-semibold">
                        <a href="#"><?php echo $event['event_name']; ?></a>
                    </h6>

                    <ul class="list-inline list-inline-separate text-muted mb-10">
                        <li><a href="#" class="text-muted"><?php if ($mod['owner'] != NULL) {
                                    echo $mod['owner'];
                                } else {
                                    echo "Адміністратор";
                                }; ?></a></li>
                    </ul>

                    <?php echo $event['description']; ?>
                </div>

                <div class="media-right text-nowrap">
                    <?php
                    if ($event['type'] == 'free') {
                        echo '<span class="label bg-green">Безкоштовно</span>';
                    } elseif ($event['type'] == 'pay') {
                        echo '<span class="label bg-blue">' . $event['price'] . ' UAH</span>';
                    }
                    ?>

                </div>
                <p align="right"><a href="#"
                                    onclick="signup(<?php echo $event['id'] ?>,<?php echo $_SESSION['uid'] ?>)"
                                    class="btn btn-sm btn-default">Записатися на подію</a></p>
            </li>
            <?php
        } ?>


    </ul>
</div>