<main>
    <div class="padding">
        <h1>Student Rooma</h1>

        <button id="login-fb-btn" class="login-buttons" autofocus><i class="ico-facebook"></i><span id="login-fb-btn-text">Continue with Facebook</span></button>

        <button id="login-email-btn" class="login-buttons"><i class="ico-email"></i><span>Continue with Email</span></button>

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
                    echo '<p class="error">Please enter your email and password.</p>';
                }
            }
            ?>
            <div class="form-row">
                <p><a href="#create-an-account" id="create-account">Create an account</a></p>
                <p><a href="#forgotten-your-password" id="forgotten-password">Forgotten your password</a></p>
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
                            echo '<p class="error">An account with this email already exists.</p>';
                        } else {
                            $response = LoginSystem::createUser($email, $password);
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
        </form>

        <div id="walkthrough-wrapper">
            <div id="walkthrough-1" class="walkthrough-slide">
                <p class="walkthrough-page">PROPERTIES</p>
                <img src="/img/walkthrough-properties-1.png" alt="Properties page"/>
                <p class="walkthrough-text">View information about a property</p>
            </div>
            <div id="walkthrough-2" class="walkthrough-slide">
                <p class="walkthrough-page">PROPERTIES</p>
                <img src="/img/walkthrough-properties-2.png" alt="Properties page"/>
                <p class="walkthrough-text">Decide if it's a NO, SAVE FOR LATER ★ or you want to BOOK a viewing</p>
            </div>
            <div id="walkthrough-3" class="walkthrough-slide">
                <p class="walkthrough-page">PROPERTIES</p>
                <img src="/img/walkthrough-properties-3.png" alt="Properties page"/>
                <p class="walkthrough-text">If you decide to book a viewing you will be called by a Student Rooma representative who will provide you with booking details</p>
            </div>
            <div id="walkthrough-4" class="walkthrough-slide">
                <p class="walkthrough-page">PROFILE</p>
                <img src="/img/walkthrough-profile-1.png" alt="Profile page"/>
                <p class="walkthrough-text">Use the search filters to narrow down the type of property you are looking for</p>
            </div>
            <div id="walkthrough-5" class="walkthrough-slide">
                <p class="walkthrough-page">PROFILE</p>
                <img src="/img/walkthrough-profile-2.png" alt="Profile page"/>
                <p class="walkthrough-text">Enter your phone number so you can be contacted when booking a property viewing</p>
            </div>
            <div id="walkthrough-6" class="walkthrough-slide">
                <p class="walkthrough-page">PROFILE</p>
                <img src="/img/walkthrough-profile-3.png" alt="Profile page"/>
                <p class="walkthrough-text">Use the "Reset No's" button to reset all the properties you previously decided "NO" on</p>
            </div>
            <div id="walkthrough-7" class="walkthrough-slide">
                <p class="walkthrough-page">ACTIVITY</p>
                <img src="/img/walkthrough-activity-1.png" alt="Activity page"/>
                <p class="walkthrough-text">View all your previous activity in one place</p>
            </div>
        </div>

        <div id="small-print">
            <p>If you click "Continue with Facebook" and are not already registered with Student Rooma, you will be registered and you agree to Student Rooma's <a href="/app/privacy-policy">Privacy Policy</a>.</p>
            <p>This site uses cookies. Some of the cookies we use are essential for the normal operation of this site. Please ensure cookies remain enabled during your use of this site. For further information, please visit our <a href="/app/privacy-policy">Privacy Policy</a>.</p>
        </div>

        <p id="copyright">&copy; 2014, Student Rooma, All Rights Reserved</p>

        <div id="fb-root"></div>
    </div>
</main>