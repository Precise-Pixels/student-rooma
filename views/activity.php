<main>
    <h1>Activity</h1>

    <div class="tabs">
        <div id="tab--booked" class="tab">Booked</div>
        <div id="tab--starred" class="tab tab--active"><i class="ico-star ico--centre"><span>Starred</span></i></div>
        <div id="tab--nos" class="tab">No's</div>
    </div>

    <div id="content-wrapper">
        <div id="content-slider">
            <div id="booked-content">
                <?php $i = 0; foreach($activity as $property):
                    if($property->status != 'book') { continue; } ?>
                    <div class="activity padding">
                        <img src="/img/properties/<?= $property->propertyId; ?>/Room 1.jpg" class="activity-image"/>
                        <span class="activity-price">£<?= str_replace('.00', '', $property->minPrice); ?>-<?= str_replace('.00', '', $property->maxPrice); ?><span>pcm</span></span>
                        <i class="ico-pointer"></i>
                        <span class="activity-address"><?= $property->address; ?></span>
                        <span class="activity-rooms"><i class="ico-bed"></i><?= $property->noOfRooms; ?></span>

                        <div class="decision-buttons decision-buttons--update" data-property-id="<?= $property->propertyId; ?>">
                            <div class="star-wrapper"><button class="star"><i class="ico-star ico--centre"><span>STAR</span></i></button></div>
                            <div class="no-wrapper"><button class="no">NO</button></div>
                            <div class="more-info-wrapper"><a href="property/<?= $property->propertyId; ?>"><button class="more-info">MORE INFO</button></a></div>
                        </div>
                    </div>
                <?php $i++; endforeach; ?>

                <?php if($i === 0): ?>
                    <p class="padding">You haven't booked any viewings yet.</p>
                <?php endif; ?>
            </div>

            <div id="starred-content">
                <?php $i = 0; foreach($activity as $property):
                    if($property->status != 'star') { continue; } ?>
                    <div class="activity padding">
                        <img src="/img/properties/<?= $property->propertyId; ?>/Room 1.jpg" class="activity-image"/>
                        <span class="activity-price">£<?= str_replace('.00', '', $property->minPrice); ?>-<?= str_replace('.00', '', $property->maxPrice); ?><span>pcm</span></span>
                        <i class="ico-pointer"></i>
                        <span class="activity-address"><?= $property->address; ?></span>
                        <span class="activity-rooms"><i class="ico-bed"></i><?= $property->noOfRooms; ?></span>

                        <div class="decision-buttons decision-buttons--update" data-property-id="<?= $property->propertyId; ?>">
                            <div class="book-wrapper"><button class="book">BOOK</button></div>
                            <div class="no-wrapper"><button class="no">NO</button></div>
                            <div class="more-info-wrapper"><a href="property/<?= $property->propertyId; ?>"><button class="more-info">MORE INFO</button></a></div>
                        </div>
                    </div>
                <?php $i++; endforeach; ?>

                <?php if($i === 0): ?>
                    <p class="padding">You haven't starred any properties yet.</p>
                <?php endif; ?>
            </div>

            <div id="nos-content">
                <?php $i = 0; foreach($activity as $property):
                    if($property->status != 'no') { continue; } ?>
                    <div class="activity padding">
                        <img src="/img/properties/<?= $property->propertyId; ?>/Room 1.jpg" class="activity-image"/>
                        <span class="activity-price">£<?= str_replace('.00', '', $property->minPrice); ?>-<?= str_replace('.00', '', $property->maxPrice); ?><span>pcm</span></span>
                        <i class="ico-pointer"></i>
                        <span class="activity-address"><?= $property->address; ?></span>
                        <span class="activity-rooms"><i class="ico-bed"></i><?= $property->noOfRooms; ?></span>

                        <div class="decision-buttons decision-buttons--update" data-property-id="<?= $property->propertyId; ?>">
                            <div class="book-wrapper"><button class="book">BOOK</button></div>
                            <div class="star-wrapper"><button class="star"><i class="ico-star ico--centre"><span>STAR</span></i></button></div>
                            <div class="more-info-wrapper"><a href="property/<?= $property->propertyId; ?>"><button class="more-info">MORE INFO</button></a></div>
                        </div>
                    </div>
                <?php $i++; endforeach; ?>

                <?php if($i === 0): ?>
                    <p class="padding">You haven't no'd any properties yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>