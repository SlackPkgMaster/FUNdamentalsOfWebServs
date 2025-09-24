<!DOCTYPE html>

<html>
    <head>
        <title>Results</title> 
    </head>
    <body>
        <h2>Shirts Requested </h2>
        <?php if (isset($_POST['shirts'])) { ?>
            <ul>
            <?php foreach ($x as $_POST['shirts']) : ?>
                <li><?= htmlspecialchars($x) ?>  </li>
                </ul>
            <?php endforeach } ?>

        <?= vardump($_POST)?>
    </body>
</html>