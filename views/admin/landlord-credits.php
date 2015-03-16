<main>
    <div class="padding">
        <h1 class="h1--show">Manage Landlord's Credits</h1>

        <p>All changes are saved automatically after clicking off of the text fields.</p>

        <?php foreach($landlords as $landlord): ?>
            <div class="availability-row">
                <div class="availability-address"><?= $landlord->name; ?> &lt;<?= $landlord->email; ?>&gt;</div>
                <input type="number" value="<?= $landlord->credits; ?>" class="credits" data-landlord-id="<?= $landlord->landlordId; ?>"/>
            </div>
        <?php endforeach; ?>
    </div>
</main>