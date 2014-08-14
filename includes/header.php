<?php if($isIndex): ?>

    <header>
        <img src="/img/logo.png" alt="Student Rooma" id="logo"/>
        <p id="slogan">Find your perfect room in Canterbury &amp; Medway</p>
    </header>

<?php else: ?>

    <header>
        <?php if($isAdmin || $isAdminActivity || $isAdminNewProperty || $isAdminUpdateRoomAvailability): ?>
            <a href="/">
                <img src="/img/logo.png" alt="Student Rooma" id="logo"/>
            </a>
        <?php else: ?>
            <img src="/img/logo.png" alt="Student Rooma" id="logo"/>
        <?php endif; ?>

        <?php if($isProfile): ?>
            <div id="header-btn-l"><i class="ico-cross ico--centre"><span>Cancel</span></i></div>
            <div id="header-btn-r"><i class="ico-tick ico--centre"><span>Save</span></i></div>
        <?php endif; ?>

        <?php if($isProperties): ?>
            <a href="/activity#starred"><div id="header-btn-l"><i class="ico-activity ico--centre"><span>Activity</span></i></div></a>
            <a href="/profile"><div id="header-btn-r"><i class="ico-profile ico--centre"><span>Profile</span></i></div></a>
        <?php endif; ?>

        <?php if($isActivity): ?>
            <a href="/properties"><div id="header-btn-l"><i class="ico-arrow-back ico--centre"><span>Back to Properties</span></i></div></a>
            <a href="/profile"><div id="header-btn-r"><i class="ico-profile ico--centre"><span>Profile</span></i></div></a>
        <?php endif; ?>

        <?php if($isProperty): ?>
            <a href="/activity#starred"><div id="header-btn-l"><i class="ico-arrow-back ico--centre"><span>Back to Activity</span></i></div></a>
            <a href="/profile"><div id="header-btn-r"><i class="ico-profile ico--centre"><span>Profile</span></i></div></a>
        <?php endif; ?>

        <?php if($isGallery): ?>
            <a href="<?= $_SERVER['HTTP_REFERER']; ?>"><div id="header-btn-l"><i class="ico-arrow-back ico--centre"><span>Back</span></i></div></a>
            <a href="/profile"><div id="header-btn-r"><i class="ico-profile ico--centre"><span>Profile</span></i></div></a>
        <?php endif; ?>

        <?php if($isAbout): ?>
            <a href="/profile"><div id="header-btn-l"><i class="ico-arrow-back ico--centre"><span>Back</span></i></div></a>
        <?php endif; ?>

        <?php if($isTerms || $isPrivacy): ?>
            <a href="/"><div id="header-btn-l"><i class="ico-arrow-back ico--centre"><span>Back</span></i></div></a>
        <?php endif; ?>

        <?php if($isAdminActivity || $isAdminNewProperty || $isAdminUpdateRoomAvailability): ?>
            <a href="/admin"><div id="header-btn-l"><i class="ico-arrow-back ico--centre"><span>Back</span></i></div></a>
        <?php endif; ?>
    </header>

<?php endif; ?>