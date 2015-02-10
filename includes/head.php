<meta charset="utf-8">
<meta name="description" content="Student Rooma - Find your perfect room in Canterbury &amp; Medway"/>
<meta name="author" content="Precise Pixels"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
<title>Student Rooma</title>

<?php if($isApp || $isLandlord || $isAdmin): ?>
    <?php if($_SERVER['SERVER_NAME'] == 'sr.dev'): ?>
        <link rel="stylesheet" type="text/css" href="/css/styles.css"/>
    <?php else: ?>
        <link rel="stylesheet" type="text/css" href="/build/styles.min.css"/>
    <?php endif; ?>
<?php endif; ?>
<?php if($isLanding): ?>
    <?php if($_SERVER['SERVER_NAME'] == 'sr.dev'): ?>
        <link rel="stylesheet" type="text/css" href="/css/styles-landing.css"/>
    <?php else: ?>
        <link rel="stylesheet" type="text/css" href="/build/styles-landing.min.css"/>
    <?php endif; ?>
<?php endif; ?>

<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans:400,600,700">
<link rel="shortcut icon" href="/img/favicon.ico"/>
<link rel="apple-touch-icon-precomposed" href="/img/touchicon-57.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/img/touchicon-72.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/img/touchicon-114.png">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/img/touchicon-144.png">

<meta property="og:title" content="Student Rooma"/>
<meta property="og:type" content="website"/>
<meta property="og:url" content="http://studentrooma.co.uk"/>
<meta property="og:image" content="http://studentrooma.co.uk/img/meta-logo.png"/>
<meta property="og:site_name" content="Student Rooma"/>
<meta property="og:description" content="Student Rooma - Find your perfect room in Canterbury &amp; Medway"/>

<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script src="/build/respond.min.js"></script>
<![endif]-->