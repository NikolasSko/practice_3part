<?php
echo $message;
if (!app()->auth->user()->id_role == '0'):
    ?>
    <h1 style="color: #b70002">Вы не являетесь сотрудником деканата!</h1>

<?php
else:
    ?>
    <h2 class="title">Добавление дисциплины</h2>
    <div class="add_person_div">
        <form class="form_add_lecturer" method="post">

            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <input placeholder="Введите название дисциплины" class="login_input1" type="text" name="name">


            <select id="b" class="select">
                <?php foreach ($departments as $department): ?>
                <option value="id"><?php echo $department->name; ?></option>
                <?php endforeach; ?>
            </select>



            <button type="submit" class="form_add_btn">Добавить</button>
        </form>

    </div>
<?php
endif;
?>










