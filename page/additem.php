<?php
$configs = include('../config/constants.php');
$url_global = $configs['url_global'];

session_start();
if (empty($_SESSION['name'])) {
    header('Location: ./login.php');
}
// echo $_SESSION['name'];
// $url_global = $configs['url_global'];
$SO_CODE = (isset($_GET['SO'])) ? $_GET['SO'] : '';
$SH_NAME = (isset($_GET['SH_NAME'])) ? $_GET['SH_NAME'] : '';

// $SHOP_CODE = $_REQUEST['SHOP_CODE'];
// $SHOP_NAME = $_REQUEST['SHOP_NAME'];
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
                            <div class="card-header" style="margin-bottom: 10px;">
                                <h5 class="text-center">เพิ่ม สินค้า </h5>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive" style="padding: 20px;">
                                        <h1><span id="vendorname"></span></h1>
                                        <!-- <button id='refcombo1'> Refresh Combo Cate </button> -->
                                        <!-- <button id='refcombo2'> Refresh Combo Send </button> -->
                                        <!-- <button id='refcombo3'> Refresh Combo Dim </button> -->
                                        <!-- <button id='refcombo4'> Refresh Combo Unit </button><br><br> -->

                                        <div class="position-relative form-group">
                                            <label for="exampleEmail" class="">ชื่อสินค้า</label>
                                            <input name="itemname" id="itemname" placeholder="" type="text" class="form-control">
                                        </div>

                                        <div class="position-relative form-group"><label for="exampleSelect" class="">Category</label>
                                            <select name="category" id="category" class="form-control">
                                            </select>
                                        </div>

                                        <div class="position-relative form-group"><label for="exampleSelect" class="">Sub Category</label>
                                            <select name="subcategory" id="subcategory" class="form-control">
                                            </select>
                                        </div>

                                        <div class="position-relative form-group"><label for="exampleSelect" class="">Type Category</label>
                                            <select name="typecategory" id="typecategory" class="form-control">
                                            </select>
                                        </div>

                                        <div class="position-relative form-group"><label for="exampleSelect" class="">ประเภทการขนส่ง</label>
                                            <select name="send" id="send" class="form-control">
                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="exampleEmail" class="">กว้าง (เซนติเมตร) <font color='red'>*(Dimension X)</font> </label>
                                                <input name="dimx" id="dimx" placeholder="" type="number" class="form-control" min="0" value="1">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="exampleEmail" class="">ยาว (เซนติเมตร) <font color='red'>*(Dimension Y)</font> </label>
                                                <input name="dimy" id="dimy" placeholder="" type="number" class="form-control" min="0" value="1">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="exampleEmail" class="">สูง (เซนติเมตร) <font color='red'>*(Dimension Z)</font> </label>
                                                <input name="dimz" id="dimz" placeholder="" type="number" class="form-control" min="0" value="1">
                                            </div>
                                        </div>

                                        <!-- <div class="position-relative form-group"><label for="exampleSelect" class="">ขนาดกล่อง</label>
                                            <select name="dim" id="dim" class="form-control">
                                            </select>
                                        </div> -->

                                        <div class="position-relative form-group">
                                            <label for="exampleEmail" class="">ราคา</label>
                                            <input name="price" id="price" placeholder="" type="number" class="form-control" min="1" value="1">
                                        </div>

                                        <div class="position-relative form-group"><label for="exampleSelect" class="">หน่วยการขาย</label>
                                            &nbsp&nbsp
                                            <!-- <input type="text" name="serch_unit" id="serch_unit" placeholder="ค้นหาหน่วยการขาย" style="width:290px" /> -->
                                            <!-- <select name="unit" id="unit" class="form-control">
                                            </select> -->
                                            <select class="form-control js-example-basic-single" name="unit" id="unit" style="width:100%">
                                            </select>
                                        </div>

                                        <div class="position-relative form-group">
                                            <label for="exampleEmail" class="">น้ำหนัก (กิโลกรัม)</label>
                                            <input name="weight" id="weight" placeholder="" type="number" class="form-control" min="0" value="1">
                                        </div>

                                        <button id='btn0' class="btn btn-primary btn-lg mt-3 mb-3">บันทึก</button>

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

            var admin_name = '<?php echo $_SESSION['name']; ?>'
            var SHOP_CODE = '<?php echo $SO_CODE; ?>'
            var SHOP_NAME = '<?php echo $SH_NAME; ?>'


            const url_global = '<?= $url_global ?>';
            $('.js-example-basic-single').select2();
            // const url_global = 'http://203.150.52.242:4200';
            // const url_global = 'http://192.168.1.175:4200';
            // const url_global = 'https://apidev.foodproonline.com';
            // const url_global = 'http://203.150.52.247:4200';

            // alert(SHOP_CODE);
            // $('#vendorname').html("<font color='blue'>" + SHOP_NAME + "</font>")

            // disable scrollmouse in text type number
            $(document).on("wheel", "input[type=number]", function(e) {
                $(this).blur();
            });

            load_category()
            load_send()
            load_unit()
            // load_unit_forserch()

            // load_dim()

            // $("#btnAddItem").click(function() {
            //     // alert($('#vendorname').text())
            //     window.location = './additem.php?SHOP_CODE=' + SHOP_CODE + '&SHOP_NAME=' + SHOP_NAME
            // });

            // $("#btnLItem").click(function() {
            //     // alert($('#vendorname').text())
            //     window.location = './itemvendor.php?SHOP_CODE=' + SHOP_CODE + '&SHOP_NAME=' + SHOP_NAME
            // });

            // $("#refcombo1").click(function() {
            //     load_category()
            // });
            // $("#refcombo2").click(function() {
            //     load_send()
            // });
            // $("#refcombo3").click(function() {
            //     load_dim()
            // });
            // $("#refcombo4").click(function() {
            //     load_unit()
            // });

            const escapeRegExp = (string) => {
                return string.replace(/[^0-9A-Za-zก-ฮ๐-๙โเแไำะาๆฯใ\s]/g, '')
            }

            // function load_dim() {
            //     $('#dim').empty()
            //     $.get(url_global + '/api/v1_0/master/getdim').done(function(data) {
            //         var append = ""
            //         if (data['STATUS'] == 1) {
            //             var dataRes = data['RESULT']
            //             if (dataRes.length != 0) {
            //                 for (var i = 0; i < dataRes.length; i++) {
            //                     var DIM_CODE = dataRes[i]['value']
            //                     var DIM_NAME_TH = dataRes[i]['label']

            //                     append = append + "<option value='" + DIM_CODE + "'>" + DIM_NAME_TH + "</option>";
            //                 }

            //                 $('#dim').append(append)

            //             } else {
            //                 alert("dataRes.length != 0 |||||| ไม่พบข้อมูล");
            //             }
            //         } else {
            //             alert("Status ไม่เท่ากับ 1")
            //         }
            //     })
            // }

            function load_unit() {
                $('#unit').empty()
                $.get(url_global + '/api/v1_0/master/getcombounit').done(function(data) {
                    var append = ""
                    if (data['STATUS'] == 1) {
                        var dataRes = data['RESULT']
                        if (dataRes.length != 0) {
                            for (var i = 0; i < dataRes.length; i++) {
                                var UNIT_CODE = dataRes[i]['value']
                                var UNIT_NAME_TH = dataRes[i]['label']

                                append = append + "<option value='" + UNIT_CODE + "'>" + UNIT_NAME_TH + "</option>";
                            }

                            $('#unit').append(append)

                        } else {
                            alert("dataRes.length != 0 |||||| ไม่พบข้อมูล");
                        }
                    } else {
                        alert("Status ไม่เท่ากับ 1")
                    }
                })
            }

            // function load_unit_forserch() {
            //     // $('#unit').empty()
            //     $.get(url_global + '/api/v1_0/master/getcombounit').done(function(data) {
            //         var append = ""
            //         if (data['STATUS'] == 1) {
            //             var dataRes = data['RESULT']
            //             console.log("diclllll");

            //             if (dataRes.length != 0) {

            //                 $("#serch_unit").autocomplete({

            //                     source: dataRes,

            //                     select: function(event, dataRes) {

            //                         event.preventDefault();

            //                         // $('#unit').append(append)
            //                         $('#unit').val(dataRes.item.value)
            //                         // console.log("123DUck L", dataRes.item.label);
            //                         // console.log("123DUck V", dataRes.item.value);

            //                         $("#serch_unit").val(dataRes.item.label);
            //                     }


            //                 });




            //             } else {
            //                 alert("dataRes.length != 0 |||||| ไม่พบข้อมูล");
            //             }
            //         } else {
            //             alert("Status ไม่เท่ากับ 1")
            //         }
            //     })
            // }


            function load_send() {
                $('#send').empty()
                $.get(url_global + '/api/v1_0/master/getcombosend').done(function(data) {
                    var append = ""
                    if (data['STATUS'] == 1) {
                        var dataRes = data['RESULT']
                        if (dataRes.length != 0) {
                            for (var i = 0; i < dataRes.length; i++) {
                                var SEND_CODE = dataRes[i]['value']
                                var SEND_NAME_TH = dataRes[i]['label']

                                append = append + "<option value='" + SEND_CODE + "'>" + SEND_NAME_TH + "</option>";
                            }

                            $('#send').append(append)

                        } else {
                            alert("dataRes.length != 0 |||||| ไม่พบข้อมูล");
                        }
                    } else {
                        alert("Status ไม่เท่ากับ 1")
                    }
                })
            }

            function load_category() {
                $('#category').empty()
                $('#subcategory').empty()
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

                            load_sub_cate($('#category').val())

                        } else {
                            alert("dataRes.length != 0 |||||| ไม่พบข้อมูล");
                        }
                    } else {
                        alert("Status ไม่เท่ากับ 1")
                    }
                })
            }

            $('#category').change(function(v) {
                //console.log(v.target.value);
                // alert(v.target.value);
                var cate_code = v.target.value;
                // console.log(province_code);
                load_sub_cate(cate_code)
            });

            function load_sub_cate(cate_code) {
                $('#subcategory').empty()
                $.get(url_global + '/api/v1_0/master/getcombosubcate/' + cate_code).done(function(data) {
                    var append = ""
                    if (data['STATUS'] == 1) {
                        var dataRes = data['RESULT']
                        if (dataRes.length != 0) {
                            for (var i = 0; i < dataRes.length; i++) {
                                var SUB_CATE_CODE = dataRes[i]['value']
                                var SUB_CATE_NAME_TH = dataRes[i]['label']

                                append = append + "<option value='" + SUB_CATE_CODE + "'>" + SUB_CATE_NAME_TH + "</option>";
                            }

                            $('#subcategory').append(append)
                            load_type_cate(cate_code, $('#subcategory').val())
                            // load_district($('#province').val())

                        } else {
                            alert("dataRes.length != 0 |||||| ไม่พบข้อมูล");
                        }
                    } else {
                        alert("Status ไม่เท่ากับ 1")
                    }
                })
            }

            $('#subcategory').change(function(v) {
                //console.log(v.target.value);
                // alert(v.target.value);
                var cate_code = $('#category').val()
                //alert(cate_code)
                var sub_cate_code = v.target.value;
                // console.log(province_code);
                load_type_cate(cate_code, sub_cate_code)
            });

            function load_type_cate(cate_code, sub_cate_code) {
                $('#typecategory').empty()
                $.get(url_global + '/api/v1_0/master/getcombotypecate/' + cate_code + '/' + sub_cate_code).done(function(data) {
                    // alert(cate_code)
                    // alert(sub_cate_code)
                    // console.log(data)
                    var append = ""
                    if (data['STATUS'] == 1) {
                        var dataRes = data['RESULT']
                        if (dataRes.length != 0) {
                            for (var i = 0; i < dataRes.length; i++) {
                                var SUB_CATE_CODE = dataRes[i]['value']
                                var SUB_CATE_NAME_TH = dataRes[i]['label']

                                append = append + "<option value='" + SUB_CATE_CODE + "'>" + SUB_CATE_NAME_TH + "</option>";
                            }

                            $('#typecategory').append(append)

                            // load_district($('#province').val())

                        } else {
                            alert("dataRes.length != 0 |||||| ไม่พบข้อมูล");
                        }
                    } else {
                        // alert("Status ไม่เท่ากับ 1")
                        append = append + "<option value='0' selected='true' disabled='disabled'>-- ไม่พบข้อมูล แจ้งแอดมินให้เพิ่มข้อมูล --</option>";
                        $('#typecategory').append(append)
                    }
                })
            }

            $("#btn0").click(function() {
                var itemname = $('#itemname').val().trim();
                var category = $('#category').val();
                var subcategory = $('#subcategory').val();
                var typecategory = $('#typecategory').val();
                var unit = $('#unit').val();
                var send = $('#send').val();
                // var dim = $('#dim').val();
                var price = $('#price').val().trim();
                var weight = $('#weight').val().trim();
                var dim = 'D01';
                var dimx = $('#dimx').val();
                var dimy = $('#dimy').val();
                var dimz = $('#dimz').val();

                var shopcode = SHOP_CODE
                // alert(shopcode)
                var countstritemname = escapeRegExp(itemname)
                // console.log(countstritemname)
                // console.log(countstritemname.length)
                if (itemname.trim().length <= 0) {
                    $('#itemname').attr("style", "border-color:#dc3545");
                }
                if (dimx.trim().length <= 0) {
                    $('#dimx').attr("style", "border-color:#dc3545");
                }
                if (dimy.trim().length <= 0) {
                    $('#dimy').attr("style", "border-color:#dc3545");
                }
                if (dimz.trim().length <= 0) {
                    $('#dimz').attr("style", "border-color:#dc3545");
                }
                if (price.trim().length <= 0) {
                    $('#price').attr("style", "border-color:#dc3545");
                }
                if (weight.trim().length <= 0) {
                    $('#weight').attr("style", "border-color:#dc3545");
                }


                if (itemname.trim().length <= 0) {
                    $('#itemname').focus();
                } else if (dimx.trim().length <= 0) {
                    $('#dimx').focus();
                } else if (dimy.trim().length <= 0) {
                    $('#dimy').focus();
                } else if (dimz.trim().length <= 0) {
                    $('#dimz').focus();
                } else if (price.trim().length <= 0) {
                    $('#price').focus();
                } else if (weight.trim().length <= 0) {
                    $('#weight').focus();
                }



                // if (itemname.trim().length > 0 && typecategory != 0 && price != 0 && weight != 0 && dimx.length > 0 && dimy.length > 0 && dimz.length > 0) {
                //     // alert("ok")
                if (countstritemname.length <= 20) {
                    $.post(url_global + "/api/v1_0/shop/shopitem", {
                        "CATE_CODE": category,
                        "SUB_CATE_CODE": subcategory,
                        "UNIT_CODE": unit,
                        "SEND_CODE": send,
                        "GOODS_NAME_TH": itemname,
                        "DIM_CODE": dim,
                        "SHOP_CODE": SHOP_CODE,
                        "PRICE": price,
                        "IS_PROMOTE": 0,
                        "IS_STOCK": 1,
                        "SHARE_LINK": "www.google.com",
                        "TYPE_CATE_CODE": typecategory,
                        "SUM_WEIGHT": weight,
                        "CREATE_BY": admin_name,
                        "GOODS_DIM_X": dimx,
                        "GOODS_DIM_Y": dimy,
                        "GOODS_DIM_Z": dimz

                    }).done(function(data) {
                        if (data['STATUS'] == 1) {
                            var dataRes = data['RESULT']
                            if (dataRes == 'SUCCESS') {
                                alert("บันทึกสำเร็จ")
                                window.location = './itemvendor.php?SHOP_CODE=' + shopcode + '&SHOP_NAME=' + SHOP_NAME
                            } else {
                                alert("ไม่สำเร็จ แจ้งแอดมิน")
                            }
                        } else {
                            alert("ไม่สำเร็จ แจ้งแอดมิน")
                        }
                        // console.log(data)
                        // alert(data)
                    });
                    // alert('ไม่เกิน20')
                } else {
                    alert('ชื่อสินค้าเกิน 20 ตัวอักษร')
                    $('#itemname').focus();

                }
                // } else {
                //     // alert("0000")
                //     if (itemname.trim().length == 0) {
                //         alert('ไม่มี ชื่อสินค้า');
                //         $('#itemname').focus();
                //     } else if (typecategory == 0) {
                //         alert('แจ้งแอดมิน ให้เพิ่มข้อมูล');
                //     } else if (price == 0) {
                //         alert('ไม่มี ราคา');
                //         $('#price').focus();
                //     } else if (weight == 0) {
                //         alert('ไม่มี น้ำหนัก');
                //         $('#weight').focus();
                //     } else if (dimx.length == 0) {
                //         alert('ไม่มี แกน X');
                //         $('#dimx').focus();
                //     } else if (dimy.length == 0) {
                //         alert('ไม่มี แกน Y');
                //         $('#dimy').focus();
                //     } else if (dimz.length == 0) {
                //         alert('ไม่มี แกน Z');
                //         $('#dimz').focus();
                //     }
                // }
            })

        })


        $('#itemname').change(function() {
            $('#itemname').attr("style", "border-color");
        });
        $('#dimx').change(function() {
            $('#dimx').attr("style", "border-color");
        });
        $('#dimy').change(function() {
            $('#dimy').attr("style", "border-color");
        });
        $('#dimz').change(function() {
            $('#dimz').attr("style", "border-color");
        });
        $('#price').change(function() {
            $('#price').attr("style", "border-color");
        });
        $('#weight').change(function() {
            $('#weight').attr("style", "border-color");
        });
    </script>

</body>

</html>