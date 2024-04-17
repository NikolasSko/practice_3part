<?php
echo $message;
if (!app()->auth->user()->id_role == '0'):
    ?>
    <h1 style="color: #b70002">Вы не являетесь сотрудником деканата!</h1>

<?php
else:
    ?>
    <h2 class="title">Добавление сотрудника</h2>
    <div class="add_person_div">
        <form class="form_add_lecturer" method="post" enctype="multipart/form-data">

            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>

            <input placeholder="Введите имя" class="login_input1" type="text" name="lastname">

            <input placeholder="Введите фамилию" class="login_input1" type="text" name="firstname">

            <input placeholder="Введите отчество" class="login_input1" type="text" name="patronymic">

            <input placeholder="Введите пол" class="login_input1" type="text" name="gender">

            <input placeholder="Введите возраст" class="login_input1" type="text" name="age">

            <input placeholder="Введите прописку" class="login_input1" type="text" name="place">

            <input placeholder="Введите место работы" class="login_input1" type="text" name="job">

            <input class="login_input1" type="file" name="img">


            <button type="submit" class="form_add_btn">Добавить</button>
        </form>
    </div>
<?php
endif;
?>
