

<body>
<div class="container mt-3">
    <h2>Edit A Supervisor</h2>
    <form action="php/editworker.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <label>Name:</label>
            <input type="text" class="form-control" placeholder="Enter name" name="name">
        </div>
        <div class="mb-3 mt-3">
            <label>Email:</label>
            <input type="text" class="form-control" placeholder="Enter description" name="description">
        </div>

        <div class="mb-3 mt-3">
            <label>Password:</label>
            <input type="text" class="form-control" placeholder="Enter Password" name="Password">
        </div>
        <button name="submit" type="submit" class="btn btn-success">Add</button>
    </form>
</div>
</body>