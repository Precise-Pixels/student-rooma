<?php if($_SERVER['SERVER_NAME'] == 'sr.dev'):
// SANDBOX ?>

    <script src="/js/dialog.js"></script>

    <?php if($isAdminNewProperty): ?>
        <script src="/js/page-admin-new-property.js"></script>
    <?php endif; ?>

    <?php if($isAdminUpdateRoomAvailability): ?>
        <script src="/js/page-admin-update-room-availability.js"></script>
    <?php endif; ?>

<?php else:
// LIVE ?>

    <script src="/build/dialog.min.js"></script>

    <?php if($isAdminNewProperty): ?>
        <script src="/build/page-admin-new-property.min.js"></script>
    <?php endif; ?>

    <?php if($isAdminUpdateRoomAvailability): ?>
        <script src="/build/page-admin-update-room-availability.min.js"></script>
    <?php endif; ?>

<?php endif; ?>