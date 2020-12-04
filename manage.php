<?php
class Book {
    private $host = 'localhost';
    private $database = 'publications';
    private $user = 'root';
    private $password = '';

    private $mysqli = false;

    public function __construct() {
        $this->mysqli = mysqli_connect($this->host, $this->user, $this->password, $this->database);

        if (mysqli_connect_errno($this->mysqli)) {
            die('Ошибка подключения к БД');
        }
    }

    public function getAll() {
        $query = "SELECT * FROM classics ORDER BY id DESC";
        $res = mysqli_query($this->mysqli, $query);

        if (!$res) die (mysqli_error($this->mysqli));

        while ($row = mysqli_fetch_assoc($res)) { ?>
            <div class="jumbotron mt-4">
                <div class="col-sm-8 mx-auto">
                    <h1><?= $row['title']; ?></h1>
                    <p><?= $row['author']; ?></p>
                    <p>Category: <?= $row['type']; ?></p>
                    <p>Year: <?= $row['year']; ?></p>
                    <p>
                        <a class="btn btn-primary" href="?edit=ok&id=<?= $row['id']; ?>" role="button">Редактировать »</a>
                        <a class="btn btn-danger" href="?del=ok&id=<?= $row['id']; ?>" role="button">Удалить »</a>
                    </p>
                </div>
            </div>
            <?php
        }
    }

    public function delete($id) {
        $id = (int)$id;

        if (!empty($id)) {
            $query = "DELETE FROM classics WHERE id = $id";
            $res = mysqli_query($this->mysqli, $query);

            if (!$res) die (mysqli_error($this->mysqli));

            if (mysqli_affected_rows($this->mysqli) == 1) return true;
        }

        return false;
    }

    public function add($author, $title, $type, $year) {
        $author = strip_tags($author);
        $title = strip_tags($title);
        $type = strip_tags($type);
        $year = strip_tags($year);

        $query = "INSERT INTO classics (author, title, type, year) VALUES ('$author', '$title', '$type', '$year')";
        $res = mysqli_query($this->mysqli, $query);

        if (!$res) die (mysqli_error($this->mysqli));

        if (mysqli_affected_rows($this->mysqli) == 1) return true;

        return false;
    }

    public function edit($author, $title, $type, $year, $id) {
        $author = strip_tags($author);
        $title = strip_tags($title);
        $type = strip_tags($type);
        $year = strip_tags($year);
        $id = (int)$id;

        $query = "UPDATE `classics` SET `title` = '".$title."', `author` = '".$author."', `type` = '".$type."', `year` = '".$year."' WHERE `id` = $id";
        $res = mysqli_query($this->mysqli, $query);

        if (!$res) die (mysqli_error($this->mysqli));

        if (mysqli_affected_rows($this->mysqli) == 1) return true;

        return false;
    }
}