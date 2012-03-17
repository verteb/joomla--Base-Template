
<?php
defined('_JEXEC') or die;
$templateDir = $_SERVER['DOCUMENT_ROOT'] . '/templates/' . $this->template;
require_once $templateDir . '/config.php';
require_once $templateDir . '/functions.php';
$db = & JFactory::getDBO();
$aliases = getAliases($db);
$catName = getCatAlias($aliases);
$sectionName = getSectionAlias($aliases);
$alias = getAlias(&JFactory::getURI()->getPath());
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7 oldie" lang="fr"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8 oldie" lang="fr"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9 oldie" lang="fr"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="fr"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<?php if (isDevAccount()) : ?>
    <meta name="robots" content="noindex, nofollow">
    <?php endif; ?>	
    <!-- Title and meta tags -->
    <title><?= isHome() ? COMPANY_NAME : $this->title . ' - '.COMPANY_NAME ?></title>
	<meta name="description" content="<?= $this->description ?>">
	<meta name="author" content="<?= COMPANY_NAME ?>">
	<?= COMPANY_GEOTAGS ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<!-- CSS -->
	<link rel="stylesheet" href="<?= $templateDir ?>/css/style.css?v=0">
	<!-- JS -->
	<script src="<?= $templateDir ?>/js/libs/modernizr.min.js"></script>
	<script scr="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="/js/libs/jquery.min.js"><\/script>')</script>
	<script src="<?= $templateDir ?>/js/libs/selectivizr-min.js"></script>
</head>
<body id="body" class="<?= $alias . ' cat-' . $catName . ' sec-' . $sectionName ?>">
	<header>

	</header>
	<div role="main">

	</div>
	<footer>

	</footer>
	<!-- scripts concatenated and minified via ant build script-->
	<script src="js/script.js"></script>
	<!-- end scripts-->

	<script>
	/*var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g,s)}(document,'script'));*/
</script>
</body>
</html>