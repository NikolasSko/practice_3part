<?php
if (!app()->auth::check()):
    ?>
    <h1>Вы не авторизованы</h1>

<?php
else:
    ?>
    <h1 class="title">Список Кафедр</h1>
        <a class="lecturers_add" href="add_departments">Добавить кафедру</a>
    <ul class="list_items">
        <?php foreach ($departments as $department): ?>
            <li>
                <span class="teacher_info"><?php echo $department->name; ?></span>
            </li>

        <?php endforeach; ?>
    </ul>
<?php
endif;
?>


