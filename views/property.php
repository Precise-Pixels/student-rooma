<main>
    <h1>Property</h1>

    <div class="property property--active">
        <div class="rooms">
            <div class="tabs<?= ($property->noOfRooms <= 5 ? " tabs--$property->noOfRooms" : ' tabs--small'); ?>">
                <?php foreach($property->rooms as $room): ?>
                    <div class="tab">Room <?= $room->roomNo; ?></div>
                <?php endforeach; ?>
            </div>

            <div class="room-content">
                <div class="room-slider">
                    <?php foreach($property->rooms as $room): ?>
                        <div class="room room--<?= ($room->availability ? 'available' : 'unavailable'); ?>">
                            <img src="/img/properties/<?= $property->propertyId; ?>/Room <?= $room->roomNo; ?>.jpg"/>
                            <div class="padding">
                                <span class="room-price">£<?= $room->price; ?>pcm</span>
                                <span class="room-type"><?= $room->roomType; ?> room</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="room-controls">
                <div class="room-control--left"></div>
                <div class="room-control--right"></div>
                <a href="/property/<?= $property->propertyId; ?>/gallery" class="view-house-gallery"><i class="ico-home"></i>View house gallery</a>
            </div>
        </div>

        <div class="padding">
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

            <a href="http://maps.google.com/maps?q=<?= $property->address; ?>" target="_blank"><img src="http://maps.googleapis.com/maps/api/staticmap?center=<?= $property->address; ?>&zoom=15&size=200x100&maptype=roadmap&key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4" class="property-map"/></a>
        </div>
    </div>
</main>