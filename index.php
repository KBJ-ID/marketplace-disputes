<?php
$routes = explode("/", $_SERVER["REQUEST_URI"]);

$api = "https://marketplace-3951a.firebaseio.com/";

$url = "https://prueba122233.000webhostapp.com/";

if (!empty($routes[2])) {

	// Filtramos el producto
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => $api . "products.json?orderBy=%22url%22&equalTo=%22" . $routes[2] . "%22&print=pretty",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
	));

	$response = curl_exec($curl);

	curl_close($curl);
	$jsonResponse = json_decode($response, true);

	if (!empty($jsonResponse)) {
		$id = $jsonResponse[array_keys($jsonResponse)[0]];

		// Título
		$title = $id["name"];

		$sumary = json_decode($id["summary"], true);

		// Palabras claves
		$description = "";
		foreach ($summary as $key => $value) {
			$description .= $value . ", ";
		}

		$description = substr($description, 0, -2);

		// Palabras claves
		$tagsArray = json_decode($id["tags"], true);
		$tags = "";
		foreach ($tagsArray as $key => $value) {
			$tags .= $value . ", ";
		}

		$tags = substr($tags, 0, -2);

		// Imagen de portada
		$image = "assets/img/products/" . $id["category"] . "/" . $id["image"];
	} else {

		// Filtramos categoría
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $api . "categories.json?orderBy=%22url%22&equalTo=%22" . $routes[2] . "%22&print=pretty",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$jsonResponse = json_decode($response, true);

		if (!empty($jsonResponse)) {
			$id = $jsonResponse[array_keys($jsonResponse)[0]];

			// Título
			$title = $id["name"];

			// Palabras claves
			$description = "Latest Free jQuery plugins with examples and tutorials for web &amp; mobile developers.";
			$description = substr($description, 0, -2);

			// Palabras claves
			$tagsArray = json_decode($id["title_list"], true);
			$tags = "";
			foreach ($tagsArray as $key => $value) {
				$tags .= $value . ", ";
			}

			$tags = substr($tags, 0, -2);

			// Imagen de portada
			$image = "assets/img/categories/" . $id["image"];
			// } else {

			// 	// Filtramos subcategoría
			// 	$curl = curl_init();

			// 	curl_setopt_array($curl, array(
			// 		CURLOPT_URL => $api . "sub-categories.json?orderBy=%22url%22&equalTo=%22" . $routes[2] . "%22&print=pretty",
			// 		CURLOPT_RETURNTRANSFER => true,
			// 		CURLOPT_ENCODING => "",
			// 		CURLOPT_MAXREDIRS => 10,
			// 		CURLOPT_TIMEOUT => 0,
			// 		CURLOPT_FOLLOWLOCATION => true,
			// 		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			// 		CURLOPT_CUSTOMREQUEST => "GET",
			// 	));

			// 	$response = curl_exec($curl);

			// 	curl_close($curl);
			// 	$jsonResponse = json_decode($response, true);

			// 	if (!empty($jsonResponse)) {
			// 		$id = $jsonResponse[array_keys($jsonResponse)[0]];

			// 		// Título
			// 		$title = $id["name"];

			// 		// Palabras claves
			// 		$description = "Latest Free jQuery plugins with examples and tutorials for web &amp; mobile developers.";
			// 		$description = substr($description, 0, -2);

			// 		// Palabras claves
			// 		$tagsArray = json_decode($id["title_list"], true);
			// 		$tags = "";
			// 		foreach ($tagsArray as $key => $value) {
			// 			$tags .= $value . ", ";
			// 		}

			// 		$tags = substr($tags, 0, -2);

			// 		// Imagen de portada
			// 		$image = "assets/img/categories/" . $id["image"];
			// 	}
		}
	}
}
?>

<!doctype html>
<html lang="en">

<head>

	<base href="/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes">

	<?php if (empty($jsonResponse)) : ?>
		<title>Marketplace | Home</title>
		<meta name="description" content="Latest Free jQuery plugins with examples and tutorials for web &amp; mobile developers.">
		<meta name="keywords" content="Marketplace, Consumer Electric, Clothing and Apparel, Home, Garden and Kitchen, Health and Beauty, Jewelry and Watches, Computer and Technology">

		<!-- Marcado Facebook -->
		<meta property="og:site_name" content="Marketplace">
		<meta property="og:title" content="Marketplace | Home">
		<meta property="og:description" content="Latest Free jQuery plugins with examples and tutorials for web &amp; mobile developers.">
		<meta property="og:type" content="Type">
		<meta property="og:image" content="assets/img/bg/about-us.jpg">
		<meta property="og:url" content="https://prueba122233.000webhostapp.com/">

		<!-- Marcado Twitter -->
		<meta property="twitter:card" content="Summary">
		<meta property="twitter:title" content="Marketplace | Home">
		<meta property="twitter:url" content="https://prueba122233.000webhostapp.com/">
		<meta property="twitter:description" content="Latest Free jQuery plugins with examples and tutorials for web &amp; mobile developers.">
		<meta property="twitter:image" content="assets/img/bg/about-us.jpg">

		<!-- Marcado Google -->
		<meta property="name" content="Marketplace | Home">
		<meta property="url" content="https://prueba122233.000webhostapp.com/">
		<meta property="description" content="Latest Free jQuery plugins with examples and tutorials for web &amp; mobile developers.">
		<meta property="image" content="assets/img/bg/about-us.jpg">

	<?php else : ?>

		<title><?php echo $title ?></title>
		<meta name="description" content="<?php echo $description ?>">
		<meta name="<?php echo $tags ?>" content="Marketplace, Consumer Electric, Clothing and Apparel, Home, Garden and Kitchen, Health and Beauty, Jewelry and Watches, Computer and Technology">

		<!-- Marcado Facebook -->
		<meta property="og:site_name" content="Marketplace">
		<meta property="og:title" content="Marketplace | <?php echo $title ?>">
		<meta property="og:description" content="<?php echo $description ?>">
		<meta property="og:type" content="Type">
		<meta property="og:image" content="<?php echo $image ?>">
		<meta property="og:url" content="<?php echo $url ?>">

		<!-- Marcado Twitter -->
		<meta property="twitter:card" content="Summary">
		<meta property="twitter:title" content="Marketplace | <?php echo $title ?>">
		<meta property="twitter:url" content="<?php echo $url ?>">
		<meta property="twitter:description" content="<?php echo $description ?>">
		<meta property="twitter:image" content="<?php echo $image ?>">

		<!-- Marcado Google -->
		<meta property="name" content="Marketplace | <?php echo $title ?>">
		<meta property="url" content="<?php echo $url ?>">
		<meta property="description" content="<?php echo $description ?>">
		<meta property="image" content="<?php echo $image ?>">

	<?php endif ?>

	<link rel="icon" href="assets/img/template/icono.png">

	<!--=====================================
	CSS
	======================================-->

	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&display=swap" rel="stylesheet">

	<!-- font awesome -->
	<link rel="stylesheet" href="assets/css/plugins/fontawesome.min.css">

	<!-- linear icons -->
	<link rel="stylesheet" href="assets/css/plugins/linearIcons.css">

	<!-- Bootstrap 4 -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- Owl Carousel -->
	<link rel="stylesheet" href="assets/css/plugins/owl.carousel.css">

	<!-- Slick -->
	<link rel="stylesheet" href="assets/css/plugins/slick.css">

	<!-- Light Gallery -->
	<link rel="stylesheet" href="assets/css/plugins/lightgallery.min.css">

	<!-- Font Awesome Start -->
	<link rel="stylesheet" href="assets/css/plugins/fontawesome-stars.css">

	<!-- jquery Ui -->
	<link rel="stylesheet" href="assets/css/plugins/jquery-ui.min.css">

	<!-- Select 2 -->
	<link rel="stylesheet" href="assets/css/plugins/select2.min.css">

	<!-- Scroll Up -->
	<link rel="stylesheet" href="assets/css/plugins/scrollUp.css">

	<!-- DataTable -->
	<link rel="stylesheet" href="assets/css/plugins/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="assets/css/plugins/responsive.bootstrap.datatable.min.css">

	<!-- Nite Alert -->
	<link rel="stylesheet" type="text/css" href="assets/css/plugins/notie.css">

	<!-- Placeholder Loading -->
	<link rel="stylesheet" type="text/css" href="assets/css/plugins/placeholder-loading.css">

	<!-- Datepicker -->
	<link rel="stylesheet" type="text/css" href="assets/css/plugins/bootstrap-datepicker.min.css">

	<!-- estilo principal -->
	<link rel=" stylesheet" href="assets/css/style.css">

	<!-- Market Place 4 -->
	<link rel="stylesheet" href="assets/css/market-place-4.css">

	<!--=====================================
	PLUGINS JS
	======================================-->

	<!-- jQuery library -->
	<script src="assets/js/plugins/jquery-1.12.4.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

	<!-- Owl Carousel -->
	<script src="assets/js/plugins/owl.carousel.min.js"></script>

	<!-- Images Loaded -->
	<script src="assets/js/plugins/imagesloaded.pkgd.min.js"></script>

	<!-- Masonry -->
	<script src="assets/js/plugins/masonry.pkgd.min.js"></script>

	<!-- Isotope -->
	<script src="assets/js/plugins/isotope.pkgd.min.js"></script>

	<!-- jQuery Match Height -->
	<script src="assets/js/plugins/jquery.matchHeight-min.js"></script>

	<!-- Slick -->
	<script src="assets/js/plugins/slick.min.js"></script>

	<!-- jQuery Barrating -->
	<script src="assets/js/plugins/jquery.barrating.min.js"></script>

	<!-- Slick Animation -->
	<script src="assets/js/plugins/slick-animation.min.js"></script>

	<!-- Light Gallery -->
	<script src="assets/js/plugins/lightgallery-all.min.js"></script>
	<script src="assets/js/plugins/lg-thumbnail.min.js"></script>
	<script src="assets/js/plugins/lg-fullscreen.min.js"></script>
	<script src="assets/js/plugins/lg-pager.min.js"></script>

	<!-- jQuery UI -->
	<script src="assets/js/plugins/jquery-ui.min.js"></script>

	<!-- Sticky Sidebar -->
	<script src="assets/js/plugins/sticky-sidebar.min.js"></script>

	<!-- Slim Scroll -->
	<script src="assets/js/plugins/jquery.slimscroll.min.js"></script>

	<!-- Select 2 -->
	<script src="assets/js/plugins/select2.full.min.js"></script>

	<!-- Scroll Up -->
	<script src="assets/js/plugins/scrollUP.js"></script>

	<!-- DataTable -->
	<script src="assets/js/plugins/jquery.dataTables.min.js"></script>
	<script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>
	<script src="assets/js/plugins/dataTables.responsive.min.js"></script>

	<!-- Chart -->
	<script src="assets/js/plugins/Chart.min.js"></script>

	<!-- Pagination -->
	<!-- https://www.jqueryscript.net/other/Simple-Customizable-Pagination-Plugin-with-jQuery-Bootstrap-Twbs-Pagination.html -->
	<script src="assets/js/plugins/pagination.min.js"></script>

	<!-- Datepicker -->
	<!-- https://github.com/uxsolutions/bootstrap-datepicker -->
	<script src="assets/js/plugins/bootstrap-datepicker.min.js"></script>

	<!-- Sweetalert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

	<!-- Paypal -->
	<script src="https://www.paypal.com/sdk/js?client-id=AYonWV1lsAtj2GF-B_q7N2uZBMc8qHlz46coUp7Bfez7uqFiaugf7AGwghM8mzgNd46pKcEzIA1TvbeQ&currency=MXN">
	</script>

	<!-- Shaphe Share -->
	<!-- view-source:https://www.jqueryscript.net/demo/Social-Share-Plugin-jQuery-Open-Graph-Shape-Share/shape.share.js -->
	<script src="assets/js/plugins/shape.share.js"></script>
	<link rel="stylesheet" href="styles.57a5b3a9bdd6899fd08a.css">
</head>

<body>

	<!-- Traductor yandex -->
	<div id="ytWidget" style="display: none;"></div>
	<script src="https://translate.yandex.net/website-widget/v1/widget.js?widgetId=ytWidget&pageLang=en&widgetTheme=light&autoMode=false" type="text/javascript"></script>
	<app-root></app-root>

	<script>
		// This function displays Smart Payment Buttons on your web page.
	</script>

	<script src="runtime.e227d1a0e31cbccbf8ec.js" defer></script>
	<script src="polyfills.a4021de53358bb0fec14.js" defer></script>
	<script src="scripts.ab245319ae3cb030a0b3.js" defer></script>
	<script src="main.06b0b931ac7106b3487d.js" defer></script>

</body>

</html>