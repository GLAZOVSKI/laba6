<nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample10" aria-controls="navbarsExample10" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample10">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Главная</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?add=ok">Добавить запись</a>
            </li>
            <li class="nav-item">
                <?php if (!empty($_SESSION['auth'])) { ?>
                    <a class="nav-link" href="?logout=ok">Выйти</a>
                <?php }else {?>
                    <a class="nav-link" href="?log=ok">Войти</a>
                <?php }?>
            </li>
        </ul>
    </div>
</nav>