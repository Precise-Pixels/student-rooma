<main>
    <div class="padding">
        <h1 class="h1--show">Landlord Tools</h1>

        <?php if(!isset($_SESSION['s_landlordId'])): ?>
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
                require_once('php/LandlordLoginSystem.php');

                if(!empty($_POST['login-submit'])) {
                    if(!empty($_POST['login-email']) && !empty($_POST['login-password'])) {
                        $response = LandlordLoginSystem::login($_POST['login-email'], $_POST['login-password']);
                        echo $response;
                    } else {
                        echo '<p class="error">Please enter your email and password.</p>';
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
                    <label for="create-account-name">Name (private)</label>
                    <input type="text" name="create-account-name" required/>
                </div>
                <div class="form-row">
                    <label for="create-account-phone">Phone (private)</label>
                    <input type="tel" name="create-account-phone" required/>
                </div>
                <div class="form-row">
                    <input type="submit" name="create-account-submit" value="Create"/>
                </div>

                <?php
                require_once('php/LandlordLoginSystem.php');

                if(!empty($_POST['create-account-submit'])) {
                    $email         = $_POST['create-account-email'];
                    $password      = $_POST['create-account-password'];
                    $emailAgain    = $_POST['create-account-email-again'];
                    $passwordAgain = $_POST['create-account-password-again'];
                    $name          = $_POST['create-account-name'];
                    $phone         = $_POST['create-account-phone'];

                    if(!empty($email) && !empty($password) && !empty($emailAgain) && !empty($passwordAgain) && !empty($name) && !empty($phone)) {
                        if($email === $emailAgain && $password === $passwordAgain) {
                            $exists = LandlordLoginSystem::checkEmailExists($email);

                            if($exists) {
                                echo '<p class="error">An account with this email already exists.</p>';
                            } else {
                                $response = LandlordLoginSystem::createUser($email, $password, $name, $phone);
                                echo $response;
                            }
                        } else {
                            echo '<p class="error">Email and/or password did not match. Please try again.</p>';
                        }
                    } else {
                        echo '<p class="error">Please enter your email and password.</p>';
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
                require_once('php/LandlordLoginSystem.php');

                if($_POST) {
                    $email = $_POST['forgotten-password-email'];

                    if(!empty($email)) {
                        $exists = LandlordLoginSystem::checkEmailExists($email);

                        if($exists) {
                            $response = LandlordLoginSystem::sendResetPasswordLink($email);
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

        <?php if(isset($_SESSION['s_landlordId'])):
            if(isset($_GET['r'])):
                header('location: /landlord/' . urldecode($_GET['r']));
            else: ?>

                <section>
                    <div class="section-padding align-center">
                        <a href="/landlord/activity" class="paragraph-a"><div class="dashboard-item third"><h3>View user activity</h3><p>View all the activity of users interacting with your properties</p></div></a>
                        <a href="/landlord/all-properties" class="paragraph-a"><div class="dashboard-item third"><p><h3>View all properties</h3><p>View all your properties and rooms in the application</p></div></a>
                        <a href="/landlord/update-room-availability" class="paragraph-a"><div class="dashboard-item third"><p><h3>Update room availability</h3><p>If a room has become occupied, it's availability can be changed here</p></div></a>
                        <a href="/landlord/new-property" class="paragraph-a"><div class="dashboard-item third"><h3>Add a new property</h3><p>Add properties to the app's listings</p></div></a>
                        <a href="/landlord/remove-property" class="paragraph-a"><div class="dashboard-item third"><h3>Remove a property</h3><p>Remove a property from the app's listings</p></div></a>
                    </div>
                </section>

                <section>
                    <div class="section-padding align-center">
                        <p class="log-out">Logged in as landlord. <a href="/landlord/logout" class="paragraph-a">Logout</a></p>
                    </div>
                </section>

        <?php endif;
        endif; ?>
    </div>
</main>