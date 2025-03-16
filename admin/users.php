<?php 
include "../config/connectDB.php";
$sql = "SELECT * FROM tblusers";
$result = mysqli_query($conn, $sql);
$errorMessage = "";

if (!$result) {
    $errorMessage = "Invalid query!";
}
?>

<div class="container mt-4">
    <h1 class="text-center fw-bold">USER LIST</h1>
    
    <?php if ($errorMessage): ?>
        <div class="alert alert-danger text-center" role="alert">
            <?= htmlspecialchars($errorMessage) ?>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between my-3">
        <a class="btn btn-primary fw-bold" href="">Add User</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Time</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <th scope="row"><?= htmlspecialchars($row['id']) ?></th>
                        <td><?= htmlspecialchars($row['firstname']) ?></td>
                        <td><?= htmlspecialchars($row['lastname']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['password']) ?></td>
                        <td><?= htmlspecialchars($row['created_at']) ?></td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="update-user.php?id=<?=htmlspecialchars($row['id'])?>">Update</a>
                            <button class="btn btn-danger btn-sm delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= htmlspecialchars($row['id']) ?>">Delete</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <!-- <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close">x</button> -->
            </div>
            <div class="modal-body">
                Are you sure you want to delete this user?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a id="confirmDelete" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var deleteModal = document.getElementById("deleteModal");
        var confirmDelete = document.getElementById("confirmDelete");
        
        document.querySelectorAll(".delete-btn").forEach(function(button) {
            button.addEventListener("click", function() {
                var userId = this.getAttribute("data-id");
                confirmDelete.href = "delete-user.php?id=" + userId;
            });
        });
    });
</script>
