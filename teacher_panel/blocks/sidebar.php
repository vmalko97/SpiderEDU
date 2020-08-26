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
                        <a href="?page=messages"><i class="icon-envelop"></i> <span>Повідомлення</span><span class="label label-success"><?php echo getNewMessagesCount($_SESSION['t_uid'].'@'.$_SESSION['t_status'])?></span></a>
                    </li>
                    <li>
                        <a href="#"><i class="icon-table2"></i> <span>Розклад</span></a>
                        <ul>
                            <li><a href="?page=timetable">Розклад занять</a></li>
                            <li><a href="?page=cist_synchronization">Синхронізація з CIST</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-book"></i> <span>Події</span></a>
                        <ul>
                            <li><a href="?page=create_event">Створити подію</a></li>
                            <li><a href="?page=my_events">Мої події</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
<!-- /main sidebar -->
