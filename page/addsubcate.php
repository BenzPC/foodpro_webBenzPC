<?php
session_start();
if (empty($_SESSION['name'])) {
    header('Location: ../');
  }

if (empty($_SESSION['name']) || $_SESSION['name'] != 'Super Admin') {
    header('Location: listshop.php');
}
$configs = include('../config/constants.php');
$url_global = $configs['url_global'];
?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin FoodPro</title>
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
                            <div class="card-header">
                                <h5 class="text-center">เพิ่ม SubCategory</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-main">
                    <div class="app-main__outer" style="margin-top:-15px;">
                        <div class="app-main__inner">
                            <div class="tab-content">
                                <div class="row">
                                    <div class="col">
                                        <div class="main-card mb-3 card">
                                            <div class="card-body"><br>
                                                <form id='fileEditForm' name="fileEditForm" method="post" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-xl">
                                                            <div class="position-relative form-group">
                                                                <label for="" class="">Category</label>
                                                                <select name="category" id="category" class="form-control">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl">
                                                            <div class="position-relative form-group">
                                                                <label for="" class="">SubCategory ชื่อไทย</label>
                                                                <input name="subcateth" id="subcateth" placeholder="" type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl">
                                                            <div class="position-relative form-group">
                                                                <label for="" class="">SubCategory ชื่ออังกฤษ</label>
                                                                <input name="subcateen" id="subcateen" placeholder="" type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <button id='btn0' class="btn btn-primary btn-lg mt-3 mb-3">บันทึก</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // const url_global = 'http://203.150.52.242:4200';
            // const url_global = 'http://192.168.1.175:4200';
            // const url_global = 'https://apidev.foodproonline.com';
            // const url_global = 'http://203.150.52.247:4200';
            const url_global = '<?= $url_global ?>';

            $("#ISsub_dashboard3").attr('style', "color : brown");

            load_cate()

            function load_cate() {
                $('#category').empty()
                $.get(url_global + '/api/v1_0/master/getcombocate').done(function(data) {
                    var append = ""
                    if (data['STATUS'] == 1) {
                        var dataRes = data['RESULT']
                        if (dataRes.length != 0) {
                            for (var i = 0; i < dataRes.length; i++) {
                                var CATE_CODE = dataRes[i]['value']
                                var CATE_NAME_TH = dataRes[i]['label']

                                append = append + "<option value='" + CATE_CODE + "'>" + CATE_NAME_TH + "</option>";
                            }

                            $('#category').append(append)
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
                var category = $('#category').val();
                var subcateth = $('#subcateth').val().trim();
                var subcateen = $('#subcateen').val().trim();

                // alert(category)
                // alert(subcateth)
                // alert(subcateen)

                if (category.trim().length > 0 && subcateth.trim().length > 0 && subcateen.trim().length > 0) {
                    // alert('okkkk');
                    $.post(url_global + "/api/v1_0/master/getcombosubcate", {
                        "CATE_CODE": category,
                        "SUB_CATE_NAME_TH": subcateth,
                        "SUB_CATE_NAME_EN": subcateen,
                    }).done(function(data) {
                        // console.log(data)
                        if (data['STATUS'] == 1) {
                            var dataRes = data['RESULT']
                            if (dataRes == 'SUCCESS') {
                                alert("บันทึกสำเร็จ")
                                // window.location = './listsubcate.php'
                                $('#subcateth').val('');
                                $('#subcateen').val('');

                            } else {
                                alert("ไม่สำเร็จ แจ้งแอดมิน")

                            }
                        } else {
                            alert("ไม่สำเร็จ แจ้งแอดมิน")
                        }
                    });
                } else {
                    if (category.trim().length == 0) {
                        alert('ใส่ Category');
                        $('#category').focus();
                    } else if (subcateth.trim().length == 0) {
                        alert('ใส่ SubCategory ชื่อไทย');
                        $('#subcateth').focus();
                    } else if (subcateen.trim().length == 0) {
                        alert('ใส่ SubCategory ชื่ออังกฤษ');
                        $('#subcateen').focus();
                    }
                }

            });

        })
    </script>

</body>

</html>