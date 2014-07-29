<h1>Gallery</h1>

<?php foreach($images as $image): ?>
    <img src="/img/properties/<?= $propertyId; ?>/<?= $image; ?>"/>
    <div class="image-caption"><?= str_replace('.jpg', '', $image); ?></div>
<?php endforeach; ?>

<div class="decision-buttons decision-buttons--decide" data-property-id="<?= $propertyId; ?>">
    <button class="no">NO</button>
    <button class="star">&#9733;</button>
    <button class="book">BOOK</button>
</div>