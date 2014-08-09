<main>
    <h1>Admin Update Room Availability</h1>

    <table>
        <thead>
            <tr>
                <th>Address</th>
                <th>Room number</th>
                <th>Availability</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($properties as $i => $property): ?>
                <tr>
                    <td><?= $property->address; ?></td>
                    <td><?= $property->roomNo; ?></td>
                    <td>
                        <input type="checkbox" id="checkbox-<?= $i; ?>" class="availability" data-room-id="<?= $property->roomId; ?>"<?= ($property->availability == 1 ? ' checked' : ''); ?>/>
                        <label for="checkbox-<?= $i; ?>" class="checkbox-style"></label>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>