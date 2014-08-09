<main>
    <h1>Activity</h1>

    <div class="tabs">
        <div id="tab--booked" class="tab">Booked</div>
        <div id="tab--starred" class="tab tab--active"><i class="ico-star ico--centre"><span>Starred</span></i></div>
        <div id="tab--nos" class="tab">No's</div>
    </div>

    <div id="booked" class="tab-content">
        <div class="padding">
            <?php $i = 0; foreach($activity as $property):
                if($property->status != 'book') { continue; } ?>

                <p>activityId: <?= $property->activityId; ?></p>
                <p>propertyId: <?= $property->propertyId; ?></p>
                <p>address: <?= $property->address; ?></p>
                <p><?= $property->noOfRooms; ?> rooms</p>

                <div class="decision-buttons decision-buttons--update" data-property-id="<?= $property->propertyId; ?>">
                    <div class="star-wrapper"><button class="star"><i class="ico-star ico--centre"><span>STAR</span></i></button></div>
                    <div class="no-wrapper"><button class="no">NO</button></div>
                    <div class="more-info-wrapper"><a href="property/<?= $property->propertyId; ?>"><button class="more-info">MORE INFO</button></a></div>
                </div>

                <br>

            <?php $i++; endforeach; ?>

            <?php if($i === 0): ?>
                <p>You haven't booked any viewings yet.</p>
            <?php endif; ?>
        </div>
    </div>

    <div id="starred" class="tab-content--show">
        <div class="padding">
            <?php $i = 0; foreach($activity as $property):
                if($property->status != 'star') { continue; } ?>

                <p>activityId: <?= $property->activityId; ?></p>
                <p>propertyId: <?= $property->propertyId; ?></p>
                <p>address: <?= $property->address; ?></p>
                <p><?= $property->noOfRooms; ?> rooms</p>

                <div class="decision-buttons decision-buttons--update" data-property-id="<?= $property->propertyId; ?>">
                    <div class="book-wrapper"><button class="book">BOOK</button></div>
                    <div class="no-wrapper"><button class="no">NO</button></div>
                    <div class="more-info-wrapper"><a href="property/<?= $property->propertyId; ?>"><button class="more-info">MORE INFO</button></a></div>
                </div>

                <br>

            <?php $i++; endforeach; ?>

            <?php if($i === 0): ?>
                <p>You haven't starred any properties yet.</p>
            <?php endif; ?>
        </div>
    </div>

    <div id="nos" class="tab-content">
        <div class="padding">
            <?php $i = 0; foreach($activity as $property):
                if($property->status != 'no') { continue; } ?>

                <p>activityId: <?= $property->activityId; ?></p>
                <p>propertyId: <?= $property->propertyId; ?></p>
                <p>address: <?= $property->address; ?></p>
                <p><?= $property->noOfRooms; ?> rooms</p>

                <div class="decision-buttons decision-buttons--update" data-property-id="<?= $property->propertyId; ?>">
                    <div class="book-wrapper"><button class="book">BOOK</button></div>
                    <div class="star-wrapper"><button class="star"><i class="ico-star ico--centre"><span>STAR</span></i></button></div>
                    <div class="more-info-wrapper"><a href="property/<?= $property->propertyId; ?>"><button class="more-info">MORE INFO</button></a></div>
                </div>

                <br>

            <?php $i++; endforeach; ?>

            <?php if($i === 0): ?>
                <p>You haven't no'd any properties yet.</p>
            <?php endif; ?>
        </div>
    </div>
</main>