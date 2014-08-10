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
                            <div class="room-info padding">
                                <span class="room-price">£<?= $room->price; ?><span>pcm</span></span>
                                <span class="room-type"><i class="ico-bed"></i><?= ucfirst($room->roomType); ?> room</span>
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
            <hr>
            <p class="property-address"><i class="ico-pointer"></i><?= $property->address; ?></p>

            <div class="property-col property-col--l">
                <p><span>Date available:</span> <?= $property->availableFrom; ?></p>
                <p><span>First listed:</span> <?= $property->timestamp; ?></p>
            </div>

            <div class="property-col property-col--r">
                <?php if($property->location == 'Canterbury'): ?>
                    <p><span>Walk to UKC:</span> <?= $property->distanceUKC; ?>m</p>
                    <p><span>Walk to CCCU:</span> <?= $property->distanceCCCU; ?>m</p>
                <?php else: ?>
                    <p><span>Walk to UKM:</span> <?= $property->distanceUKM; ?>m</p>
                <?php endif; ?>
            </div>

            <p class="property-info">
                <span>General information:</span>
                <?= nl2br(stripcslashes($property->info)); ?>
            </p>

            <a href="http://maps.google.com/maps?q=<?= $property->address; ?>" target="_blank"><img src="http://maps.googleapis.com/maps/api/staticmap?center=<?= $property->address; ?>&zoom=15&size=200x100&maptype=roadmap&key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4" class="property-map"/></a>
        </div>
    </div>
</main>