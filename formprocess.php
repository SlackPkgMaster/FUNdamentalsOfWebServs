<!DOCTYPE html>

<html>
    <head>
        <title>Results</title> 
		<style>
            @font-face {
                font-family: ComicSans;
                src: url(Fonts/ComicRelief-Regular.ttf);
            }
            h1,h2,h3 {
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            }
            .headingimage {
                height: 120px; 
                width: 10%; 
                float: left; 
                margin:0px;
            }
            .headingtitle {
                height: 120px; 
                background-color: rgba(139, 0, 0, 0.95); 
                width: 90%; 
                float:left; 
                margin:0px;
            }
            .headingtitle h1,h2 {
                text-align: center;
            }
            .navbar {
                list-style-type: none;
                margin: 0;
                padding: 0;
                overflow: hidden;
                background-color: rgba(127, 127, 127, 0.7);
            }
            .navbar li {
                float: left;
                font-family: ComicSans;
            }
            .navbar li a {
                display: block;
                color: rgb(164, 11, 11);
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }
            ul li a:hover {
                color: crimson;
                background-color: #111111;
            }
            .body_blocks{
                width:80%;
                margin:auto;
                margin-top:25px;
                margin-bottom:25px;
                padding:10px;
                border-style:solid;
                background-color: rgba(240, 248, 255, 0.9);
            }
            button {
                width:80%;
                height:25px;
                display: block;
                margin: 0 auto;
            }
            button:hover {
                background-color: rgb(55, 55, 55);
                color: aliceblue;
            }
		</style>
    </head>
    <body style="background: url(Images/SickGuitar.jpg);padding: 0px;">

		<?php
			$server = "localhost";
			$username = "php";
			$password = "Ross1234";
			$database = "order_info";
			$conn = mysqli_connect($server, $username, $password, $database); 

			// Check for successful connection
			if (!$conn) {
				die("Connection Failed: {mysqli_connect_error()}");
			}

			// Check POST results
			$shirts = [];
			if (isset($_POST['shirts'])) {
				foreach($_POST['shirts'] as $item){
					$shirts[] = htmlspecialchars($item);
				}
			}

			if (isset($_POST['sizes'])){
				$size = htmlspecialchars($_POST['sizes']);
			}
			else {$size = '';}

			if (isset($_POST['color'])){
				$color = htmlspecialchars($_POST['color']);
			}
			else {$color = '';}

			$cds = [];
			if (isset($_POST['cds'])){
				foreach($_POST['cds'] as $item){
					$cds[] = htmlspecialchars($item);
				}
			}

			if (isset($_POST['credit_number'])){
				$credit_number = htmlspecialchars($_POST['credit_number']);
			}
			else {$credit_number = '';}

			if (isset($_POST['credit_cvv'])){
				$credit_cvv = (int)$_POST['credit_cvv'];
			}
			else {$credit_cvv = '';}

			if (isset($_POST['credit_month'])){
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
				$credit_name = htmlspecialchars($_POST['credit_name']);
			}
			else {$credit_name = '';}
			
			//Making the SQL query
			$sql_credit_query = "insert into credit_cards (
					credit_number, 
					cvv,
					exp_month,
					exp_year,
					name
				)
				values (
					{$credit_number},
					{$credit_cvv},
					{$credit_month},
					{$credit_year},
					{$credit_name}
				);";
			
			$sql_credit_result = mysqli_query($conn,$sql_credit_query);

			$sql_credit_id_query = "select id from credit_cards
				where 	credit_number={$credit_number} and
						cvv={$credit_cvv} and
						exp_month={$credit_month} and
						exp_year={$credit_year} and
						name={$credit_name};";
			
			$credit_id = mysqli_query($conn, $sql_credit_id_query);
					
		?>
		<div style="display:flex; margin:0px">
            <!--The cool rocker picture at the heading-->
            <div class="headingimage">
                <img id="headerImg" src="Images/Rocker.jpg" style="height:100%; width:100%" onclick="changeHeaderImg()"/>
            </div>

            <!--The title heading-->
            <div class="headingtitle">
                <h1 style="color: rgb(49, 13, 13);">Form Processing Results</h1>
                <h2>Black Metal Music Center</h2>
            </div>
        </div>

		<ul class="navbar">
            <li><a href="index.html">Home</a></li>
            <li><a href="Form.html">Shop</a></li>
        </ul>

		<div style="border-color:purple" class="body_blocks">
			<h3>Form Results</h3>

			<h4>Shirts Requested </h4>

			<ul>
					<?php foreach ($shirts as $x) : ?>
					<li><?= $x ?>  </li>
					<?php endforeach ?>
			</ul>

			<h4>Shirt Size</h4>
			<p>
				<?= $size ?>
			</p>

			<h4>Shirt Color Values</h4>
			<p>
				<?= $color ?>
			</p>

				<h4>CDs Requested </h4>
				<ul>
					<?php foreach ($cds as $x) : ?>
					<li><?= $x ?>  </li>
					<?php endforeach ?>
			</ul>

			<h4>Credit Card Info</h4>
			<p>Credit Card Number : <?= $credit_number ?></p>
			<p>Credit Card CVV : <?= $credit_cvv ?></p>
			<p>Credit Card Expiration Date : <?= $credit_month . " " . $credit_year ?>
			<p>Name on the Card : <?= $credit_name ?> </p>
		</div>

		<div style="border-color:magenta" class="body_blocks">
			<h3>Search the database!</h3>
			<?= $credit_id?>
<!--			<form action="databasesearch.php" method="get">
				<label for="table" style="margin-left: 10px;">Database:</label>
					<select id="table" name="table">
						<option value="credit_cards">Credit Cards</option>
						<option value="orders">Orders</option>
					</select>
					
			</form> -->
		</div>
    </body>
</html>
