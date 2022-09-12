
<body>
<div class="container mt-3">
    <h2>Register</h2>
    <form action="php/register.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <label>Name:</label>
            <input type="text" class="form-control" placeholder="Enter name" name="firstname" required>
        </div>
        <div class="mb-3 mt-3">
            <label>Middle name:</label>
            <input type="text" class="form-control" placeholder="Enter middle name" name="middlename">
        </div>

        <div class="mb-3 mt-3">
            <label>Last name:</label>
            <input type="text" class="form-control" name="lastname" placeholder="Enter last name" required>
        </div>

        <div class="mb-3 mt-3">
            <label>Place:</label>
            <input type="text" class="form-control" placeholder="Enter place" name="place" required>
        </div>

        <div class="mb-3 mt-3">
            <label>Street:</label>
            <input type="text" class="form-control" placeholder="Enter street" name="street" required>
        </div>


        <div class="mb-3 mt-3">
            <label>Housenumber:</label>
            <input type="text" class="form-control" placeholder="Enter housenumber" name="housenumber" required>
        </div>

        <div class="mb-3 mt-3">
            <label>Zipcode:</label>
            <input type="text" class="form-control" placeholder="Enter zipcode" name="zipcode" required>
        </div>


        <div class="mb-3 mt-3">
            <label>Phone number:</label>
            <input type="text" class="form-control" placeholder="Enter phone number" name="number" required>
        </div>


        <div class="mb-3 mt-3">
            <label>Date of birth:</label>
            <input type="date" class="form-control" placeholder="Enter date of birth" name="dob" required>
        </div>

        <div class="mb-3 mt-3">
            <label>Email:</label>
            <input type="text" class="form-control" placeholder="Enter email" name="email" required>
        </div>

        <div class="mb-3 mt-3">
            <label>Password:</label>
            <input type="text" class="form-control" placeholder="Enter password" name="password" required>
        </div>
        <button name="submit" type="submit" class="btn btn-success">Register</button>
    </form>
</div>
</body>
</html>