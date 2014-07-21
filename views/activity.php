<h1>Activity</h1>

<h2>Booked</h2>
<?php foreach($activity as $property):
    if($property->status != 'book') { continue; } ?>

    <p>activityId: <?= $property->activityId; ?></p>
    <p>propertyId: <?= $property->propertyId; ?></p>
    <p>address: <?= $property->address; ?></p>
    <p>price: <?= $property->price; ?></p>
    <p>roomType: <?= $property->roomType; ?></p>
    <br>

<?php endforeach; ?>

<hr>

<h2>&#9733;</h2>
<?php foreach($activity as $property):
    if($property->status != 'star') { continue; } ?>

    <p>activityId: <?= $property->activityId; ?></p>
    <p>propertyId: <?= $property->propertyId; ?></p>
    <p>address: <?= $property->address; ?></p>
    <p>price: <?= $property->price; ?></p>
    <p>roomType: <?= $property->roomType; ?></p>
    <br>

<?php endforeach; ?>

<hr>

<h2>No's</h2>
<?php foreach($activity as $property):
    if($property->status != 'no') { continue; } ?>

    <p>activityId: <?= $property->activityId; ?></p>
    <p>propertyId: <?= $property->propertyId; ?></p>
    <p>address: <?= $property->address; ?></p>
    <p>price: <?= $property->price; ?></p>
    <p>roomType: <?= $property->roomType; ?></p>
    <br>

<?php endforeach; ?>