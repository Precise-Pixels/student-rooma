<main>
    <div class="padding">
        <?php
        unset($_SESSION['s_userId']);
        setcookie('c_userId', 'false', 1, '/');
        ?>

        <p>Logging out...</p>

        <div id="fb-root"></div>
    </div>
</main>