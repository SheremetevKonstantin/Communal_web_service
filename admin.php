<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/conn.php'); 
// Проверка прав администратора
if ($_SESSION['rang'] == 1 ) {
    //Переход на страницу заявок
    header('Location: admin/view_applications.php');
    exit();
}
// Переход на главную страницу
header("Location: /");