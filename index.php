<?php

require 'vendor/autoload.php';
require 'db.php';
require 'functions.php';

$session_factory = new \Aura\Session\SessionFactory;
$session = $session_factory->newInstance($_COOKIE);
$session->start();

$smarty = new Smarty();

$smarty->setTemplateDir('templates');
$smarty->setCompileDir('var/compiled');
$smarty->setCacheDir('var/cache');
$smarty->setConfigDir('var/configs');

$smarty->setCaching(Smarty::CACHING_OFF);


$page = "";
if (!empty($_REQUEST['page'])) {
    $page = $_REQUEST['page'];
};

$pageParts = explode('/', $page);
if (!empty($pageParts) && count($pageParts) == 2) {	

	$section = $pageParts[0];
	$page = $pageParts[1];
} else {
	$section = 'index';
	$page = 'index';
}

$controller = 'controllers/' . $section . '/' . $page . '.php';
$template = 'templates/' . $section . '/' . $page . '.tpl';

if (!empty($controller) && file_exists($controller)) {
    try {
        require_once $controller;
    } catch (Exception $e) {
        addError($e->getMessage());
    }
} else {
	die('Invalid controller');
}


// Prepare stuff for the top-dreapta block
$organizer = $odb->query("SELECT * FROM organizer ORDER BY id_organizer DESC LIMIT 0,1");
$organizer->execute();
$organizerlist = $organizer->fetch();

$clubslists = $odb->query("SELECT * FROM clubs");
$clubslists->execute();
$listsclubs = $clubslists->rowCount();

$teamslists = $odb->query("SELECT * FROM teams");
$teamslists->execute();
$liststeam = $teamslists->rowCount();

$smarty->assign('teams', $liststeam);
$smarty->assign('organizer', $organizerlist);
$smarty->assign('clubs', $listsclubs);

$smarty->assign('template', $template);


$smarty->assign('notices', getNotices());
$smarty->assign('errors', getErrors());
$smarty->assign('successes', getSuccesses());




if ( isset($_REQUEST['pdf'])) {
	require_once(dirname(__FILE__).'/html2pdf_v4.03/html2pdf.class.php');
    try
    {
        $content = '<link href="css/pdf.css" rel="stylesheet" type="text/css" media="all"/>';
        $content .= $smarty->fetch($template);
        $orientation = 'P';
        if (!empty($_REQUEST['orientation']) && in_array($_REQUEST['orientation'], array('P', 'L'))) {
            $orientation = $_REQUEST['orientation'];
        }
        $html2pdf = new HTML2PDF($orientation, 'A4', 'en', true, 'UTF-8', 3);
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($content, isset($_GET['display']));
		
		$html2pdf->Output($section . '.pdf');

    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
} else {
	$smarty->display('layout.tpl');
}