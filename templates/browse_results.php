<!-- Справочник пользователей -->
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Результаты</h3>
            </div>
            <div class="box-body">
                <table id="results_table2" class="table table-bordered table-hover" style="width: 100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ФИО</th>
                            <th>Раздел</th>
                            <th>Результат</th>
                            <th>Отметка</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($context["data"]); $i++) : ?>
                            <tr class="table-data">
                                <td><?= $i + 1 ?></td>
                                <td><?= $context["data"][$i]["fio"] ?></td>
                                <td><?= $context["data"][$i]["name"] ?></td>
                                <td><?= $context["data"][$i]["result"] ?></td>
                                <td align="center">
                                    <?php if ($context["data"][$i]["result"] >= 0) : ?>
                                        <span class="btn btn-success" style="border-radius: 20px;"><i class="fa fa-check"></i></span>
                                    <?php else : ?>
                                        <span class="btn btn-danger" style="border-radius: 20px;"><i class="fa fa-times"></i></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
            <a class="btn btn-md btn-default btn_in_bottom" href="?act=lk" role="button" style="margin: 12px;">
                <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Назад</a>
        </div>
    </div>
</div>