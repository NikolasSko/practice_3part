
<?php
if (!app()->auth::check()):
    ?>
    <h1>Авторизуйтесь!</h1>

<?php
else:
    ?>

    <h1 class="title">Список преподавателей</h1>
    <a class="lecturers_add" href="add">Добавить преподавателя</a>
    <ul class="list_items">
        <?php foreach ($teachers as $teacher): ?>
            <li>
                <span class="teacher_info"><?php echo $teacher->lastname . ' ' . $teacher->firstname . ' ' . $teacher->patronymic . ' ' . $teacher->age . ' ' . $teacher->place . ' ' . $teacher->job; ?></span>
                <?php if (!empty($teacher->img)): ?>
                    <img class="image" src="<?= app()->settings->getRootPath() ?>/public/image/<?php echo $teacher->img; ?>" alt="Фото преподавателя">
                <?php endif; ?>
            </li>

        <?php endforeach; ?>
    </ul>

<?php
endif;
?>