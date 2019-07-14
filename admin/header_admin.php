<?php require_once($_SERVER['DOCUMENT_ROOT'].'/conn.php');
if( $_SESSION['auth'] == true && $_SESSION['rang'] == 0 ) {
	
    header("Location: /");
    exit;
}
?>
<header>
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">О нас</h4>
          <p class="text-muted"> За состоянием благоустройств улиц в Правдинске отвечает ООО "Коммунальщик".
                    Работники  плохо справляются со своей работой — и поэтому
                    улицы далеки от совершенства. Мы создали "Единую книгу жалоб и предложений" именно для того, чтобы улучшить состояния улиц. 
                    Мы знаем, как составить обращение, куда
                    отправить жалобу. С 2019 года "Единая книга жалоб и предложений" делает улицы лучше.
                    Присоединяйтесь.</p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">Меню</h4>
          <ul class="list-unstyled">
            <li><a href="view_applications.php" class="text-white">Заявки</a></li>
            <li><a href="statistics.php" class="text-white">Статистика</a></li>
            <li><a href="edit_blog.php" class="text-white">Редактирование статей</a></li>
            <li><a href="create_article.php" class="text-white">Создать статью</a></li>
            <li><a href="/logout.php" class="text-white">Выход</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between">
      <a href="#" class="navbar-brand d-flex align-items-center">
        <strong>Административная панель</strong>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>
