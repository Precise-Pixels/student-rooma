<?php if($_SERVER['SERVER_NAME'] == 'sr.dev'):
// SANDBOX ?>

    <script src="/js/dialog.js"></script>
    <script src="/js/fastclick.js"></script>
    <script>
        window.addEventListener('load', function() {
            FastClick.attach(document.body);
        }, false);
    </script>

    <?php if($isAppIndex): ?>
        <script src="/js/page-index.js"></script>
    <?php endif; ?>

    <?php if($isProfile): ?>
        <script src="/js/page-profile.js"></script>
    <?php endif; ?>

    <?php if($isProperties): ?>
        <script src="/js/decision.js"></script>
        <script src="/js/image-slider.js"></script>
        <script src="/js/image-loader.js"></script>
    <?php endif; ?>

    <?php if($isActivity): ?>
        <script src="/js/decision.js"></script>
        <script src="/js/page-activity.js"></script>
    <?php endif; ?>

    <?php if($isProperty): ?>
        <script src="/js/image-slider.js"></script>
        <script src="/js/image-loader.js"></script>
    <?php endif; ?>

    <?php if($isGallery): ?>
        <script src="/js/decision.js"></script>
    <?php endif; ?>

    <?php if($isInstall): ?>
        <script src="/js/bowser.min.js"></script>
        <script src="/js/page-install.js"></script>
    <?php endif; ?>

    <?php if($isLogout): ?>
        <script src="/js/page-logout.js"></script>
    <?php endif; ?>

    <?php if($isLandlordIndex): ?>
        <script src="/js/page-landlord-index.js"></script>
    <?php endif; ?>

    <?php if($isAdminNewProperty): ?>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
        <script src="/js/page-admin-new-property.js"></script>
    <?php endif; ?>

    <?php if($isAdminUpdateRoomAvailability): ?>
        <script src="/js/page-admin-update-room-availability.js"></script>
    <?php endif; ?>

    <?php if($isAdminDeleteProperty): ?>
        <script src="/js/page-admin-delete-property.js"></script>
    <?php endif; ?>

<?php else:
// LIVE ?>

    <script src="/build/dialog.min.js"></script>
    <script src="/build/fastclick.min.js"></script>
    <script>window.addEventListener('load',function(){FastClick.attach(document.body)},false);</script>

    <?php if($isAppIndex): ?>
        <script src="/build/page-index.min.js"></script>
    <?php endif; ?>

    <?php if($isProfile): ?>
        <script src="/build/page-profile.min.js"></script>
    <?php endif; ?>

    <?php if($isProperties): ?>
        <script src="/build/decision.min.js"></script>
        <script src="/build/image-slider.min.js"></script>
        <script src="/build/image-loader.min.js"></script>
    <?php endif; ?>

    <?php if($isActivity): ?>
        <script src="/build/decision.min.js"></script>
        <script src="/build/page-activity.min.js"></script>
    <?php endif; ?>

    <?php if($isProperty): ?>
        <script src="/build/image-slider.min.js"></script>
        <script src="/build/image-loader.min.js"></script>
    <?php endif; ?>

    <?php if($isGallery): ?>
        <script src="/build/decision.min.js"></script>
    <?php endif; ?>

    <?php if($isInstall): ?>
        <script src="/build/bowser.min.js"></script>
        <script src="/build/page-install.min.js"></script>
    <?php endif; ?>

    <?php if($isLogout): ?>
        <script src="/build/page-logout.min.js"></script>
    <?php endif; ?>

    <?php if($isLandlordIndex): ?>
        <script src="/build/page-landlord-index.min.js"></script>
    <?php endif; ?>

    <?php if($isAdminNewProperty): ?>
        <script src="/build/page-admin-new-property.min.js"></script>
    <?php endif; ?>

    <?php if($isAdminUpdateRoomAvailability): ?>
        <script src="/build/page-admin-update-room-availability.min.js"></script>
    <?php endif; ?>

    <?php if($isAdminDeleteProperty): ?>
        <script src="/build/page-admin-delete-property.min.js"></script>
    <?php endif; ?>

    <script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create','UA-26844628-3','auto');ga('send','pageview');</script>

<?php endif; ?>