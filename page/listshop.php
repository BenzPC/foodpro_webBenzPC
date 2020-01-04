<?php
ob_start();
session_start();
date_default_timezone_set("Asia/Bangkok");
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once '../config/connection.php';
include_once '../config/function.php';


$configs = include('../config/constants.php');
$url_global = $configs['url_global'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (empty($_SESSION['name'])) {
  header('Location: ../');
}

// $user_level = getUserLevel($_SESSION['user_code']);
// if(!isset($_SESSION['user_code']) || ($user_level == 1 || empty($user_level))){
//   alertMsg('danger','ไม่พบหน้านี้ในระบบ','request.php');
// }

$act = isset($_GET['act']) ? $_GET['act'] : 'index';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Document</title>
  <?php include_once '../inc/meta.php' ?>


</head>

<body>
  <?php include_once '../inc/navbar.php' ?>

  <div class="container-fluid">
    <div class="row">
      <?php include_once '../inc/sidemenu.php' ?>
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card">
              <div class="card-header" style="margin-bottom: 10px;">
                <h5 class="text-center">รายชื่อ Shop </5>
              </div>
              <!-- Table -->
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="data2" name="data2" class="table table-bordered table-hover " style="width: 100%;">
                      <thead>
                        <tr>
                          <th>ลำดับ</th>
                          <th>ชื่อร้าน</th>
                          <th>ที่อยู่ร้าน</th>
                          <th>เขต / อำเภอ</th>
                          <!-- <th>อำเภอ</th> -->
                          <th>จังหวัด</th>
                          <th>อีเมล</th>
                          <th>เบอร์โทรศัพท์</th>
                          <th>สถานะร้านค้า</th>
                          <th>สินค้า </th>
                          <th>แก้ไขข้อมูล</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>




  <script type="text/javascript" language="javascript">
    $(document).ready(function() {
      $("#ISsub_dashboard").attr('style', "color : brown");

      $('#btndetail').click(function() {
        console.log("iooioioioioi");
      });

      const url_global = '<?= $url_global ?>';
      const urll = url_global + '/api/v1_0/master/getlistshop'
      console.log(url_global)

      var tablePropertygroup1 = $('#data2').DataTable({


        "ajax": {
          "url": urll,
          "dataSrc": "RESULT",
          "bPaginate": true,
          "bProcessing": true
        },
        //nexpang แสงหน้าต่อไป
        "paging": true, //false, // เปิด/ปิดสถานะให้สามารถเปลียนหน้าเพจของdatatabelได้
        "iDisplayLength": 15, //กำหนดแถวข้อมูลที่จะแสดง
        "aLengthMenu": [
          [15, 20],
          [15, 20]
        ], //กำหนดdropdownว่าจะให้แสดงได้กี่แถวบ้าง
        "bFilter": false,
        "bLengthChange": false,
        //end nexpang แสงหน้าต่อไป
        "searching": true,
        "select": true,
        "fixedHeader": true,
        "language": {
          "emptyTable": "My Custom Message On Empty Table"
        },
        "select": {
          "rows": {
            "_": "",
            "0": "",
            "1": ""
          }
        },
        "oLanguage": {
          "sEmptyTable": "My Custom Message On Empty Table"
        },
        "columnDefs": [{
          "searchable": false,
          "orderable": false,
          "targets": 0
        }],

        "columns": [

          // dt.rows().count()
          {
            "data": null
          },

          // { "data": "SHOP_CODE" },
          {
            "data": "SHOP_NAME_TH"
          },
          {
            "data": "SHOP_ADDRESS_NO"
          },
          {
            "data": "DISTRICT_NAME_TH"
          },
          // { "data": "order_longti" },
          {
            "data": "PROVINCE_NAME_TH"
          },
          //แก้ไข ลบ
          // { "data": "order_id",render: function (data, type, row) {
          //   console.log(data);

          //         return '<a href=?act=edit&id='+row.order_id+' class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a> <a href=?act=delete&id='+row.order_id+' class="btn btn-info btn-sm"><i class="fas fa-trash-alt"></i></a>';
          // }},
          {
            "data": "SHOP_EMAIL"
          },

          {
            "data": "SHOP_PHONE"
          },

          {
            "data": "SHOP_STATUS",
            render: function(data, type, row) {
              if (data == 2) {
                return '<font class = "text-success" color="red">เปิดใช้งาน</font>';

              } else if (data == 0) {
                return '<font color="red">ปิดใช้งาน</font>';

              }
              // return 'das';

            }
          },

          {
            "data": "SHOP_CODE",
            render: function(data, type, row) {
              // console.log("DUCK"+row.SHOP_PHONE);
              var SO_CODE = row.SHOP_CODE;
              

              return '<a   href="itemvendor.php?SO=' + SO_CODE + '&SH_NAME='+ row.SHOP_NAME_TH +'"  class="btn btn-info btn-sm"><i class="fas fa-book"></i></a> ';
              // console.log(SO_CODE);
              // return '<a  href=?act=edit&id='+row.SHOP_PHONE+' onclick="myFuntion('+row.SHOP_NAME_TH+')" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a> ';
              // return '<button  class="btn btn-primary btn-sm ml-2 fas fa-info-circle" data-toggle="modal" data-target="#exampleModalLong" onclick="myFuntion('+row.SHOP_EMAIL+')"> รายละเอียด</button>';    //  SO_CODE                                   
              // return '<button   onclick="myFuntion('+"'"+SO_CODE+"'"+')"> รายละเอียด</button>';    //  SO_CODE                                   

              // return '<a onclick="myFuntion('+row.SHOP_EMAIL+')" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a> ';
            }
          },

          {
            "data": "SHOP_CODE",
            render: function(data, type, row) {
              // console.log("DUCK"+row.SHOP_PHONE);
              let SO_CODE = row.SHOP_CODE;
              sessionStorage.setItem("duck", "Smith");
              // console.log(SO_CODE);

              // return '<button class="fas fa-edit btn btn-warning btn-sm"  id="btndetail" name="btndetail"> </button>';    //  SO_CODE                                   


              <?php
              //                     $x = 5;
              //   // ob_start();
              //   // session_start();
              //   // echo "Views: NOT SET";
              //           // "' + userName + '";
              //   $_SESSION['duck'] = 'x';


              //  
              ?>

              return '<a  href="detailshop.php?SO=' + SO_CODE + '"  class="btn btn-warning btn-sm" ><i id="btn_seedetail" name="btn_seedetail" class="fas fa-edit"></i></a> ';

              // return '<a  onclick="myFuntion('+"'"+SO_CODE+"'"+')" class="btn bg-warning btn-sm"><i class="fas fa-edit"></i></a> ';

              // return '<a  href=?act=edit&id='+row.SHOP_PHONE+' onclick="myFuntion('+row.SHOP_NAME_TH+')" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a> ';
              // return '<button  class="btn btn-primary btn-sm ml-2 fas fa-info-circle" data-toggle="modal" data-target="#exampleModalLong" onclick="myFuntion('+row.SHOP_EMAIL+')"> รายละเอียด</button>';    //  SO_CODE                                   
              // return '<button   onclick="myFuntion('+"'"+SO_CODE+"'"+')"> รายละเอียด</button>';    //  SO_CODE                                   

              // return '<a onclick="myFuntion('+row.SHOP_EMAIL+')" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a> ';
            }
          },

        ],
        "oLanguage": {
          "sProcessing": "กำลังดำเนินการ...",
          "sLengthMenu": "แสดง _MENU_ แถว",
          "sZeroRecords": "ไม่พบข้อมูล",
          "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
          "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
          "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
          "sInfoPostFix": "",
          "sSearch": "ค้นหา: ",
          "sUrl": "",
          "oPaginate": {
            "sFirst": "หน้าแรก",
            "sPrevious": "ก่อนหน้า",
            "sNext": "ถัดไป",
            "sLast": "หน้าสุดท้าย"
          }
        },

      });

      tablePropertygroup1.on('order.dt search.dt', function() {
        tablePropertygroup1.column(0, {
          search: 'applied',
          order: 'applied'
        }).nodes().each(function(cell, i) {
          cell.innerHTML = i + 1;
          // cell.innerHTML = null;

        });
      }).draw();






    });

    function myFuntion(a1) {
      let s = a1;
      // document.getElementById("a").innerHTML = a1;


      // console.log("dasdas",s);

    }

    // $("#button1").click(function(){
    //  setInterval(function () {
    //    var data2 = $('#data2').DataTable();
    //      data2.ajax.reload();
    //     console.log("รีโหลด");
    //   }, 3600);//กำหนดเวลารีโหลด
  </script>
</body>

</html>