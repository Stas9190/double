<!-- Личный кабинет -->
<section class="invoice">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-user"></i> Личный кабинет
      </h2>
    </div>
    <!-- /.col -->
  </div>

  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12 table-responsive">
      <h3>Номера зачеток:</h3>
      <!-- Уже существующие номера зачеток -->
      <table class="table table-bordered table-hover" id="numbers_table">
        <thead>
          <tr>
            <th>#</th>
            <th>Номер</th>
            <th>Действие</th>
          </tr>
        </thead>
        <tbody>
          <?php for ($i = 0; $i < count($context['numbers']['data']); $i++) : ?>
            <tr>
              <td><?= $i + 1 ?></td>
              <td><?= $context['numbers']['data'][$i]['number'] ?></td>
              <td class="text-center">
                <div class="btn-group btn-group-xs">
                  <a href="?act=del_book_number&id=<?= $context['numbers']["data"][$i]["id"] ?>&name=<?= $context['numbers']["data"][$i]["number"] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </div>
              </td>
            </tr>
          <?php endfor; ?>
        </tbody>
      </table>
    </div>
    <div class="col-xs-12">
      <!-- Добавление номеров зачеток -->
      <div class="form-group">
        <label for="check_books_numbers">Добавить номера зачеток (через ;)</label>
        <textarea name="check_books_numbers" id="check_books_numbers" cols="30" rows="10" class="form-control"></textarea>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary" id="add_number">Добавить</button>
      </div>
    </div>
    <div class="col-xs-12">
      <h3>Студенты:</h3>
      <div class="box-body">
        <!-- Просматриваем студентов -->
        <table id="students_table" class="table table-striped table-bordered" style="width: 100%;">
          <thead>
            <tr>
              <th>#</th>
              <th>ФИО</th>
              <th>Логин</th>
              <th>Группа</th>
              <th>Дата регистрации</th>
              <th>Статус</th>
              <th>Действие</th>
            </tr>
          </thead>
          <tbody>
            <?php for ($i = 0; $i < count($context['students']['data']); $i++) : ?>
              <tr>
                <td><?= $i + 1 ?></td>
                <td><?= $context['students']['data'][$i]['fio'] ?></td>
                <td><?= $context['students']['data'][$i]['login'] ?></td>
                <td><?= $context['students']['data'][$i]['student_group'] ?></td>
                <td><?= $context['students']['data'][$i]['date_reg'] ?></td>
                <td><?php $s = $context['students']['data'][$i]['status'] == 1 ? "вкл" : "выкл";
                    echo $s; ?></td>
                <td class="text-center">
                  <div class="btn-group btn-group-xs">
                    <a href="?act=edit_student&id=<?= $context['students']["data"][$i]["id"] ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                    <a href="?act=del_user&id=<?= $context['students']["data"][$i]["id"] ?>&name=<?= $context['students']["data"][$i]["fio"] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                  </div>
                </td>
              </tr>
            <?php endfor; ?>
          </tbody>
          <tfoot>
            <th>#</th>
            <th>ФИО</th>
            <th>Логин</th>
            <th>Группа</th>
            <th>Дата регистрации</th>
            <th>Статус</th>
            <th>Действие</th>
          </tfoot>
        </table>
      </div>
    </div>
    <div class="col-xs-12 table-responsive">
      <h3>Результаты:</h3>
      <!-- Просматриваем студентов -->
      <table class="table table-bordered table-hover" id="results_table1">
        <thead>
          <tr>
            <th>#</th>
            <th>ФИО</th>
            <th>Действие</th>
          </tr>
        </thead>
        <tbody>
          <?php for ($i = 0; $i < count($context['students']['data']); $i++) : ?>
            <tr>
              <td><?= $i + 1 ?></td>
              <td><?= $context['students']['data'][$i]['fio'] ?></td>
              <td class="text-center">
                <a href="?act=browse_results&id=<?= $context['students']['data'][$i]['id'] ?>">Смотреть результаты</a>
              </td>
            </tr>
          <?php endfor; ?>
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>