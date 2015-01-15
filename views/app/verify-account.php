<main>
    <div class="padding">
        <h1 class="h1--show">Verify Account</h1>

        <?php
        if(!isset($_GET['e']) || !isset($_GET['r'])) {
            header('location: /app/');
        }

        require_once('php/LoginSystem.php');

        $response = LoginSystem::validateUser($_GET['e'], $_GET['r']);

        echo ($response ? '<p class="success">User account verified. You may now <a href="/app/#continue-with-email">log in</a>.</p>' : '<p class="error">An error has occurred whilst verifying your account. Please contact <a href="mailto:support@studentrooma.co.uk">support@studentrooma.co.uk</a>.</p>');
        ?>
    </div>
</main>