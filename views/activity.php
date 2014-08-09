<main>
    <h1>Activity</h1>

    <h2>Booked</h2>
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

    <hr>

    <h2>&#9733;</h2>
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

    <hr>

    <h2>No's</h2>
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
</main>