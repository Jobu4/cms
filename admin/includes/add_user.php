<?php

if (isset($_POST['create_user'])) {
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $username = escape($_POST['username']);
    $user_role = escape($_POST['user_role']);

    $user_email = escape($_POST['user_email']);

    $user_password = escape($_POST['user_password']);

    if(!empty($username) && !empty($user_email) && !empty($user_password)){
        //this prevents sql injection
            $username = mysqli_real_escape_string($connection,$username);
           $email = mysqli_real_escape_string($connection,$user_email);
           $password = mysqli_real_escape_string($connection,$user_password);
    $user_password = password_hash($password,PASSWORD_BCRYPT,['cost' => 10]);
    $query = "INSERT INTO users( user_firstname, user_lastname, username, user_role,
     user_email, user_password )";
    $query .="VALUES( '{$user_firstname}', '{$user_lastname}', '{$username}', '{$user_role}'
     , '{$user_email}', '{$user_password}')";
    $create_user_query = mysqli_query($connection, $query);
    confirmQuery($create_user_query);
    echo "User Created: " . "" . "<a href='users.php'> View Users</a>";
}else{
    echo "<p class='bg-success'>Fields cannot be empty.</p>";
}
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <!-- when uploading we use an attribute called enctype  -->
    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="post_status">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <select name="user_role" id="post_category">
            <option value="subscriber">select option</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>


        </select>
    </div>

    <!-- <div class="form-group">
        <label for="image"></label>
        <input type="file" name="image">
    </div> -->
    <div class="form-group">
        <label for="post_tags">username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="post_fcontent">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="post_fcontent">Password</label>

        <input type="password" class="form-control" name="user_password">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>
</form>