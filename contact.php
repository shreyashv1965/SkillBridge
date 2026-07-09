<?php include('admin/includes/config.php'); ?>
<?php include('admin/includes/header.php'); ?> 

<div class="container" style="padding:40px;">
    <h2>Contact Us</h2>
    <hr>
    <p>If you have any questions or need support, please fill out the form below and we’ll get back to you as soon as possible.</p>

    <form action="send-message.php" method="post">
        <div class="form-group">
            <label for="name">Your Name:</label>
            <input type="text" class="form-control" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Your Email:</label>
            <input type="email" class="form-control" name="email" required>
        </div>

        <div class="form-group">
            <label for="message">Message:</label>
            <textarea class="form-control" name="message" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
</div>

<?php include('admin/includes/footer.php'); ?>
