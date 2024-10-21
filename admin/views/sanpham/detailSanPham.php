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
                    <h1>Quản lý danh sách sản phẩm</h1>
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

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="col-12">
                            <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" style="width:400px;height:400px" class="product-image" alt="Product Image">
                        </div>
                        <div class="col-12 product-image-thumbs">
                            <?php foreach ($listAnhSanPham as $key => $anhSP): ?>
                                <div class="product-image-thumb <?= $anhSP[$key] == 0 ? 'active' : '' ?>"><img src="<?= BASE_URL . $anhSP['link_hinh_anh'] ?>" alt="Product Image"></div>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h3 class="my-3">Tên sản phẩm: <?= $sanPham['ten_san_pham'] ?></h3>

                        <hr>


                        <?php if (!empty($sanPham['gia_khuyen_mai'])) { ?>
                            <h4 class="mt-3">Giá tiền: <small><?= $sanPham['gia_san_pham'] ?></small></h4>
                        <?php } else { ?>

                            <h4 class="mt-3">Giá khuyến mãi: <small><?= $sanPham['gia_khuyen_mai'] ?></small></h4>
                        <?php } ?>


                        <h4 class="mt-3">Số lượng: <small><?= $sanPham['so_luong'] ?></small></h4>
                        <h4 class="mt-3">Lượt xem: <small><?= $sanPham['luot_xem'] ?></small></h4>
                        <h4 class="mt-3">Ngày nhập: <small><?= $sanPham['ngay_nhap'] ?></small></h4>
                        <h4 class="mt-3">Danh mục: <small><?= $sanPham['ten_danh_muc'] ?></small></h4>
                        <h4 class="mt-3">Trạng thái: <small><?= $sanPham['trang_thai'] == 1 ? 'Còn hàng' : 'Dừng bán' ?></small></h4>
                        <h4 class="mt-3">Mô tả: <small><?= $sanPham['mo_ta'] ?></small></h4>
                    </div>
                </div>

                <div class="row mt-4">
                    <nav class="w-100">
                    </nav>

                    <ul class="nav nav-tabs row mt-4">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Bình luận của tài khoản</a>
                        </li>
                    </ul>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên người bình luận</th>
                                <th>Nội dung</th>
                                <th>Ngày đăng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listBinhLuan as $key => $listBinhLuan): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $listBinhLuan['ho_ten'] ?></td>
                                    <td><?= $listBinhLuan['noi_dung'] ?></td>
                                    <td><?= $listBinhLuan['ngay_dang'] ?></td>
                                    <td>
                                        <div class="btn-grop">
                                            <a href="#"><button class="btn btn-warning">Ẩn</button></a>
                                            <!-- <a href="#"><button class="btn btn-danger">Xóa</button></a> -->
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
</div>
<!-- /.card -->

</section>
</div>

<!-- Footer  -->
<?php include './views/layout/footer.php' ?>
<!-- End Footer  -->

<script>
    $(document).ready(function() {
        $('.product-image-thumb').on('click', function() {
            var $image_element = $(this).find('img')
            $('.product-image').prop('src', $image_element.attr('src'))
            $('.product-image-thumb.active').removeClass('active')
            $(this).addClass('active')
        })
    })
</script>