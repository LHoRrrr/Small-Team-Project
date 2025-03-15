<?php
    $sql = "SELECT * FROM tblphone ORDER BY order_phone";
    $result = mysqli_query($conn,$sql);
    if(!$result){
        die("Query connection error!");
    }
?>

<div class="table-product-list-container">
    <h1>PRODUCT LIST</h1>
    <a class="button-add btn btn-primary fw-bold display-block p-2 mb-2" href="./add-product.php" style="font-weight: 800; font-size: 18px;">Add new product</a>
    <div class="product-list-table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Specs</th>
                    <th>Brand</th>
                    <th>Status</th>
                    <th>Mark</th>
                    <th>Quantity</th>
                    <th>Order</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <input type="hidden" name="id" value="<?= $row['id_phone']?>">
                    <td><?=htmlspecialchars($row['id_phone'])?></td>
                    <td><img src="../img/<?=htmlspecialchars($row['photo_phone'])?>" alt="Product Image"></td>
                    <td><?=htmlspecialchars($row['name_phone'])?></td>
                    <td><?=htmlspecialchars($row['price_phone'])?>$</td>
                    <td><?=htmlspecialchars($row['space_phone'])?></td>
                    <td><?=htmlspecialchars($row['brand_phone'])?></td>
                    <td><?=htmlspecialchars($row['status_phone'])?></td>
                    <td><?=htmlspecialchars($row['mark_phone'])?></td>
                    <td><?=htmlspecialchars($row['total_quantity'])?></td>
                    <td><?=htmlspecialchars($row['order_phone'])?></td>
                    <td><a style="font-weight: 700; " class="btn btn-warning" href="include/update.php?id=<?=$row['id_phone']?>">Update</a> <a style="font-weight: 700; " class="btn btn-danger" href="include/delete.php?id=<?= $row['id_phone'] ?>">Delete</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>