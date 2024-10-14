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
                    <h1>Quản lý danh mục sản phẩm</h1>
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
                            <h3 class="card-title">Sửa danh mục</h3>
                        </div>
                        <form action="<?= BASE_URL_ADMIN . '?act=update-danh-muc&id=' . $danhmuc['id'] ?>" method="POST">
                            <div class="card-body">
                               
                                <div class="form-group">
                                    <label>Tên danh mục</label>
                                    <input type="text" class="form-control" name="ten_danh_muc" value="<?= $danhmuc['ten_danh_muc'] ?>" placeholder="Nhập tên danh mục">
                                    <?php if (isset($error['ten_danh_muc'])) { ?>
                                        <p class="text-danger"><?= $error['ten_danh_muc'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea name="mo_ta" id="" class="form-control" placeholder="Nhập mô tả"><?= $danhmuc['mo_ta'] ?></textarea>
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