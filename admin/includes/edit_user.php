<?php
if (isset($_GET['edit_user'])) {
    $the_user_id = $_GET['edit_user'];
    $query = "SELECT * FROM users WHERE user_id = $the_user_id"; //CAN limit number of categories you want people to see
    $select_users_query = mysqli_query($connection, $query);


    while ($row = mysqli_fetch_assoc($select_users_query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }
}

if (isset($_POST['edit_user'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $username = $_POST['username'];
    $user_role = $_POST['user_role'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
if(!empty($user_password)){
$query_password ="SELECT user_password from users WHERE user_id = $the_user_id ";
$get_user_query = mysqli_query($connection,$query_password);
confirmQuery($get_user_query);
$row =mysqli_fetch_array($get_user_query);
$db_user_password =$row['user_password'];

if($db_user_password != $user_password){
    $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, ['cost' => 10]);

    $query = "UPDATE users SET ";
    $query .= "user_firstname ='{$user_firstname}', ";
    $query .= "user_lastname='{$user_lastname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "username ='{$username}', ";
    $query .= "user_email ='{$user_email}', ";
    $query .= "user_password ='{$hashed_password}' ";
    $query .= "WHERE user_id ={$the_user_id} ";
    $update_user = mysqli_query($connection, $query);
    confirmQuery($update_user);
    echo "<div class='bg-success'>User Updated: <a href='users.php'> View all Users</a></div>";
}
}else{
    echo "<p class='bg-success'>Fields cannot be empty.</p>";
}




}
?>

<form action="" method="post" enctype="multipart/form-data">
    <!-- when uploading we use an attribute called enctype  -->
    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
    </div>
    <div class="form-group">
        <label for="post_status">Lastname</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
    </div>
    <div class="form-group">
    <select name="user_role" id="post_category">
        <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
        <?php
        if ($user_role == 'admin') {

            echo "<option value='subscriber' selected>Subscriber</option>";
        } else {

            echo "<option value='admin' selected>Admin</option>";
        }
        ?>
    </select>
</div>


    <!-- <div class="form-group">
        <label for="image"></label>
        <input type="file" name="image">
    </div> -->
    <div class="form-group">
        <label for="post_tags">username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
    </div>
    <div class="form-group">
        <label for="post_fcontent">Email</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
    </div>
    <div class="form-group">
        <label for="post_fcontent">Password</label>
        <input  autocomplete="off" type="password" class="form-control" name="user_password" value="<?php echo $user_password; ?>">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Update User">
    </div>
</form>