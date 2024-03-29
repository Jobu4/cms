<?php   
if(isset($_POST['theCheckBoxArray'])){
   foreach($_POST['theCheckBoxArray'] as $commentValueId){

  $bulk_option = $_POST['bulk_option'];
   switch($bulk_option){
    case 'approved':
        $query ="UPDATE comments SET comment_status = '{$bulk_option}' WHERE comment_id ='$commentValueId'";
        $update_to_approved_status = mysqli_query($connection,$query);
        confirmQuery($update_to_approved_status);
        break;
     case 'unapproved':
        $query ="UPDATE comments SET comment_status = '{$bulk_option}' WHERE comment_id ='$commentValueId'";
        $update_to_unapproved_status = mysqli_query($connection,$query);
        confirmQuery($update_to_unapproved_status);
        break; 
  
        case 'delete':
            $query ="DELETE FROM comments WHERE comment_id ='$commentValueId'";
            $delete_comment = mysqli_query($connection,$query);
            confirmQuery($delete_comment);
            break; 
   }

   }
}

?>
<form action="" method='post'>
<table class="table table-bordered table-hover ">
<div id="" class="col-xs-4">
<select name="bulk_option" id="bulkOptionsContainer" class="form-control" style="margin-left: -15px;">
    <option value="">Select option</option>
    <option value="approved">Approve</option>      
    <option value="unapproved">Unapprove</option>    
    <option value="delete">Delete</option> 

</select>
</div>
<div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">

    </div>
    <thead>
        <tr>
        <th><input type="checkbox" id="selectAllboxes"></th>
            <th>Post Id</th>
            <th>Author</th>
            <th>comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM comments "; //CAN limit number of categories you want people to see
        $select_comments = mysqli_query($connection, $query);


        while ($row = mysqli_fetch_assoc($select_comments)) {
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_content = $row['comment_content'];
            $comment_email = $row['comment_email'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];
            echo "<tr>";
            ?>
                         <td><input type='checkbox' class='checkboxes' name='theCheckBoxArray[]' value='<?php echo $comment_id; ?>'></td>
            <?php
            echo "<td>{$comment_id}</td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_content}</td>";
            echo "<td>{$comment_email}</td>";
            echo "<td>{$comment_status}</td>";

            $query = "SELECT * FROM posts where post_id = $comment_post_id";
            $select_post_id_query = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_post_id_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
            }
            echo "<td>{$comment_date}</td>";
            echo "<td><a href='comments.php?approve=$comment_id'>Approve</td>";
            echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</td>";
            echo "<td><a onClick=\"javascript: return confirm('ARE you sure you want to delete??'); \" href='comments.php?delete=$comment_id'>Delete</td>";
            echo "</tr>";
        }


        ?>


    </tbody>
</table>
    </form>
<?php
if (isset($_GET['approve'])) {
    $the_comment_id = $_GET['approve'];
    $query = "UPDATE comments SET comment_status ='approved' where comment_id='$the_comment_id' ";
    $approve_comment_query = mysqli_query($connection, $query);
    header("Location: comments.php");
}

if (isset($_GET['unapprove'])) {
    $the_comment_id = $_GET['unapprove'];
    $query = "UPDATE comments SET comment_status ='unapproved' where comment_id='$the_comment_id' ";
    $unapprove_comment_query = mysqli_query($connection, $query);
    header("Location: comments.php");
}

if (isset($_GET['delete'])) {
    $the_comment_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: comments.php");
}
?>