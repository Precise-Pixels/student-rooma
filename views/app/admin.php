<main>
    <div class="padding">
        <h1 class="h1--show">Admin Tools</h1>

        <?php if(!isset($_SESSION['s_admin'])): ?>
            <form action="" method="post">
                <div class="form-row">
                    <label for="login-password">Password</label>
                    <input type="password" name="login-password" autofocus required/>
                </div>

                <div class="form-row">
                    <input type="submit" name="login-submit" value="Login"/>
                </div>
            </form>
        <?php endif; ?>

        <?php
        require_once('php/hash.php');

        if(!empty($_POST['login-submit'])) {
            if(!empty($_POST['login-password'])) {
                if($hash === hash('sha256', $_POST['login-password'])) {
                    $_SESSION['s_admin'] = true;
                    header('location: /app/admin' . (isset($_GET['r']) ? '/' . $_GET['r'] : ''));
                } else {
                    echo '<p class="error">Wrong password.</p>';
                }
            } else {
                echo '<p class="error">Please enter a password.</p>';
            }
        }
        ?>

        <?php if(isset($_SESSION['s_admin'])): ?>
            <p>Logged in as admin.</p>

            <p><a href="/app/admin/activity" class="paragraph-a">View user activity</a> - View the activity of every user</p>
            <p><a href="/app/admin/all-properties" class="paragraph-a">View all properties</a> - View all the properties and rooms in the application</p>
            <p><a href="/app/admin/new-property" class="paragraph-a">Add a new property</a> - Use this form to add new properties to the application</p>
            <p><a href="/app/admin/update-room-availability" class="paragraph-a">Update a room's availability</a> - If a room has become occupied, it's availability can be changed here</p>
            <p><a href="/app/admin/delete-property" class="paragraph-a">Delete a property</a> - Completely delete a property from the app (listing, info &amp; photos)</p>
        <?php endif; ?>
    </div>
</main>