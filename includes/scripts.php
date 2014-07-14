<?php if($_SERVER['SERVER_NAME'] == 'sr.dev'):
// SANDBOX ?>

    <script src="/js/all.js"></script>

<?php else:
// LIVE ?>

    <script src="/build/all.min.js"></script>

<?php endif; ?>