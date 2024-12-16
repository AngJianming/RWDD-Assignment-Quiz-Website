<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>History - CodeCombat</title>
    <?php include '../Constants/Combine-student.php' ?>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
            background: #000;
            /* Black background */
            color: #fff;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 0 20px;
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            color: #caa0f5;
            /* Light purple */
            font-size: 2.2rem;
        }

        p {
            text-align: center;
            color: #ccc;
            margin-bottom: 30px;
            font-size: 1.1rem;
            line-height: 1.5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
            background: #111;
            /* Slightly lighter black */
            border: 1px solid #3c1e63;
            /* Purple border */
            border-radius: 8px;
            overflow: hidden;
        }

        th,
        td {
            text-align: left;
            padding: 15px;
            color: #ccc;
            border-bottom: 1px solid #333;
        }

        th {
            background: #3c1e63;
            /* Purple background for headers */
            font-weight: 700;
            color: #fff;
        }

        tr:last-child td {
            border-bottom: none;
        }

        a.btn {
            display: inline-block;
            text-decoration: none;
            text-align: center;
            padding: 10px 20px;
            border: 1px solid #3c1e63;
            border-radius: 4px;
            background: #3c1e63;
            /* Purple background */
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
            margin: 0 auto;
            display: block;
            width: fit-content;
        }

        a.btn:hover {
            background: #5f2d9f;
            /* Slightly lighter purple on hover */
        }

        .note {
            text-align: center;
            color: #777;
            font-size: 0.9rem;
            margin-top: 20px;
        }

        /* Responsive Adjustments */
        @media (max-width: 600px) {

            table,
            th,
            td {
                font-size: 0.9rem;
            }

            h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Your History Records</h1>
        <p>Below is a record of your previously saved results from CodeCombat. Keep track of your progress and see how you've improved over time!</p>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // In a real scenario, you'd fetch these from a database.
                // For demonstration, we'll use an example static array.
                // This data would have been saved in 'end.php' when the user clicked 'Save'.
                $history = [
                    ['date' => '2024-12-15', 'score' => 700],
                    ['date' => '2024-12-14', 'score' => 650],
                    ['date' => '2024-12-13', 'score' => 600],
                ];

                if (count($history) > 0) {
                    foreach ($history as $entry) {
                        echo "<tr>
                      <td>{$entry['date']}</td>
                      <td>{$entry['score']}</td>
                    </tr>";
                    }
                } else {
                    echo "<tr><td colspan='2' style='text-align:center;color:#777;'>No saved history found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a class="btn" href="userDashboard.php">Home</a>
        <p class="note">Your history will be updated each time you save your result at the end of a game.</p>
    </div>
</body>

</html>