<main>
    <div class="padding">
        <h1>Profile</h1>

        <img src="https://graph.facebook.com/<?= $user->fbId; ?>/picture?type=square" alt="<?= $user->name; ?>"/>
        <p><?= $user->name; ?></p>

        <label for="looking-in">Looking in</label>
        <input type="radio" id="canterbury" name="looking-in" value="Canterbury"<?= ($user->lookingIn === 'Canterbury' ? ' checked' : '') ?>/> <label for="canterbury">Canterbury</label>
        <input type="radio" id="medway" name="looking-in" value="Medway"<?= ($user->lookingIn === 'Medway' ? ' checked' : '') ?>/> <label for="medway">Medway</label>

        <br>

        <label for="rooms">No of rooms</label>
        <button id="rooms-decrement">-</button>
        <input type="text" id="rooms" name="rooms" value="<?= $user->rooms; ?>" disabled/>
        <button id="rooms-increment">+</button>

        <br>

        <label for="available-from">Available from</label>
        <input type="date" id="available-from" name="available-from" value="<?= $user->availableFrom; ?>"/>

        <br>

        <label for="min-price">Min price</label>
        <input type="number" id="min-price" name="min-price" value="<?= $user->minPrice; ?>"/>

        <br>

        <label for="max-price">Max price</label>
        <input type="number" id="max-price" name="max-price" value="<?= $user->maxPrice; ?>"/>

        <br>


        <label for="phone">Phone number</label>
        <input type="tel" id="phone" name="phone" value="<?= $user->phone; ?>"/>

        <br>

        <button id="reset">Reset No's</button>
        <a href="logout"><button>LOGOUT</button></a>

        <p><a href="/about">About this app</a></p>
    </div>
</main>