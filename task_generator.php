<?php
/** Генерируем задачи */

abstract class Creator
{
    abstract public function getRandomTask();
}

class TaskCreator extends Creator
{
    private $razdel, $student_id;

    public function __construct(int $razdel, int $student_id)
    {
        $this->razdel = $razdel;
        $this->student_id = $student_id;
    }

    public function getRandomTask()
    {
        return new ConcreteTask($this->razdel, $this->student_id);
    }
}

interface iTask
{
    public function getTask();
}

class ConcreteTask implements iTask
{
    private $razdel, $student_id;

    public function __construct(int $razdel, int $student_id)
    {
        $this->razdel = $razdel;
        $this->student_id = $student_id;
    }

    public function getTask()
    {
        $task = $this->SelectTask();
        return $task;
    }

    //Взять задачу из бд
    private function SelectTask()
    {
        $randomValues = array();
        $query = "SELECT t.id, t.id_razdel, t.name, t.description, t.img, IFNULL(t.formula, 'none') as formula FROM task as t
                    WHERE  t.id NOT IN (SELECT id_task FROM completed_tasks WHERE id_razdel = " . $this->razdel . " and id_student = " . $this->student_id . ")
                    AND id_razdel = " . $this->razdel . " ORDER BY RAND() LIMIT 1";
        $data = LoadDataFromDB($query);

        if (count($data['data']) == 0) {
            echo "<script>alert('Нет доступных задач!');</script>";
            return $randomValues;
        }

        $diapason = $this->getDiapason($this->razdel, $data["data"][0]['id']);
        $randValues = $this->getRandomValues($diapason, $data['data'][0]['id']);

        $task['id'] = $data["data"][0]['id'];
        $task['id_razdel'] = $data["data"][0]['id_razdel'];
        $task['name'] = $data["data"][0]['name'];
        $task['description'] = $data["data"][0]['description'];
        $task['img'] = $data["data"][0]['img'];
        $task['rand_values'] = $randValues;

        $ap = 0;
        if ($data['data'][0]['formula'] == "none")
            $ap = $task['id'];

        $solver = new Solver($data['data'][0]['formula'], $randValues, $ap);
        $task["right_answer"] = $solver->getRightAnswer();

        return $task;
    }

    private function Rnd($min, $max, $step)
    {
        return rand($min, $max / $step) * $step;
    }
    //Вернуть случайные числа по позициям
    private function getRandomValues(array $data, int $task)
    {
        $randomValues = array();
        /** 6-й раздел */
        if ($task == 27) {
            $randValues["R1"] = $this->Rnd(1, 10, 1);
            $randValues["R2"] = $this->Rnd(1, 10, 1);
            $randValues["R3"] = $this->Rnd(1, 10, 1);
            $randValues["R4"] = $this->Rnd(1, 10, 1);
            $randValues["R5"] = $this->Rnd(1, 10, 1);
            $randValues["ln1"] = $this->Rnd(1, 5, 1);
            $randValues["ln2"] = $this->Rnd(1, 5, 1);
            $randValues["ln3"] = $this->Rnd(1, 5, 1);
            $randValues["ln4"] = $this->Rnd(1, 5, 1);
            $randValues["ln5"] = $this->Rnd(1, 5, 1);
            $randValues["Vcc1"] = $this->Rnd(5, 12, 1);
            $randValues["Vcc2"] = $this->Rnd(-12, -5, 1);
            return $randValues;
        }

        /** 6-й раздел */
        if ($task == 28) {
            $randValues["R1"] = $this->Rnd(1, 10, 1);
            $randValues["R2"] = $this->Rnd(1, 10, 1);
            $randValues["R3"] = $this->Rnd(1, 10, 1);
            $randValues["R4"] = $this->Rnd(1, 10, 1);
            $randValues["ln1"] = $this->Rnd(0.1, 1, 0.1);
            $randValues["ln2"] = 2 *  $randValues["ln1"];
            $randValues["ln3"] = 4 *  $randValues["ln1"];
            $randValues["ln4"] = 8 *  $randValues["ln1"];
            $randValues["Vcc1"] = $this->Rnd(5, 12, 1);
            $randValues["Vcc2"] = $this->Rnd(-12, -5, 1);
            return $randValues;
        }

        /** 6-й раздел */
        if ($task == 29) {
            $randValues["R1"] = $this->Rnd(1, 10, 1);
            $randValues["R2"] = 2 * $randValues["R1"];
            $randValues["R3"] = 4 * $randValues["R1"];
            $randValues["R4"] = 8 * $randValues["R1"];
            $randValues["ln1"] = $this->Rnd(1, 5, 1);
            $randValues["ln2"] = $this->Rnd(1, 5, 1);
            $randValues["ln3"] = $this->Rnd(1, 5, 1);
            $randValues["ln4"] = $this->Rnd(1, 5, 1);
            $randValues["Vcc1"] = $this->Rnd(5, 12, 1);
            $randValues["Vcc2"] = $this->Rnd(-12, -5, 1);
            return $randValues;
        }

        /** 8-й раздел */
        if ($task == 31) {
            $randValues["N"] = $this->Rnd(8, 16, 1);
            $randValues["Code"] = $this->Rnd(0, pow(2,$randValues["N"]), 1);
            $randValues["Vref"] = $this->Rnd(8, 16, 1);
            return $randValues;
        }

        /** 4-й раздел */
        if ($task == 33) {
            $p1 = ["коричневый", "красный", "оранжевый", "зеленый", "желтый", "синий", "фиолетовый", "серый", "белый"];
            $p2 = ["черный", "коричневый", "красный", "оранжевый", "зеленый", "желтый", "синий", "фиолетовый", "серый", "белый"];
            $p3 = ["серебристый", "золотистый", "черный", "коричневый", "красный", "оранжевый", "зеленый", "желтый", "синий", "фиолетовый", "серый", "белый"];
            $p4 = ["серебристый", "золотистый", "коричневый", "красный", "желтый", "зеленый", "синий", "фиолетовый", "серый"];
            $randValues["П1"] = $p1[array_rand($p1)];
            $randValues["П2"] = $p2[array_rand($p2)];
            $randValues["П3"] = $p2[array_rand($p2)];
            $randValues["П4"] = $p3[array_rand($p3)];
            $randValues["П5"] = $p4[array_rand($p4)];
            return $randValues;
        }

        for ($i = 0; $i < count($data['data']); $i++) {
            if ($data['data'][$i]['name_element'] == "K") {
                $items = [10000, 100000, 1000000];
                $randValues[$data['data'][$i]['name_element']] = $items[array_rand($items)];
            } else if ($data['data'][$i]['name_element'] == "ln1" || $data['data'][$i]['name_element'] == "ln2") {
                $items = array();
                for ($j = -100; $j <= 100; $j += 10) {
                    array_push($items, $j);
                }
                $randValues[$data['data'][$i]['name_element']] = $items[array_rand($items)];
            } else
                $randValues[$data['data'][$i]['name_element']] = rand($data['data'][$i]['min'], $data['data'][$i]['max'] / $data['data'][$i]['step']) * $data['data'][$i]['step'];
        }

        return $randValues;
    }

    private function getDiapason(int $razdel, int $id_task)
    {
        $query = "SELECT name_element, step, min, max FROM diapason WHERE id_razdel = " . $razdel . " AND id_task = " . $id_task;
        return LoadDataFromDB($query);
    }
}
