<main>
    <h1>Profile</h1>

    <div id="profile-user">
        <img src="https://graph.facebook.com/<?= $user->fbId; ?>/picture?type=square&width=40&height=40" alt="<?= $user->name; ?>"/>
        <?= $user->name; ?>
    </div>

    <div id="profile-filters" class="padding">

        <div id="profile-looking-in" class="form-row">
            <p>Your search filters</p>
            <label for="looking-in" id="profile-looking-in-label">Looking in</label>
            <input type="radio" id="medway" name="looking-in" value="Medway"<?= ($user->lookingIn === 'Medway' ? ' checked' : '') ?>/> <label for="medway" class="radio-style">Medway</label>
            <input type="radio" id="canterbury" name="looking-in" value="Canterbury"<?= ($user->lookingIn === 'Canterbury' ? ' checked' : '') ?>/> <label for="canterbury" class="radio-style">Canterbury</label>
        </div>

        <hr>

        <div class="form-row">
            <label for="rooms">Number of bedrooms</label>
            <div class="stepper">
                <button id="rooms-decrement"<?= ($user->rooms === 'ANY' ? ' disabled' : ''); ?>>-</button>
                <input type="text" id="rooms" name="rooms" value="<?= $user->rooms; ?>" readonly tabindex="-1"/>
                <button id="rooms-increment">+</button>
            </div>
        </div>

        <div class="form-row form-row--half">
            <label for="min-price">Min price</label>
            <input type="number" step="10" id="min-price" name="min-price" value="<?= $user->minPrice; ?>"/>
        </div>

        <div class="form-row form-row--half">
            <label for="max-price">Max price</label>
            <input type="number" step="10" id="max-price" name="max-price" value="<?= $user->maxPrice; ?>"/>
        </div>

        <div class="form-row">
            <div id="double-range-input" data-min="<?= $min; ?>" data-max="<?= $max; ?>">
                <div id="double-range-input-handle-l" class="double-range-input-handle"></div>
                <div id="double-range-input-handle-r" class="double-range-input-handle"></div>
            </div>
        </div>
    </div>

    <div id="profile-other">
        <div class="form-row">
            <label for="phone">Phone number</label>
            <input type="tel" id="phone" name="phone" value="<?= $user->phone; ?>" placeholder="Enter your phone number"/>
        </div>

        <button id="reset" class="button-profile--left"><i class="ico-refresh"></i>Reset No's</button>
        <a href="/app/logout"><button class="button-profile--right" tabindex="-1">Logout</button></a>

        <p id="install-this-app"><a href="/app/install">Install this app on your device</a></p>
        <p id="about-this-app"><a href="/app/about">About this app</a></p>
    </div>
</main>