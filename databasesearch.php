<!DOCTYPE html>

<html>
    <head>
        <title>Database Search Results</title>
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
            }
            else {
                foreach($columns as $col){
                    $sql_search_query .= "{$col},";
                }
                $sql_search_query = rtrim($sql_search_query,",");
                $sql_search_query .= " ";
            }

        ?> 
    </head>
    <body>
    </body>

</html>