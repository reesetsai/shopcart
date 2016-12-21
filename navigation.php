  <!-- navbar -->
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">各項作品</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="./news.php">最新消息</a></li>
        <li><a href="./goods.php?type=all">作品一覽</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">服務據點<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">實體店面</a></li>
            <li><a href="#">常見問題</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" action ="search.php?" method="get">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search" name="search">
        </div>
        <button type="submit" class="btn btn-default">搜尋</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <?php if($_SESSION['user']){ 
              echo "<li><a href='cart.php'>購物車</a></li>";
              } ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">會員專區 <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">會員資料</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <?php if($_SESSION['user']){ 
            	echo "<li><a href='logout.php'>登出</a></li>";
             }else{
             	echo "<li><a href='login.php'>登入</a></li>";
             }
             ?>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- /navbar -->