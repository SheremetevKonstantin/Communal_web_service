<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/conn.php');
if( $_SESSION['auth'] != true  || $_SESSION['rang'] == 1 ) {
	
    header("Location: /index.php");
    exit;
}
?>
<?php
if(isset($_POST['add_application']))
    {
        $address = trim($_POST['address']);
        $description = trim($_POST['description']);
        $filename = uploadImage($_FILES['image']);
        $id_users = $_SESSION['id'];
        $date_today = date("d.m.y");
        $point = trim($_POST['coordinates']);
        if(!empty($_POST['address']) && !empty($_POST['coordinates']))
        {
            $query = "INSERT INTO applications(address,description,img,date,point,id_users) VALUES ('$address','$description' ,'$filename','$date_today','$point','$id_users')";
            mysqli_query($conn, $query); 
            mysqli_close($conn); 
            $msg ='Вы успешно заполнили заявку. Заявка отправлена!'; 
        }
        else
        {
            $fmsg='Заявка не отправлена. Повторите попытку!';
        }
    }  
function uploadImage($image)
{
    $extension = pathinfo($image['name'],PATHINFO_EXTENSION);
    $filename= uniqid() . "." . $extension;
    move_uploaded_file($image['tmp_name'],"img/".$filename);
    return $filename;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
    <title>Добавление заявки - "Единая книга жалоб и предложений"</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="ico.ico" rel="shortcut icon" type="image/x-icon"/>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=<63c2b744-efa1-4209-9c07-c1715c96452d>&lang=ru_RU" type="text/javascript"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<style>
        .form-signin {
        width: 100%;
        max-width: 450px;
        padding: 15px;
        margin: auto;
        }
        .form-signin .checkbox {
        font-weight: 400;
        }
        .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
        }
        .form-signin .form-control:focus {
        z-index: 2;
        }
        .form-signin input{
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        }
        .form-signin input {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        }
</style>
<body>
<!-- header -->
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/header.php'); ?>
<form class="form-signin"  action="" method="POST" enctype="multipart/form-data">
    <?if(isset($msg)){?><div class="alert alert-success"><p><?{echo $msg;}?></p></div><?}?>
    <?if(isset($fmsg)){?><div class="alert alert-danger"><p><?{echo $fmsg;}?></p></div><?}?>
    <h1 class="h3 mb-3 font-weight-normal"><strong>Оформление заявки</strong></h1>
    <label for="inputText" >Укажите месторасположение проблемы на карте</label>
    <div id="map" style="width: 100%; height: 450px ;margin-bottom: 20px;background: #f3f3f3;"></div>
    <input type="hidden"  name="address" id="address" style="margin-bottom:10px;width: 100%;">
    <input  type="hidden" name="coordinates" id="coordinates" style="margin-bottom:10px;width: 100%;">
    <p id="address_view" name="address_view" style="margin-bottom:10px;width: 100%;"></p>
    <label for="inputPassword">Уточните, где именно  расположена проблема</label>
    <textarea type="text"  name="description" class="form-control" placeholder="Введите текст" required></textarea>
    <label for="inputText" >Загрузите фотографию</label>
    <input type="file" name="image" class="form-control-file"  required>
    <button class="btn btn-lg btn-primary btn-block" name="add_application" type="submit">Отправить заявку</button>
</form>
<script src="js/event_reverse_geocode.js"></script>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/footer.php');?>
</body>
</html>