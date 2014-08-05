<main>
    <h1>Admin New Property</h1>

    <?php
    if(!empty($_POST['submit'])) {
        require('php/Admin.php');
        $success = Admin::postProperty($_POST);

        if($success):
    ?>
        <p>The new property has been successfully added.</p>
    <?php else: ?>
        <p>Something went wrong.</p>
    <?php
        endif;
    }
    ?>

    <form action="" method="post" enctype="multipart/form-data" novalidate>
        <label for="location">Location</label>
        <input type="radio" id="canterbury" name="location" value="Canterbury" required/> <label for="canterbury">Canterbury</label>
        <input type="radio" id="medway" name="location" value="Medway"/> <label for="medway">Medway</label>

        <br>

        <label for="address">Address</label>
        <input type="text" name="address" required/>
        <span class="hint">The address is used to generate the Google Maps. For best results, use the following format: [House number optional] Road, Town/City, County (e.g. 100 Downs Road, Canterbury, Kent)</span>

        <br>

        <label for="distance-UKC">Walking distance from UKC (mins)</label>
        <input type="number" name="distance-UKC" min="0" required/>
        <span class="hint">Enter 0 for N/A.</span>

        <br>

        <label for="distance-CCCU">Walking distance from CCCU (mins)</label>
        <input type="number" name="distance-CCCU" min="0" required/>
        <span class="hint">Enter 0 for N/A.</span>

        <br>

        <label for="distance-UKM">Walking distance from UKM (mins)</label>
        <input type="number" name="distance-UKM" min="0" required/>
        <span class="hint">Enter 0 for N/A.</span>

        <br>

        <label for="available-from">Available from</label>
        <input type="date" name="available-from" required/>
        <span class="hint">dd/mm/yyyy</span>

        <br>

        <label for="info">House info</label>
        <textarea name="info" required></textarea>
        <span class="hint">General information about the house such as number of bathrooms, garden, pets allowed, etc. Return carriages will be preserved.</span>

        <br>

        <label for="rooms">Number of bedrooms</label>
        <button type="button" id="rooms-decrement" disabled>-</button>
        <input type="number" id="rooms" name="rooms" readonly />
        <button type="button" id="rooms-increment">+</button>

        <br>

        <div id="room-fields"></div>

        <br>

        <label for="other-images">Other images</label>
        <input type="file" name="other-images[]" multiple required/>
        <span class="hint">The file name will be used as the image's caption in the gallery. Ctrl+click / Cmd+click to select multiple images.Valid file types: .jpg .jpeg .png</span>

        <br>

        <input type="submit" name="submit" value="Submit"/>
    </form>
</main>