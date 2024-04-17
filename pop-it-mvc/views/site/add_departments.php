<?php
echo $message;
if (!app()->auth->user()->id_role == '0'):
    ?>
    <h1 style="color: #b70002">Вы не являетесь сотрудником деканата!</h1>

<?php
else:
    ?>

    <h2 class="title">Добавление кафедры</h2>
    <div class="add_person_div">
        <form class="form_add_lecturer" method="post">

            <input  name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <input placeholder="Введите название кафедры" class="login_input1" type="text" name="name">


            <button type="submit" class="form_add_btn">Добавить</button>
        </form>

    </div>
<?php
endif;
?>
