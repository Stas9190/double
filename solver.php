<?php
/** Проверяем результат студента на корретность */

class Solver
{
    private $formula, $rand_values, $ap; //additional_parameters

    public function __construct(string $formula, array $rand_values, int $ap)
    {
        $this->formula = $formula;
        $this->rand_values = $rand_values;
        $this->ap = $ap;
    }

    public function getRightAnswer()
    {
        return $this->ComputeAnswer();
    }

    private function ComputeAnswer()
    {
        $f = "";
        if ($this->formula != "none") {
            $formula = explode("=", $this->formula);
            $f = $formula[1];
            $f = $this->substitude_values($f);
        }
        return $this->ComputeFormula($f);
    }

    private function substitude_values($f)
    {
        foreach ($this->rand_values as $key => $val) {
            $f = str_ireplace($key, $val, $f);
        }

        return $f;
    }

    private function ComputeFormula($f)
    {
        if ($this->ap == 0)
            return eval("return $f;");

        $id_task = $this->ap;
        $rv = $this->rand_values;
        /** Вычисляем значения */
        if ($id_task == 21)
            return $this->computeTask53($rv);
        if ($id_task == 22)
            return $this->computeTask54($rv);
        if ($id_task == 23)
            return $this->computeTask55($rv);
        if ($id_task == 24)
            return $this->computeTask56($rv);
        if ($id_task == 25)
            return $this->computeTask57($rv);
        if ($id_task == 26)
            return $this->computeTask58($rv);
        if ($id_task == 27)
            return $this->computeTask61($rv);
        if ($id_task == 28)
            return $this->computeTask62($rv);
        if ($id_task == 29)
            return $this->computeTask63($rv);
        if ($id_task == 30)
            return $this->computeTask71($rv);
        if ($id_task == 33)
            return $this->computeTask41($rv);
    }

    private function  computeTask53($rv)
    {
        $Out = $rv['ln1'] * pow(10, -6) * $rv['R2'] / $rv['R1'];
        if ($Out < $rv['Vcc1'] && $Out > $rv['Vcc2'])
            return $Out;
        if ($Out > $rv['Vcc1'])
            return  $rv['Vcc1'];
        if ($Out < $rv['Vcc2'])
            return  $rv['Vcc2'];
    }

    private function  computeTask54($rv)
    {
        $Out = $rv['ln1'] * pow(10,-6) * ($rv['R2'] / $rv['R1'] + 1);
        if ($Out < $rv['Vcc1'] && $Out > $rv['Vcc2'])
            return $Out;
        if ($Out > $rv['Vcc1'])
            return  $rv['Vcc1'];
        if ($Out < $rv['Vcc2'])
            return  $rv['Vcc2'];
    }
    private function  computeTask55($rv)
    {
        $Rx = $rv['R2'] * $rv['R3'] / ($rv['R2'] + $rv['R3']);
        $Out = $rv['ln1'] * pow(10, -6) * ($Rx / $rv['R1']);
        if ($Out < $rv['Vcc1'] && $Out > $rv['Vcc2'])
            return $Out;
        if ($Out > $rv['Vcc1'])
            return  $rv['Vcc1'];
        if ($Out < $rv['Vcc2'])
            return  $rv['Vcc2'];
    }
    private function  computeTask56($rv)
    {
        $Ry = $rv['R2'] + $rv['R3'];
        $Rx = $rv['R4'] * $Ry / ($rv['R4'] + $Ry);
        $Out = $rv['ln1'] * pow(10,-6) * ($Rx / $rv['R1'] + 1);
        if ($Out < $rv['Vcc1'] && $Out > $rv['Vcc2'])
            return $Out;
        if ($Out > $rv['Vcc1'])
            return  $rv['Vcc1'];
        if ($Out < $rv['Vcc2'])
            return  $rv['Vcc2'];
    }
    private function  computeTask57($rv)
    {
        $Out1 = $rv['ln1'] * pow(10, -6) * ($rv['R2'] / $rv['R1']);
        if ($Out1 < $rv['Vcc1'] && $Out1 > $rv['Vcc2'])
            $Out1 = $Out1;
        if ($Out1 > $rv['Vcc1'])
            $Out1 =  $rv['Vcc1'];
        if ($Out1 < $rv['Vcc2'])
            $Out1 =  $rv['Vcc2'];

        $Out = $Out1 * ($rv['R4'] / $rv['R3']);
        if ($Out < $rv['Vcc1'] && $Out > $rv['Vcc2'])
            return $Out;
        if ($Out > $rv['Vcc1'])
            return  $rv['Vcc1'];
        if ($Out < $rv['Vcc2'])
            return  $rv['Vcc2'];
    }
    private function  computeTask58($rv)
    {
        $Out1 = $rv['ln1'] * pow(10, -6) * (($rv['R2'] + $rv['R3']) / $rv['R1']);
        if ($Out1 < $rv['Vcc1'] && $Out1 > $rv['Vcc2'])
            $Out1 = $Out1;
        if ($Out1 > $rv['Vcc1'])
            $Out1 =  $rv['Vcc1'];
        if ($Out1 < $rv['Vcc2'])
            $Out1 =  $rv['Vcc2'];

        $Out = $Out1 * ($rv['R5'] / $rv['R4']);
        if ($Out < $rv['Vcc1'] && $Out > $rv['Vcc2'])
            return $Out;
        if ($Out > $rv['Vcc1'])
            return  $rv['Vcc1'];
        if ($Out < $rv['Vcc2'])
            return  $rv['Vcc2'];
    }

    private function  computeTask61($rv)
    {
        $Out = $rv["R5"] * ($rv["ln1"] / $rv["R1"] + $rv["ln2"] / $rv["R2"] + $rv["ln3"] / $rv["R3"] + $rv["ln4"] / $rv["R4"] + $rv["ln5"] / $rv["R5"]);
        if ($Out < $rv['Vcc1'] && $Out > $rv['Vcc2'])
            return $Out;
        if ($Out > $rv['Vcc1'])
            return  $rv['Vcc1'];
        if ($Out < $rv['Vcc2'])
            return  $rv['Vcc2'];
    }
    private function  computeTask62($rv)
    {
        $Out = $rv["R4"] * ($rv["ln1"] / $rv["R1"] + $rv["ln2"] / $rv["R2"] + $rv["ln3"] / $rv["R3"] + $rv["ln4"] / $rv["R4"]);
        if ($Out < $rv['Vcc1'] && $Out > $rv['Vcc2'])
            return $Out;
        if ($Out > $rv['Vcc1'])
            return  $rv['Vcc1'];
        if ($Out < $rv['Vcc2'])
            return  $rv['Vcc2'];
    }
    private function  computeTask63($rv)
    {
        $Out = $rv["R4"] * ($rv["ln1"] / $rv["R1"] + $rv["ln2"] / $rv["R2"] + $rv["ln3"] / $rv["R3"] + $rv["ln4"] / $rv["R4"]);
        if ($Out < $rv['Vcc1'] && $Out > $rv['Vcc2'])
            return $Out;
        if ($Out > $rv['Vcc1'])
            return  $rv['Vcc1'];
        if ($Out < $rv['Vcc2'])
            return  $rv['Vcc2'];
    }

    private function  computeTask71($rv)
    {
        if ($rv["Y"] <= $rv["V"])
            return ((pow(2, $rv['N'])) - 1) * $rv["Y"] / $rv["V"];
        else
            return ((pow(2, $rv['N'])) - 1);
    }

    private function  computeTask41($rv)
    {
        $n1 = [
            "коричневый" => 1, "красный" => 2, "оранжевый" => 3, "желтый" => 4,  "зеленый" => 5, "синий" => 6, "фиолетовый" => 7, "серый" => 8, "белый" => 9
        ];
        $n2 = [
            "черный" => 0, "коричневый" => 1, "красный" => 2, "оранжевый" => 3, "желтый" => 4,  "зеленый" => 5, "синий" => 6, "фиолетовый" => 7, "серый" => 8, "белый" => 9
        ];
        $n3 = [
            "серебристый" => 0.01, "золотистый" => 0.1, "черный" => 1, "коричневый" => 10, "красный" => 100, "оранжевый" => 1000, "желтый" => 10000,  "зеленый" => 100000, "синий" => 1000000, "фиолетовый" => 10000000, "серый" => 100000000, "белый" => 1000000000
        ];
        $n4 = [
            "серебристый" => 10, "золотистый" => 5, "коричневый" => 1, "красный" => 2,  "желтый" => 0.5,  "зеленый" => 0.5, "синий" => 0.2, "фиолетовый" => 0.2, "серый" => 0.05
        ];

        $R = ($n1[$rv["П1"]] * 100 + $n2[$rv["П2"]] * 10 + $n2[$rv["П3"]] * 1) * $n3[$rv["П4"]];

        $S = $n4[$rv["П5"]];

        return ["R" => $R, "S" => $S];
    }
}
