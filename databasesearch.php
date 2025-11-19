<!DOCTYPE html>

<html>
    <head>
        <title>Database Search Results</title>
        <?php
            if(!empty($_GET)){
                $led = (int)isset($_GET['led']);

                shell_exec("gpio write 0 {$led}");

                $server = "localhost";
                $username = "php";
                $password = "Ross1234";
                $database = "order_info";
                $conn = mysqli_connect($server, $username, $password, $database); 

                // Check for successful connection
                if (!$conn) {
                    die("Connection Failed: {mysqli_connect_error()}");
                }

                $columns = [];
                if (isset($_GET['columns'])){
                    foreach($_GET['columns'] as $column_query){
                        $columns[] = htmlspecialchars($column_query);
                    }
                } 

                if (isset($_GET['filterelement'])){
                    $filter_element = htmlspecialchars($_GET['filterelement']);
                } else { $filter_element = ''; }

                if (isset($_GET['filtersearch'])){
                    $filter_search = htmlspecialchars($_GET['filtersearch']);
                } else { $filter_search = ''; }

                $sql_search_query = "select ";

                if(empty($columns)){
                    $sql_search_query .= "* ";
		            array_push($columns,"item","shirt_size","shirt_color","credit_number","cvv","exp_month","exp_year","name");
                }
                else {
                    foreach($columns as $col){
                        $sql_search_query .= "{$col},";
                    }
                    $sql_search_query = rtrim($sql_search_query,",");
                    $sql_search_query .= " ";
                }

                $sql_search_query .= " from orders inner join credit_cards on orders.credit_info_id = credit_cards.id";

                if ($filter_element != "all"){
                    $sql_search_query .= " where {$filter_element} = '{$filter_search}'";
                }
                $sql_search_query .= ";";

                $result = mysqli_query($conn, $sql_search_query);

                mysqli_close($conn);
            }
        ?> 
        <script>
            var toggleBkg = false;
            function changeHeaderImg() {
                document.getElementById("headerImg").src = "Images/Rocker2.jpg";
            }
            function changeBackground(newBkg) {
                toggleBkg = !toggleBkg;
                if (toggleBkg){
                    document.getElementById("backgroundImg").style.background = "url(" + newBkg + ")";
                }
                else {
                    document.getElementById("backgroundImg").style.background = "url(Images/SickGuitar.jpg)";
                }
            }
            async function getDHTinfo(elem) {
                let dht = await fetch("dhttojson.php");
                let json_dht = await dht.text();
                let deserialized = JSON.parse(json_dht);
                elem.style.display = "block";
                elem.innerHTML = deserialized.temperature + ", " + deserialized.humidity + ", " + deserialized.pressure + ", " + deserialized.altitude;
            }
        </script>
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
            .filter_form {
				display:flex; 
				margin:0px;
				
			}
            .filter_form fieldset {
                border-color: rgb(90, 1, 96);
                border-style: solid;
                float:left;
                height:200px;
                margin: 50px;
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

            table { 
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }
            td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            }
		</style>
    </head>

    <body style="background: url(Images/SickGuitar.jpg);padding: 0px;" id="backgroundImg">
        <div style="display:flex; margin:0px">
            <!--The cool rocker picture at the heading-->
            <div class="headingimage">
                <img id="headerImg" src="Images/Rocker.jpg" style="height:100%; width:100%" onclick="changeHeaderImg()"/>
            </div>

            <!--The title heading-->
            <div class="headingtitle">
                <h1 style="color: rgb(49, 13, 13);">Database Search</h1>
                <h2>Black Metal Music Center</h2>
            </div>
        </div>

		<ul class="navbar">
            <li><a href="index.html">Home</a></li>
            <li><a href="Form.html">Shop</a></li>
            <li><a href="databasesearch.php">Search</a></li>
        </ul>
        <div style="border-color:magenta" class="body_blocks">
			<h3>Search the database!</h3>
			<div class="filter_form">
				<form action="databasesearch.php" method="get">
						<fieldset class="columnsform">
							<legend>Element you want to see</legend>
							<input type="checkbox" id="item" name="columns[]" value="item">
							<label for="item"> Item Name</label><br/>
							<input type="checkbox" id="shirt_size" name="columns[]" value="shirt_size">
							<label for="shirt_size"> Shirt Size</label><br/>
							<input type="checkbox" id="shirt_color" name="columns[]" value="shirt_color">
							<label for="shirt_color"> Shirt Color</label><br/>
							<input type="checkbox" id="credit_number" name="columns[]" value="credit_number">
							<label for="credit_number"> Credit Card Number</label><br/>
							<input type="checkbox" id="cvv" name="columns[]" value="cvv">
							<label for="cvv"> Security Number</label><br/>
							<input type="checkbox" id="exp_month" name="columns[]" value="exp_month">
							<label for="exp_month"> Expiration Month</label><br/>
							<input type="checkbox" id="exp_year" name="columns[]" value="exp_year">
							<label for="exp_year"> Expiration Year</label><br/>
							<input type="checkbox" id="name" name="columns[]" value="name">
							<label for="name"> Name on Card</label><br/>
						</fieldset>

                        <fieldset>
							<legend>Toggle LED</legend>
							<input type="checkbox" id="led" name="led" value="1">
							<label for="led">Toggle that LED!</label>
						</fieldset>

						<fieldset class="filtersform">
							<legend>Filters</legend>
							<span>Filter your search</span>
							<select name="filterelement">
								<option value="all">No Filter</option>
								<option value="item">Item Name</option>
								<option value="exp_month">Expiration Month</option>
								<option value="exp_year">Expiration Year</option>
								<option value="name">Name on Card</option>
							</select>
							<br/>
							<label for="filtersearch" style="margin-left: 10px;">Search Term</label>
							<input type="text" id="filtersearch" name="filtersearch">
							<input type="Submit">
						</fieldset>
				</form> 
			</div>
		</div>

        <div style="border-color:rgb(149, 50, 179)" class="body_blocks">
            <h3>Search Results</h3>
            <?php if (!empty($_GET)) : ?>
                <table>
                    <tr>
                        <?php
                            foreach($columns as $col){
                                echo "<th>{$col}</th>";
                            } 
                        ?>
                    </tr>
                    <?php 
                        foreach($result as $row){
                            echo "<tr>";
                            foreach($columns as $col){
                                echo "<td> {$row[$col]} </td>";
                            }
                            echo "</tr>";
                        }
                    ?>
                </table>
            <?php else : ?>
                <p>No searches here...</p>
            <?php endif; ?>
        </div>

        <br/>
        <button class="background_button" onclick="changeBackground('Images/SickVinyl.jpg'); changeButtonText(this)">Change the background</button>
        <br/>
        <button onclick="getDHTinfo(document.getElementById('dht_block'))">Get temp info</button>
        <div style="border-color:rgb(200, 107, 228); display:none;" id="dht_block" class="body_blocks">
            <h3>Temperature Results</h3>
            <p>
            </p>
        </div>
    </body>

</html>
