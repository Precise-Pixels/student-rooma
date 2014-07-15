<div class="listings">
    <?php foreach($listings as $listing): ?>
        <div class="listing">
            <?php
                $images = scandir(__DIR__ . "/../img/properties/{$listing->propertyId}/");
                array_splice($images, 0, 2);
                foreach($images as $image):
            ?>
                <img src="/img/properties/<?= $listing->propertyId; ?>/<?= $image; ?>" width="100"/>
            <?php endforeach; ?>

            <p><?= $listing->address; ?></p>

            <?php if($listing->location == 'Canterbury'): ?>
                <p><?= $listing->distanceUKC; ?>m walk to UKC</p>
                <p><?= $listing->distanceCCCU; ?>m walk to CCCU</p>
            <?php else: ?>
                <p><?= $listing->distanceUKM; ?>m walk to UKM</p>
            <?php endif; ?>

            <p>£<?= $listing->price; ?>pcm</p>

            <p><?= $listing->roomType; ?> room</p>

            <p>Date available: <?= $listing->availableFrom; ?></p>

            <p>Furnishing: <?= $listing->furnishing; ?></p>

            <p>First listed: <?= $listing->timestamp; ?></p>

            <a href="http://maps.google.com/maps?q=<?= $listing->address; ?>" target="_blank"><img src="http://maps.googleapis.com/maps/api/staticmap?center=<?= $listing->address; ?>&zoom=15&size=600x300&maptype=roadmap&key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4"/></a>
        </div>
    <?php endforeach; ?>
</div>