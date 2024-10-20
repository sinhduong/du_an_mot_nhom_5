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