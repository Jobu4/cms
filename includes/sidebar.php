<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">


    <?php
    if (isset($_POST['submit'])) {
        $search =  $_POST['search'];
        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
        $search_query = mysqli_query($connection, $query);
        if (!$search_query) {
            die("query failed" . mysqli_error($connection));
        }
        $count = mysqli_num_rows($search_query);
        if ($count == 0) {
            echo "<h1>no result</h1>";
        } else {
            echo "there is some content on that";
        }
    }


    ?>

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- search form -->
        <!-- /.input-group -->
    </div>
        <!-- login -->
        <div class="well">
        <h4>LOGIN</h4>
        <form action="includes/login.php" method="post">
            <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="Enter Username">

            </div>
            <div class="form-group">
                <input name="password" type="password" class="form-control" placeholder="Enter password">

            </div>
            <button class="btn btn-primary"  type="submit" name="login">Submit

            </button>
        </form>
        <!-- search form -->
        <!-- /.input-group -->
    </div>





    <!-- Blog Categories Well -->
    <div class="well">


        <?php

        $query = "SELECT * FROM categories "; //CAN limit number of categories you want people to see
        $select_categories_sidebar = mysqli_query($connection, $query);
        ?>

        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">

                    <?php
                    while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];
                        echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                    }
                    ?>
                    <!-- <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li> -->
                </ul>
            </div>
            <!-- /.col-lg-6 -->

            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>




    <!-- Side Widget Well -->
    <?php include "widget.php" ?>
</div>