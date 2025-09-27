<?php
session_start();
// Initialize variables for messages and CSS classes
$message = "";
$messageClass = "";
$formClass = ""; // for shake animation

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {     //Step 1: Check if fields are empty
        $message = "⚠️ All fields are required!";
        $messageClass = "error";
        $formClass = "shake";
    } elseif (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {        //Step 2: Validate username format
        $message = "⚠️ Username must only contain letters, numbers, or underscores.";
        $messageClass = "error";
        $formClass = "shake";
    } elseif (strlen($password) < 8) {      //Step 3: Validate password length
        $message = "⚠️ Password must be at least 8 characters long.";
        $messageClass = "error";
        $formClass = "shake";
    } elseif ($username === "student" && $password === "123student") {      //Step 4: Check valid login credential
        $_SESSION['username'] = $username;
        $_SESSION['login_success'] = true;
        header("Location: resume.php");
        exit();
    } else {
        $message = "⚠️ Invalid Username or Password";
        $messageClass = "error";
        $formClass = "shake";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <!-- Font Awesome for eye icons (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- External stylesheet -->
    <link rel="stylesheet" href="assets/css/styles.css?v=1.0">
</head>
<body>
    <div class="container">
        <h2>Login Form</h2>
        <form method="POST" action="" class="<?php echo $formClass; ?>">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter username" autocomplete="username">

            <label for="password">Password:</label>
            <div class="password-wrapper">
                <input type="password" id="password" name="password" placeholder="Enter password" autocomplete="current-password">
                <button type="button" class="toggle-password" aria-label="Show password" title="Show/hide password">
                    <i id="eyeIcon" class="fa-solid fa-eye-slash" aria-hidden="true"></i>
                </button>
            </div>
            <small class="password-hint">Password must be at least 8 characters long.</small>

            <button type="submit">Login</button>
        </form>

        <!-- Display error/success messages -->
        <?php if (!empty($message)) : ?>
            <p class="message <?php echo $messageClass; ?>"><?php echo $message; ?></p>
        <?php endif; ?>
    </div>

    <!-- External JavaScript -->
    <script src="assets/js/script.js" defer></script>
</body>
</html>
