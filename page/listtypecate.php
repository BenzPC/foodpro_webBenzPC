<?php
session_start();
if (empty($_SESSION['name']) || $_SESSION['name'] != 'Super Admin') {
    header('Location: ../logout.php');
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
                                <h5 class="text-center">รายชื่อ typecategory </h5>
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
                                                    <th>TYPE_CATE_CODE</th>
                                                    <!-- <th>หมวดหมู่ใหญ่</th>
                                                    <th>หมวดหมู่ย่อย</th> -->
                                                    <th>ชนิด</th>
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


    <script>
        $(document).ready(function() {
            // const url_global = 'http://203.150.52.242:4200';
            // const url_global = 'http://192.168.1.175:4200';
            // const url_global = 'https://apidev.foodproonline.com';
            // const url_global = 'http://203.150.52.247:4200';
            const url_global = '<?= $url_global ?>';
         
            const urll = url_global + '/api/v1_0/master/gettabletypecate'
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
                        "data": "CATE_CODE"
                    },
                    {
                        "data": "SUB_CATE_CODE"
                    },
                    {
                        "data": "TYPE_CATE_CODE"
                    },
                    {
                        "data": "TYPE_CATE_NAME_TH"
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

        })
    </script>

</body>

</html>