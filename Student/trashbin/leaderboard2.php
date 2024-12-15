<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Leaderboard - CodeCombat</title>
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

        p.note {
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
        <h1>Top Pythonistas</h1>
        <table>
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Player</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Example leaderboard data
                // In a real scenario, this data would come from a database query.
                $players = [
                    ['rank' => 1, 'name' => 'CodeNinja42', 'score' => 980],
                    ['rank' => 2, 'name' => 'PyMaster', 'score' => 950],
                    ['rank' => 3, 'name' => 'SnakeCharmer', 'score' => 920],
                    ['rank' => 4, 'name' => 'DjangoDude', 'score' => 900],
                    ['rank' => 5, 'name' => 'DataDragon', 'score' => 890],
                ];

                foreach ($players as $player) {
                    echo "<tr>
                    <td>{$player['rank']}</td>
                    <td>{$player['name']}</td>
                    <td>{$player['score']}</td>
                  </tr>";
                }
                ?>
            </tbody>
        </table>
        <a class="btn" href="/">Home</a>
        <p class="note">Think you can top these scores? Keep practicing and come back to climb the ranks!</p>
    </div>
</body>

</html>