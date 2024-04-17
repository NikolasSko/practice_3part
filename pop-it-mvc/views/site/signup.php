<?php
echo $message;
if (!app()->auth->user()->id_role == '1'):
            ?>
    <h1 style="color: #b70002">Вы не авторизованы</h1>

        <?php
        else:
            ?>
            <h2 class="title">Добавление сотрудника</h2>
            <div class="add_person_div">
                <form class="form_add_lecturer" method="post">
                    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                    <input placeholder="Введите имя" class="login_input1" type="text" name="name">
                    <input placeholder="Введите логин" class="login_input1" type="text" name="login"></label>
                    <input placeholder="Введите пароль" class="login_input1" type="password" name="password"></label>
                    <button class="form_add_btn">Зарегистрироваться</button>
                </form>
            </div>
        <?php
        endif;
        ?>
