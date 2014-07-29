<h1>Gallery</h1>

<?php foreach($images as $image): ?>
    <img src="/img/properties/<?= $propertyId; ?>/<?= $image; ?>"/>
    <div class="image-caption"><?= str_replace('.jpg', '', $image); ?></div>
<?php endforeach; ?>