<main>
    <div class="padding">
        <h1 class="h1--show">Buy Credits</h1>

         <p>Credit balance: <?= $credits; ?></p>

        <?php if($_SERVER['SERVER_NAME'] == 'sr.dev'): ?>
            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="K5R6FE6M3RYKU">
                <input type="hidden" name="return" value="http://sr.dev/landlord/buy-credits?s=success">
                <input type="hidden" name="cancel_return" value="http://sr.dev/landlord/buy-credits?s=cancelled">
                <input type="hidden" name="notify_url" value="https://studentrooma.co.uk/php/paypal_ipn.php?landlordId=<?= $_SESSION['s_landlordId']; ?>">
                <input type="image" src="https://studentrooma.co.uk/img/buy-credits.png" border="0" id="buy-credits-image" name="submit" alt="Buy credits">
                <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
        <?php else: ?>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="C3C72BGXU9LFN">
                <input type="hidden" name="return" value="https://studentrooma.co.uk/landlord/buy-credits?s=success">
                <input type="hidden" name="cancel_return" value="https://studentrooma.co.uk/landlord/buy-credits?s=cancelled">
                <input type="hidden" name="notify_url" value="https://studentrooma.co.uk/php/paypal_ipn.php?landlordId=<?= $_SESSION['s_landlordId']; ?>">
                <input type="image" src="https://studentrooma.co.uk/img/buy-credits.png" border="0" id="buy-credits-image" name="submit" alt="Buy credits">
                <img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
            </form>
        <?php endif; ?>

        <?php if(isset($_GET['s']) && $_GET['s'] === 'success'): ?>
            <p class="success">You have successfully purchased 1 credit.</p>
            <p class="success">Although usually immediate, the transaction may take some time to propagate to our systems. If your credit balance has not increased after 1 hour, please contact <a href="mailto:support@studentrooma.co.uk">support@studentrooma.co.uk</a>.</p>
        <?php endif; ?>

        <?php if(isset($_GET['s']) && $_GET['s'] === 'cancelled'): ?>
            <p class="error">Your transaction has been cancelled.</p>
        <?php endif; ?>
    </div>
</main>