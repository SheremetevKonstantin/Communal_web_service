<?php     
require_once($_SERVER['DOCUMENT_ROOT'].'/conn.php');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
    <title>Заявка - "Единая книга жалоб и предложений"</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="ico.ico" rel="shortcut icon" type="image/x-icon"/>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=<63c2b744-efa1-4209-9c07-c1715c96452d>&lang=ru_RU" type="text/javascript"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        $id =$_GET['id'];
        $query = 'SELECT*FROM blog WHERE id="'.$id.'"';
        $blog[] = mysqli_fetch_assoc(mysqli_query($conn,$query));
    ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/header.php');?>
<div class="container">
<div class="row">
  <!-- Post Content Column -->
  <?php foreach($blog as $article):?>
  <div class="col-lg-8">
        <!-- Title -->
        <h1 class="mt-4">Новость: <?=$article['description'];?></h1>
        <hr>
        <img class="img-fluid rounded" src="<?=$article['img'];?>" alt="">
        <hr>
        <p class="lead"><?=$article['article'];?></p>
        <hr>
     </div>
     <?php endforeach; ?>
    </div>
  </div>
  <?php require_once($_SERVER['DOCUMENT_ROOT'].'/footer.php');?>
</body>
</html>