<div class="container">
    <div class="header">
        <h2>Добавить новое подразделение</h2></div>
    <form method="POST">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <input name="search_query" placeholder="Искать здесь..." type="search">
        <button type="submit" >Поиск</button>
    </form>
    <?php foreach ($teachers as $teachers): ?>
        <div class="notification">
            <h3><?='Пользователь: ', $teachers->surname,' ', $teachers->name, ' ' ,$teachers->patronymic ?></h3>
        </div>
    <?php endforeach; ?><br>
    <a class="logout" href="<?= app()->route->getUrl('/') ?>"> Назад
    </a><br>
</div>