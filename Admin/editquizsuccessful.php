<?php
    // Capture the 'level' parameter from the URL
    $level = isset($_GET['level']) ? htmlspecialchars($_GET['level']) : 'Unknown Level';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Ranked</title>
    <!-- <?php include '../Constants/Combine-admin.php'; ?> -->
    <?php include 'Combine-admin.php'; ?>

    <style>
        .container {
            padding: 0px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 10px;
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
            color: #fff;
        }
        .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%; /* Full width */
            margin-top: 50px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            background-color: #4CAF50; /* Example button color */
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: green; /* Darker shade on hover */
            color: black;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="ImgIcon/green-check-mark-icon.png" id = "green-tick-mark">
        <h1>Edit successful for  <?php echo $level; ?></h1>
        <div class="button-container">
            <button id="return-btn">Return</button>
        </div>
    </div>
</body>
<script>
    document.getElementById('return-btn').addEventListener('click', function () {
        window.location.href = 'rankedquiz.php';
    });
</script>
</html>