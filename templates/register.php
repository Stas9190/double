<!-- регистрация -->
<div class="register-box">
  <div class="register-logo">
    <a href="?act=base">Система тестирования</a>
  </div>
  <div class="register-box-body">
    <p class="login-box-msg">Регистрация</p>

    <form action="" method="post" role="form" id="register_form">

      <!-- Оповещения системы -->
      <div class="alert alert-danger skleit_alert hidden" id="pass-danger">
        <p>Пароли не совпадают!</p>
      </div>
      <div class="alert alert-danger skleit_alert hidden" id="login-danger">
        <p>Пользователь с таким логином уже существует!</p>
      </div>
      <div class="alert alert-danger skleit_alert hidden" id="number-danger">
        <p>Такого номера зачетной книжки нет в базе!</p>
      </div>

      <div class="form-group has-feedback" id="gradebook_info">
        <input type="text" class="form-control" placeholder="Логин(№ зачетной книжки)" name="login">
        <span class="glyphicon glyphicon-book form-control-feedback"></span>
      </div>
      
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="ФИО" name="fio">
        <span class="glyphicon glyphicon-book form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Группа" name="group">
        <span class="glyphicon glyphicon-book form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback" id="pass">
        <input type="password" class="form-control" placeholder="Пароль" name="pass" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback" id="re_pass">
        <input type="password" class="form-control" placeholder="Повторить пароль" name="re_pass" required>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-5">
          <button type="submit" id="do_reg" class="btn btn-primary btn-block btn-flat">Регистрация</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="?act=login" class="text-center">У меня уже есть учетная запись</a>
  </div>
  <!-- /.form-box -->
</div>