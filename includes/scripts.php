<?php if($_SERVER['SERVER_NAME'] == 'sr.dev'):
// SANDBOX ?>

    <script src="/js/dialog.js"></script>

    <?php if($isIndex): ?>
        <script src="/js/page-index.js"></script>
    <?php endif; ?>

    <?php if($isProfile): ?>
        <script src="/js/page-profile.js"></script>
    <?php endif; ?>

    <?php if($isProperties): ?>
        <script src="/js/decision.js"></script>
    <?php endif; ?>

    <?php if($isActivity): ?>
        <script src="/js/decision.js"></script>
    <?php endif; ?>

    <?php if($isGallery): ?>
        <script src="/js/decision.js"></script>
    <?php endif; ?>

    <?php if($isLogout): ?>
        <script src="/js/page-logout.js"></script>
    <?php endif; ?>

    <?php if($isAdminUpdateRoomStatus): ?>
        <script src="/js/page-admin-update-room-status.js"></script>
    <?php endif; ?>

<?php else:
// LIVE ?>

    <script src="/build/dialog.min.js"></script>

    <?php if($isIndex): ?>
        <script src="/build/page-index.min.js"></script>
    <?php endif; ?>

    <?php if($isProfile): ?>
        <script src="/build/page-profile.min.js"></script>
    <?php endif; ?>

    <?php if($isProperties): ?>
        <script src="/build/decision.min.js"></script>
    <?php endif; ?>

    <?php if($isActivity): ?>
        <script src="/build/decision.min.js"></script>
    <?php endif; ?>

    <?php if($isGallery): ?>
        <script src="/build/decision.min.js"></script>
    <?php endif; ?>

    <?php if($isLogout): ?>
        <script src="/build/page-logout.min.js"></script>
    <?php endif; ?>

    <?php if($isAdminUpdateRoomStatus): ?>
        <script src="/build/page-admin-update-room-status.min.js"></script>
    <?php endif; ?>

<?php endif; ?>