<main>
    <div class="padding">
        <h1 class="h1--show">View User Activity</h1>

        <?php if(isset($_GET['propertyId']) && isset($_GET['userId'])): ?>
            <p>If no row is highlighted orange, this means that the user has cancelled their booking and reset their no's.</p>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Address</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($activity as $activity): ?>
                    <tr<?= (isset($_GET['propertyId']) && isset($_GET['userId']) && $_GET['propertyId'] === $activity->propertyId && $_GET['userId'] === $activity->userId ? ' class="highlight"' : ''); ?>>
                        <td><?= $activity->name; ?></td>
                        <td><?= $activity->phone; ?></td>
                        <td><?= $activity->status; ?></td>
                        <td><?= $activity->address; ?></td>
                        <td><?= $activity->timestamp; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>