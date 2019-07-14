<?php 
//подключение файла для работы с бд
require_once($_SERVER['DOCUMENT_ROOT'].'/conn.php');
?>
<?php 
//проверка на нажатие кнопки
if(isset($_POST['registration']))
{ 
        //забираем данные с формы
       $name_user = trim($_POST['name']);
       $lastname = trim($_POST['lastname']);
       $mail = trim($_POST['mail']);
       $password = trim($_POST['password']);
       $rang =0;
       $query = 'SELECT*FROM users WHERE mail="'.$mail.'"';
       $isLoginFree = mysqli_fetch_assoc(mysqli_query($conn,$query));
       if (empty($isLoginFree)) 
       {
            $salt = generateSalt(); //генерируем соль
            $saltedPassword = hash('sha256',$password.$salt); //соленый пароль
            $query = "INSERT INTO users(name_user,lastname,mail,pass,salt,rang) VALUES ('$name_user','$lastname' ,'$mail','$saltedPassword','$salt','$rang')";
            mysqli_query($conn, $query); 
            mysqli_close($conn);
            $msg ='Вы успешно зарегистрированы!';
            //header('Location: /authorization.php');  
            header("Refresh:0; url=/authorization.php"); 
       }
       else 
       {
            $fmsg ='Такая почта  уже занят!';
       } 
}
function generateSalt()
{
    $salt = '';
    $saltLength = 8;
    for($i=0; $i<$saltLength; $i++) {
        $salt .= chr(mt_rand(33,126)); 
    }
    return $salt;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
    <title>Регистрация - "Единая книга жалоб и предложений"</title>
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
    <!-- header -->
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/header.php'); ?> 
    <style>
        .form-signin {
        width: 100%;
        max-width: 330px;
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
<form class="form-signin"  action="" method="POST">
    <?if(isset($msg)){?><div class="alert alert-success"><p><?{echo $msg;}?></p></div><?}?>
    <?if(isset($fmsg)){?><div class="alert alert-danger"><p><?{echo $fmsg;}?></p></div><?}?>
    <h1 class="h3 mb-3 font-weight-normal">Регистрация</h1>
    <label for="inputEmail" class="sr-only">Введите Имя</label>
    <input type="text" class="form-control"  name="name"   placeholder="Введите имя">
    <label for="inputEmail" class="sr-only">Введите Фамилию</label>
    <input type="text" class="form-control"  name="lastname"   placeholder="Введите фамилию">
    <label for="inputEmail" class="sr-only">Введите Email</label>
    <input type="email"  class="form-control" name="mail" placeholder="Введите Email" required autofocus>
    <label for="inputPassword" class="sr-only">Введите пароль</label>
    <input type="password"  name="password" class="form-control" placeholder="Введите пароль" required>
    <button class="btn btn-lg btn-primary btn-block" name="registration" type="submit">Зарегистрироваться</button>
    <p style="text-align: center; margin-top: 20px;"><a class="link" href="/authorization.php">Авторизация</a></p>
</form>
</body>
</html>