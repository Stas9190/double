<?php
//Маршрутизация
//Подлючение базового файла шаблона и подгрузка основного контента
/*
	Пример:
	$act = isset($input['act']) ? $input['act'] : "";
	switch($act)
	{
		case "Some variable":
			SomeFunction();
			break;
		default:
			SomeFunction();
			break;
	}
 */
$act = isset($input['act']) ? $input['act'] : "";

switch ($act) {
	case "logout":
		logout();
		break;
	case "edit_users":
		admin_users();
		break;
	case "edit_user":
		edit_user();
		break;
	case "edit_student":
		edit_student();
		break;
	case "edit_razdel":
		edit_razdel();
		break;
	case "task_add":
		task_add();
		break;
	case "teacher_add":
		teacher_add();
		break;
	case "add_new_teacher":
		add_new_teacher();
		break;
	case "add_new_task":
		add_new_task();
		break;
	case "add_book_numbers":
		add_book_numbers();
		break;
	case "edit_tasks":
		edit_tasks();
		break;
	case "edit_razd":
		edit_razd();
		break;
	case "edit_task":
		edit_task();
		break;
	case "razdel_add":
		razdel_add();
		break;
	case "browse_results":
		browse_results();
		break;
	case "add_new_razdel":
		add_new_razdel();
		break;
	case "update_task":
		update_task();
		break;
	case "update_razdel":
		update_razdel();
		break;
	case "update_user":
		update_user();
		break;
	case "update_student":
		update_student();
		break;
	case "timeOut":
		timeOut();
		break;
	case "del_user":
		DeleteConfirmation();
		break;
	case "del_book_number":
		DeleteConfirmation();
		break;
	case "del_razdel":
		DeleteConfirmation();
		break;
	case "del_task":
		DeleteConfirmation();
		break;
	case "lk":
		lk();
		break;
	case "login":
		login();
		break;
	case "go_back":
		go_back();
		break;
		// регистрация
	case "register":
		register();
		break;
		// зарегаться
	case "do_reg":
		do_reg();
		break;
	case "do_login":
		do_login();
		break;
	case "start": //начать выполнение задачи
		start_task();
		break;
	case "check_task": //проверка выполнения
		check_task();
		break;
		// подтверждение удаления
	case "confirm_delete":
		Delete();
		break;
		//пингуем сервак
	case "ping":
		ping();
		break;
	case "main":
		loadStart();
		break;
	default:
		loadStart();
		break;
}
