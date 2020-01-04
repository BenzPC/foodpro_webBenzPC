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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
                                <h5 class="text-center">รายชื่อ SubCategory </h5>
                            </div>
                            <!-- Table -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="example" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>CATE_CODE</th>
                                                    <th>SUB_CATE_CODE</th>
                                                    <th>หมวดหมู่ใหญ่</th>
                                                    <th>หมวดหมู่ย่อย ชื่อไทย</th>
                                                    <th>หมวดหมู่ย่อย ชื่ออังกฤษ</th>
                                                    <th>รูปโปรไฟล์</th>
                                                    <th>รูปแบรนเนอร์</th>
                                                </tr>
                                            </thead>

                                            <tbody id='tablebody'>
                                            </tbody>

                                        </table>
                                        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2" id="btnModalUpBanner" hidden>
                                            Upload Banner
                                        </button> -->
                                        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="btnModalUpProfile" hidden>
                                            Upload Profile
                                        </button> -->
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
                    <h4 class="modal-title">Upload Profile &nbsp;&nbsp;&nbsp;</h4>
                    <h4 class="modal-title" id="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <h5>
                        <p id="modal-body"></p>
                    </h5>
                    <form id='fileUploadForm' method="post" enctype="multipart/form-data">
                        เลือกรูปภาพโปรไฟล์ : <input type="file" name="IMG" id="IMGPEOFILE" accept="image/x-png,image/jpeg"><br><br>
                        <div class="row">
                            <div class="col-md">
                                <img id="IMGPEOFILEShow" style="width: inherit;">
                            </div>
                        </div>
                        <input type="hidden" name="CATE_CODE" id="strcatecode">
                        <input type="hidden" name="SUB_CATE_CODE" id="strsubcatecode">
                        <!-- <input id="UploadProfile" type="button" value="UPLOAD PEOFILE" class="btn btn-primary"> -->
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" id="UploadProfile" class="btn btn-primary" data-dismiss="modal">UPLOAD PEOFILE</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
                    <h4 class="modal-title">Upload Banner &nbsp;&nbsp;&nbsp;</h4>
                    <h4 class="modal-title" id="modal-title2"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <h5>
                        <p id="modal-body2"></p>
                    </h5>
                    <form id='fileUploadForm2' method="post" enctype="multipart/form-data">
                        เลือกรูปภาพแบนเนอร์ : <input type="file" name="IMG" id="IMGBANNER" accept="image/x-png,image/jpeg"><br><br>
                        <div class="row">
                            <div class="col-md">
                                <img id="IMGBANNERShow" style="width: inherit;">
                            </div>
                        </div>
                        <input type="hidden" name="CATE_CODE" id="strcatecode2">
                        <input type="hidden" name="SUB_CATE_CODE" id="strsubcatecode2">
                        <!-- <input id="UpBanner" type="button" value="UPLOAD BANNER" class="btn btn-primary"> -->
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button id="UpBanner" type="button" class="btn btn-primary">UPLOAD BANNER</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
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

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#IMGBANNERShow').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            function readURL2(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#IMGPEOFILEShow').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#IMGBANNER").change(function() {
                readURL(this);
            }); 
            $("#IMGPEOFILE").change(function() {
                readURL2(this);
            });

            const urll = url_global + '/api/v1_0/master/gettablesubcate';
            // console.log(urll['RESULT']);
            // $.get(urll).done(function(jsonData) {
            //     console.log(jsonData);
            //     var dataRes = jsonData['RESULT'];
            //     console.log(dataRes);
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

                "columns": [{
                        "data": null
                    },
                    {
                        "data": "CATE_CODE"
                    },
                    {
                        "data": "SUB_CATE_CODE"
                    },
                    {
                        "data": "CATE_NAME_TH"
                    },
                    {
                        "data": "SUB_CATE_NAME_TH"
                    },
                    {
                        "data": "SUB_CATE_NAME_EN"
                    },
                    {
                        "data": "SUB_CATE_IMG_PATH",
                        render: function(data, type, row) {
                            if (row.SUB_CATE_IMG_PATH == null) {
                                return '<button class="btnUploadProfile  btn-warning"  type="button" data-toggle="modal"  data-target="#myModal" id="btnModalUpProfile" >Upload</button>';
                            } else {
                                return '<button class="btnUploadProfile" id="btnUploadProfile" type="button" disabled>Upload</button>';
                            }
                        }
                    }, {
                        "data": "SUB_CATE_IMG_BANNER",
                        render: function(data, type, row) {
                            if (row.SUB_CATE_IMG_BANNER == null) {
                                return '<button class="btnUploadBanner btn-warning"  type="button" data-toggle="modal" data-target="#myModal2" id="btnModalUpBanner">Upload</button>';
                            } else {
                                return '<button class="btnUploadBanner" id="btnUploadBanner" type="button" disabled>Upload</button>';
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

            // var ss = "";
            tablePropertygroup1.on('order.dt search.dt', function() {
                tablePropertygroup1.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                    // ss =cell.innerHTML = i + 1;
                    // cell.innerHTML = null;

                });
            }).draw();

            $('#example tbody').on('click', 'tr', function() {

                var data = $(this).find('td:eq(0)').text();
                var data1 = tablePropertygroup1.row(this).data();

                $('#modal-title').html(' ID: ' + data);
                $('#modal-body').html(' เพิ่มภาพโปรไฟล์ ' + data1.SUB_CATE_NAME_TH)
                $('#strcatecode').val(data1.CATE_CODE);
                $('#strsubcatecode').val(data1.SUB_CATE_CODE);

                $('#modal-title2').html(' ID: ' + data);
                $('#modal-body2').html(' เพิ่มภาพแบรนเนอร์ ' + data1.SUB_CATE_NAME_TH)
                $('#strcatecode2').val(data1.CATE_CODE);
                $('#strsubcatecode2').val(data1.SUB_CATE_CODE);

                $('#IMGBANNERShow').attr('src', "");
                $('#IMGPEOFILEShow').attr('src', "");
                $('#IMGBANNER').val("");
                $('#IMGPEOFILE').val("");
                // document.getElementById('IMGBANNER').value = "";
                // document.getElementById('IMGPEOFILE').value = "";
                
            });


            $('#UploadProfile').click(function(event) {
                var url = url_global + '/api/v1_0/master/updatepicprofilesubcate/' + $('#strcatecode').val()
                // alert('ddd')
                event.preventDefault();

                // Get form
                var form = $('#fileUploadForm')[0];

                // Create an FormData object 
                var data = new FormData(form);

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

                    },
                    error: function(e) {

                        console.log("ERROR : ", e);

                    }
                });

            });

            $('#UpBanner').click(function(event) {
                var url = url_global + '/api/v1_0/master/updatepicbannersubcate'
                // alert('ddd')
                event.preventDefault();

                // Get form
                var form = $('#fileUploadForm2')[0];

                // Create an FormData object 
                var data = new FormData(form);

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

                    },
                    error: function(e) {

                        console.log("ERROR : ", e);

                    }
                });
            });
        });
    </script>

</body>

</html>
