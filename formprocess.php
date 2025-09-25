<!DOCTYPE html>

<html>
    <head>
        <title>Results</title> 
    </head>
    <body>
        <?php if (isset($_POST['shirts'])) {
            $shirts = $_POST['shirts'];
        }
	if (isset($_POST['sizes'])){
	    $size = $_POST['sizes'];
	}
	if (isset($_POST['color'])){
	    $color = $_POST['color'];
	}
	if (isset($_POST['cds'])){
	    $cds = $_POST['cds'];
	}
	if (isset($_POST['credit_number'])){
	    $credit_number = $_POST['credit_number'];
	}
	if (isset($_POST['credit_cvv'])){
	    $credit_cvv = $_POST['credit_cvv'];
	}
	if (isset($_POST['credit_month'])){
		echo (int)$_POST['credit_month'];
		switch((int)$_POST['credit_month']) {
			case 1: $credit_month = 'January'; break;
			case 2: $credit_month = 'February';break;
			case 3: $credit_month = 'March';break;
			case 4: $credit_month = 'April';break;
			case 5: $credit_month = 'May';break;
			case 6: $credit_month = 'June';break;
			case 7: $credit_month = 'July';break;
			case 8: $credit_month = 'August';break;
			case 9: $credit_month = 'September';break;
			case 10: $credit_month = 'October';break;
			case 11: $credit_month = 'November';break;
			case 12: $credit_month = 'December';break;
			default: $credit_month = '';
		}
	}
	if (isset($_POST['credit_year'])){
		switch((int)$_POST['credit_year']) {
			case 26: $credit_year = '2026';break;
			case 27: $credit_year = '2027';break;
			case 28: $credit_year = '2028';break;
			case 29: $credit_year = '2029';break;
			default: $credit_year = '';
		}
	}
	if (isset($_POST['credit_name'])){
		$credit_name = $_POST['credit_name'];
	}
	 ?>
        <h2>Shirts Requested </h2>
        <ul>
        	<?php foreach ($shirts as $x) : ?>
        	<li><?= htmlspecialchars($x) ?>  </li>
        	<?php endforeach ?>
	</ul>

	<h2>Shirt Size</h2>
	<p>
		<?= htmlspecialchars($size) ?>
	</p>

	<h2>Shirt Color Values</h2>
	<p>
		<?= htmlspecialchars($color) ?>
	</p>

        <h2>CDs Requested </h2>
        <ul>
        	<?php foreach ($cds as $x) : ?>
        	<li><?= htmlspecialchars($x) ?>  </li>
        	<?php endforeach ?>
	</ul>

	<h2>Credit Card Info</h2>
	<p>Credit Card Number : <?= (int)$credit_number ?></p>
	<p>Credit Card CVV : <?= (int)$credit_cvv ?></p>
	<p>Credit Card Expiration Date : <?= $credit_month . " " . $credit_year ?>
	<p>Name on the Card : <?= htmlspecialchars($credit_name) ?> </p>
    </body>
</html>
