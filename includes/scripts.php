<?php if($_SERVER['SERVER_NAME'] == 'sr.dev'):
// SANDBOX ?>

    <script src="/js/all.js"></script>

    <?php if($isIndex): ?>
        <script src="/js/page-index.js"></script>
    <?php endif; ?>

    <?php if($isLogout): ?>
        <script src="/js/page-logout.js"></script>
    <?php endif; ?>

<?php else:
// LIVE ?>

    <script src="/build/all.min.js"></script>

    <?php if($isIndex): ?>
        <script src="/build/page-index.min.js"></script>
    <?php endif; ?>

    <?php if($isLogout): ?>
        <script src="/build/page-logout.min.js"></script>
    <?php endif; ?>

<?php endif; ?>