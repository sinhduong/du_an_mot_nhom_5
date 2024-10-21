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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="<?= BASE_URL_ADMIN . '?act=form-them-san-pham' ?>">
                                <button class="btn btn-success">Thêm sản phẩm</button>
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Ảnh sản phẩm</th>
                                        <th>Giá tiền</th>
                                        <th>Số lượng</th>
                                        <th>Danh mục</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($listSanPham)): ?>
                                        <?php foreach ($listSanPham as $key => $sanPham): ?>
                                            <tr>
                                                <td><?= $key + 1 ?></td>
                                                <td><?= htmlspecialchars($sanPham['ten_san_pham']) ?></td>
                                                <td>
                                                    <img src="<?= BASE_URL . htmlspecialchars($sanPham['hinh_anh']) ?>" style="width: 100px" alt="Hình sản phẩm" onerror="this.onerror=null; this.src='default_image_url.jpg'">
                                                </td>
                                                <td><?= number_format($sanPham['gia_san_pham'], 0, ',', '.') ?> VNĐ</td>
                                                
                                                <td><?= htmlspecialchars($sanPham['so_luong']) ?></td>
                                                <td><?= htmlspecialchars($sanPham['ten_danh_muc']) ?></td>
                                                <td><?= $sanPham['trang_thai'] == 1 ? 'Còn bán' : 'Dừng bán' ?></td>
                                                <td>
                                                    <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-san-pham&id_san_pham=' . htmlspecialchars($sanPham['id']) ?>">
                                                        <button class="btn btn-warning">Chi tiết</button>
                                                    </a>
                                                    <a href="<?= BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham=' . htmlspecialchars($sanPham['id']) ?>">
                                                        <button class="btn btn-warning">Sửa</button>
                                                    </a>
                                                    <a href="<?= BASE_URL_ADMIN . '?act=delete-san-pham&id_san_pham=' . htmlspecialchars($sanPham['id']) ?>" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                                        <button class="btn btn-danger">Xóa</button>
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