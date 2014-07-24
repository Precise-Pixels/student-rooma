<h1>Activity</h1>

<h2>Booked</h2>
<?php foreach($activity as $property):
    if($property->status != 'book') { continue; } ?>

    <p>activityId: <?= $property->activityId; ?></p>
    <p>propertyId: <?= $property->propertyId; ?></p>
    <p>address: <?= $property->address; ?></p>
    <p><?= $property->noOfRooms; ?> rooms</p>

    <div class="activity--buttons" data-property-id="<?= $property->propertyId; ?>">
        <button class="book" disabled>BOOK</button>
        <button class="star">&#9733;</button>
        <button class="no">NO</button>
        <a href="property/<?= $property->propertyId; ?>"><button class="info">MORE INFO</button></a>
    </div>

    <br>

<?php endforeach; ?>

<hr>

<h2>&#9733;</h2>
<?php foreach($activity as $property):
    if($property->status != 'star') { continue; } ?>

    <p>activityId: <?= $property->activityId; ?></p>
    <p>propertyId: <?= $property->propertyId; ?></p>
    <p>address: <?= $property->address; ?></p>
    <p><?= $property->noOfRooms; ?> rooms</p>

    <div class="activity--buttons" data-property-id="<?= $property->propertyId; ?>">
        <button class="book">BOOK</button>
        <button class="star" disabled>&#9733;</button>
        <button class="no">NO</button>
        <a href="property/<?= $property->propertyId; ?>"><button class="info">MORE INFO</button></a>
    </div>

    <br>

<?php endforeach; ?>

<hr>

<h2>No's</h2>
<?php foreach($activity as $property):
    if($property->status != 'no') { continue; } ?>

    <p>activityId: <?= $property->activityId; ?></p>
    <p>propertyId: <?= $property->propertyId; ?></p>
    <p>address: <?= $property->address; ?></p>
    <p><?= $property->noOfRooms; ?> rooms</p>

    <div class="activity--buttons" data-property-id="<?= $property->propertyId; ?>">
        <button class="book">BOOK</button>
        <button class="star">&#9733;</button>
        <button class="no" disabled>NO</button>
        <a href="property/<?= $property->propertyId; ?>"><button class="info">MORE INFO</button></a>
    </div>

    <br>

<?php endforeach; ?>