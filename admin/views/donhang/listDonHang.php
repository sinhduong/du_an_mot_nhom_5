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
                <div class="col-sm-6">
                    <h1>Quản lý đơn hàng</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">DataTables</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Tên người nhận</th>
                                        <th>Số Điện Thoại</th>
                                        <th>Ngày đặt</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($listDonHang)): ?>
                                        <?php foreach ($listDonHang as $key => $donHang): ?>
                                            <tr>
                                                <td><?= $key + 1 ?></td>
                                                <td><?= htmlspecialchars($donHang['ma_don_hang']) ?></td>
                                                <td><?= htmlspecialchars($donHang['ten_nguoi_nhan']) ?></td>
                                                <td><?= htmlspecialchars($donHang['sdt_nguoi_nhan']) ?></td>
                                                <td><?= formatDate($donHang['ngay_dat']) ?></td>
                                                <td><?= formatPrice($donHang['tong_tien']+30000) . ' đ'?></td>
                                                <td><?= htmlspecialchars($donHang['ten_trang_thai']) ?></td>
                                                <td>
                                                    <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-don-hang&id_don_hang=' . htmlspecialchars($donHang['id']) ?>">
                                                        <button class="btn btn-warning">Chi tiết</button>
                                                    </a>
                                                    <a href="<?= BASE_URL_ADMIN . '?act=form-sua-don-hang&id_don_hang=' . htmlspecialchars($donHang['id']) ?>">
                                                        <button class="btn btn-warning">Sửa</button>
                                                    </a>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center">Không có sản phẩm nào.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
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