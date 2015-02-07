<main>
    <div class="padding">
        <h1 class="h1--show">Landlord Login</h1>

        <?php if(!isset($_SESSION['s_landlord'])): ?>
            <form method="post" id="login-email-form">
                <div class="form-row">
                    <label for="login-email">Email</label>
                    <input type="email" id="login-email" name="login-email" required/>
                </div>
                <div class="form-row">
                    <label for="login-password">Password</label>
                    <input type="password" name="login-password" required/>
                </div>
                <div class="form-row">
                    <input type="submit" name="login-submit" value="Login"/>
                </div>
                <?php
                require_once('php/LoginSystem.php');

                if(!empty($_POST['login-submit'])) {
                    if(!empty($_POST['login-email']) && !empty($_POST['login-password'])) {
                        $response = LoginSystem::login($_POST['login-email'], $_POST['login-password']);
                        echo $response;
                    } else {
                        echo $wrapStart . 'Please enter your email and password.' . $wrapEnd;
                    }
                }
                ?>
                <div class="form-row">
                    <p><a href="#create-an-account">Create an account</a></p>
                    <p><a href="#forgotten-your-password">Forgotten your password</a></p>
                </div>
            </form>

            <form method="post" id="create-account-form">
                <p>Create an account</p>
                <div class="form-row">
                    <label for="create-account-email">Email (private)</label>
                    <input type="email" id="create-account-email" name="create-account-email" required/>
                </div>
                <div class="form-row">
                    <label for="create-account-email-again">Retype email</label>
                    <input type="email" name="create-account-email-again" required/>
                </div>
                <div class="form-row">
                    <label for="create-account-password">Password</label>
                    <input type="password" name="create-account-password" required/>
                </div>
                <div class="form-row">
                    <label for="create-account-password-again">Retype password</label>
                    <input type="password" name="create-account-password-again" required/>
                </div>
                <div class="form-row">
                    <input type="submit" name="create-account-submit" value="Create"/>
                </div>

                <?php
                require_once('php/LoginSystem.php');

                if(!empty($_POST['create-account-submit'])) {
                    $email         = $_POST['create-account-email'];
                    $password      = $_POST['create-account-password'];
                    $emailAgain    = $_POST['create-account-email-again'];
                    $passwordAgain = $_POST['create-account-password-again'];

                    if(!empty($email) && !empty($password) && !empty($emailAgain) && !empty($passwordAgain)) {
                        if($email === $emailAgain && $password === $passwordAgain) {
                            $exists = LoginSystem::checkEmailExists($email);

                            if($exists) {
                                echo LoginSystem::wrapStart . 'An account with this email already exists.' . LoginSystem::wrapEnd;
                            } else {
                                $response = LoginSystem::createUser($email, $password);
                                echo $response;
                            }
                        } else {
                            echo LoginSystem::wrapStart . 'Email and/or password did not match. Please try again.' . LoginSystem::wrapEnd;
                        }
                    } else {
                        echo LoginSystem::wrapStart . 'Please enter your email and password.' . LoginSystem::wrapEnd;
                    }
                }
                ?>
                <div class="form-row">
                    <p><a href="#">Back</a></p>
                </div>
            </form>

            <form method="post" id="forgotten-password-form">
                <p>Forgotten your password</p>
                <div class="form-row">
                    <label for="forgotten-password-email">Email</label>
                    <input type="email" id="forgotten-password-email" name="forgotten-password-email" required/>
                </div>
                <div class="form-row">
                    <input type="submit" name="forgotten-password-submit" value="Submit"/>
                </div>

                <?php
                require_once('php/LoginSystem.php');

                if($_POST) {
                    $email = $_POST['forgotten-password-email'];

                    if(!empty($email)) {
                        $exists = LoginSystem::checkEmailExists($email);

                        if($exists) {
                            $response = LoginSystem::sendResetPasswordLink($email);
                            echo $response;
                        } else {
                            echo '<p class="error">No account with this email exists.</p>';
                        }
                    } else {
                        echo '<p class="error">Please enter your email.</p>';
                    }
                }
                ?>
                <div class="form-row">
                    <p><a href="#">Back</a></p>
                </div>
            </form>
        <?php endif; ?>

        <?php if(isset($_SESSION['s_landlord'])): ?>
            <p>Logged in as landlord.</p>

            <p><a href="/landlord/activity" class="paragraph-a">View user activity</a> - View the activity of users interacting with your properties</p>
            <p><a href="/landlord/all-properties" class="paragraph-a">View all my properties</a> - View all your properties and rooms in the application</p>
            <p><a href="/landlord/new-property" class="paragraph-a">Add a new property</a> - Use this form to add new properties to the application</p>
            <p><a href="/landlord/update-room-availability" class="paragraph-a">Update a room's availability</a> - If a room has become occupied, it's availability can be changed here</p>
            <p><a href="/landlord/remove-property" class="paragraph-a">Remove a property</a> - Remove a property from the app's listings</p>
        <?php endif; ?>
    </div>
</main>