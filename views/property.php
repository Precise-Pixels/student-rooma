<main>
    <h1>Property</h1>

    <div class="property property--active">
        <div class="rooms">
            <div class="tabs tabs--<?= $property->noOfRooms; ?>">
                <?php foreach($property->rooms as $key => $room): ?>
                    <div class="tab tab-<?= $key; ?>">Room <?= $room->roomNo; ?></div>
                <?php endforeach; ?>
            </div>

            <div class="room-content">
                <div class="room-slider">
                    <?php foreach($property->rooms as $room): ?>
                        <div class="room room--<?= ($room->availability ? 'available' : 'unavailable'); ?>">
                            <div data-src="/img/properties/<?= $property->propertyId; ?>/Room <?= $room->roomNo; ?>.jpg" class="room-image"></div>
                            <div class="room-info padding">
                                <span class="room-price">£<?= str_replace('.00', '', $room->price); ?><span>pcm</span></span>
                                <span class="room-type"><i class="ico-bed"></i><?= ucfirst($room->roomType); ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="room-controls">
                <div class="room-control--left"><i class="ico-arrow-left ico--centre"></i></div>
                <div class="room-control--right"><i class="ico-arrow-right ico--centre"></i></div>
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
                    <p><span>Walk to UKC:</span> <?= $property->distanceUKC; ?>min</p>
                    <p><span>Walk to CCCU:</span> <?= $property->distanceCCCU; ?>min</p>
                <?php else: ?>
                    <p><span>Walk to Medway Campus:</span> <?= $property->distanceUKM; ?>min</p>
                <?php endif; ?>
            </div>

            <p class="property-info">
                <span>General information:</span>
                <?= nl2br(stripcslashes($property->info)); ?>
            </p>

            <a href="http://maps.google.com/maps?q=<?= $property->address; ?>" target="_blank" class="property-map"><div data-src="http://maps.googleapis.com/maps/api/staticmap?center=<?= $property->address; ?>&zoom=15&size=WIDTHxHEIGHT&maptype=roadmap&format=jpg&scale=2&markers=scale:2%7Cicon:http://sr.precisepixels.co.uk/img/pin.png%7C<?= $property->address; ?>&key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4"></div></a>
        </div>
    </div>
</main>