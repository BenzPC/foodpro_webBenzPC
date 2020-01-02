<?php

$configs = include('../config/constants.php');
$url_global = $configs['url_global'];

session_start();
if (empty($_SESSION['name'])) {
    header('Location: ./login.php');
}
// echo $_SESSION['name'];

$url_global = $configs['url_global'];
$SHOP_CODE = $_REQUEST['SHOP_CODE'];
$SHOP_NAME = $_REQUEST['SHOP_NAME'];
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin FoodPro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Wide selection of forms controls, using the Bootstrap 4 code base, but built with React.">
    <meta name="msapplication-tap-highlight" content="no">
    <?php include_once '../inc/meta.php' ?>


</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include_once '../inc/sidemenu.php' ?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="margin-bottom: 10px;">
                                <h5 class="text-center">รายชื่อ Shop </h5>
                            </div>
                            <!-- Table -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="example" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <!-- <th>ชื่อร้าน</th> -->
                                                    <th>ลำดับ</th>
                                                    <th>ชื่อสินค้า</th>
                                                    <th>Category</th>
                                                    <th>Sub Category</th>
                                                    <th>Type Category</th>
                                                    <th>หน่วยการขาย</th>
                                                    <th>น้ำหนัก (kg)</th>
                                                    <th>กาารขนส่ง</th>
                                                    <th>ขนาดกล่อง</th>
                                                    <th>ราคา</th>
                                                    <th>Is Stock</th>
                                                    <!-- <th>แก้ไขสินค้า</th> -->
                                                    <th>เพิ่มรูปสินค้า</th>
                                                    <th>คำบรรยายสินค้า</th>
                                                    <th>เพิ่ม Dimension</th>
                                                </tr>
                                            </thead>
                                            <tbody id='tablebody'>

                                            </tbody>
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




    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="btnModalUpImg" style='display:none;'>
        เพิ่มรูปสินค้า
    </button>
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p id="modal-body"></p>
                    <form id='fileUploadForm' method="post" enctype="multipart/form-data">
                        เลือกรูปภาพ : <input type="file" name="IMG" accept="image/x-png,image/jpeg"><br>
                        <input type="hidden" name="SHOP_CODE" id="strshopcode">
                        <input type="hidden" name="CATE_CODE" id="strcatecode">
                        <input type="hidden" name="SUB_CATE_CODE" id="strsubcode">
                        <input type="hidden" name="TYPE_CATE_CODE" id="strtypecode">
                        <input type="hidden" name="ADMIN_NAME" id="admin_name"><br>

                        <input id="UpImg" type="button" value="Upload Image" class="btn btn-primary">
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>


    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2" id="btnModalDesc" style='display:none;'>
        เพิ่มคำบรรยาย
    </button>
    <!-- The Modal -->
    <div class="modal" id="myModal2">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title2"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p id="modal-body2"></p>
                    <!-- <form id='fileUploadForm2' method="post" enctype="multipart/form-data"> -->
                    <!-- Select a file: <input type="file" name="IMG" accept="image/x-png,image/jpeg"><br> -->
                    <textarea rows="15" cols="60" id='txtdesc'></textarea>
                    <input type="hidden" name="SHOP_CODE" id="strshopcode2">
                    <input type="hidden" name="CATE_CODE" id="strcatecode2">
                    <input type="hidden" name="SUB_CATE_CODE" id="strsubcode2">
                    <input type="hidden" name="TYPE_CATE_CODE" id="strtypecode2">

                    <input id="UpDesc" type="button" value="Upload Description" class="btn btn-primary">
                    <!-- </form> -->
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>


    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal3" id="btnModalDim" style='display:none;'>
        เพิ่ม Dimension
    </button>
    <!-- The Modal -->
    <div class="modal" id="myModal3">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title3"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p id="modal-body2"></p>

                    <input type="hidden" name="GOODS_CODE" id="strgoodcode">

                    <div class="row">
                        <div class="col-md-4">
                            <label for="exampleEmail" class="">กว้าง (เซนติเมตร) <br>
                                <font color='red'>*(Dimension X)</font>
                            </label>
                            <input name="dimx" id="dimx" placeholder="" type="number" class="form-control" min="0" value="1">
                        </div>

                        <div class="col-md-4">
                            <label for="exampleEmail" class="">ยาว (เซนติเมตร) <br>
                                <font color='red'>*(Dimension Y)</font>
                            </label>
                            <input name="dimy" id="dimy" placeholder="" type="number" class="form-control" min="0" value="1">
                        </div>

                        <div class="col-md-4">
                            <label for="exampleEmail" class="">สูง (เซนติเมตร) <br>
                                <font color='red'>*(Dimension Z)</font>
                            </label>
                            <input name="dimz" id="dimz" placeholder="" type="number" class="form-control" min="0" value="1">
                        </div>
                    </div>

                    <br>
                    <input id="UpDim" type="button" value="บันทึก" class="btn btn-primary">
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>


    <!-- <script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script> -->

    <!-- <script>
    $(document).ready(function() {
       var table = $('#example').DataTable({
            "ajax": "data_item_vendor.json",
            "columnDefs": [ 
                {
                    "targets": -1,
                    "data": null,
                    "defaultContent": "<button id='btnDetail'>ดูรายละเอียด</button>"
                }
            ]
        });
    });


    $('#example tbody').on( 'click', '#btnDetail', function () {
        alert('btnDetail ดูรายละเอียดสินค้า')
    } );

    $('#divbtnAddNewItem').on( 'click', '#btnAddNewItem', function () {
        alert('btnAddNewItem เพิ่มสินค้าใหม่')
    } );

</script> -->
    <script>
        $(document).ready(function() {
            var admin_name = '<?php echo $_SESSION['name']; ?>'
            var SHOP_CODE = '<?php echo $SHOP_CODE; ?>'
            var SHOP_NAME = '<?php echo $SHOP_NAME; ?>'

            const url_global = '<?php echo $url_global; ?>'
            const urll = url_global + '/api/v1_0/master/getlistitemshop/V191220004';
            $('#vendorname').html("<font color='blue'>" + SHOP_NAME + "</font>")




            $("#btnAddItem").click(function() {
                // alert($('#vendorname').text())
                window.location = './additem.php?SHOP_CODE=' + SHOP_CODE + '&SHOP_NAME=' + SHOP_NAME
            });

            $("#btnListItem").click(function() {
                // alert($('#vendorname').text())
                window.location = './itemvendor.php?SHOP_CODE=' + SHOP_CODE + '&SHOP_NAME=' + SHOP_NAME
            });


            var tablePropertygroup1 = $('#example').DataTable({
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

                    {
                        "data": null
                    },
                    {
                        "data": "GOODS_CODE",
                        render: function(data, type, row) {
                            return '<a href="/edititemvender.php?SHOP_CODE=' + row.SHOP_CODE + '&GOODS_CODE=' + row.GOODS_CODE + ' ">' + row.GOODS_NAME_TH + '</a>';
                        }
                    },
                    {
                        "data": "CATE_NAME_TH"
                    },
                    {
                        "data": "SUB_CATE_NAME_TH"
                    },
                    {
                        "data": "TYPE_CATE_NAME_TH"
                    },
                    {
                        "data": "UNIT_NAME_TH"
                    },
                    {
                        "data": "SUM_WEIGHT"
                    },

                    {
                        "data": "SEND_NAME_TH"
                    },

                    {
                        "data": "DIM_NAME_TH"
                    },
                    {
                        "data": "PRICE"
                    },
                    {
                        "data": "IS_STOCK"
                    },
                    {
                        "data": "IMG",
                        render: function(data, type, row) {

                            if (row.IMG < 4) {
                                return "<button class='btnAddImg'> เพิ่มรูปสินค้า (" + row.IMG + ") </button>";

                            } else {
                                return "<button class='btnAddImg' disabled> เพิ่มรูปสินค้า (" + row.IMG + ") </button>";

                            }
                        }
                    },
                    {
                        "data": "DESC",
                        render: function(data, type, row) {
                            var DESC = row.DESC;

                            if (DESC != null) {
                                if (DESC.length == 0) {
                                    return "<button class='btnDesc btn btn-danger'> เพิ่มคำบรรยาย </button>"
                                } else {
                                    return "<button class='btnDesc btn btn-success'> เพิ่มคำบรรยาย </button>"
                                }
                            } else {
                                return "<button class='btnDesc btn btn-danger'> เพิ่มคำบรรยาย </button>"
                            }
                        }
                    },
                    {
                        "data": "GOODS_DIM_X",
                        render: function(data, type, row) {
                            var DIMX = row.GOODS_DIM_X;
                            if (DIMX == null) {
                                return "<button class='btnDim btn btn-danger'> Dimension </button>"
                            } else {
                                return "<button class='btnDim btn btn-success'> Dimension </button>"
                            }
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



            $('#UpDim').click(function(event) {
                let dimx = $('#dimx').val()
                let dimy = $('#dimy').val()
                let dimz = $('#dimz').val()
                let goodcode = $('#strgoodcode').val()

                if (dimx.length > 0 && dimy.length > 0 && dimz.length > 0) {
                    $.post(url_global + '/api/v1_0/master/updatedimension', {
                        "GOODS_CODE": goodcode,
                        "GOODS_DIM_X": dimx,
                        "GOODS_DIM_Y": dimy,
                        "GOODS_DIM_Z": dimz,
                        "ADMIN_NAME": admin_name,
                        "SHOP_CODE": SHOP_CODE

                    }).done(function(data) {
                        // console.log(data)
                        if (data['STATUS'] == 1) {
                            var dataRes = data['RESULT']
                            if (dataRes == 'SUCCESS') {
                                alert("บันทึกสำเร็จ")
                                location.reload();
                            } else {
                                alert("ไม่สำเร็จ แจ้งแอดมิน")
                            }
                        } else {
                            alert("ไม่สำเร็จ แจ้งแอดมิน")
                        }
                    })
                } else {
                    if (dimx.length == 0) {
                        alert('ไม่มี แกน X');
                        $('#dimx').focus();
                    } else if (dimy.length == 0) {
                        alert('ไม่มี แกน Y');
                        $('#dimy').focus();
                    } else if (dimz.length == 0) {
                        alert('ไม่มี แกน Z');
                        $('#dimz').focus();
                    }
                }
            });

            $('#UpDesc').click(function(event) {
                // alert('dsfsdsf')
                var strshopcode2 = $('#strshopcode2').val();
                var strcatecode2 = $('#strcatecode2').val();
                var strsubcode2 = $('#strsubcode2').val();
                var strtypecode2 = $('#strtypecode2').val();
                var txtdesc = $('#txtdesc').val().trim();

                if (txtdesc.length <= 500) {
                    $.post(url_global + "/api/v1_0/shop/getitemdesc", {
                        "CATE_CODE": strcatecode2,
                        "SUB_CATE_CODE": strsubcode2,
                        "SHOP_CODE": strshopcode2,
                        "TYPE_CATE_CODE": strtypecode2,
                        "GOODS_DESC_TH": txtdesc,
                        "ADMIN_NAME": admin_name

                    }).done(function(data) {
                        if (data['STATUS'] == 1) {
                            var dataRes = data['RESULT']
                            if (dataRes == 'SUCCESS') {
                                alert("บันทึกสำเร็จ")
                                location.reload();
                            } else {
                                alert("ไม่สำเร็จ แจ้งแอดมิน")
                            }
                        } else {
                            alert("ไม่สำเร็จ แจ้งแอดมิน")
                        }
                        // console.log(data)
                        // alert(data)
                    });
                } else {
                    alert('ตัวอักษรเกิน 500')
                }
            });

            $('#UpImg').click(function(event) {
                var url = url_global + '/api/v1_0/shop/uploadpicshopitem'
                // alert('ddd')
                event.preventDefault();

                // Get form
                var form = $('#fileUploadForm')[0];

                // Create an FormData object 
                var data = new FormData(form);
                console.log("duckDATAA : ", form)

                // If you want to add an extra field for the FormData
                // data.append("CustomField", "This is some extra data, testing");

                // disabled the submit button
                // $("#btnSubmit").prop("disabled", true);

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
                        // console.log(data);
                        // console.log(data['STATUS']);
                        if (data['STATUS'] == 1) {
                            if (data['RESULT'] == 'SUCCESS') {
                                alert("บึกทึกรูปภาพสำเร็จ");
                                location.reload();
                            } else {
                                alert("ผิดพลาด");
                            }
                        } else {
                            alert("ผิดพลาด");
                        }

                        // $("#result").text(data);
                        // console.log("SUCCESS : ", data);
                        // $("#btnSubmit").prop("disabled", false);

                    },
                    error: function(e) {

                        // $("#result").text(e.responseText);
                        console.log("ERROR : ", e);
                        // $("#btnSubmit").prop("disabled", false);

                    }
                });
            });

        })

        $('#btnlogout').click(function() {
            window.location = './logout.php'
        })
    </script>

</body>

</html>