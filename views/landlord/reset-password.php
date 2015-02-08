<main>
    <div class="padding">
        <h1 class="h1--show">Reset Password</h1>

        <p>Please enter a new password into the field above.</p>

        <form method="post">
            <div class="form-row">
                <label for="password">Password:</label>
                <input type="password" name="password" required autofocus/>
            </div>
            <div class="form-row">
                <input type="submit" value="Reset"/>
            </div>
        </form>

        <?php
        if(!isset($_GET['e']) || !isset($_GET['r'])) {
            header('location: /landlord/');
        }

        require_once('php/LandlordLoginSystem.php');

        if($_POST) {
            $email    = $_GET['e'];
            $rand     = $_GET['r'];
            $password = $_POST['password'];

            if(!empty($password)) {
                $response = LandlordLoginSystem::resetPassword($email, $password, $rand);
                echo $response;
            } else {
                echo '<p class="error">Please enter your new password.</a>';
            }
        }
        ?>
    </div>
</main>