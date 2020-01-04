<?php
ob_start();
session_start();
date_default_timezone_set("Asia/Bangkok");
include_once 'config/connection.php';
include_once 'config/function.php';

// $_SESSION['name'] = 'sutida';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Document</title>
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-pro/css/all.min.css">
  <link rel="stylesheet" href="public/css/custom.css">
  <style>
    .container {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
    }

    a:hover {
      text-decoration: none;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6">
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-sm-4">
        <div class="card shadow">
          <div class="card-body">
            <h4 class="my-4 text-center">เข้าสู่ระบบ</h4>
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-user"></i></div>
                </div>
                <input type="text" class="form-control" id="txtuser" name="username" placeholder="ชื่อผู้ใช้งานระบบ">
              </div>
            </div>
            <div class="form-group" id="margin-bottom-pass" >
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-key"></i></div>
                </div>
                <input type="password" class="form-control" id="txtpass" name="password" placeholder="รหัสผ่าน">
              </div>
            </div>
            <div class="form-group" style="margin-bottom: 7px;text-align: right;" >
              <small id="small_err" class="text-muted" hidden>
                <font color="red">ชื่อผู้ใช้หรือรหัสไม่ถูกต้อง</font>
              </small>
            </div>

            <div class="form-group">
              <button class="btn btn-success btn-sm btn-block" id="btnLogin" name="btnLogin">
                <i class="fa fa-check pr-2"></i>เข้าสู่ระบบ
              </button>
            </div>
            <!-- <div class="form-group row justify-content-center">
              <a href="javascript:void(0)" data-toggle="modal" data-target="#forgotModal">
                <i class="fa fa-user-times pr-2"></i>ลืมรหัสผ่าน?
              </a>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="forgotModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header mx-auto">
          <h5 class="modal-title">ลืมรหัสผ่าน?</h5>
        </div>
        <div class="modal-body">
          <div class="row justify-content-center">
            <div class="col-sm-8">
              <form action="?act=forgot" method="POST">
                <div class="form-group row">
                  <div class="col-sm-12">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                      </div>
                      <input type="email" class="form-control" name="email" placeholder="E-Mail">
                    </div>
                  </div>
                </div>
                <div class="form-group row justify-content-center">
                  <div class="col-sm-6 pb-2">
                    <button class="btn btn-success btn-sm btn-block" name="btnForgot">
                      <i class="fa fa-check pr-2"></i>ยืนยัน
                    </button>
                  </div>
                  <div class="col-sm-6 pb-2">
                    <button class="btn btn-danger btn-sm btn-block" data-dismiss="modal">
                      <i class="fa fa-times pr-2"></i>ปิด
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="public/js/main.min.js"></script>
</body>

<script>
  $(document).ready(function() {
    var input = document.getElementById("txtpass");
    var uid;
    input.addEventListener("keyup", function(event) {
      if (event.keyCode === 13) {
        event.preventDefault();
        document.getElementById("btnLogin").click();
      }
    });

    //check Username Password
    $('#btnLogin').click(function() {
      var user = $('#txtuser').val();
      var pass = $('#txtpass').val();
      if (user === 'sutida' && pass === 'panrodcrm01') {
        uid = "ADMIN";
        ajax_login();
      } else if (user === '1234' && pass === '1234') {
        uid = "Super Admin";
        ajax_login();
      } else {
        uid = "err"
        $('#txtuser').val("");
        $('#txtpass').val("");
        $('#margin-bottom-pass').attr("style" , "margin-bottom: 7px");
        document.getElementById('small_err').hidden = false;
      }
    });

    function ajax_login() {
      $.ajax({
        type: "POST",
        url: 'login.php?uid=' + uid,
        data: "",
        success: function(result) {
          // alert(result.status);
          $('#margin-bottom-pass').attr("style" , "margin-bottom: 16px");
          document.getElementById('small_err').hidden = true;
          window.location.replace("page/listshop.php");
        }
      });

    }
  });
</script>

</html>