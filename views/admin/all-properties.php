<main class="main--full-width">
    <div class="padding">
        <h1 class="h1--show">View All Properties</h1>

        <table>
            <thead>
                <tr>
                    <th class="th--xs">ID</th>
                    <th class="th--m">Location</th>
                    <th class="th--l">Address</th>
                    <th class="th--s">Distance UKC</th>
                    <th class="th--s">Distance CCCU</th>
                    <th class="th--s">Distance UKM</th>
                    <th class="th--s">No. of Rooms</th>
                    <th class="th--m">Available From</th>
                    <th class="th--l">Info</th>
                    <th class="th--m">Timestamp</th>
                    <th class="th--l">Rooms</th>
                    <th class="th--l">General House Images</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($properties as $key => $property): ?>
                    <tr>
                        <td><?= $property->propertyId; ?></td>
                        <td><?= $property->location; ?></td>
                        <td><?= $property->addressNumber; ?> <?= $property->address; ?></td>
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