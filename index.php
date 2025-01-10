<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom New Tab</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <ul id="target"></ul>

    <script>
        <?php
            $json = file_get_contents('config.json'); 
            $json = json_encode(json_decode($json));
            echo "const json='$json'\nconst config=JSON.parse(json).services";
        ?>
        
    </script>
    <script type="text/javascript" src="main.js"></script>

</body>

</html>