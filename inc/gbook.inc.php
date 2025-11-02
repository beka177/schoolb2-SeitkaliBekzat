<?php
  include 'inc/headers.inc.php'; 
  include 'inc/cookie.inc.php'; 
/* Основные настройки */
define('DB_HOST', 'localhost');
define('DB_LOGIN', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'gbook');

$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
if (!$link) {
    die("Ошибка подключения: " . mysqli_connect_error());
}
/* Основные настройки */

/* Сохранение записи в БД */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name  = mysqli_real_escape_string($link, trim($_POST['name']));
    $email = mysqli_real_escape_string($link, trim($_POST['email']));
    $msg   = mysqli_real_escape_string($link, trim($_POST['msg']));

    if ($name && $email && $msg) {
        $sql = "INSERT INTO msgs (name, email, msg) VALUES ('$name', '$email', '$msg')";
        mysqli_query($link, $sql) or die(mysqli_error($link));
    }
}
/* Сохранение записи в БД */

/* Удаление записи из БД */
if (isset($_GET['del'])) {
    $del = (int)$_GET['del'];
    if ($del > 0) {
        $sql = "DELETE FROM msgs WHERE id = $del";
        mysqli_query($link, $sql) or die(mysqli_error($link));
    }
}
/* Удаление записи из БД */
?>

<h3>Оставьте запись в нашей Гостевой книге</h3>

<form method="post" action="<?= $_SERVER['REQUEST_URI']?>">
Имя: <br /><input type="text" name="name" /><br />
Email: <br /><input type="text" name="email" /><br />
Сообщение: <br /><textarea name="msg"></textarea><br />
<br />
<input type="submit" value="Отправить!" />
</form>

<?php
/* Вывод записей из БД */
$sql = "SELECT id, name, email, msg, UNIX_TIMESTAMP(datetime) as dt
        FROM msgs
        ORDER BY id DESC";
$result = mysqli_query($link, $sql) or die(mysqli_error($link));

$count = mysqli_num_rows($result);
echo "<p>Всего записей в гостевой книге: $count</p>";

while ($row = mysqli_fetch_assoc($result)) {
    $id    = $row['id'];
    $name  = htmlspecialchars($row['name']);
    $email = htmlspecialchars($row['email']);
    $msg   = nl2br(htmlspecialchars($row['msg']));
    $dt    = date("d-m-Y H:i:s", $row['dt']);

    echo "<p><a href='mailto:$email'>$name</a> $dt<br />$msg</p>";
    echo "<p align='right'><a href='index.php?id=gbook&del=$id'>Удалить</a></p>";
}

mysqli_close($link);
/* Вывод записей из БД */
