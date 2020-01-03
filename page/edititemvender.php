<?php

session_start();
if (empty($_SESSION['name'])) {
    header('Location: ./login.php');
}

$configs = include('../config/constants.php');
$url_global = $configs['url_global'];


$SO_CODE = (isset($_GET['SHOP_CODE'])) ? $_GET['SHOP_CODE'] : '';
$GOODS_CODE = (isset($_GET['GOODS_CODE'])) ? $_GET['GOODS_CODE'] : '';


?>

<!doctype html>
<html lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Admin FoodPro</title>
<?php include_once '../inc/meta.php' ?>

<head>


    <style>
        .toggle.ios,
        .toggle-on.ios,
        .toggle-off.ios {
            border-radius: 20px;
            background-color: #FF6666;
        }

        .toggle.ios .toggle-handle {
            border-radius: 20px;
        }
    </style>

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
                                <h5 class="text-center">รายชื่อ สินค้า </h5>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <h4 style="color: rgb(0, 0, 255); padding: 10px; padding-bottom: 0px;"><?php echo $SH_ANME; ?> </h4>
                                    <!-- Table -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <form id='fileUploadForm' method="post" enctype="multipart/form-data">

                                            <div class="card-body">
                                                <h1><span id="vendorname"></span></h1>
                                                <!-- <button id='refcombo1'> Refresh Combo Cate </button>

                                                <button id='refcombo4'> Refresh Combo Unit </button> -->
                                                <br>
                                                <!-- ////////////////////////////////////// -->
                                                <div class="position-relative form-group">
                                                    <label for="exampleEmail" class="">ชื่อสินค้า</label>
                                                    <input name="itemname" id="itemname" placeholder="" type="text" class="form-control">
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="position-relative form-group"><label for="exampleSelect" class="">Category</label>
                                                            <select name="category" id="category" class="form-control">
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="position-relative form-group"><label for="exampleSelect" class="">Sub Category</label>
                                                            <select name="subcategory" id="subcategory" class="form-control">
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="position-relative form-group"><label for="exampleSelect" class="">Type Category</label>
                                                            <select name="typecategory" id="typecategory" class="form-control">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="position-relative form-group">
                                                            <label for="exampleEmail" class="">ราคา</label>
                                                            <input name="price" id="price" placeholder="" type="number" class="form-control" min="1" value="1">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="position-relative form-group"><label for="exampleSelect" class="">หน่วยการขาย </label>

                                                            <!-- <label>ค้นหา:</label> -->

                                                            &nbsp&nbsp
                                                            <!-- <input type="text" name="serch_unit" id="serch_unit" placeholder="ค้นหาหน่วยการขาย" style="width:290px" /> -->
                                                            <select name="unit" id="unit" class="form-control js-example-basic-single">
                                                            </select>
                                                        </div>
                                                    </div>




                                                    <div class="col-md-4">
                                                        <div class="position-relative form-group">
                                                            <label for="exampleEmail" class="">น้ำหนัก (กิโลกรัม)</label>
                                                            <input name="weight" id="weight" placeholder="" type="number" class="form-control" min="0" value="1">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="position-relative form-group"><label for="exampleSelect" class="">ประเภทการขนส่ง</label>
                                                    <select name="send" id="send" class="form-control">
                                                    </select>
                                                </div>


                                                <div class="position-relative form-group"><label for="exampleSelect" class="">สถานะสินค้า </label>

                                                    <!-- <input name="statusproduct" id="statusproduct" value="1" type="checkbox" checked data-toggle="toggle" data-style="ios"> -->


                                                    <select name="statusproduct" id="statusproduct" class="form-control">
                                                        <option value="1">เปิดการใช้งาน</option>

                                                        <option value="2">ปิดการใช้งาน</option>
                                                    </select>
                                                </div>

                                                <input type="text" name="SHOP_CODE" id="strshopcode2"><br>
                                                <input type="text" name="good_code" id="good_code"><br>
                                                <input type="text" name="ADMIN_NAME" id="admin_name"><br>
                                                <input type="text" name="old_catecode" id="old_catecode"><br>
                                                <input type="text" name="old_typecatecode" id="old_typecatecode"><br>
                                                <input type="text" name="old_subcatecode" id="old_subcatecode"><br>
                                                <input type="text" name="tepy_cate_img" id="tepy_cate_img"><br>
                                                <input type="text" name="oldimg1" id="oldimg1"><br>
                                                <input type="text" name="oldimg2" id="oldimg2"><br>
                                                <input type="text" name="oldimg3" id="oldimg3"><br>
                                                <input type="text" name="oldimg4" id="oldimg4"><br>



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

                                                <hr>



                                                <button id='btn0' class="btn btn-primary btn-lg mt-3 mb-3">บันทึก</button>

                                                <!-- ////////////////////////////////////// -->


                                            </div>
                                        </form>
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
            var GOODS_CODE = '<?php echo $GOODS_CODE; ?>'

            const url_global = '<?= $url_global ?>';

            var getParams = function(url) {
                var params = {};
                var parser = document.createElement('a');
                parser.href = url;
                var query = parser.search.substring(1);
                var vars = query.split('&');
                for (var i = 0; i < vars.length; i++) {
                    var pair = vars[i].split('=');
                    params[pair[0]] = decodeURIComponent(pair[1]);
                }
                return params;
            };
            $('.js-example-basic-single').select2();
            // const params = getParams(window.location.href)
            getItemDetail(SHOP_CODE, GOODS_CODE)

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
                                document.getElementById('imgproduct' + i).hidden = false;

                            }
                            reader.readAsDataURL(this.files[0])
                        }
                    }
                })
            }

            var type_code;
            var unit_codefind;

            function getItemDetail(shop_code, goods_code) {
                $.get(url_global + `/api/v1_0/product/item/${shop_code}/${goods_code}`).done(function(data) {
                    const shop = data.RESULT
                    const imgshop = shop.DETAIL;
                    const s = "1";

                    $('#itemname').val(shop.GOODS_NAME_TH),

                        $('#category').val(),
                        $('#good_code').val(shop.GOODS_CODE),

                        $('#subcategory').val(shop.SUB_CATE_CODE),
                        $('#typecategory').val(shop.TYPE_CATE_CODE),
                        $('#price').val(shop.PRICE),
                        $('#unit').val(shop.UNIT_CODE),
                        $('#send').val(shop.SEND_CODE),
                        $('#weight').val(shop.SUM_WEIGHT),

                        $('#unit1').val(shop.UNIT_CODE),

                        $('#strshopcode2').val(shop_code),
                        $('#admin_name').val(admin_name),
                        $('#old_catecode').val(shop.CATE_CODE),
                        $('#old_subcatecode').val(shop.SUB_CATE_CODE),
                        $('#old_typecatecode').val(shop.TYPE_CATE_CODE),

                        type_code = shop.TYPE_CATE_CODE;
                        unit_codefind = shop.UNIT_CODE

                    $('#IS_STOCK').val(shop.IS_STOCK)
                    for (i = 1; i <= shop.SUM_IMG; i++) {
                        let count = i - 1;
                        $("#imgproduct" + i).attr("src", imgshop[count].IMG_PATH);
                        $("#oldimg" + i).val(imgshop[count].OLD_PATH);
                    }

                    load_category(shop.CATE_CODE, shop.SUB_CATE_CODE, shop.IS_STOCK)
                    // params.SHOP_CODE,params.GOODS_CODE
                    load_send(shop.SEND_CODE)
                    load_unit(shop.UNIT_CODE)
                    // load_unit_forserch(shop.UNIT_CODE)
                    check_isstcok(shop.IS_STOCK);
                    // load_province(shop.PROVINCE_CODE, shop.DISTRICT_CODE)
                    // location_dc(shop.DC_LOCATION_ID)
                })
            }

            // disable scrollmouse in text type number
            $(document).on("wheel", "input[type=number]", function(e) {
                $(this).blur();
            });

            // load_category()
            // params.SHOP_CODE,params.GOODS_CODE
            // load_send()
            // load_unit()

            // onclick edit image
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

            const escapeRegExp = (string) => {
                return string.replace(/[^0-9A-Za-zก-ฮ๐-๙โเแไำะาๆฯใ\s]/g, '')
            }

            function load_unit(UNIT_CODEq) {
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
                            $('#unit').val(UNIT_CODEq)



                        } else {
                            alert("dataRes.length != 0 |||||| ไม่พบข้อมูล");
                        }
                    } else {
                        alert("Status ไม่เท่ากับ 1")
                    }
                })
            }


            // function load_unit_forserch(UNIT_CODEq) {
            //     // $('#unit').empty()
            //     $.get(url_global + '/api/v1_0/master/getcombounit').done(function(data) {
            //         var append = ""
            //         if (data['STATUS'] == 1) {
            //             var dataRes = data['RESULT']
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



            function check_isstcok(IS_STOCKq) {

                if (IS_STOCKq == 1) {
                    $('#statusproduct').val(1)
                } else if (IS_STOCKq == 2) {
                    $('#statusproduct').val(2)

                }

            }

            function load_send(SEND_CODEq) {
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
                            $('#send').val(SEND_CODEq)


                        } else {
                            alert("dataRes.length != 0 |||||| ไม่พบข้อมูล");
                        }
                    } else {
                        alert("Status ไม่เท่ากับ 1")
                    }
                })
            }

            function load_category(CATE_CODEq, SUB_CATE_CODEq, IS_STOCKq) {
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
                            $('#category').val(CATE_CODEq)

                            load_sub_cate($('#category').val(), SUB_CATE_CODEq)


                        } else {
                            alert("dataRes.length != 0 |||||| ไม่พบข้อมูล");
                        }
                    } else {
                        alert("Status ไม่เท่ากับ 1")
                    }
                })
            }




            $('#category').change(function(v) {

                var cate_code = v.target.value;
                load_sub_cate(cate_code)
            });

            function load_sub_cate(cate_code, SUB_CATE_CODEq) {
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
                            $('#subcategory').val(SUB_CATE_CODEq)


                            load_type_cate(cate_code, $('#subcategory').val())



                        } else {
                            alert("dataRes.length != 0 |||||| ไม่พบข้อมูล");
                        }
                    } else {
                        alert("Status ไม่เท่ากับ 1")
                    }
                })
            }

            $('#subcategory').change(function(v) {
                // alert(v.target.value);
                var cate_code = $('#category').val()
                //alert(cate_code)
                var sub_cate_code = v.target.value;
                load_type_cate(cate_code, sub_cate_code)
            });

            function load_type_cate(cate_code, sub_cate_code) {
                $('#typecategory').empty()
                $.get(url_global + '/api/v1_0/master/getcombotypecate/' + cate_code + '/' + sub_cate_code).done(function(data) {

                    var append = ""
                    if (data['STATUS'] == 1) {
                        var dataRes = data['RESULT']
                        if (dataRes.length != 0) {
                            for (var i = 0; i < dataRes.length; i++) {
                                var SUB_CATE_CODE = dataRes[i]['value']
                                var SUB_CATE_NAME_TH = dataRes[i]['label']

                                append = append + "<option value='" + SUB_CATE_CODE + "'>" + SUB_CATE_NAME_TH + "</option>";
                            }
                            // type_code
                            $('#typecategory').append(append)
                            $('#typecategory').val(type_code)



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
                var price = $('#price').val();

                var unit = $('#unit').val();
                var send = $('#send').val();
                var weight = $('#weight').val().trim();
                var IS_STOCK = $('#statusproduct').val();


                var url = url_global + '/api/v1_0/product'
                event.preventDefault();



                var form1 = $('#fileUploadForm')[0];
                ''


                // Create an FormData object 
                var data = new FormData(form1);








                var shopcode = SHOP_CODE
                // alert(shopcode)
                var countstritemname = escapeRegExp(itemname)
                // console.log(countstritemname)

                if (itemname.trim().length > 0 && typecategory != 0 && price != 0 && weight != 0) {
                    if (countstritemname.length <= 60) {
                        $.ajax({
                            type: "POST",
                            enctype: 'multipart/form-data',
                            url: url,
                            data: data,
                            processData: false,
                            contentType: false,
                            cache: false,
                            timeout: 600000,
                            success: function(data) {

                                if (data['STATUS'] == 1) {
                                    if (data['RESULT'] == 'SUCCESS') {
                                        alert("แก้ไขข้อมูลเสร็จสิ้น");
                                        location.reload();
                                    } else {
                                        alert("ผิดพลาด");
                                    }
                                } else {
                                    alert("ผิดพลาด");
                                }



                            },
                            error: function(e) {

                                console.log("ERROR : ", e);

                            }
                        });
                    } else {
                        alert('ชื่อสินค้าเกิน 60 ตัวอักษร')
                        $('#itemname').focus();
                    }
                } else {
                    // alert("0000")
                    if (itemname.trim().length == 0) {
                        alert('ไม่มี ชื่อสินค้า');
                        $('#itemname').focus();
                    } else if (typecategory == 0) {
                        alert('แจ้งแอดมิน ให้เพิ่มข้อมูล');
                    } else if (price == 0) {
                        alert('ไม่มี ราคา');
                        $('#price').focus();
                    } else if (weight == 0) {
                        alert('ไม่มี น้ำหนัก');
                        $('#weight').focus();
                    }
                }
            })





        })

        $('#btnlogout').click(function() {
            window.location = './logout.php'
        })
    </script>

</body>

</html>