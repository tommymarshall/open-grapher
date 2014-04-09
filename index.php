<?php

require 'vendor/autoload.php';

use OpenGrapher\OpenGrapher;

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Open Graph Test</title>
	<?php
		$pitcher = $_GET['_escaped_fragment_'];

		if ($pitcher)
		{
			$grapher = new OpenGrapher;
			$grapher->parse('data.yml');
			try {
				echo $grapher->find($pitcher)->get();
			} catch (Exception $e) {
				echo "<!-- {$e->getMessage()} -->\n";
				echo "<meta property=\"og:url\" content=\"http://tommyjm.com/open-graph-test\">\n";
				echo "<meta property=\"og:title\" content=\"Default title\">\n";
				echo "<meta property=\"og:description\" content=\"Default description.\">\n";
			}
		}
	?>

	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<h1>Open Graph test</h1>
		<p>This is a proof of concept of routing Facebook and Twitter bots to retrieve defined open graph information in an external YAML file for hashed URLs.</p>
		<p>To test, visit one of the hashed routes below and copy and paste the URL <a href="https://developers.facebook.com/tools/debug/og/object" target="_blank">Facebook's Open Graph debugger</a>.</p>
		<h3>Currently defined routes.</h3>
		<ul>
			<li><a href="#!doug">Doug</a></li>
			<li><a href="#!dan">Dan</a></li>
			<li><a href="#!john">John</a></li>
			<li><a href="#!sally">Sally</a></li>
		</ul>
	</div>
</body>
</html>
