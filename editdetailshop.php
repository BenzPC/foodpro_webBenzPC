<?php
ob_start();
session_start();
date_default_timezone_set("Asia/Bangkok");
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'config/connection.php';
include_once 'config/function.php';


$configs = include('config/constants.php');
$url_global = $configs['url_global'];
$SOSS = $_GET["SO"];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (empty($_SESSION['name'])) {
  header('Location: index.php');
}

// $user_level = getUserLevel($_SESSION['user_code']);
// if(!isset($_SESSION['user_code']) || ($user_level == 1 || empty($user_level))){
//   alertMsg('danger','ไม่พบหน้านี้ในระบบ','request.php');
// }

// $act = isset($_GET['act']) ? $_GET['act'] : 'index';
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
  <link rel="stylesheet" href="node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="node_modules/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="public/css/custom.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

  <style>
    .switch {
      position: relative;
      display: inline-block;
      width: 70px;
      height: 34px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #dc3545;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .switch_on {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 40px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
      border-radius: 34px;
    }

    .switch_off {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
      border-radius: 34px;
    }

    .switch_sides {
      background-color: #28a745;
    }

    input:focus+.slider {
      box-shadow: 0 0 1px #28a745;
    }

    .slider.round {
      border-radius: 34px;
    }
  </style>
</head>

<body>
  <?php include_once 'inc/navbar.php' ?>
  <div class="container-fluid">
    <div class="row">
      <?php include_once 'inc/sidemenu.php' ?>
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5 class="text-center">
                  <?php if ($SOSS == "") {
                    echo "เพิ่ม Shop Vendor";
                  } else {
                    echo "แก้ไข Shop Vendor";
                  } ?>
                </h5>
              </div>
            </div>
          </div>
        </div>

        <div class="app-main">
          <div class="app-main__outer" style="margin-top:-15px;">
            <div class="app-main__inner">
              <div class="tab-content">

                <!-- <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel"> -->
                <div class="row">
                  <div class="col">
                    <div class="main-card mb-3 card">
                      <div class="card-body">
                        <!-- <h5 class="card-title"> Edit Register Vendor </h5> -->
                        <!-- <button id='refcombo'> Refresh Combo </button><br>--><br>
                        <form id='fileEditForm' name="fileEditForm" method="post" enctype="multipart/form-data">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="position-relative form-group">
                                <label for="exampleEmail" class="">ชื่อร้าน</label>
                                <input name="shopname" id="shopname" placeholder="" type="text" class="form-control">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="position-relative form-group"><label for="exampleSelect" class="">ตลาด</label>
                                <select name="market" id="market" class="form-control">
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="position-relative form-group">
                            <label for="exampleText" class="">ที่อยู่ร้าน</label>
                            <textarea name="address" id="address" class="form-control"></textarea>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="position-relative form-group"><label for="exampleSelect" class="">จังหวัด</label>
                                <select name="province" id="province" class="form-control">
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="position-relative form-group"><label for="exampleSelect" class="">เขต/อำเภอ</label>
                                <select name="district" id="district" class="form-control">
                                  <!-- <option value="" selected></option> -->
                                  <!-- <option>ลาดกระบัง</option>
                                            <option>วัฒนา</option>
                                            <option>สะพานสูง</option>
                                            <option>หนองแขม</option>
                                            <option>หนองจอก</option> -->
                                </select>
                              </div>
                            </div>

                            <div class="col-md-4">
                              <div class="position-relative form-group">
                                <label for="exampleEmail" class="">รหัสไปรษณี</label>
                                <input name="postcode" id="postcode" placeholder="" type="text" class="form-control" readonly>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6">
                              <div class="position-relative form-group">
                                <label for="" class="">ชื่อ</label>
                                <input name="firstname" id="firstname" placeholder="" type="text" class="form-control">
                                <input name="shopcreateby" id="shopcreateby" placeholder="" type="hidden" class="form-control">
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="position-relative form-group">
                                <label for="" class="">นามสกุล</label>
                                <input name="lastname" id="lastname" placeholder="" type="text" class="form-control">
                              </div>
                            </div>
                          </div>

                          <div class="position-relative form-group">
                            <label for="" class="">เลขประจำตัวผู้เสียภาษี</label>
                            <input name="uid" id="uid" placeholder="" type="text" class="form-control">
                          </div>

                          <div class="row">
                            <div class="col-md-6">
                              <div class="position-relative form-group">
                                <label for="" class="">อีเมล</label>
                                <input name="email" id="email" placeholder="" type="email" class="form-control">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="position-relative form-group">
                                <label for="" class="">เบอร์โทร</label>
                                <input name="tel" id="tel" placeholder="" type="text" class="form-control">
                              </div>
                            </div>
                          </div>

                          <div class="position-relative form-group">
                            <label for="" class="">รหัสผ่าน</label>
                            <input name="password" id="password" placeholder="" type="text" class="form-control" value="1234">
                          </div>

                          <div class="row">
                            <div class="col-md-4">
                              <div class="position-relative form-group"><label for="exampleSelect" class="">บริการ lalamove</label>
                                <select name="active_lalamove" id="active_lalamove" class="form-control">
                                  <option value="0">ไม่ใช้บริการ</option>
                                  <option value="1">ใช้บริการ</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="position-relative form-group"><label for="exampleSelect" class="">เจ้าของ แพ็กเอง</label>
                                <select name="owner_pack" id="owner_pack" class="form-control">
                                  <option value="0">ไม่แพ็กเอง</option>
                                  <option value="1">แพ็กเอง</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="position-relative form-group"><label for="exampleSelect" class="">บริการรับที่บ้าน</label>
                                <select name="receive_from_home" id="receive_from_home" class="form-control">
                                  <option value="0">ไม่ใช้บริการ</option>
                                  <option value="1">ใช้บริการ</option>
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6">
                              <div class="position-relative form-group"><label for="exampleSelect" class="">เลือกภาคจุดส่งสินค้า</label>
                                <select name="region" id="region" class="form-control">
                                </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="position-relative form-group"><label for="exampleSelect" class="">ศูนย์บริการ</label>
                                <select name="servicecenter" id="servicecenter" class="form-control">
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="position-relative form-group"><label for="exampleSelect" class="">เลขบัญชี</label>
                                <input name="accountnumber" id="accountnumber" placeholder="" type="text" class="form-control">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="position-relative form-group"><label for="exampleSelect" class="">ชื่อบัญชี</label>
                                <input name="accountname" id="accountname" placeholder="" type="text" class="form-control">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="position-relative form-group"><label for="exampleSelect" class="">ธนาคาร</label>
                                <select name="bank" id="bank" class="form-control">
                                </select>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="position-relative form-group"><label for="exampleSelect" class="">สถานะร้านค้า ปิด / เปิด </label>
                                <select name="servicecenter1" id="servicecenter1" class="form-control" hidden>
                                </select>
                                <br>
                                <label class="switch">
                                  <input type="checkbox" id="InSwitchStore" value="2" checked>
                                  <span class="slider round switch_sides " id="SwitchStore">
                                    <span class="span12" id="span12">
                                    </span>
                                  </span>
                                </label>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="position-relative form-group text-center"><label for="exampleSelect" class="">รูปที่ 1 : Profile</label>
                                <div>
                                  <img id="imgproduct1" src="" class="center" alt="" style="width:300px;">
                                  <img id="imgproduct1S" src="https://png.pngtree.com/png-clipart/20190603/original/pngtree-oranges-pattern-png-image_3254.jpg" class="center" alt="" style="width:300px" hidden>
                                </div>
                                <div class="custom-file ml-5">
                                  <br>
                                  <input type="file" id="editimgproduct1" name="IMG1" accept="image/x-png,image/jpeg">
                                  <button type="button" class="btn btn-danger" id="noeditimgproduct1" style="height:80% ;font-size: small;" hidden>X</button>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="position-relative form-group text-center"><label for="exampleSelect" class="">รูปที่ 2 : Banner</label>
                                <div>
                                  <img id="imgproduct2" src="" class="center" alt="" style="width:300px;height: 250px">
                                  <img id="imgproduct2S" src="https://png.pngtree.com/png-clipart/20190610/original/pngtree-orange-pattern-background-png-image_1910701.jpg" alt="" style="width:300px" hidden>
                                </div>
                                <div class="custom-file ml-5">
                                  <br>
                                  <input type="file" id="editimgproduct2" name="IMG2" accept="image/x-png,image/jpeg">
                                  <button type="button" class="btn btn-danger" id="noeditimgproduct2" style="height:80% ;font-size: small;" hidden>X</button>
                                </div>
                              </div>
                            </div>

                          </div>
                        </form>

                        <button id='btn0' class="btn btn-primary btn-lg mt-3 mb-3">บันทึก</button>
                        <button id='btn2' class="btn btn-primary btn-lg mt-3 mb-3" hidden>ยืนยัน</button>

                      </div>
                    </div>
                  </div>


                </div>
                <!-- </div> -->

              </div>

            </div>
          </div>
        </div>





      </main>
    </div>
  </div>


  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="node_modules/select2/dist/js/select2.min.js"></script>
  <script src="public/js/main.min.js"></script>



  <!-- data table -->
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <!-- boostrap -->
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
  <script type="text/javascript" charset="utf8" src="/js/jquery.dataTables.js"></script>
  <!-- 
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"> </script> -->



  <script type="text/javascript" language="javascript">
    $(document).ready(function() {
      var admin_name = '<?php echo $_SESSION['name']; ?>'
      const url_global = '<?= $url_global ?>';
      const SOO = '<?= $SOSS ?>';
      var imgProfile = "";
      var imgBanner = "";
      var SaveConfirmShop = "";

      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
            document.getElementById('imgproduct1').hidden = true;
            document.getElementById('imgproduct1S').hidden = false;
            document.getElementById('noeditimgproduct1').hidden = false;
            $('#imgproduct1S').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        }
      }

      $("#editimgproduct1").change(function() {
        readURL(this);
      });

      function readURL2(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
            document.getElementById('imgproduct2').hidden = true;
            document.getElementById('imgproduct2S').hidden = false;
            document.getElementById('noeditimgproduct2').hidden = false;
            $('#imgproduct2S').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        }
      }

      $("#editimgproduct2").change(function() {
        readURL2(this);
      });

      $("#noeditimgproduct1").click(function() {
        if (SOO == "") {
          document.getElementById('imgproduct1').hidden = true;
          document.getElementById('imgproduct1S').hidden = true;
          document.getElementById('noeditimgproduct1').hidden = true;
          document.getElementById('editimgproduct1').value = "";
        } else {
          document.getElementById('imgproduct1').hidden = false;
          document.getElementById('imgproduct1S').hidden = true;
          document.getElementById('noeditimgproduct1').hidden = true;
          document.getElementById('editimgproduct1').value = "";
        }
      });
      $("#noeditimgproduct2").click(function() {
        if (SOO == "") {
          document.getElementById('imgproduct2').hidden = true;
          document.getElementById('imgproduct2S').hidden = true;
          document.getElementById('noeditimgproduct2').hidden = true;
          document.getElementById('editimgproduct2').value = "";
        } else {
          document.getElementById('imgproduct2').hidden = false;
          document.getElementById('imgproduct2S').hidden = true;
          document.getElementById('noeditimgproduct2').hidden = true;
          document.getElementById('editimgproduct2').value = "";
        }
      });


      if (SOO !== "") {
        $.get(url_global + `/api/v1_0/shop/detail/${SOO}`).done(function(data) {
          console.log(data)
          const shop = data.RESULT
          $('#shopname').val(shop.SHOP_NAME_TH)
          $('#market').val(shop.MARKET_CODE)
          $('#address').val(shop.SHOP_ADDRESS_NO)
          $('#province').val(shop.PROVINCE_CODE)
          $('#district').val(shop.DISTRICT_CODE)
          $('#postcode').val();
          $('#shopcreateby').val(shop.SHOP_CREATE_BY)
          $('#firstname').val(shop.MEM_FNAME_TH)
          $('#lastname').val(shop.MEM_LNAME_TH)
          $('#uid').val(shop.SHOP_UID)
          $('#email').val(shop.SHOP_EMAIL)
          $('#tel').val(shop.SHOP_PHONE)
          $('#active_lalamove').val()
          $('#owner_pack').val()
          $('#receive_from_home').val(shop.IS_RECEIVE_FROM_HOME)
          $('#servicecenter option:selected').text()
          $('#servicecenter').val()
          $('#accountnumber').val(shop.ACC_NO)
          $('#accountname').val(shop.ACC_NAME)
          $('#InSwitchStore').val(shop.SHOP_STATUS)
          document.getElementById('imgproduct1').src = "https://apidev.foodproonline.com/api/img/shop/" + shop.SHOP_IMG_PATH_PROFILE;
          document.getElementById('imgproduct2').src = "https://apidev.foodproonline.com/api/img/banner/" + shop.SHOP_IMG_PATH_BANNER;

          SwitchStorefun();
          load_province(shop.PROVINCE_CODE, shop.DISTRICT_CODE)
          location_dc(shop.DC_LOCATION_ID)
          load_bank(shop.BANK_CODE);

          // ใส่ชื่อรูป
          imgProfile = shop.SHOP_IMG_PATH_PROFILE;
          imgBanner = shop.SHOP_IMG_PATH_BANNER;

          document.getElementById('btn0').hidden = true;
          document.getElementById('btn2').hidden = false;
        })
      } else {
        document.getElementById('btn0').hidden = false;
        document.getElementById('btn2').hidden = true;

        $('#imgproduct1').attr('hidden', "true");
        $('#imgproduct2').attr('hidden', "true");
        load_province();
        location_dc();
        SwitchStorefun();
        load_region();
        load_bank();


      }
      $("#InSwitchStore").click(function() {
        SwitchStorefun();
      });

      function SwitchStorefun() {
        var InSwitchStore = document.getElementById("InSwitchStore").value

        if (InSwitchStore == 2) {
          var element = document.getElementById("SwitchStore");
          element.classList.add("switch_sides");

          var element = document.getElementById("span12");
          element.classList.add("switch_on");
          element.classList.remove("switch_off");
          $('#InSwitchStore').val(0)

        } else {
          var element = document.getElementById("SwitchStore");
          element.classList.remove("switch_sides");

          var element = document.getElementById("span12");
          element.classList.add("switch_off");
          element.classList.remove("switch_on");
          $('#InSwitchStore').val(2)
        }
      }


      const escapeRegExp = (string) => {
        return string.replace(/[^0-9A-Za-zก-ฮ๐-๙โเแไำะาๆฯใ\s]/g, '')
      }

      if ($('#province').val() == '001') {
        $('#active_lalamove').prop('disabled', false);
      } else {
        $('#active_lalamove').prop('disabled', true);
        $('#owner_pack').prop('disabled', true);
      }

      $("#refcombo").click(function() {
        load_province();
        if ($('#province').val() == '001') {
          $('#active_lalamove').prop('disabled', false);
        } else {
          $('#active_lalamove').prop('disabled', true);
        }
      });

      function load_province(provinceCode, districtCode) {
        $('#province').empty()
        $('#district').empty()
        $.get(url_global + '/api/v1_0/master/getcomboprovince').done(function(data) {
          var append = ""
          if (data['STATUS'] == 1) {
            var dataRes = data['RESULT']

            if (dataRes.length != 0) {
              for (var i = 0; i < dataRes.length; i++) {
                var PROVINCE_CODE = dataRes[i]['value']
                var PROVINCE_NAME_TH = dataRes[i]['label']
                append = append + "<option value='" + PROVINCE_CODE + "'>" + PROVINCE_NAME_TH + "</option>";
              }

              $('#province').append(append)
              if (provinceCode) {
                $('#province').val(provinceCode)
              }

              // alert(provinceCode)
              load_district($('#province').val(), districtCode)

            } else {
              alert("dataRes.length != 0 |||||| ไม่พบข้อมูล");
            }
          } else {
            alert("Status ไม่เท่ากับ 1")
          }
        })
      }

      $('#province').change(function(v) {
        //console.log(v.target.value);
        // alert(v.target.value);
        var province_code = v.target.value;
        // console.log(province_code);

        load_district(province_code)
        $('#postcode').val('')

        if ($('#province').val() == '001') {
          $('#active_lalamove').prop('disabled', false);
        } else {
          $('#active_lalamove').prop('disabled', true);
          $('#active_lalamove').val(0)
          $('#owner_pack').prop('disabled', true);
          $('#receive_from_home').prop('disabled', false);
          $('#owner_pack').val(0)
          $('#receive_from_home').val(0)
          $('#region').prop('disabled', false);
          $('#servicecenter').prop('disabled', false);
        }
      });

      $('#active_lalamove').change(function(v) {
        if ($('#active_lalamove').val() == 1) {
          $('#owner_pack').prop('disabled', true);
          $('#receive_from_home').prop('disabled', true);
          $('#owner_pack').val(1)
          $('#receive_from_home').val(1)
          $('#region').prop('disabled', true);
          $('#servicecenter').prop('disabled', true);

          // $('#region').val(0)
          // $('#servicecenter').val(0)

        } else {
          $('#owner_pack').prop('disabled', true);
          $('#receive_from_home').prop('disabled', false);
          $('#owner_pack').val(0)
          $('#receive_from_home').val(0)
          $('#region').prop('disabled', false);
          $('#servicecenter').prop('disabled', false);
        }
      });

      $('#receive_from_home').change(function() {
        if ($('#receive_from_home').val() == 1) {
          // $('#region').prop('disabled', true);
          // $('#servicecenter').prop('disabled', true);
          load_region2()
        } else {
          // $('#region').prop('disabled', false);
          // $('#servicecenter').prop('disabled', false);
          load_region()
        }
      });


      function load_district(province_code, districtCode) {
        // alert(province_code)
        $('#district').empty()
        var url = url_global + '/api/v1_0/master/getcombodistrict/' + province_code
        $.get(url).done(function(data) {
          // console.log(data);
          // var jsonData = JSON.parse(data);
          var append = ""
          if (data['STATUS'] == 1) {
            var dataRes = data['RESULT']
            if (dataRes.length != 0) {
              for (var i = 0; i < dataRes.length; i++) {
                var DISTRICT_CODE = dataRes[i]['value']
                var DISTRICT_NAME_TH = dataRes[i]['label']

                append = append + "<option value='" + DISTRICT_CODE + "'>" + DISTRICT_NAME_TH + "</option>";
              }
              $('#district').append(append)

              if (districtCode) {
                $('#district').val(districtCode)
              }
              // load_postcode(dataRes[0]['value'])
              load_postcode($('#district').val())
              //alert(append)
            } else {
              alert("dataRes.length != 0 |||||| ไม่พบข้อมูล");
            }
          } else {
            alert("Status ไม่เท่ากับ 1")
          }
        })
      }

      $('#district').change(function(v) {
        //console.log(v.target.value);
        // alert(v.target.value);
        var district_code = v.target.value;
        // console.log(province_code);

        load_postcode(district_code)
        $('#postcode').val('')
      });

      function load_postcode(district_code) {
        var url = url_global + '/api/v1_0/master/getpostcode/' + district_code
        $.get(url).done(function(data) {
          // console.log(data);
          // var jsonData = JSON.parse(data);
          // var append = ""
          if (data['STATUS'] == 1) {
            var dataRes = data['RESULT']
            if (dataRes.length != 0) {
              // for (var i = 0; i < dataRes.length; i++) {
              //     var POSTCODE = dataRes[i]['POSTCODE']
              // }
              $('#postcode').val(dataRes[0]['POSTCODE'])
              //alert(append)
            } else {
              alert("dataRes.length != 0 |||||| ไม่พบข้อมูล");
            }
          } else {
            alert("Status ไม่เท่ากับ 1")
          }
        })
      }



      function load_region(region, dcLocationId) {
        $('#region').empty()
        $('#servicecenter').empty()
        var url = 'http://ebooking.iel.co.th:3001/site/list/all'
        $.get(url).done(function(data) {
          // console.log(data);
          // var jsonData = JSON.parse(data);
          var appendRegion = ""
          var appendSiteC = ""
          var appendSiteN = ""
          var appendSiteSE = ""
          var appendSiteS = ""

          if (data['status'] == 200) {
            var dataRes = data['data']
            // console.log(dataRes.length)
            if (dataRes.length != 0) {
              for (var i = 0; i < dataRes.length; i++) {
                appendRegion = appendRegion + "<option value='" + dataRes[i]['region'] + "'>" + dataRes[i]['region_name'] + "</option>";

                var siteData = dataRes[i]['sites']
                for (var j = 0; j < siteData.length; j++) {
                  if (dataRes[i]['region'] == "C") {
                    appendSiteC = appendSiteC + "<option value='" + siteData[j]['service_location_id'] + "'>" + siteData[j]['site_name'] + "</option>";
                  } else if (dataRes[i]['region'] == "N") {
                    appendSiteN = appendSiteN + "<option value='" + siteData[j]['service_location_id'] + "'>" + siteData[j]['site_name'] + "</option>";
                  } else if (dataRes[i]['region'] == "SE") {
                    appendSiteSE = appendSiteSE + "<option value='" + siteData[j]['service_location_id'] + "'>" + siteData[j]['site_name'] + "</option>";
                  } else if (dataRes[i]['region'] == "S") {
                    appendSiteS = appendSiteS + "<option value='" + siteData[j]['service_location_id'] + "'>" + siteData[j]['site_name'] + "</option>";
                  }
                }
              }
              $('#region').append(appendRegion)
              $('#servicecenter').append(appendSiteC)

              if (region) {

                $('#region').val(region)

                if ($('#region').val() == "C") {
                  $('#servicecenter').append(appendSiteC)
                } else if ($('#region').val() == "N") {
                  $('#servicecenter').append(appendSiteN)
                } else if ($('#region').val() == "SE") {
                  $('#servicecenter').append(appendSiteSE)
                } else if ($('#region').val() == "S") {
                  $('#servicecenter').append(appendSiteS)
                }
                $('#servicecenter').val(dcLocationId)
              }
            } else {
              alert("dataRes.length != 0 |||||| ไม่พบข้อมูล");

            }
          } else {
            alert("Status ไม่เท่ากับ 200")
          }

          $('#region').change(function() {
            alert("55");
            $('#servicecenter').empty()
            // alert($('#region').val())
            if ($('#region').val() == "C") {
              $('#servicecenter').append(appendSiteC)
            } else if ($('#region').val() == "N") {
              $('#servicecenter').append(appendSiteN)
            } else if ($('#region').val() == "SE") {
              $('#servicecenter').append(appendSiteSE)
            } else if ($('#region').val() == "S") {
              $('#servicecenter').append(appendSiteS)
            }

          });

        })
      }

      function location_dc(dcLocationId) {
        var appendRegion = ""
        var appendSiteC = ""
        var appendSiteN = ""
        var appendSiteSE = ""
        var appendSiteS = ""

        var url = 'http://ebooking.iel.co.th:3001/site/list/all'
        $.get(url).done(function(data) {
          if (data['status'] == 200) {
            var dataRes = data['data']
            for (var i = 0; i < dataRes.length; i++) {
              const dc = dataRes[i]['sites']
              if (dc.find(({
                  service_location_id
                }) => service_location_id == dcLocationId)) {
                load_region(dataRes[i]['region'], dcLocationId)
              }
            }
          }
        })
      }


      function load_region2() {
        $('#region').empty()
        $('#servicecenter').empty()
        var url = 'http://ebooking.iel.co.th:3001/site/list/all'
        $.get(url).done(function(data) {
          // console.log(data);
          // var jsonData = JSON.parse(data);
          var appendRegion = ""
          var appendSiteC = ""

          if (data['status'] == 200) {
            var dataRes = data['data']
            // console.log(dataRes)
            if (dataRes.length != 0) {
              for (var i = 0; i < dataRes.length; i++) {
                if (dataRes[i]['region'] == "C") {
                  appendRegion = appendRegion + "<option value='" + dataRes[i]['region'] + "'>" + dataRes[i]['region_name'] + "</option>";
                  var siteData = dataRes[i]['sites']
                  for (var j = 0; j < siteData.length; j++) {
                    if (siteData[j]['service_location_id'] == 'H2' || siteData[j]['service_location_id'] == 'H1') {
                      appendSiteC = appendSiteC + "<option value='" + siteData[j]['service_location_id'] + "'>" + siteData[j]['site_name'] + "</option>";
                    }
                  }
                }
              }

              $('#region').append(appendRegion)
              $('#servicecenter').append(appendSiteC)
            } else {
              alert("dataRes.length != 0 |||||| ไม่พบข้อมูล");
            }
          } else {
            alert("Status ไม่เท่ากับ 200")
          }

          $('#region').change(function() {
            $('#servicecenter').empty()
            // alert($('#region').val())
            if ($('#region').val() == "C") {
              $('#servicecenter').append(appendSiteC)
            } else if ($('#region').val() == "N") {
              $('#servicecenter').append(appendSiteN)
            } else if ($('#region').val() == "SE") {
              $('#servicecenter').append(appendSiteSE)
            } else if ($('#region').val() == "S") {
              $('#servicecenter').append(appendSiteS)
            }
          });

        })
      }


      load_market()

      function load_market() {
        $('#market').empty()
        $.get(url_global + '/api/v1_0/master/getcombomarket').done(function(data) {
          var append = ""
          if (data['STATUS'] == 1) {
            var dataRes = data['RESULT']
            if (dataRes.length != 0) {
              for (var i = 0; i < dataRes.length; i++) {
                var MARKET_CODE = dataRes[i]['value']
                var MARKET_NAME_TH = dataRes[i]['label']

                append = append + "<option value='" + MARKET_CODE + "'>" + MARKET_NAME_TH + "</option>";
              }

              $('#market').append(append)
              //alert(append)

            } else {
              alert("dataRes.length != 0 |||||| ไม่พบข้อมูล");
            }
          } else {
            alert("Status ไม่เท่ากับ 1")
          }
        })
      }

      function load_bank(bankCode) {
        $('#bank').empty()
        var url = url_global + '/api/v1_0/master/getBank/'
        $.get(url).done(function(data) {
          //  console.log(data);
          // var jsonData = JSON.parse(data);
          var append = ""
          if (data['STATUS'] == 1) {
            var dataRes = data['RESULT']
            // console.log(dataRes.length);
            if (dataRes.length != 0) {
              for (var i = 0; i < dataRes.length; i++) {
                var BANK_CODE = dataRes[i].BANK_CODE;
                var BANK_NAME_TH = dataRes[i].BANK_NAME_TH;
                // console.log(BANK_CODE);
                append = append + "<option value='" + BANK_CODE + "'>" + BANK_NAME_TH + "</option>";
              }
              $('#bank').append(append)
              if (bankCode) {
                $('#bank').val(bankCode)
              }

              //alert(append)
            } else {
              alert("dataRes.length != 0 |||||| ไม่พบข้อมูล");
            }
          } else {
            alert("Status ไม่เท่ากับ 1")
          }
        })
      }

      $("#btn0").click(function() {
        SaveConfirmShop = "Save";
        CheckSave_Confirm();
      });
      $("#btn2").click(function() {
        SaveConfirmShop = "Confirm";
        CheckSave_Confirm();

      });

      function CheckSave_Confirm() {
        // const params = getParams(window.location.href)
        var id = '<?= $SOSS; ?>';
        var emailFilter = /^.+@.+\..{2,3}$/; // ตรวจอีเมล
        var emailerr = ""; // อีเมลผิด
        // console.log(id);
        
        // var url = url_global + '/api/v1_0/product'
        // event.preventDefault();
        var form1 = $('#fileEditForm')[0];
        var data = new FormData(form1);

        var shopname = $('#shopname').val().trim();
        var market = $('#market').val();
        var address = $('#address').val().trim();
        var province = $('#province').val();
        var district = $('#district').val();
        var postcode = $('#postcode').val();
        var shopcreateby = $('#shopcreateby').val().trim();
        var firstname = $('#firstname').val().trim();
        var lastname = $('#lastname').val().trim();
        var uid = $('#uid').val().trim();
        var email = $('#email').val().trim();
        var tel = $('#tel').val().trim();
        var password = $('#password').val().trim();
        var active_lalamove = $('#active_lalamove').val();
        var owner_pack = $('#owner_pack').val();
        var receive_from_home = $('#receive_from_home').val();
        var dcName = $('#servicecenter option:selected').text();
        var dcLocationId = $('#servicecenter').val();
        var accountnumber = $('#accountnumber').val().trim();
        var accountname = $('#accountname').val().trim();
        var bank = $('#bank').val();
        var InSwitchStore = $('#InSwitchStore').val();
        var editimgproduct1 = $('#editimgproduct1').val();
        var editimgproduct2 = $('#editimgproduct2').val();
        if (editimgproduct1 == "") {} else {
          imgProfile = editimgproduct1;
        }
        if (editimgproduct2 == "") {} else {
          imgBanner = editimgproduct2;
        }

        if (shopname.trim().length <= 0) {
          $('#shopname').attr("style", "border-color:#dc3545");
        }
        if (address.trim().length <= 0) {
          $('#address').attr("style", "border-color:#dc3545");
        }
        if (firstname.trim().length <= 0) {
          $('#firstname').attr("style", "border-color:#dc3545");
        }
        if (lastname.trim().length <= 0) {
          $('#lastname').attr("style", "border-color:#dc3545");
        }
        if (uid.trim().length <= 0) {
          $('#uid').attr("style", "border-color:#dc3545");
        }
        if (email.trim().length <= 0) {
          $('#email').attr("style", "border-color:#dc3545");
        } else {
          if (!(emailFilter.test(email))) {
            $('#email').attr("style", "border-color:#dc3545");
            emailerr = "err";
          } else {
            emailerr = "ok";
          }
        }
        if (tel.trim().length <= 0) {
          $('#tel').attr("style", "border-color:#dc3545");
        }
        if (password.trim().length <= 0) {
          $('#password').attr("style", "border-color:#dc3545");
        }
        if (accountnumber.trim().length <= 0) {
          $('#accountnumber').attr("style", "border-color:#dc3545");
        }
        if (accountname.trim().length <= 0) {
          $('#accountname').attr("style", "border-color:#dc3545");
        }
        if (!SOO) {
          if (editimgproduct1.trim().length <= 0) {
            $('#editimgproduct1').attr("style", "border: 1px solid; border-color:#dc3545; padding: 3px;");
          }
          if (editimgproduct2.trim().length <= 0) {
            $('#editimgproduct2').attr("style", "border: 1px solid; border-color:#dc3545; padding: 3px;");
          }
        }

        // focus
        if (shopname.trim().length <= 0) {
          document.getElementById("shopname").focus();
        } else if (address.trim().length <= 0) {
          document.getElementById("address").focus();
        } else if (firstname.trim().length <= 0) {
          document.getElementById("firstname").focus();
        } else if (lastname.trim().length <= 0) {
          document.getElementById("lastname").focus();
        } else if (uid.trim().length <= 0) {
          document.getElementById("uid").focus();
        } else if (email.trim().length <= 0) {
          document.getElementById("email").focus();
        } else if (emailerr == "err") {
          //alert(emailerr); // ถึงต่อนี้นะ
          document.getElementById("email").focus();
        } else if (tel.trim().length <= 0) {
          document.getElementById("tel").focus();
        } else if (password.trim().length <= 0) {
          document.getElementById("password").focus();
        } else if (accountnumber.trim().length <= 0) {
          document.getElementById("accountnumber").focus();
        } else if (accountname.trim().length <= 0) {
          document.getElementById("accountname").focus();
        }
        // }else if (editimgproduct1.trim().length <= 0) {
        //   document.getElementById("editimgproduct1").focus();
        // }else if (editimgproduct2.trim().length <= 0) {
        //   document.getElementById("editimgproduct2").focus();
        // }


        if (shopname.trim().length > 0 && address.trim().length > 0 && province.trim().length > 0 && district.trim().length > 0 &&
          postcode.trim().length > 0 && firstname.trim().length > 0 && lastname.trim().length > 0 && uid.trim().length > 0 &&
          email.trim().length > 0 && tel.trim().length > 0 && password.trim().length > 0 && accountnumber.trim().length > 0 &&
          accountname.trim().length > 0) {
          //   // alert('okkkk');
          //   var countstritemname = escapeRegExp(shopname)
          if (shopname.length <= 20) {
            if (emailerr == "err") {
              alert('อีเมล์ไม่ถูกต้อง');
            } else {
              if (tel.length < 9) {
                alert('เบอร์โทรควรไม่ต่ำกว่า 9 ตัว');
              } else {
                if (SaveConfirmShop == "Save") {
                  if (imgProfile.length > 0 && imgBanner.length > 0) {
                    SaveShop();
                  } else {
                    alert('ใส่รูป');
                  }
                } else {
                  ConfirmShop();
                }
              }
            }
          } else {
            alert('ชื่อร้านไม่ควรเกิน 20 ตัวอักษร');
          }
        };
      };

      function SaveShop() {
        var url = url_global + '/api/v1_0/shop/admingenshop/'
        alert("บันทึก");
        // $.ajax({
        //   type: "POST",
        //   enctype: 'multipart/form-data',
        //   url: url,
        //   data: data,
        //   processData: false,
        //   contentType: false,
        //   cache: false,
        //   timeout: 600000,
        //   success: function(data) {
        //     if (data['STATUS'] == 1) {
        //       if (data['RESULT'] == 'SUCCESS') {
        //         alert("แก้ไขข้อมูลเสร็จสิ้น");
        //         location.reload();
        //       } else {
        //         alert("ผิดพลาด");
        //       }
        //     } else {
        //       alert("ผิดพลาด");
        //     }
        //   },
        //   error: function(e) {
        //     console.log("ERROR : ", e);
        //   }
        // });
      };

      function ConfirmShop() {

        var url = url_global + '/api/v1_0/shop/'
        alert("ยืนยัน");
        // $.ajax({
        //   type: "POST",
        //   enctype: 'multipart/form-data',
        //   url: url,
        //   data: data,
        //   processData: false,
        //   contentType: false,
        //   cache: false,
        //   timeout: 600000,
        //   success: function(data) {
        //     if (data['STATUS'] == 1) {
        //       if (data['RESULT'] == 'SUCCESS') {
        //         alert("แก้ไขข้อมูลเสร็จสิ้น");
        //         location.reload();
        //       } else {
        //         alert("ผิดพลาด");
        //       }
        //     } else {
        //       alert("ผิดพลาด");
        //     }
        //   },
        //   error: function(e) {
        //     console.log("ERROR : ", e);
        //   }
        // });
      };
      //----- เปลี่ยนแปลงให้ลบกรอบแดง
      $('#shopname').change(function() {
        $('#shopname').attr("style", "border-color");
      });
      $('#address').change(function() {
        $('#address').attr("style", "border-color");
      });
      $('#firstname').change(function() {
        $('#firstname').attr("style", "border-color");
      });
      $('#lastname').change(function() {
        $('#lastname').attr("style", "border-color");
      });
      $('#uid').change(function() {
        $('#uid').attr("style", "border-color");
      });
      $('#email').change(function() {
        $('#email').attr("style", "border-color");
      });
      $('#tel').change(function() {
        $('#tel').attr("style", "border-color");
      });
      $('#password').change(function() {
        $('#password').attr("style", "border-color");
      });
      $('#accountnumber').change(function() {
        $('#accountnumber').attr("style", "border-color");
      });
      $('#accountname').change(function() {
        $('#accountname').attr("style", "border-color");
      });
      if (!SOO) {
        $('#editimgproduct1').change(function() {
          $('#editimgproduct1').attr("style", "border-color");
        });
        $('#editimgproduct2').change(function() {
          $('#editimgproduct2').attr("style", "border-color");
        });
      }

      $('#btnlogout').click(function() {
        window.location = './logout.php'
      });

    });
  </script>
</body>

</html>