<h1>Admin Tools</h1>

<?php if(!isset($_SESSION['admin'])): ?>
    <form action="" method="post">
        <label for="login-password">Password</label>
        <input type="password" name="login-password" autofocus required/>

        <input type="submit" name="login-submit" value="Login"/>
    </form>
<?php endif; ?>

<?php
require_once('php/hash.php');

if(!empty($_POST['login-submit'])) {
    if(!empty($_POST['login-password'])) {
        if($hash === hash('sha256', $_POST['login-password'])) {
            $_SESSION['admin'] = true;
            header('location: admin');
        } else {
            return '<p class="error">Wrong password.</p>';
        }
    } else {
        echo '<p class="error">Please enter a password.</p>';
    }
}
?>

<?php if(isset($_SESSION['admin'])): ?>
    <p>Logged in as admin.</p>

    <p><a href="admin/activity">View user activity</a> - View the activity of every user</p>
    <p><a href="admin/new-property">Add a new property</a> - Use this form to add new properties to the application</p>
    <p><a href="admin/update-room-status">Update a room's status</a> - If a room has become occupied, it's status can be changed here</p>
<?php endif; ?>