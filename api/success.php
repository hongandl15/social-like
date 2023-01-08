<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include 'api.php';?>
    <?php
    $api = new Api();
    $order = $api->order(['service' => $_POST["services"], 'link' => $_POST["link"], 'quantity' => $_POST["quantity"], 'runs' => 2, 'interval' => 5]); # Default
    $status = $api->status($order->order)->status;
    // $status = $api->status(2000716)->status;
    echo $status;
    ?>


</body>
</html>