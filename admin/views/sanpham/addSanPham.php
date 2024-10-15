<!-- Header  -->
<?php include './views/layout/header.php' ?>
<!-- End header  -->

<!-- nav -->
<?php include './views/layout/navbar.php' ?>
<!-- End nav  -->

<!-- sidebar  -->
<?php include './views/layout/sidebar.php' ?>
<!-- End sidebar  -->
<style>
    .input-container {
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    .input-group {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        /* Để thêm một khoảng cách nhỏ giữa các hàng nếu cần */
    }

    .btn-add,
    .btn-delete {
        background-color: #f5f5f5;
        border: 1px solid #ccc;
        padding: 5px 10px;
        cursor: pointer;
    }

    input.form-control {
        flex-grow: 1;
        margin: 0 5px;
    }

    .btn-add,
    .btn-delete {
        width: 40px;
        text-align: center;
    }
</style>

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
                            <h3 class="card-title">Thêm sản phẩm</h3>
                        </div>
                        <form action="<?= BASE_URL_ADMIN . '?act=them-san-pham' ?>" method="POST" enctype="multipart/form-data">
                            <div class="row card-body">
                                <div class="form-group col-12">
                                    <label>Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="ten_san_pham" placeholder="Nhập tên sản phẩm">
                                    <?php if (isset($_SESSION['error']['ten_san_pham'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['error']['ten_san_pham'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-6">
                                    <label>Giá sản phẩm</label>
                                    <input type="number" class="form-control" name="gia_san_pham" placeholder="Nhập giá sản phẩm">
                                    <?php if (isset($_SESSION['error']['gia_san_pham'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['error']['gia_san_pham'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-6 ">
                                    <label>Giá Khuyến mãi</label>
                                    <input type="number" class="form-control" name="gia_khuyen_mai" placeholder="Nhập giá khuyến mãi">
                                    <!-- <?php if (isset($_SESSION['error']['gia_khuyen_mai'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['error']['gia_khuyen_mai'] ?></p>
                                    <?php } ?> -->
                                </div>
                                <div class="form-group col-6 ">
                                    <label>Hình ảnh</label>
                                    <input type="file" class="form-control" name="hinh_anh">
                                    <?php if (isset($_SESSION['error']['hinh_anh'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['error']['hinh_anh'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-6">
                                    <label>Album ảnh</label>
                                    <div id="image-input-container" class="input-container">
                                        <div class="input-group">
                                            <button type="button" id="add-input" class="btn-add">+</button>
                                            <input type="file" class="form-control" name="img_array[]" multiple>
                                            <button type="button" class="btn-delete" onclick="removeInput(this)">X</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-6 ">
                                    <label>Số lượng</label>
                                    <input type="number" class="form-control" name="so_luong" placeholder="Nhập số lượng">
                                    <?php if (isset($_SESSION['error']['so_luong'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['error']['so_luong'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-6 ">
                                    <label>Ngày nhập</label>
                                    <input type="date" class="form-control" name="ngay_nhap" placeholder="Nhập ngày">
                                    <?php if (isset($_SESSION['error']['ngay_nhap'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['error']['ngay_nhap'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-6 ">

                                    <label>Danh mục</label>
                                    <select class="form-control" name="danh_muc_id" id="exampleFormControlSelect1">
                                        <option selected disabled> chọn danh mục sản phẩm</option>
                                        <?php foreach ($listDanhMuc as $danhMuc): ?>
                                            <option value="<?= $danhMuc['id'] ?>"><?= $danhMuc['ten_danh_muc'] ?></option>
                                        <?php endforeach ?>


                                    </select>

                                    <?php if (isset($_SESSION['error']['danh_muc_id'])) { ?>

                                        <p class="text-danger"><?= $_SESSION['error']['danh_muc_id'] ?></p>

                                    <?php } ?>
                                </div>

                                <div class="form-group col-6 ">

                                    <label>Trạng thái</label>
                                    <select class="form-control" name="trang_thai" id="exampleFormControlSelect1">
                                        <option selected disabled> chọn trạng thái sản phẩm</option>
                                        <option value="1">còn bán</option>
                                        <option value="2">dừng bán </option>
                                    </select>
                                    <?php if (isset($_SESSION['error']['trang_thai'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['error']['trang_thai'] ?></p>

                                    <?php } ?>
                                </div>


                                <div class="form-group col-12">
                                    <label>Mô tả</label>
                                    <textarea name="mo_ta" id="" class="form-control" placeholder="Nhập mô tả"></textarea>
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
<script>
    document.getElementById('add-input').addEventListener('click', function() {
        addNewInputGroup();
    });

    function addNewInputGroup() {
        const container = document.getElementById('image-input-container');

        // Tạo phần tử mới
        const newInputGroup = document.createElement('div');
        newInputGroup.classList.add('input-group');

        // Tạo nút +
        const addButton = document.createElement('button');
        addButton.type = 'button';
        addButton.classList.add('btn-add');
        addButton.textContent = '+';
        addButton.onclick = function() {
            addNewInputGroup(); // Đệ quy để thêm nhóm mới khi click vào dấu +
        };

        // Tạo input file
        const inputFile = document.createElement('input');
        inputFile.type = 'file';
        inputFile.name = 'img_array[]';
        inputFile.classList.add('form-control');
        inputFile.multiple = true;

        // Tạo nút X
        const deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.classList.add('btn-delete');
        deleteButton.textContent = 'X';
        deleteButton.onclick = function() {
            removeInput(deleteButton);
        };

        // Thêm các phần tử vào nhóm
        newInputGroup.appendChild(addButton);
        newInputGroup.appendChild(inputFile);
        newInputGroup.appendChild(deleteButton);

        // Thêm nhóm mới vào container
        container.appendChild(newInputGroup);
    }

    function removeInput(button) {
        const container = document.getElementById('image-input-container');
        const inputGroups = container.getElementsByClassName('input-group');

        // Kiểm tra nếu còn hơn 1 nhóm mới cho phép xóa
        if (inputGroups.length > 1) {
            button.parentElement.remove();
        }
    }
</script>
<!-- Footer  -->
<?php include './views/layout/footer.php' ?>
<!-- End Footer  -->
</body>

</html>