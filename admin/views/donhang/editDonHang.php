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
                    <h1>Quản lý thông tin đơn hàng </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">DataTables</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Sửa thông tin đơn hàng <?= $donHang['ma_don_hang'] ?></h3>
                        </div>
                        <form action="<?= BASE_URL_ADMIN . '?act=update-don-hang&id=' . $donHang['id'] ?>" method="POST">
                            <input type="text" name="don_hang_id" value="<?= $donHang['id'] ?>" hidden>
                            <div class="card-body">

                                <div class="form-group">
                                    <label>Tên Người Nhận</label>
                                    <input type="text" class="form-control" name="ten_nguoi_nhan" value="<?= $donHang['ten_nguoi_nhan'] ?>" placeholder="Nhập tên người nhận">
                                    <?php if (isset($error['ten_nguoi_nhan'])) { ?>
                                        <p class="text-danger"><?= $error['ten_nguoi_nhan'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input type="text" class="form-control" name="sdt_nguoi_nhan" value="<?= $donHang['sdt_nguoi_nhan'] ?>" placeholder="Nhập sô điện thoại người nhận">
                                    <?php if (isset($error['sdt_nguoi_nhan'])) { ?>
                                        <p class="text-danger"><?= $error['sdt_nguoi_nhan'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label>Email Người Nhận</label>
                                    <input type="email" class="form-control" name="email_nguoi_nhan" value="<?= $donHang['email_nguoi_nhan'] ?>" placeholder="Nhập Email người nhận">
                                    <?php if (isset($error['email_nguoi_nhan'])) { ?>
                                        <p class="text-danger"><?= $error['email_nguoi_nhan'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ Người Nhận</label>
                                    <input type="text" class="form-control" name="dia_chi_nguoi_nhan" value="<?= $donHang['dia_chi_nguoi_nhan'] ?>" placeholder="Nhập địa chỉ người nhận">
                                    <?php if (isset($error['dia_chi_nguoi_nhan'])) { ?>
                                        <p class="text-danger"><?= $error['dia_chi_nguoi_nhan'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label>Ghi chú</label>
                                    <input type="text" class="form-control" name="ghi_chu" value="<?= $donHang['ghi_chu'] ?>" placeholder="Nhập ghi chú người nhận">
                                    <?php if (isset($error['ghi_chu'])) { ?>
                                        <p class="text-danger"><?= $error['ghi_chu'] ?></p>
                                    <?php } ?>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Trạng thái đơn hàng</label>
                                    <select name="trang_thai_id" id="" class="form-control custom-select">
                                        <?php foreach ($listTrangThaiDonHang as $trangThai): ?>
                                            <option
                                                <?php
                                                if (
                                                    $donHang['trang_thai_id'] > $trangThai['id']
                                                    || $donHang['trang_thai_id'] == 9
                                                    || $donHang['trang_thai_id'] == 10
                                                    || $donHang['trang_thai_id'] == 11
                                                ) {
                                                    echo 'disabled';
                                                }
                                                ?>
                                                <?= $trangThai['id'] == $donHang['trang_thai_id'] ? 'selected' : '' ?>
                                                value="<?= $trangThai['id'] ?> ">
                                                <?= $trangThai['ten_trang_thai'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>



                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>


                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Footer  -->
<?php include './views/layout/footer.php' ?>
<!-- End Footer  -->
</body>

</html>