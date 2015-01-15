<main>
    <div class="padding">
        <h1 class="h1--show">Resend Validation Email</h1>

        <p>Please enter in your email and we will send you another email so you can validate your account.</p>

        <form method="post">
            <div class="form-row">
                <label for="email">Email:</label>
                <input type="email" name="email" required autofocus/>
            </div>
            <div class="form-row">
                <input type="submit" value="Resend"/>
            </div>
        </form>

        <?php
        require_once('php/LoginSystem.php');

        if($_POST) {
            $email = $_POST['email'];

            if(!empty($email)) {
                $response = LoginSystem::resendValidationEmail($email);
                echo $response;
            } else {
                echo '<p class="error">Please enter your email.</p>';
            }
        }
        ?>
    </div>
</main>