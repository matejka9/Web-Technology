<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="<?= base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $title ?></title>
	<link href='http://fonts.googleapis.com/css?family=Bree+Serif' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link href="<?= base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<link href="<?= base_url()?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">

	<link href="<?= base_url()?>assets/css/style.css" rel="stylesheet">
</head>

<body>

<?php include "nav.php";?>

<div class="container">

	<?= $content ?>


	<?php include "footer.php";?>
</div>



</body>
</html>