<?php    require_once($_SERVER['DOCUMENT_ROOT'].'/conn.php');
if( $_SESSION['auth'] != true && $_SESSION['rang'] != 1 ) {
	
    header("Location: /index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Статистика - "Единая книга жалоб и предложений"</title>
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

    $query = 'SELECT COUNT(*) FROM applications';
    $res = mysqli_query($conn,$query);
    $row = mysqli_fetch_row($res);
    $total = $row[0]; 

    $query = 'SELECT COUNT(*) FROM applications WHERE status =1';
    $res = mysqli_query($conn,$query);
    $row = mysqli_fetch_row($res);
    $total_complied = $row[0];

    $query = 'SELECT COUNT(*) FROM applications WHERE status =0';
    $res = mysqli_query($conn,$query);
    $row = mysqli_fetch_row($res);
    $total_deal = $row[0];

    $query = 'SELECT COUNT(*) FROM applications WHERE status =2';
    $res = mysqli_query($conn,$query);
    $row = mysqli_fetch_row($res);
    $total_close = $row[0];

    mysqli_close($conn);
?> 
<?php  require_once($_SERVER['DOCUMENT_ROOT'].'/admin/header_admin.php'); ?>

<table class="table" style="margin-top: 20px;">
  <thead>
    <tr>
      <th scope="col">Общее количество поданных обращений</th>
      <th scope="col">Проделанная работа</th>
      <th scope="col">Отклонено обращений</th>
      <th scope="col">Количество рассматриваемых обращений</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?=$total;?></td>
      <td><?=$total_complied;?></td>
      <td><?=$total_close;?></td>
      <td><?=$total_deal;?></td>
    </tr>
  </tbody>
</table>
<div id="container" style="width:100%; height:500px;"></div>
    <script src="https://cdn.anychart.com/js/latest/anychart-bundle.min.js"></script>
    <script>
      anychart.onDocumentLoad(function() {
  // create chart and set data
  var chart = anychart.pie([
    ["Проделанная работа", <?=$total_complied;?>],
    ["Отклонено обращений", <?=$total_close;?>],
    ["Количество рассматриваемых обращений",<?=$total_deal;?> ],
  ]);
  // set chart title
  chart.title("Общая статистика");
  // set chart container and draw
  chart.container("container").draw();
});
    </script>
</body>
</html>
