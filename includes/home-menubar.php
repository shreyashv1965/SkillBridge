<?php $base = "/SkillBridge/"; ?>

<!-- PUBLIC NAVIGATION BAR -->
<nav class="navbar navbar-default">
    <div class="container">

        <!-- Mobile Toggle -->
        <div class="navbar-header">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#homeMenu">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="<?php echo $base; ?>">
                <strong>SkillBridge</strong>
            </a>

        </div>

        <div class="collapse navbar-collapse" id="homeMenu">

            <ul class="nav navbar-nav">

                <li class="active">
                    <a href="<?php echo $base; ?>">Home</a>
                </li>

                <li>
                    <a href="<?php echo $base; ?>about.php">About</a>
                </li>

                <li>
                    <a href="<?php echo $base; ?>contact.php">Contact</a>
                </li>

                <li>
                    <a href="<?php echo $base; ?>faq.php">FAQ</a>
                </li>

            </ul>

          

        </div>

    </div>
</nav>