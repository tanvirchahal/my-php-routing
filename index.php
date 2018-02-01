<?php 
	header("Content-Type: text/html");
	include dirname(__FILE__) . '/AltoRouter.php';
	$router = new AltoRouter();
	$router->setBasePath('/my-php-routing');
	
	/* Setup the URL routing. This is production ready. */
	// Main routes that non-customers see
	$router->map('GET','/', 'hey.php', 'home');
	$router->map('GET','/home/', 'home.php', 'home-home');
	$router->map('GET','/plans/', 'plans.php', 'plans');
	$router->map('GET','/about/', 'about.php', 'about');
	$router->map('GET','/contact/', 'contact.php', 'contact');
	$router->map('GET','/tos/', 'tos.html', 'tos');
	
	// Special (payments, ajax processing, etc)
	$router->map('GET','/charge/[*:customer_id]/[*:customer_name]','charge.php','charge');
	$router->map('GET','/pay/[*:status]/','payment_results.php','payment-results');
	
	// API Routes
	$router->map('GET','/api/[*:key]/[*:name]/', 'json.php', 'api');
	/* Match the current request */
	$match = $router->match();
	
	if($match) {
	  require $match['target'];
	}
	else {
	  header("HTTP/1.0 404 Not Found");
	  require '404.html';
	}
?>
