<!-- Header  -->
<?php include './views/layout/header.php' ?>
<!-- End header  -->

<!-- nav -->
<?php include './views/layout/navbar.php' ?>
<!-- End nav  -->

<!-- sidebar  -->
<?php include './views/layout/sidebar.php' ?>
<!-- End sidebar  -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-5">
                    <h1>Quản lý danh sách đơn hàng - Đơn hàng: <?= $donHang['ma_don_hang'] ?> </h1>
                </div>
                <div class="col-sm-5">
                    <!-- <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
                    </ol> -->
                </div>
                <div class="col-sm-2 ">

                    <form action="" method="post" class="form-group">
                        <select name="" id="" form-group>
                            <?php foreach ($listTrangThaiDonHang as $key => $trangThai): ?>
                                <option <?= $trangThai['id'] < $donHang['trang_thai_id'] ? 'disabled' : '' ?>
                                    <?= $trangThai['id'] == $donHang['trang_thai_id'] ? 'selected' : '' ?>
                                    value="<?= $trangThai['id'] ?>"><?= $trangThai['ten_trang_thai'] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <!-- Main content -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?php
                    if ($donHang['trang_thai_id'] == 1) {
                        $colorAlerts = 'primary';


                        # code...
                    } elseif ($donHang['trang_thai_id'] >= 2 && $donHang['trang_thai_id'] <= 9) {
                        $colorAlerts = 'warning';
                    } elseif ($donHang['trang_thai_id'] == 10) {
                        $colorAlerts = 'success';
                    } else {
                        $colorAlerts = 'danger';
                    }

                    ?>
                    <div class="alert alert-<?= $colorAlerts ?>" role="alert">
                        Đơn Hàng:<?= $donHang['ten_trang_thai'] ?>
                    </div>

                    <div class="invoice p-3 mb-3">

                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> Shop bán đòng hồ
                                    <small class="float-right">Ngày đặt:<?= formatDate($donHang['ngay_dat']) ?></small>
                                </h4>
                            </div>

                        </div>

                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                Thông tin người đặt
                                <address>
                                    <strong> <?= $donHang['ho_ten'] ?> </strong><br>
                                    Email:<?= $donHang['email'] ?> <br>
                                    Số điện thoại: <?= $donHang['so_dien_thoai'] ?><br>
                                </address>
                            </div>

                            <div class="col-sm-4 invoice-col">
                                Người nhận
                                <address>
                                    <strong><?= $donHang['ten_nguoi_nhan'] ?></strong><br>
                                    Email:<?= $donHang['email_nguoi_nhan'] ?><br>
                                    Số điện thoại:<?= $donHang['sdt_nguoi_nhan'] ?><br>
                                    Địa chỉ:<?= $donHang['dia_chi_nguoi_nhan'] ?><br>

                                </address>
                            </div>

                            <div class="col-sm-4 invoice-col">
                                <b>Mã đơn hàng:<?= $donHang['ma_don_hang'] ?></b><br>
                                <br>
                                <b>Tổng tiền:</b> <?= $donHang['tong_tien'] ?><br>
                                <b>Ghi chú:</b> <?= $donHang['ghi_chu'] ?><br>
                                <b>Phương thúc thanh toán:</b> <?= $donHang['ten_phuong_thuc'] ?>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Ảnh sản phẩm</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Đơn giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $tong_tien = 0;  ?>
                                        <?php foreach ($sanPhamDonHang as $key => $sanPham): ?>

                                            <tr>
                                                <td><?= $key + 1 ?></td>
                                                <td>
                                                    <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" style="width: 100px" class="product-image" alt="Product Image">
                                                </td>
                                                <td><?= $sanPham['ten_san_pham'] ?></td>
                                                <td><?= $sanPham['don_gia'] ?></td>
                                                <td><?= $sanPham['so_luong'] ?></td>
                                                <td><?= $sanPham['thanh_tien'] ?></td>

                                                <?php $tong_tien += $sanPham['thanh_tien']  ?>
                                            </tr>
                                        <?php endforeach ?>

                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="row">



                            <div class="col-6">
                                <p class="lead">Ngày đặt hàng :<?= $donHang['ngay_dat'] ?></p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Thành tiền:</th>
                                            <td><?= $tong_tien  ?></td>
                                        </tr>

                                        <tr>
                                            <th>Vận chuyển:</th>
                                            <td>300.000</td>
                                        </tr>
                                        <tr>
                                            <th>Tổng tiền:</th>
                                            <td><?= $tong_tien + 30000 ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                        </div>


                        <div class="row no-print">
                            <!-- <div class="col-12">
                                <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                                    Payment
                                </button>
                                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Generate PDF
                                </button>
                            </div> -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<!-- Footer  -->
<?php include './views/layout/footer.php' ?>
<!-- End Footer  -->

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
<script>
    // <![CDATA[  <-- For SVG support
    if ('WebSocket' in window) {
        (function() {
            function refreshCSS() {
                var sheets = [].slice.call(document.getElementsByTagName("link"));
                var head = document.getElementsByTagName("head")[0];
                for (var i = 0; i < sheets.length; ++i) {
                    var elem = sheets[i];
                    var parent = elem.parentElement || head;
                    parent.removeChild(elem);
                    var rel = elem.rel;
                    if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
                        var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                        elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
                    }
                    parent.appendChild(elem);
                }
            }
            var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
            var address = protocol + window.location.host + window.location.pathname + '/ws';
            var socket = new WebSocket(address);
            socket.onmessage = function(msg) {
                if (msg.data == 'reload') window.location.reload();
                else if (msg.data == 'refreshcss') refreshCSS();
            };
            if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
                console.log('Live reload enabled.');
                sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
            }
        })();
    } else {
        console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
    }
    // ]]>
</script>