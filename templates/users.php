<!-- Справочник пользователей -->
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Пользователи</h3>
            </div>
            <div class="box-body">
                <table id="users_table" class="table table-bordered table-hover" style="width: 100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ФИО</th>
                            <th>Логин</th>
                            <th>Роль</th>
                            <th>Статус</th>
                            <th class="text-center">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($context["data"]); $i++) : ?>
                            <tr class="table-data">
                                <td><?= $i + 1 ?></td>
                                <td><?= $context["data"][$i]["fio"] ?></td>
                                <td><?= $context["data"][$i]["login"] ?></td>
                                <td><?php
                                    switch ($context["data"][$i]["role"]) {
                                        case "1":
                                            echo "Студент";
                                            break;
                                        case "2":
                                            echo "Преподаватель";
                                            break;
                                    }
                                    ?></td>
                                <td><?php $s = $context['data'][$i]['status'] == 1 ? "вкл" : "выкл";
                                    echo $s; ?></td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-xs">
                                        <a href="?act=edit_user&id=<?= $context["data"][$i]["id"] ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="?act=del_user&id=<?= $context["data"][$i]["id"] ?>&name=<?= $context["data"][$i]["fio"] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>

            <a class="btn btn-md btn-primary btn_in_bottom" href="?act=teacher_add" role="button" style="margin: 12px;">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить преподавателя</a>

        </div>
    </div>
</div>