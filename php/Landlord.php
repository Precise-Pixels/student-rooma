<?php

class Landlord {
    static function getActivity() {
        require('db.php');

        $sth = $dbh->query("SELECT users.name, users.phone, status, properties.addressNumber, properties.address, activity.timestamp, activity.userId, activity.propertyId
                            FROM activity
                            INNER JOIN properties ON activity.propertyId=properties.propertyId
                            INNER JOIN users ON activity.userId=users.userId
                            INNER JOIN landlords ON properties.landlordId=landlords.landlordId
                            WHERE properties.landlordId=".$_SESSION['s_landlordId']."
                            ORDER BY activity.timestamp DESC");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $results = $sth->fetchAll();

        return $results;
    }

    static function getAllProperties() {
        require('db.php');

        $sth = $dbh->query("SELECT propertyId, location, addressNumber, address, distanceUKC, distanceCCCU, distanceUKM, noOfRooms, availableFrom, info, timestamp FROM properties WHERE landlordId=".$_SESSION['s_landlordId']." ORDER BY propertyId DESC");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $properties = $sth->fetchAll();

        // Find all the rooms for each property and append to property object
        $sth = $dbh->query("SELECT propertyId, roomNo, roomType, price, availability FROM rooms");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $rooms = $sth->fetchAll();

        foreach($properties as $property) {
            $roomArray = array();

            foreach($rooms as $room) {
                if($room->propertyId == $property->propertyId) {
                    array_push($roomArray, $room);
                }
            }

            $property->rooms = ($roomArray);
        }

        return $properties;
    }

    static function postProperty($post) {
        require('db.php');

        // Insert property
        $distanceUKC = (int)$post['distance-UKC'];
        $distanceCCCU = (int)$post['distance-CCCU'];
        $distanceUKM = (int)$post['distance-UKM'];
        $noOfRooms = (int)$post['rooms'];
        $availableFrom = date("Y-m-d", strtotime($post['available-from']));
        $info = addslashes($post['info']);
        $timestamp = date("Y-m-d H:i:s");

        $sth = $dbh->prepare("INSERT INTO properties (landlordId, location, addressNumber, address, distanceUKC, distanceCCCU, distanceUKM, noOfRooms, availableFrom, info, active, timestamp) VALUE (".$_SESSION['s_landlordId'].", :location, :addressNumber, :address, :distanceUKC, :distanceCCCU, :distanceUKM, :noOfRooms, :availableFrom, :info, 0, :timestamp)");
        $sth->bindParam(':location', $post['location']);
        $sth->bindParam(':addressNumber', $post['address-number']);
        $sth->bindParam(':address', $post['address']);
        $sth->bindParam(':distanceUKC', $distanceUKC);
        $sth->bindParam(':distanceCCCU', $distanceCCCU);
        $sth->bindParam(':distanceUKM', $distanceUKM);
        $sth->bindParam(':noOfRooms', $noOfRooms);
        $sth->bindParam(':availableFrom', $availableFrom);
        $sth->bindParam(':info', $info);
        $sth->bindParam(':timestamp', $timestamp);
        $result = $sth->execute();

        if(!$result) { return false; }

        $propertyId = $dbh->lastInsertId();

        // Insert rooms
        mkdir("img/properties/$propertyId", 0777, true);

        $values = '';

        for($i = 1; $i <= $noOfRooms; $i++) {
            $availability = (isset($_POST["availability-$i"]) ? 1 : 0);
            $values .= "({$propertyId},{$i},'{$post["room-type-$i"]}',{$post["price-$i"]},{$availability}),";
        }

        $values = rtrim($values, ',');

        $sth = $dbh->prepare("INSERT INTO rooms (propertyId, roomNo, roomType, price, availability) VALUES $values");
        $result = $sth->execute();

        // Verify, compress and write other images
        // http://php.net/manual/en/features.file-upload.multiple.php#53240
        function reArrayFiles(&$file_post) {
            $file_ary = array();
            $file_count = count($file_post['name']);
            $file_keys = array_keys($file_post);

            for ($i=0; $i<$file_count; $i++) {
                foreach ($file_keys as $key) {
                    $file_ary[$i][$key] = $file_post[$key][$i];
                }
            }

            return $file_ary;
        }

        function resizeImage($img) {
            $oldWidth = imagesx($img);
            $oldHeight = imagesy($img);

            $goalWidth = 1200;
            $goalHeight = 675;

            $oldAspect  = $oldWidth / $oldHeight;
            $goalAspect = $goalWidth / $goalHeight;

            if($oldAspect >= $goalAspect) {
                $newHeight = $goalWidth;
                $newWidth  = $oldWidth / ($oldHeight / $goalHeight);
            } else {
                $newWidth  = $goalWidth;
                $newHeight = $oldHeight / ($oldWidth / $goalWidth);
            }

            $newImg = imagecreatetruecolor($goalWidth, $goalHeight);

            imagecopyresampled($newImg, $img, 0 - ($newWidth - $goalWidth) / 2, 0 - ($newHeight - $goalHeight) / 2, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight);

            return $newImg;
        }

        $i = 1;

        foreach(reArrayFiles($_FILES['other-images']) as $image) {
            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
            $jpg = ((strtolower($ext) === 'jpg' || strtolower($ext) === 'jpeg') && $image['type'] === 'image/jpeg');
            $png = (strtolower($ext) === 'png' && $image['type'] === 'image/png');

            if($jpg || $png) {
                if($jpg) {
                    $img = imagecreatefromjpeg($image['tmp_name']);
                } elseif($png) {
                    $img = imagecreatefrompng($image['tmp_name']);
                }

                $resizedImage = resizeImage($img);

                $filename = pathinfo($image['name'], PATHINFO_FILENAME);

                imagejpeg($resizedImage, "img/properties/$propertyId/$filename.jpg", 50);
                imagedestroy($img);
                imagedestroy($resizedImage);
            }

            $i++;
        }

        unset($_FILES['other-images']);

        // Verify, compress and write room images
        $i = 1;

        foreach($_FILES as $image) {
            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
            $jpg = ((strtolower($ext) === 'jpg' || strtolower($ext) === 'jpeg') && $image['type'] === 'image/jpeg');
            $png = (strtolower($ext) === 'png' && $image['type'] === 'image/png');

            if($jpg || $png) {
                if($jpg) {
                    $img = imagecreatefromjpeg($image['tmp_name']);
                } elseif($png) {
                    $img = imagecreatefrompng($image['tmp_name']);
                }

                $resizedImage = resizeImage($img);

                imagejpeg($resizedImage, "img/properties/$propertyId/Room $i.jpg", 50);
                imagedestroy($img);
                imagedestroy($resizedImage);
            } else {
                copy('img/image-unavailable.jpg', "img/properties/$propertyId/Room $i.jpg");
            }

            $i++;
        }

        return $propertyId;
    }

    static function getProperties() {
        require('db.php');

        $sth = $dbh->query("SELECT propertyId, addressNumber, address FROM properties WHERE landlordId=".$_SESSION['s_landlordId']." ORDER BY propertyId DESC");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $properties = $sth->fetchAll();

        $sth = $dbh->query("SELECT roomId, propertyId, roomNo, availability FROM rooms");
        $sth->setFetchMode(PDO::FETCH_OBJ);
        $rooms = $sth->fetchAll();

        foreach($properties as $property) {
            $roomArray = array();

            foreach($rooms as $room) {
                if($room->propertyId === $property->propertyId) {
                    array_push($roomArray, $room);
                }
            }

            $property->rooms = $roomArray;
        }

        return $properties;
    }
}