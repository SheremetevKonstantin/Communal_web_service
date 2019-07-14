<?php     
require_once($_SERVER['DOCUMENT_ROOT'].'/conn.php');
if( $_SESSION['auth'] != true && $_SESSION['rang'] != 1 ) {
	
    header("Location: /");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Просмотр зявок - "Единая книга жалоб и предложений"</title>
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
    $query = 'SELECT*FROM applications';
    $applications  = array();
    if ($result = mysqli_query($conn,$query)) 
    {
        while ($row = mysqli_fetch_assoc($result)) 
        {
            $applications [] =$row;
        }
    }
    mysqli_close($conn);
?> 
<?php  require_once($_SERVER['DOCUMENT_ROOT'].'/admin/header_admin.php'); ?>
<table class="table" style="margin-top: 20px;">
  <thead>
    <tr>
      <th scope="col">Номер зявки</th>
      <th scope="col">Адрес</th>
      <th scope="col">Описание проблемы</th>
      <th scope="col">Фото</th>
      <th scope="col">Дата заявки</th>
      <th scope="col">Статус заявки</th>
      <th scope="col">Изменить статус</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($applications as $application){?>
    <tr>
      <th scope="row"><?=$application['id'];?></th>
      <td style="width:250px;"><?=$application['address'];?></td>
      <td><?=$application['description'];?></td>
      <td><img src="/img/<?=$application['img'];?>"  width="270" height="170"></td>
      <td><?=$application['date'];?></td>
      <td><?php if($application['status']=='0'){?>
                    <h3 style="color: Gray;">На рассмотрении</h3>
                <?php } ?>
                <?php if($application['status']=='1'){?>
                    <h3 style="color: green;">Принято</h3>
                <?php } ?>
                <?php if($application['status']=='2'){?>
                    <h3 style="color: red;">Отказано</h3>
                <?php } ?></td>
      <td><a href="view_application.php?id=<?=$application['id'];?>">Изменить</a></td>
    </tr>
    <?php } ?>
  </tbody>
</table>

</body>
</html>
