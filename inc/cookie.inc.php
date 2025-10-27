<?php
// Счётчик посещений
$visitCounter = 0;
if (isset($_COOKIE['visitCounter'])) {
  $visitCounter = (int)$_COOKIE['visitCounter'];
}
$visitCounter++;

// Последний визит
$lastVisit = "";
if (isset($_COOKIE['lastVisit'])) {
  $lastVisit = date("d-m-Y H:i:s", $_COOKIE['lastVisit']);
}

// Устанавливаем куки
setcookie("visitCounter", $visitCounter, time() + 3600*24*30);

// Куки lastVisit обновляем только раз в день
if (!isset($_COOKIE['lastVisit']) || date('d-m-Y', $_COOKIE['lastVisit']) != date('d-m-Y')) {
  setcookie("lastVisit", time(), time() + 3600*24*30);
}
?>
