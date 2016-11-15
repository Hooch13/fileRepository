<?PHP


?>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/simple-sidebar.css">
<link rel="stylesheet" type="text/css" href="affixed.css">
<div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <a href="#">
                    Navigation
                </a>
            </li>
            <li>
                <a href="dashboard.php"><span class="glyphicon glyphicon-home"></span> Dashboard</a>
            </li>
            <li>
                <a href="#"><span class="glyphicon glyphicon-user"></span> Profile</a>
            </li>

            <?PHP
            $level = 201;
            if($level < 200)
            {
                ?>
                <li>
                    <a href="#"><span class="glyphicon glyphicon-star"></span> Admin</a>
                </li>

            <?PHP }  ?>


            <li>
                <a href="#"><span class="glyphicon glyphicon-upload"></span> Upload</a>
            </li>
            <li>
                <a href="search.php"><span class="glyphicon glyphicon-search"></span> Search</a>
            </li>
            <li>
                <a href="index.php?action=logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
            </li>
        </ul>
    </div>



