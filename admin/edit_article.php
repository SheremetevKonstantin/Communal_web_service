﻿<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/conn.php');
if( $_SESSION['auth'] != true && $_SESSION['rang'] != 1 ) {
	
    header("Location: /index.php");
    exit;
}
?>
<?php
$id=$_GET['id'];
$query = 'SELECT*FROM blog WHERE id="'.$id.'"';
$article  = array();
if ($result = mysqli_query($conn,$query)) 
{
    while ($row = mysqli_fetch_assoc($result)) 
    {
        $article [] =$row;
    }
}
function uploadFile($FILE) {
  // Папка сохранения
  $uploaddir = '/img/';
  // Название файла
  $file_name = hash('md5', time() . basename($FILE['name']));
  // Тип файла
  $file_type = explode(".", basename($FILE['name']));
  $file_type = $file_type[ count($file_type) - 1 ];
  // Полное название файла
  $uploadfile = $uploaddir . $file_name . "." . $file_type;
  // Сохранение файла
  if (move_uploaded_file($FILE['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $uploadfile)) {
      // Возвращает путь к файлу
      return $uploadfile;
  }
  else {
      return false;
  }
}
  if(isset($_POST['edit_article']))
  {
    $description = trim($_POST['description']);
    $article = trim($_POST['article']);
    $filename = uploadFile($_FILES['image']);
    $query = "UPDATE blog SET description = '$description', article = '$article', img = '$filename'  WHERE id='$id' ";
    mysqli_query($conn, $query); 
    $msg ='Вы успешно изменили новость!';
    $query = 'SELECT*FROM blog WHERE id="'.$id.'"';
    $article  = array();
    if ($result = mysqli_query($conn,$query)) 
    {
        while ($row = mysqli_fetch_assoc($result)) 
        {
            $article [] =$row;
        }
    }
    //header("Location: /edit_blog.php");
    mysqli_close($conn);
  }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактирование - "Единая книга жалоб и предложений"</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="ico.ico" rel="shortcut icon" type="image/x-icon"/>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=<63c2b744-efa1-4209-9c07-c1715c96452d>&lang=ru_RU" type="text/javascript"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<?php  require_once($_SERVER['DOCUMENT_ROOT'].'/admin/header_admin.php'); ?>
<div class="container">
<div class="row">
  <!-- Post Content Column -->
  <div class="col-lg-8">
  <?if(isset($msg)){?><div style="margin-top:20px;" class="alert alert-success"><p><?{echo $msg;}?></p></div><?}?>
<form  action="" method="POST"  enctype="multipart/form-data"> 
  <h2>Редактировать новость</h2>
  <hr>
        <!-- Title -->
        <h5>Заголовок новости</h5>
        <textarea  class="form-control" type="text" placeholder="Введите текст" name="description" required maxlength="32"><?=$article[0]['description'];?></textarea >
        <h1 class="mt-4"><?=$article['description'];?></h1>
        <hr>
        <h5>Статья</h5>
        <textarea  class="form-control" style="height:400px;" type="text" placeholder="Введите текст" name="article" required><?=$article[0]['article'];?></textarea >
        <hr>
        <p class="lead"><?=$article['description'];?></p>
        <hr>
        <p style="margin:10px 0px 10px 0px;font-size:18px;">Загрузите фотографию новости<p>
        <input type="file" name="image" required>
        <hr>
        <button class="btn  btn-primary btn-lg" name="edit_article" type="submit">Редактировать новость</button>
    </form>
     </div>
    </div>
  </div>
</body>
</html>