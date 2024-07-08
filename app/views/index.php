<?php
$title = "Todo List";
require_once './app/views/layouts/header.php';
?>
<style>
    a {
        text-decoration: none;
    }

    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    table {
        width: 100%;
        margin-top: 16px;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #e0e0e0;
    }

    .btn {
        background-color: transparent;
        border: none;
        cursor: pointer;
        font-size: 16px;
        padding: 5px 10px;
        border-radius: 10px;
        color: white;
    }

    .btn.edit {
        background-color: #408dff;
    }

    .btn.delete {
        background-color: #f44336;
    }

    .btn.add {
        background-color: green;
    }

    .btn i {
        pointer-events: none;
    }
</style>

<h2>Todo List</h2>

<a href="<?php echo $router->route('work.create') ?>" class="btn add">Add</a>

<table>
    <thead>
        <tr>
            <th>Tên nhân viên</th>
            <th>Ngày Bắt Đầu</th>
            <th>Ngày Kết thúc</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($work = mysqli_fetch_array($data["works"])) {
        ?>
            <tr>
                <td><?php echo $work['name'] ?></td>
                <td><?php echo $work['start_date'] ?></td>
                <td><?php echo $work['end_date'] ?></td>
                <td><?php echo WorkStatus::getValueStatus($work['status']) ?></td>
                <td>
                    <a href="<?php echo $router->route('work.edit', $work['id']) ?>" class="btn edit">Sửa</a>
                    <form style="display: inline;" action="<?php echo $router->route('work.destroy', $work['id']) ?>" method="POST">
                        <button type="submit" class="btn delete">Xoá</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php
require_once './app/views/layouts/footer.php'
?>