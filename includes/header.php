<header>
    <img src="/img/logo.png" alt="Student Rooma"/>

    <?php if($isProfile): ?>
        <div id="header-btn-l">Cross</div>
        <div id="header-btn-r">Tick</div>
    <?php endif; ?>

    <?php if($isListing): ?>
        <div id="header-btn-l"><a href="shortlist">Shortlist</a></div>
        <div id="header-btn-r"><a href="profile">Profile</a></div>
    <?php endif; ?>
</header>