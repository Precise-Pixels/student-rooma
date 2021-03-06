<main>
    <div class="padding">
        <h1 class="h1--show">Add A New Property</h1>

        <?php
        if(!empty($_POST['submit'])) {
            $propertyId = Landlord::postProperty($_POST);

            if($propertyId):
                header("location: /landlord/payment?propertyId=$propertyId");
            else:
        ?>
            <p class="error">Something went wrong.</p>
        <?php
            endif;
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data" name="form">
            <div class="form-row">
                <label for="location">Location</label>
                <input type="radio" id="medway" name="location" value="Medway"/> <label for="medway" class="radio-style">Medway</label>
                <input type="radio" id="canterbury" name="location" value="Canterbury" required/> <label for="canterbury" class="radio-style">Canterbury</label>
            </div>

            <div class="form-row">
                <label for="address-number">House/Flat number</label>
                <input type="text" id="address-number" name="address-number" required/>
            </div>

            <div class="form-row">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required/>
                <span class="hint">The address is used to generate the Google Maps and walking distances. For best results, use the following format: Road, Town/City, County (e.g. Downs Road, Canterbury, Kent)</span>
            </div>

            <div id="distances-canterbury" class="form-row">
                <label for="distance-UKC">Walking distance from UKC (mins)</label>
                <input type="number" id="distance-UKC" name="distance-UKC" value="0" min="0" required/>

                <label for="distance-CCCU">Walking distance from CCCU (mins)</label>
                <input type="number" id="distance-CCCU" name="distance-CCCU" value="0" min="0" required/>
            </div>

            <div id="distances-medway" class="form-row">
                <label for="distance-UKM">Walking distance from UKM (mins)</label>
                <input type="number" id="distance-UKM" name="distance-UKM" value="0" min="0" required/>
            </div>

            <div class="form-row">
                <label for="available-from">Available from</label>
                <input type="date" name="available-from" required/>
                <span class="hint hint--date">yyyy-mm-dd</span>
            </div>

            <div class="form-row">
                <label for="info">General information</label>
                <textarea name="info" required></textarea>
                <span class="hint">General information about the house such as number of bathrooms, garden, pets allowed, etc. Return carriages will be preserved.</span>
            </div>

            <div class="form-row">
                <label for="rooms">Number of bedrooms</label>
                <div class="stepper">
                    <button type="button" id="rooms-decrement" disabled>-</button>
                    <input type="number" id="rooms" name="rooms" readonly tabindex="-1"/>
                    <button type="button" id="rooms-increment">+</button>
                </div>
            </div>

            <div class="form-row">
                <div id="room-fields"></div>
            </div>

            <div class="form-row">
                <label for="other-images">General house images (e.g. kitchen, bathroom)</label>
                <input type="file" name="other-images[]" multiple/>
                <span class="hint">The file name will be used as the image's caption in the gallery. Ctrl+click / Cmd+click to select multiple images. Valid file types: .jpg .jpeg .png</span>
            </div>

            <div class="form-row">
            <label>Payment will be arranged on the next page.</label>
                <input type="submit" id="submit" name="submit" value="Submit"/>
            </div>
        </form>
    </div>
</main>