
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="menu">
                <ul class="nav sidebar-nav flex-row">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="role">Roles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="category">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="type">Book Type</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="book">Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="plan">Plans</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="comment">Comments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="order">Orders</a>
                </li>
                <?php if (!is_null($_SESSION['userid'])){
                ?>
                <li class="nav-item ms-auto">
                    <a class="nav-link" href="logout">Logout</a>
                </li>
                <?php
                }?>
                
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col">