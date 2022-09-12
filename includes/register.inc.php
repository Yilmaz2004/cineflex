
<body>
<div class="container mt-3">
    <h2>Register</h2>
    <form action="php/register.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <label>Name:</label>
            <input type="text" class="form-control" placeholder="Enter name" name="name">
        </div>
        <div class="mb-3 mt-3">
            <label>Middle name:</label>
            <input type="text" class="form-control" placeholder="Enter middle name" name="middlename">
        </div>

        <div class="mb-3 mt-3">
            <label>Last name:</label>
            <input type="text" class="form-control" name="lastname" placeholder="Enter last name" >
        </div>

        <div class="mb-3 mt-3">
            <label>Place:</label>
            <input type="text" class="form-control" placeholder="Enter place" name="place">
        </div>

        <div class="mb-3 mt-3">
            <label>Street:</label>
            <input type="text" class="form-control" placeholder="Enter street" name="street">
        </div>

        <div class="mb-3 mt-3">
            <label>Postal code:</label>
            <input type="text" class="form-control" placeholder="Enter postal code" name="postal code">
        </div>

        <div class="mb-3 mt-3">
            <label>Date of birth:</label>
            <input type="date" class="form-control" placeholder="Enter date of birth" name="dateofbirth">
        </div>

        <div class="mb-3 mt-3">
            <label>Email:</label>
            <input type="text" class="form-control" placeholder="Enter email" name="email">
        </div>

        <div class="mb-3 mt-3">
            <label>Password:</label>
            <input type="text" class="form-control" placeholder="Enter password" name="password">
        </div>
        <button name="submit" type="submit" class="btn btn-success">Register</button>
    </form>
</div>
</body>
</html>