<main>
    <h1>Properties</h1>

    <?php if(!empty($properties)): ?>
        <div class="properties">
            <?php foreach($properties as $key => $property): ?>
                <div class="property<?= ($key === 0 ? ' property--active' : ''); ?>" data-property-id="<?= $property->propertyId; ?>">
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
                                <p><span>Walk to UKM:</span> <?= $property->distanceUKM; ?>min</p>
                            <?php endif; ?>
                        </div>

                        <p class="property-info">
                            <span>General information:</span>
                            <?= nl2br(stripcslashes($property->info)); ?>
                        </p>

                        <a href="http://maps.google.com/maps?q=<?= $property->address; ?>" target="_blank" class="property-map"><div data-src="http://maps.googleapis.com/maps/api/staticmap?center=<?= $property->address; ?>&zoom=15&size=WIDTHxHEIGHT&maptype=roadmap&format=jpg&key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4"></div></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="decision-buttons decision-buttons--decide padding">
            <div class="no-wrapper"><button class="no">NO</button></div>
            <div class="star-wrapper"><button class="star"><i class="ico-star ico--centre"><span>STAR</span></i></button></div>
            <div class="book-wrapper"><button class="book">BOOK</button></div>
        </div>
    <?php else: ?>
        <div class="properties">
            <div class="padding">
                <p>There are no properties available within your search filters.</p>
                <p>Expand your filters in your <a href="profile">Profile</a>.</p>
            </div>
        </div>
    <?php endif; ?>
</main>