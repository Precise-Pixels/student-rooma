<main>
    <div class="padding">
        <?php
        require_once('php/LoginSystem.php');
        LoginSystem::logout();
        ?>

        <h1 class="h1--show">Logging out...</h1>

        <div id="fb-root"></div>
    </div>
</main>