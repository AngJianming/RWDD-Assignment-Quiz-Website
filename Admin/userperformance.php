<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student Performance</title>
    <!-- Include Combine-admin if needed -->
    <?php include 'Combine-admin.php'; ?>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            overflow: auto;
            font-family: 'Inter', sans-serif;
            background: #000; /* Dark background */
            color: #fff;
        }

        body {
            padding-top: 100px;
            margin-bottom: 100px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 32px;
            margin-top: -10px;
            color: #fff;
        }

        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background: #111;
            border: 1px solid #222;
            border-radius: 8px;
            overflow: hidden;
        }

        table thead {
            background: #222;
        }

        table th,
        table td {
            padding: 1rem;
            text-align: center;
            font-size: 14px;
            color: #eee;
            border-bottom: 1px solid #333;
        }

        table th {
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        table tbody tr:hover {
            background: #1a1a1a;
        }

        /* Responsive adjustments */
        @media (max-width: 720px) {
            h1 {
                font-size: 20px;
            }

            table th, table td {
                font-size: 12px;
                padding: 0.75rem;
            }

            body {
                padding-left: 20px;
                padding-right: 20px;
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
            <!-- add rows here Shift + Alt + Down arrow -->
            <tr>
                <td>67890</td>
                <td>Rank 6</td>
                <td>last Levels</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
