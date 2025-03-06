<?php
$sql = "SELECT * FROM tblbanner ORDER BY order_banner";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Query connection error!");
}
?>

<div class="table-product-list-container">
    <h1>Banner List</h1>
    <div class="product-list-table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title 1</th>
                    <th>Title 2</th>
                    <th>Link</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Order</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id_banner']) ?></td>
                        <td><?= htmlspecialchars($row['title1_banner']) ?></td>
                        <td><?= htmlspecialchars($row['title2_banner']) ?>$</td>
                        <td><?= htmlspecialchars($row['link_banner']) ?></td>
                        <td><img src="../img/<?= htmlspecialchars($row['image_banner']) ?>" alt="Banner Image"></td>
                        <td><?= htmlspecialchars($row['enable_banner']) ?></td>
                        <td><?= htmlspecialchars($row['order_banner']) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>