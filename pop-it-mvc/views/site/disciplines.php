<?php
if (!app()->auth::check()):
    ?>
    <h1>Вы не авторизованы</h1>

<?php
else:
    ?>
    <h1 class="title">Список дисциплин</h1>
        <a class="lecturers_add" href="add_discipline">Добавить</a>
    <ul class="list_items">
        <?php foreach ($disciplines as $discipline): ?>
            <li>
                <span class="teacher_info"><?php echo $discipline->name; ?></span>
            </li>

        <?php endforeach; ?>
    </ul>

<?php
endif;
?>


