<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="success.php" method="post">
        Link post: <input type="text" name="link"><br>
        Số lượng tương tác cần: <input type="number" name="quantity" min="50" max="100"><br>
        Dịch vụ:
        <select name="services" id="services">
            <option value="199">Like</option>
            <option value="200">Love</option>
        </select>
        <br>
        <input type="submit">
    </form>
</body>
</html>