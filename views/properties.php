<div class="properties">
    <?php foreach($properties as $property): ?>
        <div id="property-<?= $property->propertyId; ?>" class="property">
            <?php
                $images = scandir(__DIR__ . "/../img/properties/{$property->propertyId}/");
                array_splice($images, 0, 2);
                foreach($images as $image):
            ?>
                <img src="/img/properties/<?= $property->propertyId; ?>/<?= $image; ?>" width="100"/>
            <?php endforeach; ?>

            <p><?= $property->address; ?></p>

            <?php if($property->location == 'Canterbury'): ?>
                <p><?= $property->distanceUKC; ?>m walk to UKC</p>
                <p><?= $property->distanceCCCU; ?>m walk to CCCU</p>
            <?php else: ?>
                <p><?= $property->distanceUKM; ?>m walk to UKM</p>
            <?php endif; ?>

            <p>£<?= $property->price; ?>pcm</p>

            <p><?= $property->roomType; ?> room</p>

            <p>Date available: <?= $property->availableFrom; ?></p>

            <p>Furnishing: <?= $property->furnishing; ?></p>

            <p>First listed: <?= $property->timestamp; ?></p>

            <a href="http://maps.google.com/maps?q=<?= $property->address; ?>" target="_blank"><img src="http://maps.googleapis.com/maps/api/staticmap?center=<?= $property->address; ?>&zoom=15&size=200x100&maptype=roadmap&key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4"/></a>

            <div class="property--buttons" data-property-id="<?= $property->propertyId; ?>">
                <button class="no">NO</button>
                <button class="star">&#9733;</button>
                <button class="book">BOOK</button>
            </div>
        </div>
    <?php endforeach; ?>
</div>