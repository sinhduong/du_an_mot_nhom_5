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
                    <h1>Quản lý tài khoản quản trị</h1>
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


                    <div class="card">
                        <div class="card-header">
                            <a href="<?= BASE_URL_ADMIN . '?act=form-them-quan-tri' ?>">
                                <button class="btn btn-success">Thêm tài khoản</button>
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Họ tên</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listQuanTri as $key => $quantri): ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $quantri['ho_ten'] ?></td>
                                            <td><?= $quantri['email'] ?></td>
                                            <td><?= $quantri['so_dien_thoai'] ?></td>
                                            <td><?= $quantri['trang_thai'] == 1 ? 'Active' : 'Inactive' ?></td>
                                            <td>
                                                <a href="<?= BASE_URL_ADMIN . '?act=form-sua-quan-tri&id_quan_tri=' . $quantri['id'] ?>">
                                                    <button class="btn btn-warning">Sửa</button>
                                                </a>
                                                <a href="<?= BASE_URL_ADMIN . '?act=reset-password&id_quan_tri=' . $quantri['id'] ?>"
                                                    onclick="return confirm('Bạn có muốn reset password của tài khoản này không?')">
                                                    <button class="btn btn-danger">Reset</button>
                                                </a>
                                            </td>
                                        </tr>
                                </tbody>
                            <?php endforeach ?>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
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