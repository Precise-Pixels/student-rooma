<main>
    <div class="padding">
        <h1 class="h1--show">Payment</h1>

        <?php if(isset($_GET['s']) && $_GET['s'] === 'success'): ?>
            <p class="success">You have successfully activated your new property.</p>
            <p><a href="/landlord/all-properties">Click here</a> to see all of your properties.</p>
            <p class="success">Although usually immediate, the transaction may take some time to propagate to our systems. If your property has not been activated after 1 hour, please contact <a href="mailto:support@studentrooma.co.uk">support@studentrooma.co.uk</a>.</p>
        <?php else: ?>
            <?php if($active): ?>
                <p>This property is already active.</p>
            <?php else:
                $propertyId = (isset($_GET['propertyId']) ? $_GET['propertyId'] : '');

                if($propertyId): ?>
                    <p>Your property has been successfully added to our system but is not currently active.</p>
                    <p>Activate your property by making your payment.</p>

                    <?php if($_SERVER['SERVER_NAME'] == 'sr.dev'): ?>
                        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                            <input type="hidden" name="cmd" value="_s-xclick">
                            <input type="hidden" name="hosted_button_id" value="837TVKC5PP23A">
                            <input type="hidden" name="return" value="http://sr.dev/landlord/payment?s=success">
                            <input type="hidden" name="cancel_return" value="http://sr.dev/landlord/payment?s=cancelled&propertyId=<?= $propertyId; ?>">
                            <input type="hidden" name="notify_url" value="https://studentrooma.co.uk/php/paypal_ipn.php?landlordId=<?= $_SESSION['s_landlordId']; ?>&propertyId=<?= $propertyId; ?>">
                            <input type="image" src="/img/paypal.png" border="0" id="paypal-image" name="submit" alt="Activate with PayPal">
                            <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                        </form>
                    <?php else: ?>
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                            <input type="hidden" name="cmd" value="_s-xclick">
                            <input type="hidden" name="hosted_button_id" value="C3C72BGXU9LFN">
                            <input type="hidden" name="return" value="https://studentrooma.co.uk/landlord/payment?s=success">
                            <input type="hidden" name="cancel_return" value="https://studentrooma.co.uk/landlord/payment?s=cancelled&propertyId=<?= $propertyId; ?>">
                            <input type="hidden" name="notify_url" value="https://studentrooma.co.uk/php/paypal_ipn.php?landlordId=<?= $_SESSION['s_landlordId']; ?>&propertyId=<?= $propertyId; ?>">
                            <input type="image" src="https://studentrooma.co.uk/img/paypal.png" border="0" id="paypal-image" name="submit" alt="Activate with PayPal">
                            <img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
                        </form>
                    <?php endif;

                    if(isset($_GET['s']) && $_GET['s'] === 'cancelled'): ?>
                        <p class="error">Your transaction has been cancelled.</p>
                    <?php endif;
                else: ?>
                    <p class="error">Something went wrong.</p>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</main>