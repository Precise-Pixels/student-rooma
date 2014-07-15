<h1>Profile</h1>

<img src="https://graph.facebook.com/<?= $user->fbId; ?>/picture?type=square" alt="<?= $user->name; ?>"/>
<p><?= $user->name; ?></p>

<label for="looking-in">Looking in</label>
<input type="radio" name="looking-in" value="Canterbury"<?= ($user->lookingIn === 'Canterbury' ? ' checked' : '') ?>/> Canterbury
<input type="radio" name="looking-in" value="Medway"<?= ($user->lookingIn === 'Medway' ? ' checked' : '') ?>/> Medway

<br>

<label for="room-type">Room type</label>
<select id="room-type" name="room-type">
    <option value="any"<?= ($user->roomType === 'any' ? ' selected' : '') ?>>Any</option>
    <option value="single"<?= ($user->roomType === 'single' ? ' selected' : '') ?>>Single</option>
    <option value="double"<?= ($user->roomType === 'double' ? ' selected' : '') ?>>Double</option>
    <option value="ensuite"<?= ($user->roomType === 'ensuite' ? ' selected' : '') ?>>En suite</option>
</select>

<br>

<label for="available-from">Available from</label>
<input type="date" id="available-from" name="available-from" value="<?= $user->availableFrom; ?>"/>

<br>

<label for="min-price">Min price</label>
<input type="text" id="min-price" name="min-price" value="<?= $user->minPrice; ?>"/>

<br>

<label for="max-price">Max price</label>
<input type="text" id="max-price" name="max-price" value="<?= $user->maxPrice; ?>"/>

<br>

<label for="phone">Phone number</label>
<input type="tel" id="phone" name="phone" value="<?= $user->phone; ?>"/>

<br>

<a href="logout">LOGOUT</a>