<aside class="main-sidebar" style="background-color: #ecf0f5;">
    <section class="sidebar">
        <!-- Меню сайдбара -->
        <ul class="sidebar-menu" data-widget="tree">
            <?php if (isset($_SESSION['sid']['login']) and ($_SESSION['sid']['role'] == 0 || $_SESSION['sid']['role'] == 2)) : ?>
                <!-- Меню для админа -->
                <li class="header">Администрирование</li>
                <?php if ($_SESSION['sid']['role'] == 0) : ?>
                    <!-- <li class="active"><a href="?act=edit_users"><i class="fa fa-users"></i> <span>Пользователи</span></a></li> -->
                <?php endif; ?>
                <!-- <li class="active"><a href="?act=edit_tasks"><i class="fa fa-circle"></i> <span>Задания</span></a></li>
                            <li class="active"><a href="?act=edit_razdel"><i class="fa fa-circle"></i> <span>Справочник разделов</span></a></li> -->
            <?php endif; ?>
        </ul>
    </section>
</aside>