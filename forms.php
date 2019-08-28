<?php

/** Модели сущностей */

/** Базовое объявление текстового поля */
// class ClassName
// {
// var $form_presentation = [
// "some_field" => ["type"=>"text", "label_text" => "label_text"]
// ];
// }

class User
{
    var $form_presentation = [
        "fio" => ["type" => "text", "label_text" => "ФИО", "id" => "fio"],
        "login" => ["type" => "text", "label_text" => "Логин", "id" => "login"],
        "role" => ["type" => "select_assoc", "label_text" => "Роль", "id" => "role", "class" => "form-control select", "data" => [
            1 => "Студент",
            2 => "Преподаватель"
        ]],
        "status" => ["type" => "select_assoc", "label_text" => "Статус", "id" => "status", "class" => "form-control select", "data" => [
            0 => "Выкл",
            1 => "Вкл"
        ]]
    ];
}

class Student
{
    var $form_presentation = [
        "fio" => ["type" => "text", "label_text" => "ФИО", "id" => "fio"],
        "login" => ["type" => "text", "label_text" => "Логин", "id" => "login"],
        "student_group" => ["type" => "text", "label_text" => "Группа", "id" => "student_group"],
        "password" => ["type" => "text", "label_text" => "Пароль", "id" => "password"],
        "status" => ["type" => "select_assoc", "label_text" => "Статус", "id" => "status", "class" => "form-control select", "data" => [
            0 => "Выкл",
            1 => "Вкл"
        ]]
    ];
}

class Razdel
{
    var $form_presentation = [
        "name" => ["type" => "text", "label_text" => "Наименование", "id" => "name"]
    ];
}

class Task
{
    function form_presentation()
    {
        $get_razdel = "Select id, name From razdel order by id";
        $razdel_ds = LoadDataFromDB($get_razdel);
        $razdel = array();
        for ($i = 0; $i < count($razdel_ds["data"]); $i++) {
            $razdel[$razdel_ds["data"][$i]["id"]] = $razdel_ds["data"][$i]["name"];
        }
        $form_presentation = [
            "razdel" => ["type" => "select_assoc", "label_text" => "Раздел", "id" => "rname", "class" => "form-control select", "data" => $razdel],
            "name" => ["type" => "text", "label_text" => "Наименование", "id" => "name"],
            "description" => ["type" => "text", "label_text" => "Описание", "id" => "description"],
            "img" => ["type" => "file", "label_text" => "Картинка", "id" => "img"],
            "formula" => ["type" => "text", "label_text" => "Формула", "id" => "formula"],
        ];

        return $form_presentation;
    }
}

class Teacher
{
    var $form_presentation = [
        "fio" => ["type" => "text", "label_text" => "ФИО", "id" => "fio", "class" => "form-control select"],
        "password" => ["type" => "text", "label_text" => "Пароль", "id" => "password"],
        "login" => ["type" => "text", "label_text" => "Логин", "id" => "login"]
    ];
}
