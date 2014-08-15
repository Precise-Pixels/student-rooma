<main>
    <div class="padding">
        <h1 class="h1--show">View All Properties</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Location</th>
                    <th>Address</th>
                    <th>Distance UKC</th>
                    <th>Distance CCCU</th>
                    <th>Distance UKM</th>
                    <th>Number of Rooms</th>
                    <th>Available From</th>
                    <th>Info</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($properties as $key => $property): ?>
                    <tr<?= ($key % 2 === 1 ? ' class="tr--even"' : ' class="tr--odd"'); ?>>
                        <td><?= $property->propertyId; ?></td>
                        <td><?= $property->location; ?></td>
                        <td><?= $property->address; ?></td>
                        <td><?= $property->distanceUKC; ?></td>
                        <td><?= $property->distanceCCCU; ?></td>
                        <td><?= $property->distanceUKM; ?></td>
                        <td><?= $property->noOfRooms; ?></td>
                        <td><?= $property->availableFrom; ?></td>
                        <td><?= nl2br(stripcslashes($property->info)); ?></td>
                        <td><?= $property->timestamp; ?></td>
                    </tr>
                    <tr<?= ($key % 2 === 1 ? ' class="tr--even"' : ' class="tr--odd"'); ?>>
                        <td colspan="10" class="td--centre">Rooms</td>
                    </tr>
                    <tr<?= ($key % 2 === 1 ? ' class="tr--even"' : ' class="tr--odd"'); ?>>
                        <td colspan="10">
                            <?php foreach($property->rooms as $room): ?>
                                <div class="admin-room">
                                    <span>Room <?= $room->roomNo; ?></span>
                                    <span><?= ucfirst($room->roomType); ?></span>
                                    <span><?= $room->price; ?></span>
                                    <span><?= ($room->availability ? 'Available' : 'Unavailable'); ?></span>
                                    <img src="/img/properties/<?= $property->propertyId; ?>/Room <?= $room->roomNo; ?>.jpg"/>
                                </div>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                    <tr<?= ($key % 2 === 1 ? ' class="tr--even"' : ' class="tr--odd"'); ?>>
                        <td colspan="10" class="td--centre">General House Images</td>
                    </tr>
                    <tr<?= ($key % 2 === 1 ? ' class="tr--even"' : ' class="tr--odd"'); ?>>
                        <td colspan="10">
                            <?php
                                $images = scandir(__DIR__ . "/../../img/properties/{$property->propertyId}/");
                                array_splice($images, 0, 2);

                                foreach($images as $key => $image) {
                                    if(preg_match('/Room \d+.jpg/', $image)) {
                                        unset($images[$key]);
                                    }
                                }

                                foreach($images as $image):
                            ?>
                                <div class="admin-room">
                                    <span><?= str_replace('.jpg', '', $image); ?></span>
                                    <img src="/img/properties/<?= $property->propertyId; ?>/<?= $image; ?>"/>
                                </div>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>