<nav class="navbar navbar-expand-md bg-light navbar-light">
<a class="navbar-brand text-primary" href="#">KJC REPORTS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button> 
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
     <?php if($_SESSION['role'] == 'Staff') {?>
      <li class="nav-item">
        <a class="nav-link bg-danger text-white" href="genrep.php?deptid=<?php if(isset($_GET['deptid'])) echo $_GET['deptid']; ?>">REPORT</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white bg-primary" href="sessionclose.php">LOGOUT</a>
      </li> 
    <?php } 
    elseif($_SESSION['role'] == 'Student'){?>

<li class="nav-item">
        <a class="nav-link text-white bg-primary" href="sessionclose.php">LOGOUT</a>
      </li> 
    <?php }?>

    </ul>
  </div> 
</nav>