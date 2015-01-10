<?php if($isAppIndex): ?>

    <header>
        <img src="/img/logo.png" alt="Student Rooma" id="logo"/>
        <p id="slogan">Find your perfect room in Canterbury &amp; Medway</p>
    </header>

<?php else: ?>

    <header>
        <a href="/app/">
            <img src="/img/logo.png" alt="Student Rooma" id="logo"/>
        </a>

        <?php if($isProfile): ?>
            <?php if(!isset($_SESSION['s_firstTime']) || !$_SESSION['s_firstTime']): ?>
                <div id="header-btn-l" tabindex="1"><i class="ico-cross ico--centre"><span>Cancel</span></i></div>
            <?php endif; ?>
            <div id="header-btn-r" tabindex="2"><i class="ico-tick ico--centre"><span>Save</span></i></div>
        <?php endif; ?>

        <?php if($isProperties): ?>
            <a href="/app/activity#starred" id="header-btn-l"><i class="ico-activity ico--centre"><span>Activity</span></i></a>
            <a href="/app/profile" id="header-btn-r"><i class="ico-profile ico--centre"><span>Profile</span></i></a>
        <?php endif; ?>

        <?php if($isActivity): ?>
            <a href="/app/properties" id="header-btn-l"><i class="ico-arrow-back ico--centre"><span>Back to Properties</span></i></a>
            <a href="/app/profile" id="header-btn-r"><i class="ico-profile ico--centre"><span>Profile</span></i></a>
        <?php endif; ?>

        <?php if($isProperty): ?>
            <a href="/app/activity#starred" id="header-btn-l"><i class="ico-arrow-back ico--centre"><span>Back to Activity</span></i></a>
            <a href="/app/profile" id="header-btn-r"><i class="ico-profile ico--centre"><span>Profile</span></i></a>
        <?php endif; ?>

        <?php if($isGallery): ?>
            <a href="<?= (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/app/properties'); ?>" id="header-btn-l"><i class="ico-arrow-back ico--centre"><span>Back</span></i></a>
            <a href="/app/profile" id="header-btn-r"><i class="ico-profile ico--centre"><span>Profile</span></i></a>
        <?php endif; ?>

        <?php if($isInstall || $isAbout): ?>
            <a href="/app/profile" id="header-btn-l"><i class="ico-arrow-back ico--centre"><span>Back</span></i></a>
        <?php endif; ?>

        <?php if($isTerms || $isPrivacy): ?>
            <a href="/app/" id="header-btn-l"><i class="ico-arrow-back ico--centre"><span>Back</span></i></a>
        <?php endif; ?>

        <?php if($isAdminActivity || $isAdminAllProperties || $isAdminNewProperty || $isAdminUpdateRoomAvailability || $isAdminDeleteProperty): ?>
            <a href="/app/admin" id="header-btn-l"><i class="ico-arrow-back ico--centre"><span>Back</span></i></a>
        <?php endif; ?>
    </header>

<?php endif; ?>