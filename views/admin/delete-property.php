<main>
    <div class="padding">
        <h1 class="h1--show">Delete A Property</h1>

        <table>
            <thead>
                <tr>
                    <th class="th--xs">ID</th>
                    <th class="th--l">Address</th>
                    <th>Delete (immediate / permanent)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($properties as $property): ?>
                    <tr>
                        <td><?= $property->propertyId; ?></td>
                        <td><?= $property->address; ?></td>
                        <td><button data-property-id="<?= $property->propertyId; ?>">Delete</button></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>