<?php
/** Загрузчик внешних скриптов (External Scripts Loader) */
Class Esl
{
    static function LoadBaseCss()
    {
        echo '<link rel="stylesheet" href="static/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">';
        echo '<link rel="stylesheet" href="static/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">';
		echo '<link rel="stylesheet" href="static/AdminLTE/dist/css/AdminLTE.min.css">';
		echo '<link rel="stylesheet" href="static/AdminLTE/dist/css/skins/skin-green.min.css">';
		echo '<link rel="stylesheet" href="static/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">';
		echo '<link rel="stylesheet" href="static/AdminLTE/bower_components/select2/dist/css/select2.min.css">';
		echo '<link rel="stylesheet" href="static/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">';
		echo '<link rel="stylesheet" href="static/AdminLTE/dist/css/skins/_all-skins.min.css">';
        echo '<link rel="stylesheet" href="static/AdminLTE/plugins/iCheck/square/blue.css">';
        /** Свои стили */
        echo '<link rel="stylesheet" href="static/css/mycss.css">';
    }

    static function LoadBaseJS()
    {
        echo '<script src="static/AdminLTE/bower_components/jquery/dist/jquery.js"></script>';
		echo '<script src="static/AdminLTE/bower_components/jquery-ui/jquery-ui.min.js"></script>';
		echo '<script src="static/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>';
		echo '<script src="static/AdminLTE/dist/js/adminlte.min.js"></script>';
		echo '<script src="static/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>';
		echo '<script src="static/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>';
		echo '<script src="static/AdminLTE/bower_components/select2/dist/js/select2.full.min.js"></script>';
		echo '<script src="static/AdminLTE/plugins/iCheck/icheck.min.js"></script>';
        echo '<script src="static/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>';
        echo '<script src="static/AdminLTE/bower_components/ckeditor/ckeditor.js"></script>';
        /** Свои скрипты */
        echo '<script src="static/Scripts/dt.js"></script>';
    }
}
?>