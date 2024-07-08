<?php
$title = "Edit Work";
require_once './app/views/layouts/header.php';
?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .form-container {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="date"],
    select {
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    input[type="text"],
    input[type="date"] {
        width: calc(100% - 20px);
    }

    select {
        width: 100%;
    }

    button {
        width: 100%;
        background-color: #28a745;
    }

    a {
        width: calc(100% - 20px);
        margin-top: 14px;
        font-size: 13.3333px;
        font-family: Arial, sans-serif;
        display: block;
        text-align: center;
        text-decoration: none;
        background-color: gray;
    }

    button,
    a {
        padding: 10px;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    a:hover {
        background-color: #9c9999;
    }

    button:hover {
        background-color: #218838;
    }
</style>

<div class="form-container">
    <?php $work = $data['work']; ?>
    <form action="<?php echo $router->route('work.update', $work['id']) ?>" method="POST">
        <div class="form-group">
            <label for="ten-tac-pham">Tên nhân viên:</label>
            <input type="text" value="<?php echo $work['name'] ?>" id="ten-tac-pham" name="name" required>
        </div>
        <div class="form-group">
            <label for="ngay-bat-dau">Ngày bắt đầu:</label>
            <input type="date" id="ngay-bat-dau" value="<?php echo $work['start_date'] ?>" name="start_date" required>
        </div>
        <div class="form-group">
            <label for="ngay-ket-thuc">Ngày kết thúc:</label>
            <input type="date" id="ngay-ket-thuc" value="<?php echo $work['end_date'] ?>" name="end_date" required>
        </div>
        <div class="form-group">
            <label for="trang-thai">Trạng thái:</label>
            <select id="trang-thai" name="status" required <?php ?>>
                <?php foreach (WorkStatus::all() as $key => $value) { ?>
                    <option <?php echo $work['status'] == $key ? 'selected' : '' ?> value=<?php echo $key ?>>
                        <?php echo $value ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <button type="submit">Lưu</button>
        <a href="<?php echo $router->route('work.index') ?>"" class=" btn">Quay lại</a>
    </form>
</div>

<?php
require_once './app/views/layouts/footer.php'
?>