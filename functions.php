<?php

/** Класс отрисовки страниц */
include("classes/render/render.php");
/** класс работы с базой */
include("classes/db/db_connection.php");
/** Подключение к бд */
require_once("classes/ssa/ConnectDb.php");
/** Отрисовщик форм */
include("classes/ssa/moldmaker.php");
/** Разные полезные функции */
include("classes/ssa/AdditionalFunc.php");
/** Класс, который генерит задачи для пользака */
include("solver.php");
include("task_generator.php");

/** ОСНОВНЫЕ ФУНКЦИИ */

//Стартовая страница
function loadStart()
{
    /** Проверка и удаление закрытых сессий */
    checkSessions();

    if (!isset($_SESSION['sid']['id'])) login();

    if ($_SESSION['sid']['role'] == 0) {
        admin_users();
        return;
    }

    if ($_SESSION['sid']['role'] == 2) {
        lk();
        return;
    }

    $query = "SELECT  r.id, r.name, s.result From razdel as r
    INNER JOIN results as s ON s.id_razdel = r.id
    WHERE s.id_student = " . $_SESSION['sid']['id'] . " ORDER BY r.name";
    $context = LoadDataFromDB($query);
    //получить задачу, которая в бэкапе, если такая есть
    $res = checkSaveExists();
    if (count($res) > 0) {
        $data = DeserializeTest($res[0]['file']);
        $context['save_razdel'] = $data['id_razdel'];
    }

    $render = new Render("templates/start.php", $context);
    return $render->renderPage();
}

function checkSessions()
{
    $query = "SELECT file FROM current_state WHERE status = 1";
    $res = LoadDataFromDB($query);
    for ($i = 0; $i < count($res['data']); $i++) {
        AddFunc::delete_file($res['data'][$i]['file']);
    }
}

function login()
{
    $render = new Render("templates/login.php");
    return $render->renderPage();
}

// регистрация
function register()
{
    $render = new Render("templates/register.php");
    return $render->renderPage();
}

// войти
function do_login()
{
    $input = $GLOBALS["input"];
    if (!isset($input['login']) && !isset($input['password']))
        return;

    $login = isset($input['login']) ? $input['login'] : "";
    $password = isset($input['password']) ? $input['password'] : "";

    $query = "Select * From users as u Where u.login='$login' and password = '" . sha1($password) . "' and status = 1";
    $context = LoadDataFromDB($query);

    if ($context['status'] != 1)
        return;

    if (count($context["data"]) == 0) {
        $render = new Render("service_files/user_not_found.php", $context);
        return $render->renderPage();
    }
    $fio = $context["data"][0]["fio"];
    $login = $context["data"][0]["login"];
    $role = $context["data"][0]["role"];
    $id = $context["data"][0]["id"];

    session_variables_create($fio, $role, $id, $login);

    /** Заполнить таблицу результатов */
    $query = "SELECT count(*) as counter FROM results WHERE id_student = " . $_SESSION['sid']['id'];
    if (LoadDataFromDB($query)['data'][0]['counter'] == 0)
        fillResults();

    loadStart();
}

function fillResults()
{
    $query = "SELECT id FROM razdel";
    $ids = LoadDataFromDB($query);
    for ($i = 0; $i < count($ids['data']); $i++) {
        $query = "INSERT INTO results (id_student, id_razdel) VALUES (?,?)";
        $params = array($_SESSION['sid']['id'], $ids['data'][$i]['id']);
        bd_interaction($query, $params);
    }
}

function getSessionUID()
{
    $uid = session_id();
    return $uid;
}

// обработка данных регистрации
function do_reg()
{
    $input = $GLOBALS["input"];
    $input = $GLOBALS["input"];
    $str = isset($input['str']) ? $input['str'] : "";
    $data = array();
    foreach (explode('&', $str) as $val) {
        preg_match_all("#([^,\s]+)=([^\*]+)#s", $val, $out);
        unset($out[0]);
        $out = array_combine($out[1], $out[2]);
        $data = array_merge($data, $out);
    }

    $fio = isset($data['fio']) ? $data['fio'] : "";
    $login = isset($data['login']) ? $data['login'] : "";
    $group = isset($data['group']) ? $data['group'] : "";

    $pass = isset($data['pass']) ? $data['pass'] : "";
    $re_pass = isset($data['re_pass']) ? $data['re_pass'] : "";

    if ($pass != $re_pass) {
        echo 0; //пароль не существует
        return;
    }


    $query = "Select count(id) as counter From users Where login = '$login'";
    $context = LoadDataFromDB($query);
    if ($context["status"] == 1) {
        if ($context["data"][0]["counter"] > 0) {
            echo 1; //такой пользак уже существует
            return;
        }
    }

    $query = "SELECT count(id) as counter FROM credit_book_numbers WHERE number = '" . $login . "'";
    if (LoadDataFromDB($query)["data"][0]["counter"] == 0) {
        echo 2; //такой зачетки нет в системе
        return;
    }

    $query = "Insert Into users (fio, password, login, role, status, student_group) VALUES (?,?,?,?,?,?)";
    $params = array($fio, sha1($pass), $login, 1, 1, $group);

    $res = bd_interaction($query, $params);
    if ($res["status"] == 1) {
        echo 1000;
        return;
    }
}

// создание переменных сессии
function session_variables_create($fio, $role, $id, $login)
{
    $seance = array();
    $_SESSION['sid'] = getSessionUID();
    $seance['login'] = $login;
    $seance['fio'] = $fio;
    $seance['role'] = $role;
    $seance['id'] = $id;
    $_SESSION['sid'] = $seance;
}

function logout()
{
    unset($_SESSION['sid']);
    loadStart();
}

/** Принимаем запрос от клиента */
function ping()
{
    $input = $GLOBALS['input'];
    $s = $input['s'];
    if ($s != 1)
        return;

    $res = checkSaveExists();
    if (count($res) > 0) {
        UpdateTime();
    }
    return;
}

// /** Записываем время в объект и сериализуем */
// function writeTimeStamp($data){
//     $s = serialize($data);
//     $name = $_SESSION['sid']['id'] . '_time_stamp' . time();
//     $path = 'save/' . $name;
//     file_put_contents($path, $s);
//     saveStateToDb($path);
//     return;
// }

/** Запустить выполнение задачи */
function start_task()
{
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");

    if (!isset($_SESSION['sid']))
        return;

    if ($_SESSION['sid']['role'] != 1)
        return;

    $res = checkSaveExists();
    if (count($res) > 0)
        $context = DeserializeTest($res[0]['file']);
    else {
        $context = getRandomTask();
        if (count($context) > 0)
            saveObject($context);
    }

    if (count($context) == 0) {
        loadStart();
        return;
    }

    $context['time'] = getTime();

    $render = new Render("templates/task_exec.php", $context);
    return $render->renderPage();
}

function getTime()
{
    $res = checkSaveExists();
    if (count($res) == 0)
        return 7200;

    return LoadDataFromDB("SELECT time FROM current_state WHERE status = 0 AND id_user = " . $_SESSION['sid']['id'])['data'][0]['time'];
}

//Проверяем наличие активных сохраненных состояний
function checkSaveExists()
{
    $data = LoadDataFromDB("SELECT * FROM current_state WHERE id_user = " . $_SESSION['sid']['id'] . " AND status = 0");
    $res = count($data['data']) == 0 ? array() : $data['data'];
    return $res;
}

//Сериализуем и сохраняем объект текущего теста
function saveObject($context)
{
    $s = serialize($context);
    $name = $_SESSION['sid']['id'] . '_store' . time();
    $path = 'save/' . $name;
    file_put_contents($path, $s);
    saveStateToDb($path);
    return;
}

//Десереализация сохраненного теста
function DeserializeTest($path)
{
    $s = file_get_contents($path);
    return unserialize($s);
}

//После использования бэкапа делаем его недействительным 
function UpdateBackupStatus()
{
    $query = "UPDATE current_state SET status = 1 WHERE status = 0 AND id_user = ?";
    $params = array($_SESSION['sid']['id']);
    bd_interaction($query, $params);
    return;
}

function UpdateTime()
{
    $query = "UPDATE current_state SET time = time - 20 WHERE status = 0 and id_user = ?";
    $params = array($_SESSION['sid']['id']);
    bd_interaction($query, $params);
    return;
}

//Сохраняем данные о бэкапе в базу для контроля
function saveStateToDb($file)
{
    $query = "INSERT INTO current_state (id_user, file, time) VALUES (?,?, '7200')";
    $params = array($_SESSION['sid']['id'], $file);
    bd_interaction($query, $params);
}

/** Запросить рандомную задачу */
function getRandomTask()
{
    $input = $GLOBALS["input"];
    $task_id = $input['id'];

    $task_creator = new TaskCreator($task_id, $_SESSION['sid']['id']);
    $task = $task_creator->getRandomTask();

    return $task->getTask();
}

/** Проверка решения задачи */
function check_task()
{
    $input = $GLOBALS["input"];
    if (!isset($input['str']))
        return;

    $data = array();

    foreach (explode('&', $input['str']) as $val) {
        preg_match_all("#([^,\s]+)=([^\*]+)#s", $val, $out);
        unset($out[0]);
        $out = array_combine($out[1], $out[2]);
        $data = array_merge($data, $out);
    }

    $task_id = $data["task_id"];
    $id_razdel = $data["id_razdel"];
    $right_answer = $data["ra"];
    $answer = $data["answer"];

    if (isset($data['answer_pogr'])) {
        if ($data['answer_pogr'] != $data['pogr']) {
            write_result($task_id, $id_razdel, false);
            return;
        }
    }

    /** Допускаем небольшую погрешность ответа */
    abs((round($answer, 2)) - round($right_answer, 2)) > 0.8 ? write_result($task_id, $id_razdel, false) : write_result($task_id, $id_razdel, true);
    //Делаем бэкап недействительным
    UpdateBackupStatus();
    return;
}

/** Отвалился по времени */
function timeOut()
{
    $input = $GLOBALS["input"];
    $student_id = $input['student_id'];
    $razdel_id = $input['razdel_id'];

    $query = "UPDATE results SET result = result - 1 WHERE id_razdel = $razdel_id and id_student = ?";
    $params = array($student_id);
    bd_interaction($query, $params);
    return;
}

function write_result(int $task_id, int $id_razdel, bool $answ)
{
    /** Помечаем задание как выполненное и больше не предлагаем конкретному студенту */
    if ($answ) {
        $query = "INSERT INTO completed_tasks (id_razdel, id_task, id_student) VALUES (?,?,?)";
        $params = array($id_razdel, $task_id, $_SESSION['sid']['id']);
        bd_interaction($query, $params);
    }

    /** Апдейтим счетчик */
    $x = $answ ? 1 : -1;
    $query = "UPDATE results SET result = result + $x WHERE id_razdel = $id_razdel and id_student = ?";
    $params = array($_SESSION['sid']['id']);
    bd_interaction($query, $params);
    return;
}

/** Личный кабинет */
function lk()
{
    $context["numbers"] = LoadDataFromDB("SELECT id, number FROM credit_book_numbers ORDER BY id");
    $context["students"] = LoadDataFromDB("SELECT id, fio, login, role, status, date_reg, student_group FROM users WHERE role = 1 ORDER BY id");
    $render = new Render("templates/lk.php", $context);
    return $render->renderPage();
}

/** АДМИНКА 																					*****************/

// Управление пользаками
function admin_users()
{
    if ($_SESSION['sid']['role'] == 0) {
        $query = "SELECT id, fio, role, status, login From users WHERE role != 0 Order By id";
        $context = LoadDataFromDB($query);

        if ($context["status"] == 1) {
            $render = new Render("templates/users.php", $context);
            return $render->renderPage();
        } else {
            echo 'Возникли ошибки в ходе выполнения запроса';
        }
    }
}

function edit_razdel()
{
    if ($_SESSION['sid']['role'] == 0 || $_SESSION['sid']['role'] == 2) {
        $query = "Select * From razdel Order By id";
        $context = LoadDataFromDB($query);

        if ($context["status"] == 1) {
            $render = new Render("templates/razdel.php", $context);
            return $render->renderPage();
        } else {
            echo 'Возникли ошибки в ходе выполнения запроса';
        }
    }
}

function edit_tasks()
{
    if ($_SESSION['sid']['role'] == 0 || $_SESSION['sid']['role'] == 2) {
        $query = "Select t.id, t.name, t.description, t.img, t.formula, r.name as rname  From task t INNER JOIN razdel r ON r.id = t.id_razdel Order By id";
        $context = LoadDataFromDB($query);

        if ($context["status"] == 1) {
            $render = new Render("templates/tasks.php", $context);
            return $render->renderPage();
        } else {
            echo 'Возникли ошибки в ходе выполнения запроса';
        }
    }
}

function task_add()
{
    if ($_SESSION['sid']['role'] == 0 || $_SESSION['sid']['role'] == 2) {
        $createView = new MoldMaker('Task', "Добавить задание", 'add_new_task');
        $createView->CreateView();
    }
}

function razdel_add()
{
    if ($_SESSION['sid']['role'] == 0 || $_SESSION['sid']['role'] == 2) {
        $createView = new MoldMaker('Razdel', "Добавить раздел", 'add_new_razdel');
        $createView->CreateView();
    }
}

function add_new_razdel()
{
    $input = $GLOBALS['input'];
    $name = $input["name"];

    $query = "INSERT INTO razdel (name) VALUES (?)";
    $params = array($name);
    bd_interaction($query, $params);
    edit_razdel();
    return;
}

function add_new_task()
{
    $input = $GLOBALS['input'];
    $razdel = isset($input['razdel']) ? $input['razdel'] : "";
    $name = isset($input['name']) ? $input['name'] : "";
    $description = isset($input['description']) ? $input['description'] : "";
    $formula = isset($input['formula']) ? $input['formula'] : "";

    $uploaddir = 'static/img/images/';
    $link = AddFunc::FileUpload($input['img'], $uploaddir);

    $query = "INSERT INTO task (id_razdel, name, description, img, formula) VALUES (?, ?, ?, ?, ?)";
    $params = array($razdel, $name, $description, $link, $formula);
    bd_interaction($query, $params);
    echo '<script>
        window.location.href = "?act=edit_tasks";
    </script>';
}

function add_book_numbers()
{
    $input = $GLOBALS['input'];
    $str = isset($input['str']) ? $input['str'] : "";
    $numbers = explode(";", $str);
    foreach ($numbers as $val) {
        $query = "INSERT INTO credit_book_numbers (number) VALUES (?)";
        $params = array($val);
        bd_interaction($query, $params);
    }
    echo 0;
    return;
}

/** Добавить учетную запись преподавателя */
function teacher_add()
{
    if ($_SESSION['sid']['role'] == 0) {
        $createView = new MoldMaker('Teacher', "Добавить учетную запись", 'add_new_teacher');
        $createView->CreateView();
    }
}

function add_new_teacher()
{
    $input = $GLOBALS['input'];
    $fio = isset($input['fio']) ? $input['fio'] : "";
    $password = isset($input['password']) ? $input['password'] : "";
    $login = isset($input['login']) ? $input['login'] : "";

    if (!checkUser($login))
        return;

    $query = "Insert Into users (fio, password, login, role, status) VALUES (?,?,?,?,?)";
    $params = array($fio, sha1($password), $login, 2, 1);

    $res = bd_interaction($query, $params);
    if ($res["status"] == 1) {
        admin_users();
        return;
    }
}

function checkUser(string $login)
{
    $query = "SELECT count(*) as counter FROM users WHERE login = '$login'";
    return LoadDataFromDB($query)['data'][0]['counter'] > 0 ? false : true;
}

function edit_user()
{
    if ($_SESSION['sid']['role'] == 0) {
        $input = $GLOBALS['input'];
        $id = $input['id'];

        $query = "SELECT * FROM users WHERE id = $id";
        $context = LoadDataFromDB($query);

        $editView = new MoldMaker('User', 'Редактировать пользователя', 'update_user');
        $editView->EditView($context);
    }
}

function edit_student()
{
    if ($_SESSION['sid']['role'] == 0 || $_SESSION['sid']['role'] == 2) {
        $input = $GLOBALS['input'];
        $id = $input['id'];

        $query = "SELECT id, fio, login, student_group, status, '' as password FROM users WHERE id = $id";
        $context = LoadDataFromDB($query);

        $editView = new MoldMaker('Student', 'Редактировать студента', 'update_student');
        $editView->EditView($context);
    }
}

function edit_razd()
{
    if ($_SESSION['sid']['role'] == 0 || $_SESSION['sid']['role'] == 2) {
        $input = $GLOBALS['input'];
        $id = $input['id'];

        $query = "SELECT * FROM razdel WHERE id = $id";
        $context = LoadDataFromDB($query);

        $editView = new MoldMaker('Razdel', 'Редактировать раздел', 'update_razdel');
        $editView->EditView($context);
    }
}

function update_razdel()
{
    $input = $GLOBALS['input'];
    $id = $input['unique_id'];
    $name = $input["name"];
    $query = "UPDATE razdel SET name = ? WHERE id = ?";
    $params = array($name, $id);    
    bd_interaction($query, $params);
    edit_razdel();
    return;
}

function browse_results()
{
    $input = $GLOBALS["input"];
    $id = $input['id'];

    $query = "SELECT u.fio, l.name, r.result FROM results as r 
                INNER JOIN users as u ON u.id = r.id_student
                INNER JOIN razdel as l ON l.id = r.id_razdel WHERE u.id = " . $id;

    $context = LoadDataFromDB($query);

    $render = new Render("templates/browse_results.php", $context);
    return $render->renderPage();
}

function update_user()
{
    if ($_SESSION['sid']['role'] == 0) {
        $input = $GLOBALS['input'];
        $id = $input['unique_id'];
        $fio = $input['fio'];
        $login = $input['login'];
        $role = $input['role'];
        $status = $input['status'];

        $query = "UPDATE users SET fio = ?, login = ?, role = ?, status = ? WHERE id = ?";
        $params = array($fio, $login, $role, $status, $id);
        bd_interaction($query, $params);
        echo '<script>window.location.href = "?act=edit_users";</script>';
    }
}

function update_student()
{
    if ($_SESSION['sid']['role'] == 2) {
        $input = $GLOBALS['input'];
        $id = $input['unique_id'];
        $fio = $input['fio'];
        $login = $input['login'];
        $status = $input['status'];
        $student_group = $input['student_group'];
        $password = $input['password'];

        if ($password == "") {
            $query = "UPDATE users SET fio = ?, login = ?, status = ?, student_group = ? WHERE id = ?";
            $params = array($fio, $login, $status, $student_group, $id);
        }

        if ($password != "") {
            $query = "UPDATE users SET fio = ?, login = ?, status = ?, password = ?, student_group = ? WHERE id = ?";
            $params = array($fio, $login, $status, sha1($password), $student_group, $id);
        }

        bd_interaction($query, $params);
        lk();
        return;
    }
}

/** Подтверждение удаления */
function DeleteConfirmation()
{
    $input = $GLOBALS['input'];
    $id = isset($input['id']) ? $input['id'] : "";
    $act = isset($input['act']) ? $input['act'] : "";
    $name = isset($input['name']) ? $input['name'] : "имя не установлено";
    $context = ["id" => $id, "act" => $act, "name" => $name];
    $render = new Render("templates/delete_view.php", $context);
    return $render->renderPage();
}
/** Удалить */
function Delete()
{
    $input = $GLOBALS['input'];
    $id = isset($input['id']) ? $input['id'] : "";
    $from = isset($input['from']) ? $input['from'] : "";

    switch ($from) {
        case "del_user":
            $query = "Delete From users Where id = ?";
            break;
        case "del_razdel":
            $query = "Delete From razdel Where id = ?";
            break;
        case "del_book_number":
            $query = "Delete From credit_book_numbers Where id = ?";
            break;
        case "del_task":
            $query = "Delete From task Where id = ?";
            break;
    }

    $params = array($id);
    bd_interaction($query, $params);

    switch ($from) {
        case "del_user":
            if ($_SESSION['sid']['role'] == 0)
                admin_users();
            else
                lk();
            break;
        case "del_razdel":
            edit_razdel();
            break;
        case "del_book_number":
            lk();
            break;
        case "del_task":
            edit_tasks();
            break;
    }
}
/** АДМИНКА КОНЕЦ */

/** Возвращение на предыдущие страницы */
function go_back($step = -2)
{
    echo '<script>window.history.go(' . $step . ');</script>';
}

/** ОПЕРАЦИИ С БД */
// выборка из бд
function LoadDataFromDB($query, $params = array())
{
    if ($query == "")
        return;

    /** Экземпляр класса подключения */
    $ConDB = new ConnectDB();
    $connObj = $ConDB -> connect();
    echo '<p style="background-color: white">';
    print_r($connObj['log']);
    echo '</p>';
    $CONN = $connObj['connection'];
    $mySqlCommand = new Command($CONN, $query, $params);
    $context = $mySqlCommand->Execute();

    return $context;
}

/** Вставка, удаление, обновление */
function bd_interaction($query, $params)
{
    /** Экземпляр класса подключения */
    $ConDB = new ConnectDB();
    $connObj = $ConDB -> connect();
    $CONN = $connObj['connection'];
    $mySqlCommand = new Command($CONN, $query, $params);
    $cmd = $mySqlCommand->ExecuteNonQuery();

    return $cmd;
}
/** КОНЕЦ ОПЕРАЦИИ С БД */
