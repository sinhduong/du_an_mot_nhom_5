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
                    <h1>Sửa sản phẩm <?= $sanPham['ten_san_pham'] ?></h1>
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
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Thông tin chung</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <form action="<?= BASE_URL_ADMIN . '?act=update-san-pham' ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <input type="hidden" name="san_pham_id" value="<?= $sanPham['id'] ?>">
                            <div class="form-group">

                                <label for="ten_san_pham">Tên sản phẩm</label>
                                <input type="text" id="ten_san_pham" name="ten_san_pham" class="form-control" value="<?= $sanPham['ten_san_pham'] ?>">
                                <?php if (isset($_SESSION['error']['ten_san_pham'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['ten_san_pham'] ?></p>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="gia_san_pham">Giá sản phẩm</label>
                                <input type="text" id="gia_san_pham" name="gia_san_pham" class="form-control" value="<?= $sanPham['gia_san_pham'] ?>">
                                <?php if (isset($_SESSION['error']['gia_san_pham'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['gia_san_pham'] ?></p>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label >Giá Khuyến Mãi</label>
                                <input type="number" name="gia_khuyen_mai" class="form-control" value="<?= $sanPham['gia_khuyen_mai'] ?>">
                                <!-- <?php if (isset($_SESSION['error']['gia_khuyen_mai'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['gia_khuyen_mai'] ?></p>
                                <?php } ?> -->
                            </div>
                            <div class="form-group">
                                <label for="hinh_anh">Hình ảnh</label>
                                <input type="file" id="hinh_anh" name="hinh_anh" class="form-control">
                                <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" style="width:100px;height:100px" alt="">
                                <input type="hidden" name="hinh_anh" value="<?= $sanPham['hinh_anh'] ?>">

                            </div>
                            <div class="form-group">
                                <label for="so_luong">Số lượng</label>
                                <input type="number" id="so_luong" name="so_luong" class="form-control" value="<?= $sanPham['so_luong'] ?>">
                                <?php if (isset($_SESSION['error']['so_luong'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['so_luong'] ?></p>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="ngay_nhap">Ngày nhập</label>
                                <input type="date" id="ngay_nhap" name="ngay_nhap" class="form-control" value="<?= $sanPham['ngay_nhap'] ?>">
                                <?php if (isset($_SESSION['error']['so_luong'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['so_luong'] ?></p>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="inputStatus">Danh mục sản phẩm</label>
                                <select id="danh_muc_id" name="danh_muc_id" class="form-control custom-select">
                                    <?php foreach ($listDanhMuc as $danhmuc): ?>
                                        <option <?= $danhmuc['id'] == $sanPham['id'] ? 'selected' : '' ?> value="<?= $danhmuc['id'] ?>"><?= $danhmuc['ten_danh_muc'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <?php if (isset($_SESSION['error']['danh_muc_id'])) { ?>

                                    <p class="text-danger"><?= $_SESSION['error']['danh_muc_id'] ?></p>

                                <?php } ?>

                            </div>
                            <div class="form-group">
                                <label for="trang_thai">Trạng thái sản phẩm</label>
                                <select id="trang_thai" name="trang_thai" class="form-control custom-select">

                                    <option <?= $sanPham['trang_thai'] == 1 ? 'selected' : '' ?> value="1">Còn bán</option>
                                    <option <?= $sanPham['trang_thai'] == 2 ? 'selected' : '' ?> value="2">Dừng bán</option>

                                </select>
                                <?php if (isset($_SESSION['error']['trang_thai'])) { ?>

                                    <p class="text-danger"><?= $_SESSION['error']['trang_thai'] ?></p>

                                <?php } ?>

                            </div>
                            <div class="form-group">
                                <label for="mo_ta">Mô tả</label>
                                <textarea id="mo_ta" name="mo_ta" class="form-control" rows="4" value=""><?= $sanPham['mo_ta'] ?></textarea>
                            </div>


                            <div class="form-group">

                            </div>
                            <div class="cart-footer text-center">
                                <button type="submit" class="btn btn-primary">Sửa thông tin</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Album Ảnh sản phẩm</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <form action="<?= BASE_URL_ADMIN . '?act=sua-album-san-pham' ?>" method="post" enctype="multipart/form-data">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="faqs" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Ảnh</th>
                                                    <th>File</th>
                                                    <th>
                                                        <div class="text-center">
                                                            <button type="button" onclick="addfaqs();" class="badge badge-success">
                                                                <i class="fa fa-plus"></i> Thêm
                                                            </button>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <input type="hidden" name="san_pham_id" value="<?= $sanPham['id'] ?>">
                                                <input type="hidden" name="img_delete" id="img_delete">

                                                <?php foreach ($listAnhSanPham as $key => $value): ?>
                                                    <tr id="faqs-row-<?= $key ?>">
                                                        <input type="hidden" name="current_img_ids[]" value="<?= $value['id'] ?>">
                                                        <td><img src="<?= BASE_URL . $value['link_hinh_anh'] ?>" style="width:50px;height:50px" alt=""></td>
                                                        <td><input type="file" name="img_array[]" class="form-control"></td>
                                                        <td class="mt-10">
                                                            <button type="submit"  class="badge badge-danger" onclick="removeRow(<?= $key ?>, <?= $value['id'] ?>)">
                                                                <i class="fa fa-trash"></i> Xóa
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="cart-footer text-center">
                                        <button type="submit" class="btn btn-primary">Sửa thông tin</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="#" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Save Changes" class="btn btn-success float-right">
            </div>
        </div>
    </section>
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Footer  -->
<?php include './views/layout/footer.php' ?>
<!-- End Footer  -->
</body>
<script>
    var faqs_row = <?= count($listAnhSanPham) ?>;

    function addfaqs() {
        var html = '<tr id="faqs-row-' + faqs_row + '">';
        html += '<td><img src="https://lienquan.garena.vn/wp-content/uploads/2024/05/2225114632e2b46f7cf7b9fe6386f7db5a55d2269d2721.jpg" style="width:50px;height:50px" alt=""></td>';
        html += '<td><input type="file" name="img_array[]" class="form-control"></td>';
        html += '<td class="mt-10"><button type="submit" class="badge badge-danger" onclick="removeRow(' + faqs_row + ', null);"><i class="fa fa-trash"></i> Xóa</button></td>';
        html += '</tr>';

        $('#faqs tbody').append(html);
        faqs_row++;
    }

    function removeRow(rowId, imgId) {
        // Remove the row from the table
        $('#faqs-row-' + rowId).remove();

        // If it's an existing image (imgId is not null), mark it for deletion
        if (imgId !== null) {
            var deleteInput = $('#img_delete');
            deleteInput.val(deleteInput.val() + imgId + ',');
        }
    }
</script>

</html>