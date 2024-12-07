<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student Performance</title>
    <!-- <?php include '../Constants/Combine-admin.php'; ?> -->
    <?php include 'Combine-admin.php'; ?>
    <style>
        html,
        body {
            overflow: auto;
        }

        body {
            margin: 0;
            padding: 0;
            padding-top: 100px;
            margin-bottom: 100px;
            font-family: Arial, sans-serif;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #fff;
        }

        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
            background-color: #f4f4f4;
        }

        table th {
            background-color: #b9b9b9;
            text-align: center;
        }

        table td {
            word-wrap: break-word;
            text-align: center;
            vertical-align: middle;
        }

        /* Media query for smaller screens */
        @media (max-width: 720px) {
            h1 {
                font-size: 20px;
            }

            body {
                padding-left: 50px;
            }
        }
    </style>
</head>

<body>
    <h1>Student Performance</h1>
    <table id="stuPerformanceTable">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Ranked</th>
                <th>Level Completed</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <!-- take data from sql -->
                <td>12345</td>
                <td>Rank 3</td>
                <td>19 Levels</td>
            </tr>
            <tr>
                <td>67890</td>
                <td>Rank 6</td>
                <td>30 Levels</td>
            </tr>
            <tr>
                <td>67890</td>
                <td>Rank 6</td>
                <td>30 Levels</td>
            </tr>
            <tr>
                <td>67890</td>
                <td>Rank 6</td>
                <td>30 Levels</td>
            </tr>
            <tr>
                <td>67890</td>
                <td>Rank 6</td>
                <td>30 Levels</td>
            </tr>
            <tr>
                <td>67890</td>
                <td>Rank 6</td>
                <td>30 Levels</td>
            </tr>
            <tr>
                <td>67890</td>
                <td>Rank 6</td>
                <td>30 Levels</td>
            </tr>
            <tr>
                <td>67890</td>
                <td>Rank 6</td>
                <td>30 Levels</td>
            </tr>
            <tr>
                <td>67890</td>
                <td>Rank 6</td>
                <td>30 Levels</td>
            </tr>
            <tr>
                <td>67890</td>
                <td>Rank 6</td>
                <td>30 Levels</td>
            </tr>
            <tr>
                <td>67890</td>
                <td>Rank 6</td>
                <td>30 Levels</td>
            </tr>
            <tr>
                <td>67890</td>
                <td>Rank 6</td>
                <td>30 Levels</td>
            </tr>
            <tr>
                <td>67890</td>
                <td>Rank 6</td>
                <td>30 Levels</td>
            </tr>
            <tr>
                <td>67890</td>
                <td>Rank 6</td>
                <td>30 Levels</td>
            </tr>
            <tr>
                <td>67890</td>
                <td>Rank 6</td>
                <td>30 Levels</td>
            </tr>
            <tr>
                <td>67890</td>
                <td>Rank 6</td>
                <td>30 Levels</td>
            </tr>
            <tr>
                <td>67890</td>
                <td>Rank 6</td>
                <td>30 Levels</td>
            </tr>
            <tr>
                <td>67890</td>
                <td>Rank 6</td>
                <td>30 Levels</td>
            </tr><tr>
                <td>67890</td>
                <td>Rank 6</td>
                <td>30 Levels</td>
            </tr>
            <tr>
                <td>67890</td>
                <td>Rank 6</td>
                <td>last Levels</td>
            </tr>
        </tbody>
    </table>
</body>

</html>