<div id="property-<?= $property->propertyId; ?>" class="property">
    <?php
        $images = scandir(__DIR__ . "/../img/properties/{$property->propertyId}/");
        array_splice($images, 0, 2);
    ?>
    <a href="/property/<?= $property->propertyId; ?>/gallery">
        <div id="property-images" class="image-count-<?= (count($images) > 5 ? '5' : count($images)); ?>">
            <?php foreach($images as $image): ?>
                <img src="/img/properties/<?= $property->propertyId; ?>/<?= $image; ?>" width="100"/>
            <?php endforeach; ?>
        </div>
    </a>

    <p><?= $property->noOfRooms; ?> rooms</p>

    <?php foreach($property->rooms as $room): ?>
        <p><?= $room->roomNo; ?><br>
        <?= $room->roomType; ?> room<br>
        &pound;<?= $room->price; ?>pcm<br>
        <?= ($room->status ? 'available' : 'not available' ); ?></p>
    <?php endforeach; ?>

    <p><?= $property->address; ?></p>

    <?php if($property->location == 'Canterbury'): ?>
        <p><?= $property->distanceUKC; ?>m walk to UKC</p>
        <p><?= $property->distanceCCCU; ?>m walk to CCCU</p>
    <?php else: ?>
        <p><?= $property->distanceUKM; ?>m walk to UKM</p>
    <?php endif; ?>

    <p>Date available: <?= $property->availableFrom; ?></p>

    <p>Info: <?= nl2br($property->info); ?></p>

    <p>First listed: <?= $property->timestamp; ?></p>

    <a href="http://maps.google.com/maps?q=<?= $property->address; ?>" target="_blank"><img src="http://maps.googleapis.com/maps/api/staticmap?center=<?= $property->address; ?>&zoom=15&size=200x100&maptype=roadmap&key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4"/></a>
</div>