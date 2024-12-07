<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- <?php include '../Constants/Combine-admin.php'; ?> -->
    <?php include 'Combine-admin.php'; ?>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }
        h1 {
            margin-top: 70px;
            margin-bottom: 20px;
            color: #fff;
        }

        .dashboard-box {
            background-color: #ccc;
            border: 1px solid #000;
            height: 350px;
            margin: 10px 0;
        }

        .dashboard-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px;
            min-height: 100vh;
        }

        .dashboard-row {
            display: flex;
            gap: 2.5%;
            width: 80%;
            justify-content: center;
        }

        .dashboard-big {
            margin-top: 15px;
            width: 80%;
            margin-bottom: 80px;
        }

        .dashboard-small{
            width: calc(80% - 1.25%);
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <h1>Dashboard</h1>
        <div class="dashboard-row">
            <div class="dashboard-box dashboard-small"></div>
            <div class="dashboard-box dashboard-small"></div>
        </div>
        <div class="dashboard-box dashboard-big"></div>
    </div>
</body>

</html>