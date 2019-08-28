<!-- Стартовая с задачей -->
<?php
if (count($context) == 0)
    echo '<script>window.location.href = "?act=main";</script>';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Решите задачу</h3>
                    </div>
                    <div class="box-body no-padding">
                        <p id="countdown" style="padding: 20px; font-weight: bold;"></p>
                        <table>
                            <tr>
                                <td>
                                    <p><?= $context['description'] ?></p>
                                    <br>
                                    <?php
                                    foreach ($context['rand_values'] as $key => $value) {
                                        echo $key . " = " . $value . "<br>";
                                    }
                                    ?>
                                    <br>
                                </td>
                                <td><img src="<?= $context['img'] ?>" alt=""></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <form id="users_answer">
                                            <?php if (!is_array($context['right_answer'])) : ?>
                                                <input type="hidden" name="ra" value="<?= $context["right_answer"] ?>">
                                            <?php else : ?>
                                                <input type="hidden" name="ra" value="<?= $context["right_answer"]["R"] ?>">
                                                <input type="hidden" name="pogr" value="<?= $context["right_answer"]["S"] ?>">
                                            <?php endif; ?>
                                            <input type="hidden" name="task_id" value="<?= $context["id"] ?>">
                                            <input type="hidden" name="id_razdel" id="id_razdel" value="<?= $context["id_razdel"] ?>">
                                            <input type="hidden" name="id_student" id="id_student" value="<?= $_SESSION['sid']['id'] ?>">
                                            <?php if (!is_array($context['right_answer'])) : ?>
                                                <label for="answer">Ответ</label>
                                                <input type="text" id="answer" class="form-control" name="answer" style="width: 240px; height: 30px;">
                                            <?php else : ?>
                                                <label for="answer">Ответ</label>
                                                <input type="text" id="answer" class="form-control" name="answer" style="width: 240px; height: 30px;">
                                                <label for="answer_pogr">Погрешность</label>
                                                <input type="text" id="answer_pogr" class="form-control" name="answer_pogr" style="width: 240px; height: 30px;">
                                            <?php endif; ?>
                                        </form>
                                    </div>
                                    <button type="submit" class="btn btn-primary" id="submit_task" style="margin-bottom: 20px;">Подтвердить</button>
                                </td>
                                <td>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    if (performance.navigation.type == 1) {
        window.location.href = "?act=main";
    }

    var counter = <?=$context['time']?>;
    var elem = document.getElementById("countdown");
    elem.innerHTML = "На выполнение задачи осталось: 2:00:00";
    var id;
    student_id = document.getElementById("id_student").value;
    razdel_id = document.getElementById("id_razdel").value;

    id = setInterval(function() {
        counter--;
        if (counter < 0) {
            clearInterval(id);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', "", false);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                    alert("Время вышло. Введите ответ.");
                    window.location.href = "?act=main";
                }
            }

            xhr.send("act=timeOut&student_id=" + student_id + "&razdel_id=" + razdel_id);
        } else {
            elem.innerHTML = "На выполнение задачи осталось: " + counter.toHHMMSS();
        }
    }, 1000);

    Number.prototype.toHHMMSS = function() {
        var sec_num = parseInt(this, 10);
        var hours = Math.floor(sec_num / 3600);
        var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
        var seconds = sec_num - (hours * 3600) - (minutes * 60);

        if (hours < 10) {
            hours = "0" + hours;
        }
        if (minutes < 10) {
            minutes = "0" + minutes;
        }
        if (seconds < 10) {
            seconds = "0" + seconds;
        }
        return hours + ':' + minutes + ':' + seconds;
    }

    function ping() {
        if (counter <= 0)
            return;
        var xhr2 = new XMLHttpRequest();
        xhr2.open('POST', "", false);
        xhr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr2.send("act=ping&s=1");
        if (xhr2.status != 200) {
            alert("Возникла ошибка соединения с сервером.");
            console.Log(xhr2.status + ': ' + xhr2.statusText);
        }
    }

    setInterval(ping, 20000);
</script>