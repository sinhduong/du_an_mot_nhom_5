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
                    <h1>Quản lý tài khoản quản trị viên</h1>
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
                            <h3 class="card-title">Sửa thông tin tài khoản quản trị: <?=$quanTri['ho_ten'];?></h3>
                        </div>
                        <form action="<?= BASE_URL_ADMIN . '?act=update-quan-tri' ?>" method="POST">
    <input type="hidden" name="quan_tri_id" value="<?=$quanTri['id']?>">
    <div class="card-body">
        <div class="form-group">
            <label>Họ tên</label>
            <input type="text" class="form-control" name="ho_ten" value="<?= htmlspecialchars($quanTri['ho_ten']) ?>" placeholder="Nhập tên họ tên">
            <?php if (isset($_SESSION['error']['ho_ten'])) { ?>
                <p class="text-danger"><?= $_SESSION['error']['ho_ten'] ?></p>
            <?php } ?>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input name="email" id="" class="form-control" value="<?= htmlspecialchars($quanTri['email']) ?>" placeholder="Nhập email">
            <?php if (isset($_SESSION['error']['email'])) { ?>
                <p class="text-danger"><?= $_SESSION['error']['email'] ?></p>
            <?php } ?>
        </div>
        <div class="form-group">
            <label>Số điện thoại</label>
            <input name="so_dien_thoai" value="<?= htmlspecialchars($quanTri['so_dien_thoai']) ?>" id="" class="form-control" placeholder="Nhập số điện thoại">
            <?php if (isset($_SESSION['error']['so_dien_thoai'])) { ?>
                <p class="text-danger"><?= $_SESSION['error']['so_dien_thoai'] ?></p>
            <?php } ?>
        </div>
        <div class="form-group">
            <label for="inputStatus">Trạng thái</label>
            <select name="trang_thai" id="inputStatus" class="form-control custom-select">
                <option <?= $quanTri['trang_thai'] == 1 ? 'selected' : '' ?> value="1">Active</option>
                <option <?= $quanTri['trang_thai'] != 1 ? 'selected' : '' ?> value="2">Inactive</option>
            </select>
            <?php if (isset($_SESSION['error']['trang_thai'])) { ?>
                <p class="text-danger"><?= $_SESSION['error']['trang_thai'] ?></p>
            <?php } ?>
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