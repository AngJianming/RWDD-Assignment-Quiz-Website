<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Ranked</title>
    <?php include '../Constants/Combine-admin.php'; ?>

    <style>
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 115px;
            width: auto;
            height: auto;
        }

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            height: 100vh;
        }

        #green-tick-mark {
            width: 450px;
            height: 450px;
            max-width: 650px;
            max-height: 650px;
        }
        h1{
            font-weight: 1px bold;
            color: black;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="ImgIcon/green-check-mark-icon.png" id = "green-tick-mark">
        <h1>You have successful publish Level 6!</h1>
    </div>
</body>

</html>