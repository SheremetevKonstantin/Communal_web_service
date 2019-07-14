<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/conn.php');
if( $_SESSION['auth'] != true && $_SESSION['rang'] != 1 ) {
	
    header("Location: /index.php");
    exit;
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
<?php
    $query = 'SELECT*FROM blog';
    $blog  = array();
    if ($result = mysqli_query($conn,$query)) 
    {
        while ($row = mysqli_fetch_assoc($result)) 
        {
            $blog [] =$row;
        }
    }
    mysqli_close($conn);
?> 
<?php  require_once($_SERVER['DOCUMENT_ROOT'].'/admin/header_admin.php'); ?>
<table class="table" style="margin-top: 20px;">
  <thead>
    <tr>
      <th scope="col">Название статьи</th>
      <th scope="col">Текст статьи</th>
      <th scope="col">Картинка</th>
      <th scope="col">Удаление статьи</th>
      <th scope="col">Редактирование статьи</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($blog as $article){?>
    <tr>
    <form action="edit_article" method="POST">
    <th scope="row"><?=$article['description'];?></th>
    <td style="width:400px;"><?=$article['article'];?></td>
    <td>
        <img src="<?=$article['img'];?>"  width="270" height="170">
    </td>
    <td><a href="/admin/del_article.php?id=<?=$article['id'];?>">Удалить</a></td>
    <td><a href="/admin/edit_article.php?id=<?=$article['id'];?>">Редактировать</a></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</body>
</html>