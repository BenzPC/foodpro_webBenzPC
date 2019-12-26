<?php
session_start();
if (empty($_SESSION['name']) || $_SESSION['name'] != 'Super Admin') {
    header('Location: ../logout.php');
}
?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin FoodPro</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-pro/css/all.min.css">
    <link rel="stylesheet" href="node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="node_modules/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="public/css/custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">



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
    <script>
        $(document).ready(function() {
            const url_global = 'http://203.150.52.242:4200';
            // const url_global = 'http://192.168.1.175:4200';
            // const url_global = 'https://apidev.foodproonline.com';
            // const url_global = 'http://203.150.52.247:4200';

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