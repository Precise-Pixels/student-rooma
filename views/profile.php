<main>
    <h1>Profile</h1>

    <div class="profile-user">
        <img src="https://graph.facebook.com/<?= $user->fbId; ?>/picture?type=square&width=40&height=40" alt="<?= $user->name; ?>"/>
        <?= $user->name; ?>
    </div>

    <div class="profile-filters padding">

        <div class="profile-looking-in form-row">
            <p>Your search filters</p>
            <label for="looking-in">Looking in</label>
            <input type="radio" id="canterbury" name="looking-in" value="Canterbury"<?= ($user->lookingIn === 'Canterbury' ? ' checked' : '') ?>/> <label for="canterbury" class="radio-style">Canterbury</label>
            <input type="radio" id="medway" name="looking-in" value="Medway"<?= ($user->lookingIn === 'Medway' ? ' checked' : '') ?>/> <label for="medway" class="radio-style">Medway</label>
        </div>

        <hr>

        <div class="form-row">
            <label for="rooms">No of rooms</label>
            <div class="stepper">
                <button id="rooms-decrement"<?= ($user->rooms === 'ANY' ? ' disabled' : ''); ?>>-</button>
                <input type="text" id="rooms" name="rooms" value="<?= $user->rooms; ?>" readonly/>
                <button id="rooms-increment">+</button>
            </div>
        </div>

        <div class="form-row">
            <label for="available-from">Available from</label>
            <input type="date" id="available-from" name="available-from" value="<?= $user->availableFrom; ?>"/>
        </div>

        <div class="form-row">
            <label for="min-price">Min price</label>
            <input type="number" id="min-price" name="min-price" value="<?= $user->minPrice; ?>"/>
        </div>

        <div class="form-row">
            <label for="max-price">Max price</label>
            <input type="number" id="max-price" name="max-price" value="<?= $user->maxPrice; ?>"/>
        </div>
    </div>

    <div class="profile-other">
        <div class="form-row">
            <label for="phone">Phone number</label>
            <input type="tel" id="phone" name="phone" value="<?= $user->phone; ?>"/>
        </div>

        <button id="reset" class="button-profile--left"><i class="ico-refresh"></i>Reset No's</button>
        <a href="logout"><button class="button-profile--right">LOGOUT</button></a>

        <p id="about-this-app"><a href="/about">About this app</a></p>
    </div>
</main>