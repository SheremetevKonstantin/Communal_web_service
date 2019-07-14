<?php require_once($_SERVER['DOCUMENT_ROOT'].'/conn.php'); ?>
<?php 
if(isset($_POST['authorization']))
{
    $mail=trim($_POST['mail']);
    $password=trim($_POST['password']);
    $query = 'SELECT*FROM users WHERE mail="'.$mail.'"';
    $result = mysqli_query($conn,$query);
    $user = mysqli_fetch_assoc($result); 

    mysqli_close($conn);
    if (!empty($user)) 
    {
        $salt = $user['salt'];

        $saltedPassword = hash('sha256',$password.$salt);
        if ($user['pass'] == $saltedPassword) 
        {
            $msg ='Вы успешно авторизировались';
            $_SESSION['auth'] = true; 

			$_SESSION['id'] = $user['id']; 
            $_SESSION['mail'] = $user['mail'];
            $_SESSION['name'] = $user['name_user']; 
            $_SESSION['lastname'] = $user['lastname'];
            $_SESSION['rang']=$user['rang'];
            if($_SESSION['rang']==1)
            {
                header("Refresh:0; url=/admin/view_applications.php"); 
            }
            else
            {
                header("Refresh:0; url=/index.php"); 
            }
        }
        else
        {
            $fmsg = 'Неправильный пароль';
        } 
    } 
    else
    {
        $fmsg = 'Неправильный логин или пароль';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
    <title>Авторизация - "Единая книга жалоб и предложений"</title>
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
    <h1 class="h3 mb-3 font-weight-normal">Авторизация</h1>
    <label for="inputEmail" class="sr-only">Введите Email</label>
    <input type="email" id="inputEmail" class="form-control" name="mail" placeholder="Введите Email" required autofocus>
    <label for="inputPassword" class="sr-only">Введите пароль</label>
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Введите пароль" required>
    <button class="btn btn-lg btn-primary btn-block" name="authorization" type="submit">Войти</button>
    <p style="text-align: center; margin-top: 20px;"><a class="link" href="/registration.php">Регистрация</a></p>
</form>
</body>
</html>