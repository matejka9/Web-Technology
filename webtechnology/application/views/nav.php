
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="home">WebSiteName</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><?= anchor('home','Home', 'id="home" class="active"') ?></li>
        <li><?= anchor('menu','Daily menu', 'id="menu"') ?></li>
        <li><?= anchor('reservation','Reservation', 'id="reservation"') ?></li>
        <li><?= anchor('contact','Contact', 'id="contact"') ?></li>
      </ul>
    </div>
  </div>
</nav>