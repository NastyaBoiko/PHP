<?php 
$fileName = basename(__FILE__, '.php');
require_once "lib/$fileName" . "init.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Информационная система - .....</title>
	<?= file_get_contents('lib/header.html');?>

	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="css/jquery.timepicker.css">
</head>

<body>

	<div id="colorlib-page">
		<?php 
		require_once 'lib/init.php';
		echo $menu->nav(basename(__FILE__));
		?>

		<div id="colorlib-main">
			<section class="contact-section px-md-2 pt-5">
				<div class="container">
					<div class="row d-flex contact-info">
						<div class="col-md-12 mb-1">
							<h2 class="h3">Создание поста</h2>
						</div>

					</div>
					<div class="row block-9">
						<div class="col-lg-6 d-flex">

							<form action="#" class="bg-light p-5 contact-form">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Post title" name="title">

								</div>
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Post preview" name="preview">
								</div>
								<div class="form-group">
									<textarea name="" id="" cols="30" rows="10" class="form-control" placeholder="Post content"
										name="content"></textarea> 
								</div>
								
								<div class="form-group">
									<input type="submit" value="Регистрация" class="btn btn-primary py-3 px-5">
								</div>
							</form>

						</div>


					</div>
				</div>
			</section>
		</div><!-- END COLORLIB-MAIN -->
	</div><!-- END COLORLIB-PAGE -->

	<!-- loader -->
	<?= file_get_contents('lib/preloader.html');?>


	<?= file_get_contents('lib/script.html');?>


</body>

</html>