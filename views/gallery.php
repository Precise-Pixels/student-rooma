<main>
    <h1>Gallery</h1>

    <?php foreach($images as $image): ?>
        <img src="/img/properties/<?= $propertyId; ?>/<?= $image; ?>"/>
        <div class="image-caption"><?= str_replace('.jpg', '', $image); ?></div>
    <?php endforeach; ?>

    <div class="decision-buttons decision-buttons--decide padding" data-property-id="<?= $propertyId; ?>">
        <div class="no-wrapper"><button class="no">NO</button></div>
        <div class="star-wrapper"><button class="star"><i class="ico-star ico--centre"><span>STAR</span></i></button></div>
        <div class="book-wrapper"><button class="book">BOOK</button></div>
    </div>
</main>