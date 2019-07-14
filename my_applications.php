<?php require_once($_SERVER['DOCUMENT_ROOT'].'/conn.php');
if( $_SESSION['auth'] == true && $_SESSION['rang'] == 1 ) {
	
    header("Location: /admin.php");
    exit;
}
elseif($_SESSION['auth'] != true )
{
  header("Location: /index.php");
  exit;
}
?>
<?php 
    $id = $_SESSION['id'];
    $query = 'SELECT*FROM applications WHERE id_users="'.$id.'"';
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
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>База заявок - "Единая книга жалоб и предложений"</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="ico.ico" rel="shortcut icon" type="image/x-icon"/>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=<63c2b744-efa1-4209-9c07-c1715c96452d>&lang=ru_RU" type="text/javascript"></script>
	  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
</body>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/header.php');?>
<main role="main">
  <div class="album py-5 bg-light">
    <div class="container">
    <h1>Мои заявки</h1>
      <div class="row">
      <?php foreach($applications as $application):?>
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
             <img src="img/<?=$application['img'];?>"  width="100%" height="225">
            <div class="card-body">
              <p class="card-text"><?=$application['address'];?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a class="btn  btn-primary btn-sm" href="/application.php?id=<?=$application['id'];?>">Подробней</a>
                </div>
                <small class="text-muted">
                <?php if($application['status']=='0'){?>
                            <p style="color: Gray; margin:10px 0px 10px 0px;">На рассмотрении</p>
                        <?php } ?>
                        <?php if($application['status']=='1'){?>
                            <p style="color: green; margin:10px 0px 10px 0px;">Принято</p>
                        <?php } ?>
                        <?php if($application['status']=='2'){?>
                            <p style="color: red; margin:10px 0px 10px 0px;">Отказано</p>
                        <?php } ?>
                </small>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</main>
</body>
</html>