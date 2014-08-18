<main class="main--non-centre">
    <div class="padding">
        <h1 class="h1--show">View All Properties</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Location</th>
                    <th class="th--min-width-l">Address</th>
                    <th>Distance UKC</th>
                    <th>Distance CCCU</th>
                    <th>Distance UKM</th>
                    <th>No. of Rooms</th>
                    <th class="th--min-width-s">Available From</th>
                    <th class="th--min-width-l">Info</th>
                    <th>Timestamp</th>
                    <th class="th--min-width-l">Rooms</th>
                    <th class="th--min-width-l">General House Images</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($properties as $key => $property): ?>
                    <tr>
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
                        <td>
                            <?php foreach($property->rooms as $room): ?>
                                <div class="admin-room">
                                    <img src="/img/properties/<?= $property->propertyId; ?>/Room <?= $room->roomNo; ?>.jpg"/>
                                    <span>Room <?= $room->roomNo; ?></span>
                                    <span><?= ucfirst($room->roomType); ?></span>
                                    <span><?= $room->price; ?></span>
                                    <span><?= ($room->availability ? 'Available' : 'Unavailable'); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </td>
                        <td>
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
                                    <img src="/img/properties/<?= $property->propertyId; ?>/<?= $image; ?>"/>
                                    <span><?= str_replace('.jpg', '', $image); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>