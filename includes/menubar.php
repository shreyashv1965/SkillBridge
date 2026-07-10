<?php $base = "/SkillBridge/"; ?>

<!-- NAVBAR -->
<nav class="navbar navbar-default">
    <div class="container">

        <!-- Mobile toggle -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="<?php echo $base; ?>">
                SkillBridge
            </a>
        </div>

        <!-- Menu Items -->
        <div class="collapse navbar-collapse" id="menu">
            <ul class="nav navbar-nav">

                <li><a href="<?php echo $base; ?>index.php">Home</a></li>

                <li><a href="<?php echo $base; ?>enroll.php">Enroll Course</a></li>

                <li><a href="<?php echo $base; ?>my-courses.php">My Courses</a></li>

                <li><a href="<?php echo $base; ?>change-password.php">Change Password</a></li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo $base; ?>logout.php">Logout</a></li>
            </ul>
        </div>

    </div>
</nav>