<?php
if (isset($_SESSION['melding'])) {
    echo '<p style = "color:red;">' . $_SESSION['melding'] . '</p>';
    unset($_SESSION['melding']);
} ?>

<body>
<div class="container mt-3">
    <h2>Add A worker</h2>
    <form action="php/addworker.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <label>Name:</label>
            <input type="text" class="form-control" placeholder="Enter name" name="firstname">
        </div>
        <div class="mb-3 mt-3">
            <label>Email:</label>
            <input type="text" class="form-control" placeholder="Enter email" name="email">
        </div>

        <div class="mb-3 mt-3">
            <label>Password:</label>
            <input type="text" class="form-control" placeholder="Enter Password" name="password">
        </div>
        <button name="submit" type="submit" class="btn btn-success">Add</button>
    </form>
</div>
</body>