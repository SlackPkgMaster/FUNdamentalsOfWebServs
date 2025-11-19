<?php
    $raw_json = exec_shell("./bme280");
    echo $raw_json;
?>