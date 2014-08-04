<main>
    <div class="properties">
        <?php foreach($properties as $property): ?>
            <div class="property">
                <div class="rooms">
                    <div class="room-tabs">
                        <?php foreach($property->rooms as $room): ?>
                            <div class="room-tab">Room <?= $room->roomNo; ?></div>
                        <?php endforeach; ?>
                    </div>

                    <div class="room-content">
                        <?php foreach($property->rooms as $room): ?>
                            <div class="room room--<?= ($room->availability ? 'available' : 'unavailable'); ?>">
                                <img src="/img/properties/<?= $property->propertyId; ?>/Room <?= $room->roomNo; ?>.jpg"/>
                                <span>&pound;<?= $room->price; ?>pcm</span>
                                <span><?= $room->roomType; ?> room</span>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="room-controls">
                        <div class="room-control--left"></div>
                        <div class="room-control--right"></div>
                        <a href="/property/<?= $property->propertyId; ?>/gallery" class="view-house-gallery">View house gallery</a>
                    </div>
                </div>

                <p><?= $property->address; ?></p>

                <?php if($property->location == 'Canterbury'): ?>
                    <p><?= $property->distanceUKC; ?>m walk to UKC</p>
                    <p><?= $property->distanceCCCU; ?>m walk to CCCU</p>
                <?php else: ?>
                    <p><?= $property->distanceUKM; ?>m walk to UKM</p>
                <?php endif; ?>

                <p>Date available: <?= $property->availableFrom; ?></p>

                <p>Info: <?= nl2br(stripcslashes($property->info)); ?></p>

                <p>First listed: <?= $property->timestamp; ?></p>

                <a href="http://maps.google.com/maps?q=<?= $property->address; ?>" target="_blank"><img src="http://maps.googleapis.com/maps/api/staticmap?center=<?= $property->address; ?>&zoom=15&size=200x100&maptype=roadmap&key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4"/></a>

                <div class="decision-buttons decision-buttons--decide" data-property-id="<?= $property->propertyId; ?>">
                    <button class="no">NO</button>
                    <button class="star">&#9733;</button>
                    <button class="book">BOOK</button>
                </div>
            </div>

            <hr>
        <?php endforeach; ?>

        <?php if(empty($properties)): ?>
            <p>There are no properties available within your search filters.</p>
            <p>Expand your filters in your <a href="profile">Profile</a>.</p>
        <?php endif; ?>
    </div>
</main>