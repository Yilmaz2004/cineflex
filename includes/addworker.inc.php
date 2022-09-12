<head>
    <title>My Buddy</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">



</head>

<body>
<div class="container mt-3">
    <h2>Add A Supervisor</h2>
    <form action="php/addworker.php" method="POST" enctype="multipart/form-data">
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