<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pop it MVC</title>
    <link rel="stylesheet" href="/pop-it-mvc/public/css/style.css">
</head>
<body>
<header>
    <nav>
        <img class="logo" src="/pop-it-mvc/public/image/logo.png" alt="logo">
        <div class="links">
            <?php
            if (!app()->auth::check()):
                ?>
                <a class="enter" href="<?= app()->route->getUrl('/login') ?>">Вход</a>

            <?php
            else:
                ?>
                <?php if (!app()->auth->user()->id_role == '1'):
                    ?>
                <a class="main_links" href="<?= app()->route->getUrl('/teachers') ?>">Сотрудники</a>
                <a class="main_links" href="<?= app()->route->getUrl('/departments') ?>">Кафедры</a>
                <a class="main_links" href="<?= app()->route->getUrl('/discipline') ?>">Дисциплины</a>
                <a class="main_links" href="<?= app()->route->getUrl('/logout') ?>">Выход</a>
                <?php
                else:
                    ?>
                    <a class="main_links" href="<?= app()->route->getUrl('/signup') ?>">Добавить декана</a>
                    <a class="main_links" href="<?= app()->route->getUrl('/logout') ?>">Выход</a>
            <?php
            endif;
            ?>
            <?php
            endif;
            ?>
        </div>

    </nav>
</header>
<main>
    <?= $content ?? '' ?>
</main>

</body>
</html>
