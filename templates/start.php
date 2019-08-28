<!-- Справочник пользователей -->
<?php print_r($context['log']); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Система тестирования</h3>
            </div>
            <div class="box-body">                
                <table id="tasks_table" class="table table-bordered table-hover" style="width: 100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Раздел</th>
                            <th>Оценка</th>
                            <th class="text-center">Действие</th>
                            <th class="text-center">Отметка</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($context["data"]); $i++) : ?>
                            <tr class="table-data">
                                <td><?= $i + 1 ?></td>
                                <td><?= $context["data"][$i]["name"] ?></td>
                                <td><?= $context["data"][$i]["result"] ?></td>
                                <td class="text-center">
                                    <?php if (isset($context['save_razdel'])) : ?>
                                        <?php if ($context['save_razdel'] == $context['data'][$i]['id']) : ?>
                                            <div class="btn-group btn-group-xs">
                                                <a href="?act=start&id=<?= $context["data"][$i]["id"] ?>">
                                                    Начать выполнение
                                                </a>
                                            </div>
                                        <?php else : ?>
                                            <p style="color: lightgrey;">Недоступно</p>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <div class="btn-group btn-group-xs">
                                            <a href="?act=start&id=<?= $context["data"][$i]["id"] ?>">
                                                Начать выполнение
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </td>
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
        </div>
    </div>
</div>