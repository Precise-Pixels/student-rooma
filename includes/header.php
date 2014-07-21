<header>
    <img src="/img/logo.png" alt="Student Rooma"/>

    <?php if($isProfile): ?>
        <div id="header-btn-l">Cross</div>
        <div id="header-btn-r">Tick</div>
    <?php endif; ?>

    <?php if($isProperties): ?>
        <div id="header-btn-l"><a href="/activity">Activity</a></div>
        <div id="header-btn-r"><a href="/profile">Profile</a></div>
    <?php endif; ?>

    <?php if($isActivity): ?>
        <div id="header-btn-l"><a href="/properties">Back to Properties</a></div>
        <div id="header-btn-r"><a href="/profile">Profile</a></div>
    <?php endif; ?>

    <?php if($isProperty): ?>
        <div id="header-btn-l"><a href="/activity">Back to Activity</a></div>
        <div id="header-btn-r"><a href="/profile">Profile</a></div>
    <?php endif; ?>
</header>