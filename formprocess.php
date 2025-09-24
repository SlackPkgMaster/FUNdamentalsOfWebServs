<!DOCTYPE html>

<html>
    <head>
        <title>Results</title> 
    </head>
    <body>
        <?php if (isset($_POST['shirts'])) {
            $shirts = $_POST['shirts'];
        } ?>
        <h2>Shirts Requested </h2>
            <ul>
            <?php foreach ($shirts as $x) : ?>
                <li><?= htmlspecialchars($x) ?>  </li>
            <?php endforeach ?>
            </ul>
        <?= var_dump($_POST)?>
    </body>
</html>