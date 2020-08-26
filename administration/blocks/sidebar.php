<!-- Main sidebar -->
<div class="sidebar sidebar-main">
    <div class="sidebar-content">

        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <li class="navigation-header"><span>Меню</span> <i class="icon-menu" title="Main pages"></i></li>
                    <li><a href="?page=main"><i class="icon-home4"></i> <span>Головна</span></a></li>
                    <li>
                        <a href="#"><i class="icon-users"></i> <span>Викладачі/IT-професіонали</span></a>
                        <ul>
                            <li><a href="?page=add_teacher">Додати викладача</a></li>
                            <li><a href="?page=add_it_professional">Додати IT-Професіонала</a></li>
                            <li><a href="?page=all_teachers">Всі викладачі/IT-Професіонали</a></li>
                        </ul>
                    </li>
                      <li>
                        <a href="#"><i class="icon-users4"></i> <span>Студенти</span></a>
                        <ul>
                            <li><a href="?page=add_student">Додати студента</a></li>
                            <li><a href="?page=all_students">Всі студенти</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="?page=messages"><i class="icon-envelop"></i> <span>Повідомлення</span><span class="label label-success"><?php echo getNewMessagesCount('1@super_administrator')?></span></a>
                    </li>
                    <li>
                        <a href="#"><i class="icon-table2"></i> <span>Розклад</span></a>
                        <ul>
                            <li><a href="?page=timetable">Розклад занять</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-sigma"></i> <span>Аудиторії</span></a>
                        <ul>
                            <li><a href="?page=add_auditory">Додати аудиторію</a></li>
                            <li><a href="?page=auditories">Список аудиторій</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-book"></i> <span>Події</span></a>
                        <ul>
                            <li><a href="?page=add_event">Додати подію</a></li>
                            <li><a href="?page=events_moderation">Модерація подій<span class="label label-warning"><?php echo getUnmoderatedEventsCount();?></span></a></li>
                            <li><a href="?page=my_events">Мої події</a></li>
                            <li><a href="?page=all_events">Список усіх подій</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-wordpress"></i> <span>Налаштування WP блогу</span></a>
                        <ul>
                            <li><a href="?page=edit_wp_config">Налаштування конфігурації</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-paperplane"></i> <span>Управління Тelegram</span></a>
                        <ul>
                            <li><a href="?page=all_telegram_channels">Всі групи/канали</a></li>
                            <li><a href="?page=telegram_moderation">Модерація груп/каналів</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-cogs"></i> <span>Налаштування</span></a>
                        <ul>
                            <li><a href="?page=edit_config">Конфігурація</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
<!-- /main sidebar -->
