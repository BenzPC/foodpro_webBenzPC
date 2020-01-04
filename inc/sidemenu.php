<nav class="col-xl-2 col-md-3 d-none d-md-block sidebar">
  <div class="sidebar-sticky">
    <ul class="nav flex-column">
      <li class="nav-item">
        <!-- <img class="nav-link img-fluid picture-profile mx-auto d-block"
          src="" alt=""> -->
      </li>
      <li class="nav-item">
        <h4 class="nav-link text-center">
          <?php echo $_SESSION['name']; ?>
        </h4>
      </li>
      <?php
      $request = strpos($_SERVER['PHP_SELF'], "request.php");
      $view = strpos($_SERVER['PHP_SELF'], "view.php");
      $manage = strpos($_SERVER['PHP_SELF'], "manage.php");
      $category = strpos($_SERVER['PHP_SELF'], "category.php");
      $service = strpos($_SERVER['PHP_SELF'], "service.php");
      $status = strpos($_SERVER['PHP_SELF'], "status.php");
      $dashboard = strpos($_SERVER['PHP_SELF'], "dashboard.php");
      $profile = strpos($_SERVER['PHP_SELF'], "profile.php");
      $chgpwd = strpos($_SERVER['PHP_SELF'], "change_pwd.php");
      $departments = strpos($_SERVER['PHP_SELF'], "departments.php");
      $log = strpos($_SERVER['PHP_SELF'], "log.php");
      $users = strpos($_SERVER['PHP_SELF'], "users.php");
      $computers = strpos($_SERVER['PHP_SELF'], "computers.php");
      $software = strpos($_SERVER['PHP_SELF'], "software.php");
      $system = strpos($_SERVER['PHP_SELF'], "system.php");
      // $check_level = getUserLevel($_SESSION['user_code']);
      $check_level = strpos($_SERVER['PHP_SELF'], "system.php");

      ?>
      <li class="nav-item" >
        <a class="nav-link" data-toggle="collapse" id="Asub_dashboard" href="#">
          <i class="fas fa-users px-2" id="ISsub_dashboard"></i>
          SHOP
          <i class="fas fa-angle-<?php echo ($profile || $chgpwd ? 'down' : 'down') ?> px-3" id="Isub_dashboard"></i>
        </a>
        <div id="sub_dashboard" class="collapse <?php if ($profile || $chgpwd) echo ''; ?>">
          <ul class="nav flex-column">
            <li class="nav-item <?php if ($profile) echo 'active' ?>">
              <a class="nav-link sub-menu" href="listshop.php">
                <small>
                  <i class="fas fa-list px-2"></i>
                  List Shop
                </small>
              </a>
            </li>
            <li class="nav-item <?php if ($profile) echo 'active' ?>">
              <!-- <a class="nav-link sub-menu" href="addshop.php"> -->
              <a class="nav-link sub-menu" href="detailshop.php">
                <small>
                  <i class="fas fa-clipboard-check px-2" ></i>
                  Add Shop
                </small>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item" >
        <a class="nav-link" data-toggle="collapse" id="Asub_dashboard2" href="#">
          <i class="fas fa-file-alt px-2" id="ISsub_dashboard2"></i>
          CATEGORY
          <i class="fas fa-angle-<?php echo ($profile || $chgpwd ? 'down' : 'down') ?> px-3" id="Isub_dashboard2"></i>
        </a>
        <div id="sub_dashboard2" class="collapse <?php if ($profile || $chgpwd) echo ''; ?>">
          <ul class="nav flex-column">
            <li class="nav-item <?php if ($profile) echo 'active' ?>">
              <a class="nav-link sub-menu" href="Manageparts.php">
                <small>
                  <i class="fas fa-list px-2"></i>
                  List Category
                </small>
              </a>
            </li>
            <li class="nav-item <?php if ($chgpwd) echo 'active' ?>">
              <a class="nav-link sub-menu" href="software.php">
                <small>
                  <i class="fas fa-clipboard-check px-2"></i>
                  Add Category
                </small>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" id="Asub_dashboard3" href="#">
          <i class="far fa-file-alt px-2" id="ISsub_dashboard3"></i>
          SUB CATEGORY
          <i class="fas fa-angle-<?php echo ($profile || $chgpwd ? 'down' : 'down') ?> px-3" id="Isub_dashboard3"></i>
        </a>
        <div id="sub_dashboard3" class="collapse <?php if ($profile || $chgpwd) echo ''; ?>">
          <ul class="nav flex-column">
            <li class="nav-item <?php if ($profile) echo 'active' ?>">
              <a class="nav-link sub-menu" href="listsubcate.php">
                <small>
                  <i class="fas fa-list px-2"></i>
                  List Sub Category
                </small>
              </a>
            </li>
            <li class="nav-item <?php if ($chgpwd) echo 'active' ?>">
              <a class="nav-link sub-menu" href="addsubcate.php">
                <small>
                  <i class="fas fa-clipboard-check px-2"></i>
                  Add Sub Category
                </small>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" id="Asub_dashboard4" href="#">
          <i class="fas fa-tag px-2" id="ISsub_dashboard4"></i>
          SUB TYPE CATEGORY
          <i class="fas fa-angle-<?php echo ($profile || $chgpwd ? 'down' : 'down') ?> px-3" id="Isub_dashboard4"></i>
        </a>
        <div id="sub_dashboard4" class="collapse <?php if ($profile || $chgpwd) echo ''; ?>">
          <ul class="nav flex-column">
            <li class="nav-item <?php if ($profile) echo 'active' ?>">
              <a class="nav-link sub-menu" href="listtypecate.php">
                <small>
                  <i class="fas fa-list px-2"></i>
                  List Type Category
                </small>
              </a>
            </li>
            <li class="nav-item <?php if ($chgpwd) echo 'active' ?>">
              <a class="nav-link sub-menu" href="addtypecate.php">
                <small>
                  <i class="fas fa-clipboard-check px-2"></i>
                  Add Type Category
                </small>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" id="Asub_dashboard5" href="#" >
          <i class="fas fa-box px-2" id="ISsub_dashboard5"></i>
          UNIT
          <i class="fas fa-angle-<?php echo ($profile || $chgpwd ? 'up' : 'down') ?> px-3" id="Isub_dashboard5"></i>
        </a>
        <div id="sub_dashboard5" class="collapse <?php if ($profile || $chgpwd) echo ''; ?>">
          <ul class="nav flex-column">
            <li class="nav-item <?php if ($profile) echo 'active' ?>">
              <a class="nav-link sub-menu" href="listunit.php">
                <small>
                  <i class="fas fa-list px-2"></i>
                  List Unit
                </small>
              </a>
            </li>
            <li class="nav-item <?php if ($chgpwd) echo 'active' ?>">
              <a class="nav-link sub-menu" href="addunit.php">
                <small>
                  <i class="fas fa-clipboard-check px-2"></i>
                  Add Unit
                </small>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <?php if ($check_level == 69 || $check_level == 99) : ?>
      <?php endif; ?>
    </ul>
  </div>
</nav>
<script type="text/javascript" language="javascript">
  $(document).ready(function() {
    
    $("#Asub_dashboard").click(function() {
      var element = document.getElementById("sub_dashboard");
      var element2 = document.getElementById("Isub_dashboard");
      classshow(element , element2 );
    });
    $("#Asub_dashboard2").click(function() {
      // var element = document.getElementById("sub_dashboard2");
      // var element2 = document.getElementById("Isub_dashboard2");
      // classshow(element , element2 );
    });
    $("#Asub_dashboard3").click(function() {
      var element = document.getElementById("sub_dashboard3");
      var element2 = document.getElementById("Isub_dashboard3");
      classshow(element , element2 );
    });
    $("#Asub_dashboard4").click(function() {
      var element = document.getElementById("sub_dashboard4");
      var element2 = document.getElementById("Isub_dashboard4");
      classshow(element , element2 );
    });
    $("#Asub_dashboard5").click(function() {
      var element = document.getElementById("sub_dashboard5");
      var element2 = document.getElementById("Isub_dashboard5");
      classshow(element , element2 );
    });


    function classshow(element , element2) {
      var QQ = element.classList.contains("show");
      if (QQ) {
        element.classList.remove("show");
        element2.classList.add("fa-angle-down");
        element2.classList.remove("fa-angle-up");
      } else {
        element.classList.add("show");
        element2.classList.remove("fa-angle-down");
        element2.classList.add("fa-angle-up");
      }
    }


  });
</script>