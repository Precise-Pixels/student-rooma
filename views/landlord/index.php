<main>
    <div class="padding">
        <h1 class="h1--show">Landlord Tools</h1>

        <?php if(!isset($_SESSION['s_landlord'])): ?>
            <form action="" method="post">
                <div class="form-row">
                    <label for="login-password">Password</label>
                    <input type="password" name="login-password" autofocus required/>
                </div>

                <div class="form-row">
                    <input type="submit" name="login-submit" value="Login"/>
                </div>
            </form>
        <?php endif; ?>

        <?php if(isset($_SESSION['s_landlord'])): ?>
            <p>Logged in as landlord.</p>

            <p><a href="/landlord/activity" class="paragraph-a">View user activity</a> - View the activity of users interacting with your properties</p>
            <p><a href="/landlord/all-properties" class="paragraph-a">View all my properties</a> - View all the properties and rooms in the application</p>
            <p><a href="/landlord/new-property" class="paragraph-a">Add a new property</a> - Use this form to add new properties to the application</p>
            <p><a href="/landlord/update-room-availability" class="paragraph-a">Update a room's availability</a> - If a room has become occupied, it's availability can be changed here</p>
            <p><a href="/landlord/remove-property" class="paragraph-a">Remove a property</a> - Remove a property from the app's listings</p>
        <?php endif; ?>
    </div>
</main>