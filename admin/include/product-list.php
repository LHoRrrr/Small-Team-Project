<?php
    $sql = "SELECT * FROM tblphone ORDER BY order_phone";
    $result = mysqli_query($conn,$sql);
    if(!$result){
        die("Query connection error!");
    }
?>

<div class="table-product-list-container">
    <h1>Product List</h1>
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
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
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
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


