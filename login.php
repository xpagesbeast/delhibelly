<?php 
include ('includes/session.php');
$page_title = 'Sign In';
$errors = "";

if (isset($_POST['submitted'])) {

    require_once ('login_functions.inc.php');
    require_once ('mysqli_connect.php');
    list ($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);

    if ($check) { // OK!
            session_save_path('');
            // Set the session data:.
            $_SESSION['user_id'] = $data['user_id'];
            $_SESSION['first_name'] = $data['first_name'];
            $_SESSION['last_name'] = $data['last_name'];
            $_SESSION['user_type_id'] = $data['user_type_id'];

            // Store the HTTP_USER_AGENT:
            $_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);

            // Redirect:
            $url = absolute_url ('index.php');
            header("Location: $url");
            exit();

    } else { // Unsuccessful!
		$errors = $data;
    }

    mysqli_close($dbc);	    
} // End of the main submit conditional.

include ('includes/header.php');

// Print any error messages, if they exist:
if (!empty($errors)) {
	echo '<div class="alert alert-danger">
				<strong>Error signing in.</strong><br />
	The following error(s) occurred:<br />';
	foreach ($errors as $msg) {
		echo " - $msg<br />\n";
		}
	echo '</p><p>Please try again.</p></div>';
}     
?>

    <form role="form" action="login.php" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <div class="form-group">
            <label for="InputEmail1">Email address</label>
            <input type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp" required autofocus name="email" placeholder="Enter email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required name="pass">
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input"  value="remember-me" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        <input type="hidden" name="submitted" value="TRUE" />
    </form>
<p><?php echo 'Signing in from ' . $_SERVER['REMOTE_ADDR']; ?></p>
<?php
include ('includes/footer.html');
?>

</body>
</html>
