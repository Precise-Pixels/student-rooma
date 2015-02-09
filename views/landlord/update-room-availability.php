<main>
    <div class="padding">
        <h1 class="h1--show">Update Room Availability</h1>

        <p>All changes are saved automatically.</p>

        <?php foreach($properties as $property): ?>
            <div class="availability-row">
                <div class="availability-address"><?= $property->addressNumber; ?> <?= $property->address; ?></div>
                <div class="availability-rooms">
                    <?php foreach($property->rooms as $room): ?>
                        <div class="availability-room">
                            <label>Room <?= $room->roomNo; ?></label>
                            <input type="checkbox" id="checkbox-<?= $room->roomId; ?>" class="availability" data-room-id="<?= $room->roomId; ?>"<?= ($room->availability == 1 ? ' checked' : ''); ?>/>
                            <label for="checkbox-<?= $room->roomId; ?>" class="checkbox-style"></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>