<h1>Admin Update Room Availability</h1>

<?php if(isset($_GET['status']) && $_GET['status'] === 'success'): ?>
    <p class="toast">Success</p>
<?php endif; ?>

<?php if(isset($_GET['status']) && $_GET['status'] === 'unchanged'): ?>
    <p class="toast">Unchanged</p>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>Address</th>
            <th>Room number</th>
            <th>Availability</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($properties as $property): ?>
            <tr>
                <td><?= $property->address; ?></td>
                <td><?= $property->roomNo; ?></td>
                <td>
                    <select class="availability" data-room-id="<?= $property->roomId; ?>">
                        <option value="1"<?= ($property->availability == 1 ? ' selected' : ''); ?>>Available</option>
                        <option value="0"<?= ($property->availability == 0 ? ' selected' : ''); ?>>Unavailable</option>
                    </select>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>