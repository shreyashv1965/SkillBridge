<?php
session_start();
include('includes/config.php');
include('includes/header.php');
include('includes/home-menubar.php');
?> 

<div class="container" style="padding:40px;">

    <h2>Frequently Asked Questions (FAQs)</h2>
    <hr>

    <h4>1. What is SkillBridge?</h4>
    <p>
        SkillBridge is an Online Course Registration System that enables students to register for courses online and allows administrators to manage students, courses, departments, semesters, and academic information efficiently.
    </p>

    <h4>2. How do I register for a course?</h4>
    <p>
        Log in using your student credentials, navigate to the <strong>Enroll Course</strong> page, select your preferred course, and submit your registration.
    </p>

    <h4>3. Who can access this system?</h4>
    <p>
        The system provides separate access for students and administrators. Students can manage their course registrations, while administrators can manage academic records and system data.
    </p>

    <h4>4. What should I do if I forget my password?</h4>
    <p>
        Contact the system administrator to reset your password or update your login credentials.
    </p>

    <h4>5. Can I change my password after logging in?</h4>
    <p>
        Yes. Students can change their password anytime by selecting the <strong>Change Password</strong> option after logging in.
    </p>

    <h4>6. How can I view my enrolled courses?</h4>
    <p>
        After logging in, open the <strong>Enrollment History</strong> section to view all the courses you have successfully registered for.
    </p>

    <h4>7. Can I update my profile information?</h4>
    <p>
        Yes. Students can update their personal details through the <strong>My Profile</strong> page, while administrators can also edit student records when required.
    </p>

    <h4>8. Is my information secure?</h4>
    <p>
        Yes. SkillBridge uses secure authentication and stores student information in a MySQL database to help protect academic records and user data.
    </p>

    <h4>9. Which technologies are used to develop SkillBridge?</h4>
    <p>
        SkillBridge is developed using PHP, MySQL, HTML5, CSS3, JavaScript, Bootstrap, and XAMPP for local development.
    </p>

    <h4>10. Who should I contact for technical support?</h4>
    <p>
        If you experience any technical issues, please contact the system administrator or use the contact information available on the Contact page.
    </p>

</div>

<!-- ✅ Footer -->
<?php include('admin/includes/simple-footer.php'); ?>
