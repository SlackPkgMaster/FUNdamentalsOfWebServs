<!DOCTYPE html>

<html>
    <head>Results</head>
    <?php 
        if isset($_POST)
    ?>
    <body>
        <h1>Result of Form request</h1>
        <ul>
            <li>Demi-God Slut shirt : <?=  ?></li>
            <li>Chasm of Filth shirt : <?=  ?></li>
            <li>Maggot Desecration shirt : <?=  ?></li>
            <li>Graves of Piss shirt : <?=  ?></li>
            <li>Ninja Sex Party shirt : <?=  ?></li>
        </ul>
        <p>Shirt size : <?= $_POST['sizes'] ?></p>
        <p>Shirt color : <?= $_POST['color'] ?>
        <ul>
            <li>Demi-God Slut shirt : <?= $_POST['dgs_shirt'] ?></li>
            <li>Chasm of Filth shirt : <?= $_POST['cof_shirt'] ?></li>
            <li>Maggot Desecration shirt : <?= $_POST['md_shirt'] ?></li>
            <li>Graves of Piss shirt : <?= $_POST['gop_shirt'] ?></li>
            <li>Ninja Sex Party shirt : <?= $_POST['nsp_shirt'] ?></li>
        </ul>
    </body>
</html>