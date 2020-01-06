<?php

$configs = include('../config/constants.php');
$url_global = $configs['url_global'];

session_start();
if (empty($_SESSION['name'])) {
    header('Location: ./login.php');
}
// echo $_SESSION['name'];
$SO_CODE = (isset($_GET['SO'])) ? $_GET['SO'] : '';
$SH_NAME = (isset($_GET['SH_NAME'])) ? $_GET['SH_NAME'] : '';

// $url_global = $configs['url_global'];
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
                                <h5 class="text-center">รายชื่อ สินค้า </h5>
                            </div>
                            <div class="row">
                                <div class="col-6" >
                                    <h4 style="color: rgb(0, 0, 255); padding: 10px; padding-bottom: 0px;"><?php echo $SH_NAME; ?> </h4>
                                    <!-- Table -->
                                </div>
                                <div class="col-6" style="text-align: right; padding-right: 25px;">
                                <a  class="btn btn-primary" type="button"href="additem.php?SO=<?php echo $SO_CODE; ?>&SH_NAME=<?php echo $SH_NAME; ?> ">เพิ่ม / + /  เพิ่มไอเทม</a>
                                </div>
                            </div>
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
                                                    <!-- <th>เพิ่มรูปสินค้า</th> -->
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
                        เลือกรูปภาพ : <input type="file" name="IMGItem" id="IMGItem" accept="image/x-png,image/jpeg"><br><br>
                        <div class="row">
                            <div class="col-md">
                                <img id="IMGItemShow" style="width: inherit;">
                            </div>
                        </div>
                        <input type="hidden" name="SHOP_CODE" id="strshopcode">
                        <input type="hidden" name="CATE_CODE" id="strcatecode">
                        <input type="hidden" name="SUB_CATE_CODE" id="strsubcode">
                        <input type="hidden" name="TYPE_CATE_CODE" id="strtypecode">
                        <input type="hidden" name="ADMIN_NAME" id="admin_name"><br>

                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <input id="UpImg" type="button" value="บันทึก" class="btn btn-primary">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                </div>

            </div>
        </div>
    </div>

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
                    <textarea rows="15" id='txtdesc' style="width: -webkit-fill-available;"></textarea>
                    <input type="text" name="SHOP_CODE" id="strshopcode2">
                    <input type="text" name="CATE_CODE" id="strcatecode2">
                    <input type="text" name="SUB_CATE_CODE" id="strsubcode2">
                    <input type="text" name="TYPE_CATE_CODE" id="strtypecode2">
                    <input type="text" name="GOODS_CODE" id="strgoodcode2">

                    <!-- </form> -->
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <input id="UpDesc" type="button" value="บันทึก" class="btn btn-primary">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                </div>

            </div>
        </div>
    </div>

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
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <input id="UpDim" type="button" value="บันทึก" class="btn btn-primary">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
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
            var SH_NAME = '<?php echo $SH_NAME; ?>'

            const SOO = '<?= $SO_CODE ?>';
            const url_global = '<?php echo $url_global; ?>'
            const urll = url_global + `/api/v1_0/master/getlistitemshop/${SOO}`;


            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#IMGItemShow').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#IMGItem").change(function() {
                readURL(this);
            });

            // $("#btnAddItem").click(function() {
            //     // alert($('#vendorname').text())
            //     window.location = './additem.php?SHOP_CODE=' + SHOP_CODE + '&SHOP_NAME=' + SHOP_NAME
            // });

            // $("#btnListItem").click(function() {
            //     // alert($('#vendorname').text())
            //     window.location = './itemvendor.php?SHOP_CODE=' + SHOP_CODE + '&SHOP_NAME=' + SHOP_NAME
            // });


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
                            return '<a style="color: #3f6ad8;" href="edititemvender.php?SHOP_CODE=' + SOO + '&GOODS_CODE=' + row.GOODS_CODE + ' &SH_NAME=' + SH_NAME + '">' + row.GOODS_NAME_TH + '</a>';
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
                    // {
                    //     "data": "IMG",
                    //     render: function(data, type, row) {

                    //         if (row.IMG < 4) {
                    //             return "<button class='btnAddImg btn btn-secondary' id='btnidAddImg' data-toggle='modal' data-target='#myModal'> เพิ่มรูปสินค้า (" + row.IMG + ") </button>";

                    //         } else {
                    //             return "<button class='btnAddImg btn btn-secondary' id='btnidAddImg' disabled> เพิ่มรูปสินค้า (" + row.IMG + ") </button>";

                    //         }
                    //     }
                    // },
                    {
                        "data": "DESC",
                        render: function(data, type, row) {

                            var DESC = row.DESC;
                            if (DESC != null) {
                                if (DESC.length == 0) {
                                    return "<button class='btnDesc btn btn-danger' data-toggle='modal' data-target='#myModal2'> เพิ่มคำบรรยาย </button>"
                                } else {
                                    return "<button class='btnDesc btn btn-success' data-toggle='modal' data-target='#myModal2'> เพิ่มคำบรรยาย </button>"
                                }
                            } else {
                                return "<button class='btnDesc btn btn-danger' data-toggle='modal' data-target='#myModal2'> เพิ่มคำบรรยาย </button>"
                            }
                        }
                    },
                    {
                        "data": "GOODS_DIM_X",
                        render: function(data, type, row) {
                            var DIMX = row.GOODS_DIM_X;
                            if (DIMX == null) {
                                return "<button class='btnDim btn btn-danger' data-toggle='modal' data-target='#myModal3'> Dimension </button>"
                            } else {
                                return "<button class='btnDim btn btn-success' data-toggle='modal' data-target='#myModal3'> Dimension </button>"
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

            $('#example tbody').on('click', 'tr', function() {

                var data = $(this).find('td:eq(0)').text();
                var data1 = tablePropertygroup1.row(this).data();
                //Modal 1
                $('#strshopcode').val(SOO);
                $('#strcatecode').val(data1.CATE_CODE);
                $('#strsubcode').val(data1.SUB_CATE_CODE);
                $('#strtypecode').val(data1.TYPE_CATE_CODE);
                $('#admin_name').val(admin_name);
                $('#modal-title').html('ชื่อสินค้า: ' + data1.GOODS_NAME_TH);
                $('#IMGItemShow').attr('src', "");
                $('#IMGItem').val("");
                //Modal 3
                $('#strshopcode2').val(SOO);
                $('#strcatecode2').val(data1.CATE_CODE);
                $('#strsubcode2').val(data1.SUB_CATE_CODE);
                $('#strtypecode2').val(data1.TYPE_CATE_CODE);
                $('#strgoodcode2').val(data1.GOODS_CODE);
                
                $('#txtdesc').val('')
                $('#modal-title2').html('ชื่อสินค้า: ' + data1.GOODS_NAME_TH);

                $.get(url_global + '/api/v1_0/shop/getitemdesc/' + SOO + "/" + data1.CATE_CODE + "/" + data1.SUB_CATE_CODE + "/" + data1.TYPE_CATE_CODE).done(function(jsonData) {
                    // console.log(jsonData)
                    if (jsonData['STATUS'] == 1) {
                        var dataRes = jsonData['RESULT']
                        // $('#vendorname').html("<font color='blue'>" + dataRes[0]['SHOP_NAME_TH'] + "</font>")

                        if (dataRes.length != 0) {
                            $('#txtdesc').val(dataRes[0]['GOODS_DESC_TH'])
                        } else {
                            $('#txtdesc').val('')
                        }
                    }
                });
                //Modal 3
                $('#strgoodcode').val(data1.GOODS_CODE);
                $('#modal-title3').html('เพิ่ม Dimension สินค้า : ' + data1.GOODS_NAME_TH);

                $.get(url_global + '/api/v1_0/master/updatedimension/' + data1.GOODS_CODE).done(function(jsonData) {
                    console.log(jsonData)
                    if (jsonData['STATUS'] == 1) {
                        var dataRes = jsonData['RESULT']
                        // $('#vendorname').html("<font color='blue'>" + dataRes[0]['SHOP_NAME_TH'] + "</font>")

                        if (dataRes.length != 0) {
                            if (dataRes[0]['GOODS_DIM_X'] == null) {
                                $('#dimx').val(0)
                            } else {
                                $('#dimx').val(dataRes[0]['GOODS_DIM_X'])
                            }

                            if (dataRes[0]['GOODS_DIM_Y'] == null) {
                                $('#dimy').val(0)
                            } else {
                                $('#dimy').val(dataRes[0]['GOODS_DIM_Y'])
                            }

                            if (dataRes[0]['GOODS_DIM_Z'] == null) {
                                $('#dimz').val(0)
                            } else {
                                $('#dimz').val(dataRes[0]['GOODS_DIM_Z'])
                            }
                        } else {
                            // $('#txtdesc').val('')
                        }
                    }
                })
            });



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
                        "SHOP_CODE": SOO

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
                var strgoodcode2 = $('#strgoodcode2').val();

                if (txtdesc.length <= 500) {
                    $.post(url_global + "/api/v1_0/shop/getitemdesc", {
                        "CATE_CODE": strcatecode2,
                        "SUB_CATE_CODE": strsubcode2,
                        "SHOP_CODE": strshopcode2,
                        "TYPE_CATE_CODE": strtypecode2,
                        "GOODS_DESC_TH": txtdesc,
                        "ADMIN_NAME": admin_name,
                        "GOODS_CODE": strgoodcode2

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
