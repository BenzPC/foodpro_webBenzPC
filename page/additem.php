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
                                <div class="col-6">
                                    <h4 style="color: rgb(0, 0, 255); padding: 10px; padding-bottom: 0px;"><?php echo $SH_NAME; ?> </h4>
                                    <!-- Table -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive" style="padding: 20px;">
                                        <h1><span id="vendorname"></span></h1>

                                        <!-- <button id='refcombo1'> Refresh Combo Cate </button> -->
                                        <!-- <button id='refcombo2'> Refresh Combo Send </button> -->
                                        <!-- <button id='refcombo3'> Refresh Combo Dim </button> -->
                                        <!-- <button id='refcombo4'> Refresh Combo Unit </button><br><br> -->
                                        <form id='fileEditForm' name="fileEditForm" method="post" enctype="multipart/form-data">
                                            <input name="CREATE_BY" id='CREATE_BY' value="<?php echo $_SESSION['name']; ?>">
                                            <input name="DIM_CODE" id='dim' value="D01">
                                            <input name="IS_PROMOTE" id='IS_PROMOTE' value="0">
                                            <input name="IS_STOCK" id='IS_STOCK' value="1">
                                            <input name="SHARE_LINK" id='SHARE_LINK' value="www.google.com">
                                            <div class="position-relative form-group">
                                                <label for="exampleEmail" class="">ชื่อสินค้า</label>
                                                <input name="GOODS_NAME_TH" id="itemname" placeholder="" type="text" class="form-control">
                                            </div>

                                            <div class="position-relative form-group"><label for="exampleSelect" class="">Category</label>
                                                <select name="CATE_CODE" id="category" class="form-control">
                                                </select>
                                            </div>

                                            <div class="position-relative form-group"><label for="exampleSelect" class="">Sub Category</label>
                                                <select name="SUB_CATE_CODE" id="subcategory" class="form-control">
                                                </select>
                                            </div>

                                            <div class="position-relative form-group"><label for="exampleSelect" class="">Type Category</label>
                                                <select name="TYPE_CATE_CODE" id="typecategory" class="form-control">
                                                </select>
                                            </div>

                                            <div class="position-relative form-group"><label for="exampleSelect" class="">ประเภทการขนส่ง</label>
                                                <select name="SEND_CODE" id="send" class="form-control">
                                                </select>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="exampleEmail" class="">กว้าง (เซนติเมตร) <font color='red'>*(Dimension X)</font> </label>
                                                    <input name="GOODS_DIM_X" id="dimx" placeholder="" type="number" class="form-control" min="0" value="1">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="exampleEmail" class="">ยาว (เซนติเมตร) <font color='red'>*(Dimension Y)</font> </label>
                                                    <input name="GOODS_DIM_Y" id="dimy" placeholder="" type="number" class="form-control" min="0" value="1">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="exampleEmail" class="">สูง (เซนติเมตร) <font color='red'>*(Dimension Z)</font> </label>
                                                    <input name="GOODS_DIM_Z" id="dimz" placeholder="" type="number" class="form-control" min="0" value="1">
                                                </div>
                                            </div>

                                            <!-- <div class="position-relative form-group"><label for="exampleSelect" class="">ขนาดกล่อง</label>
                                            <select name="dim" id="dim" class="form-control">
                                            </select>
                                        </div> -->

                                            <div class="position-relative form-group">
                                                <label for="exampleEmail" class="">ราคา</label>
                                                <input name="PRICE" id="price" placeholder="" type="number" class="form-control" min="1" value="1">
                                            </div>

                                            <div class="position-relative form-group"><label for="exampleSelect" class="">หน่วยการขาย</label>
                                                &nbsp&nbsp
                                                <!-- <input type="text" name="serch_unit" id="serch_unit" placeholder="ค้นหาหน่วยการขาย" style="width:290px" /> -->
                                                <!-- <select name="unit" id="unit" class="form-control">
                                            </select> -->
                                                <select class="form-control js-example-basic-single" name="UNIT_CODE" id="unit" style="width:100%">
                                                </select>
                                            </div>

                                            <div class="position-relative form-group">
                                                <label for="exampleEmail" class="">น้ำหนัก (กิโลกรัม)</label>
                                                <input name="SUM_WEIGHT" id="weight" placeholder="" type="number" class="form-control" min="0" value="1">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="position-relative form-group text-center"><label for="exampleSelect" class="">รูปที่ : 1</label>
                                                        <div>
                                                            <img id="imgproduct1" src="" class="center" alt="">
                                                        </div>
                                                        <div class="custom-file ml-5">
                                                            <br>
                                                            <input type="file" id="editimgproduct1" name="IMG1" accept="image/x-png,image/jpeg">
                                                            <button type="button" class="btn btn-danger" id="noeditimgproduct1" style="height:80% ;font-size: small;" hidden>X</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="position-relative form-group text-center"><label for="exampleSelect" class="">รูปที่ : 2</label>
                                                        <div>
                                                            <img id="imgproduct2" src="" alt="">
                                                        </div>
                                                        <div class="custom-file ml-5">
                                                            <br>
                                                            <input type="file" id="editimgproduct2" name="IMG2" accept="image/x-png,image/jpeg">
                                                            <button type="button" class="btn btn-danger" id="noeditimgproduct2" style="height:80% ;font-size: small;" hidden>X</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="position-relative form-group text-center"><label for="exampleSelect" class="">รูปที่ : 3</label>
                                                        <div>
                                                            <img id="imgproduct3" src="" alt="">
                                                        </div>
                                                        <div class="custom-file ml-5">
                                                            <br>
                                                            <input type="file" id="editimgproduct3" name="IMG3" accept="image/x-png,image/jpeg">
                                                            <button type="button" class="btn btn-danger" id="noeditimgproduct3" style="height:80% ;font-size: small;" hidden>X</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="position-relative form-group text-center"><label for="exampleSelect" class="">รูปที่ : 4</label>
                                                        <div>
                                                            <img id="imgproduct4" src="" alt="">
                                                        </div>
                                                        <div class="custom-file ml-5">
                                                            <br>
                                                            <input type="file" id="editimgproduct4" name="IMG4" accept="image/x-png,image/jpeg">
                                                            <button type="button" class="btn btn-danger" id="noeditimgproduct4" style="height:80% ;font-size: small;" hidden>X</button>
                                                        </div>
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
            $("#noeditimgproduct1").click(function() {
                noimg(1)
            });
            $("#noeditimgproduct2").click(function() {
                noimg(2)
            });
            $("#noeditimgproduct3").click(function() {
                noimg(3)
            });
            $("#noeditimgproduct4").click(function() {
                noimg(4)
            });
            $("#editimgproduct1").click(function() {
                // alert($('#vendorname').text())
                // $('#modal-title').html('รูปสินค้าที่: 1');
                selectimg(1)
            });
            $("#editimgproduct2").click(function() {
                // alert($('#vendorname').text())
                // $('#modal-title').html('รูปสินค้าที่: 2');
                selectimg(2)

            });
            $("#editimgproduct3").click(function() {
                // alert($('#vendorname').text())
                // $('#modal-title').html('รูปสินค้าที่: 3');
                selectimg(3)
            });

            $("#editimgproduct4").click(function() {
                // $('#modal-title').html('รูปสินค้าที่: 4');
                selectimg(4)
            });

            function noimg(i) {
                document.getElementById('imgproduct' + i).hidden = true;
                document.getElementById('noeditimgproduct' + i).hidden = true;
                document.getElementById('editimgproduct' + i).value = "";
            }

            function selectimg(a) {
                $('#editimgproduct' + a).on('change', function() {
                    var size = this.files[0].size / 1024 / 1024
                    if (size.toFixed(2) > 2) {
                        alert('to big, maximum is 2MB')
                    } else {
                        var fileName = $(this).val().split('\\').pop()
                        $(this).siblings('.custom-file-label').html(fileName)
                        if (this.files[0]) {
                            var reader = new FileReader()
                            reader.onload = function(e) {
                                $("#imgproduct" + a).attr("src", e.target.result).width(300).height(300);
                                $(this).siblings('.custom-file-label').html("")
                                document.getElementById('noeditimgproduct' + a).hidden = false;
                                document.getElementById('imgproduct' + a).hidden = false;

                            }
                            reader.readAsDataURL(this.files[0])
                        }
                    }
                })
            }

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
                if (weight.trim().length <= 0 || weight <= 0) {
                    $('#weight').attr("style", "border-color:#dc3545");
                }
                if (typecategory == null) {
                    $('#typecategory').attr("style", "border-color:#dc3545");
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
                } else if (typecategory == null) {
                    $('#typecategory').focus();
                }


                if (itemname.trim().length > 0 && typecategory != null && price != 0 && weight != 0 && dimx.length > 0 && dimy.length > 0 && dimz.length > 0) {
                    alert("ok")
                    // $.post(url_global + "/api/v1_0/shop/shopitem", {
                    //     "CREATE_BY": admin_name,
                    //     "DIM_CODE": dim,
                    //     "IS_PROMOTE": 0,
                    //     "IS_STOCK": 1,
                    //     "SHARE_LINK": "www.google.com",
                    //     "GOODS_NAME_TH": itemname,
                    //     "CATE_CODE": category,
                    //     "SUB_CATE_CODE": subcategory,
                    //     "TYPE_CATE_CODE": typecategory,
                    //     "SEND_CODE": send,
                    //     "GOODS_DIM_X": dimx,
                    //     "GOODS_DIM_Y": dimy,
                    //     "GOODS_DIM_Z": dimz,
                    //     "PRICE": price,
                    //     "UNIT_CODE": unit,
                    //     "SUM_WEIGHT": weight,
                    //     "SHOP_CODE": SHOP_CODE

                    // }).done(function(data) {
                    //     if (data['STATUS'] == 1) {
                    //         var dataRes = data['RESULT']
                    //         if (dataRes == 'SUCCESS') {
                    //             alert("บันทึกสำเร็จ")
                    //             window.location = './itemvendor.php?SO=' + shopcode + '&SH_NAME=' + SHOP_NAME
                    //         } else {
                    //             alert("ไม่สำเร็จ แจ้งแอดมิน")
                    //         }
                    //     } else {
                    //         alert("ไม่สำเร็จ แจ้งแอดมิน")
                    //     }
                    //     // console.log(data)
                    //     // alert(data)
                    // });
                    var url = url_global + '/api/v1_0/shop/shopitem/'
                    var form1 = $('#fileEditForm')[0];
                    var data = new FormData(form1);

                    for (var value of data.values()) {
                        console.log(value);
                    }
                    // $.ajax({
                    //     type: "POST",
                    //     enctype: 'multipart/form-data',
                    //     url: url,
                    //     data: data,
                    //     processData: false,
                    //     contentType: false,
                    //     cache: false,
                    //     timeout: 600000,
                    //     success: function(data) {

                    //         if (data['STATUS'] == 1) {
                    //             var dataRes = data['RESULT']
                    //             if (dataRes == 'SUCCESS') {
                    //                 alert("บันทึกสำเร็จ")
                    //                 location.reload();
                    //             } else {
                    //                 alert("ไม่สำเร็จ แจ้งแอดมิน")
                    //             }
                    //         } else {
                    //             alert("ไม่สำเร็จ แจ้งแอดมิน")
                    //         }
                    //     },
                    //     error: function(e) {
                    //         console.log("ERROR : ", e);
                    //     }
                    // });
                    // alert('ไม่เกิน20')

                } else {
                    alert("err")
                }
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