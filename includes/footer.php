<?php $base = "/onlinecourse/"; ?>

<footer class="footer-section">
    <div class="container">
        <div class="row">

            <!-- About -->
            <div class="col-md-4 col-sm-6">
                <h4>About SkillBridge</h4>
                <p>
                    SkillBridge is an online course registration and learning
                    management system designed to simplify student enrollment
                    and academic administration.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="col-md-4 col-sm-6">
                <h4>Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="<?php echo $base; ?>about.php">About Us</a></li>
                    <li><a href="<?php echo $base; ?>privacy.php">Privacy Policy</a></li>
                    <li><a href="<?php echo $base; ?>terms.php">Terms & Conditions</a></li>
                    <li><a href="<?php echo $base; ?>faq.php">FAQs</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-md-4 col-sm-12">
                <h4>Contact Us</h4>
                <p>
                    📧 Email: support@skillbridge.com<br>
                    📍 Location: Karad, Maharashtra, India
                </p>
            </div>

        </div>

        <hr>

        <div class="row">
            <div class="col-md-12 text-center">
                <p class="copyright">
                    © <?php echo date("Y"); ?> SkillBridge. All Rights Reserved.
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- CSS -->
<style>
.footer-section {
    background: #2f4050;
    color: #ffffff;
    padding: 40px 0 20px;
    margin-top: 40px;
}
.footer-section h4 {
    color: #ffffff;
    margin-bottom: 15px;
}
.footer-section p {
    font-size: 14px;
    line-height: 22px;
}
.footer-links {
    list-style: none;
    padding: 0;
}
.footer-links li {
    margin-bottom: 8px;
}
.footer-links a {
    color: #cfd8dc;
    text-decoration: none;
}
.footer-links a:hover {
    color: #ffffff;
}
.footer-section hr {
    border-top: 1px solid #555;
}
.copyright {
    font-size: 13px;
}
</style>

<!-- IMPORTANT: JS FILES -->
<script src="<?php echo $base; ?>assets/js/jquery-1.10.2.js"></script>
<script src="<?php echo $base; ?>assets/js/bootstrap.js"></script>

</body>
</html>