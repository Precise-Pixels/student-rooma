<?php if($isIndex): ?>

    <header>
        <img src="/img/logo.png" alt="Student Rooma" id="logo"/>
        <p id="slogan">Find your perfect room in Canterbury &amp; Medway</p>
    </header>

<?php else: ?>

    <header>
        <?php if($isAdmin || $isAdminActivity || $isAdminAllProperties || $isAdminNewProperty || $isAdminUpdateRoomAvailability): ?>
            <a href="/">
                <img src="/img/logo.png" alt="Student Rooma" id="logo"/>
            </a>
        <?php else: ?>
            <img src="/img/logo.png" alt="Student Rooma" id="logo"/>
        <?php endif; ?>

        <?php if($isAdminActivity || $isAdminAllProperties || $isAdminNewProperty || $isAdminUpdateRoomAvailability): ?>
            <a href="/admin"><div id="header-btn-l"><i class="ico-arrow-back ico--centre"><span>Back</span></i></div></a>
        <?php endif; ?>
    </header>

<?php endif; ?>