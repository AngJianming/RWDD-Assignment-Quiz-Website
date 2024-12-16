<?php 

// session_start();

// if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Educator') {
//     header("Location: ../Login/login.php");
//     exit();
// }

// $educator_id = $_SESSION['user_id'];
// $username = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Include the combined admin layout -->
    <?php include 'Combine-admin.php'; ?>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            font-family: 'Inter', sans-serif;
            color: #fff;
        }

        h1 {
            color: #fff;
            margin-top: 30px;
            margin-bottom: 40px;
            text-align: center;
            font-size: 32px;
            font-weight: 600;
        }

        .dashboard-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            width: 100%;
            padding: 20px; /* Added padding for better spacing */
            box-sizing: border-box; /* Ensure padding doesn't affect total width */
        }

        .dashboard-row {
            display: flex;
            gap: 2.5%;
            width: 80%;
            justify-content: center;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .dashboard-box {
            background: #111;
            border: 1px solid #222;
            border-radius: 8px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            transition: background 0.3s ease;
            box-sizing: border-box; /* Ensure padding doesn't affect total size */
        }

        .dashboard-box:hover {
            background: #1a1a1a;
        }

        .dashboard-small {
            flex: 1 1 calc(50% - 1.25%);
            min-width: 280px;
            min-height: 180px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .dashboard-big {
            width: 80%;
            min-height: 400px;
            margin-bottom: 80px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Statistics Styles */
        .stat-title {
            color: #fff;
            font-size: 1.2rem;
            font-weight: 500;
            margin-bottom: 10px;
            text-align: center;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 10px;
            text-align: center;
            color: #b027f4; /* Neon purple accent */
        }

        .stat-description {
            font-size: 0.9rem;
            color: #ccc;
            text-align: center;
        }

        /* Chart / Activity Styles */
        .chart-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #ccc;
            border: 1px dashed #333;
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 20px;
            position: relative;
            background-color: #1a1a1a; /* Enhance contrast */
        }

        /* Bar Chart Styles */
        .bar-chart {
            display: flex;
            align-items: flex-end;
            justify-content: space-around;
            width: 100%;
            height: 250px; /* Adjust height as needed */
            background: #222;
            border-radius: 6px;
            padding: 20px;
            box-sizing: border-box;
            position: relative;
        }

        /* Individual Bar Styles */
        .bar {
            width: 40px;
            background-color: #b027f4; /* Neon purple accent */
            border-radius: 4px 4px 0 0;
            position: relative;
            transition: height 1s ease-out, background-color 0.3s ease;
            cursor: pointer;
        }

        .bar:hover {
            background-color: #d047ff; /* Lighter purple on hover */
        }

        /* Bar Labels */
        .bar-label {
            position: absolute;
            bottom: -20px;
            width: 100%;
            text-align: center;
            font-size: 0.9rem;
            color: #ccc;
        }

        /* Bar Values */
        .bar-value {
            position: absolute;
            top: -25px;
            width: 100%;
            text-align: center;
            font-size: 0.9rem;
            color: #fff;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .bar:hover .bar-value {
            opacity: 1;
        }

        /* Chart Note Styling */
        .chart-note {
            margin-top: 10px;
            font-size: 0.9rem;
            color: #ccc;
            text-align: center;
        }

        /* Recent Activity or Additional Info */
        .activity-container {
            background: #1a1a1a;
            border-radius: 6px;
            padding: 20px;
        }

        .activity-container h3 {
            color: #fff;
            font-size: 1.1rem;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .activity-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .activity-list li {
            border-bottom: 1px solid #333;
            padding: 10px 0;
            font-size: 0.9rem;
            color: #ccc;
        }

        .activity-list li:last-child {
            border-bottom: none;
        }

        @media (max-width: 915px) {
            h1 {
                font-size: 24px;
            }

            .dashboard-row {
                flex-direction: column;
                gap: 20px;
            }

            .dashboard-small {
                width: 100% !important;
            }

            .dashboard-big {
                width: 90%;
                margin-left: 40px;
            }

            .bar-chart {
                height: 200px;
                padding: 15px;
            }

            .bar {
                width: 30px;
            }

            .bar-label {
                font-size: 0.8rem;
            }

            .bar-value {
                font-size: 0.8rem;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <h1>Admin Dashboard</h1>
        <div class="dashboard-row">
            <!-- First small box: Total Users -->
            <div class="dashboard-box dashboard-small">
                <div class="stat-title">Total Users</div>
                <div class="stat-value">1,234</div>
                <div class="stat-description">Total registered players</div>
            </div>

            <!-- Second small box: Active Quizzes -->
            <div class="dashboard-box dashboard-small">
                <div class="stat-title">Active Quizzes</div>
                <div class="stat-value">56</div>
                <div class="stat-description">Quizzes currently online</div>
            </div>
        </div>

        <!-- Big box: Holds the chart and recent activity -->
        <div class="dashboard-box dashboard-big">
            <div class="chart-container">
                <h2>Player Performance Trend</h2>
                <!-- Bar Chart Container -->
                <div class="bar-chart" id="barChart">
                    <!-- Bars will be dynamically inserted here via JavaScript -->
                </div>
                <p class="chart-note">
                    *Data represents average quiz completion rates over the past weeks.
                </p>
            </div>
            <div class="activity-container">
                <h3>Recent Activity</h3>
                <ul class="activity-list">
                    <li>User <strong>JaneDoe</strong> completed "Python Basics Quiz"</li>
                    <li>New quiz "History of AI" added by Educator <strong>Mr.Rex</strong></li>
                    <li>User <strong>JohnSmith</strong> achieved Rank 2 in "Math Trivia"</li>
                    <li>System maintenance scheduled for Friday 10 PM</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Initialize the Vanilla Bar Chart -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Define demo data
            const chartData = {
                labels: ['Week1', 'Week2', 'Week3', 'Week4', 'Week5', 'Week6'],
                values: [75, 68, 80, 85, 90, 78] // Random demo data (percentages)
            };

            // Reference to the bar chart container
            const barChartContainer = document.getElementById('barChart');

            // Determine the maximum value for scaling
            const maxValue = Math.max(...chartData.values);

            // Function to create a single bar
            function createBar(label, value) {
                // Create bar element
                const bar = document.createElement('div');
                bar.classList.add('bar');

                // Set initial height to 0 for animation
                bar.style.height = '0%';

                // Create bar label
                const barLabel = document.createElement('div');
                barLabel.classList.add('bar-label');
                barLabel.textContent = label;

                // Create bar value tooltip
                const barValue = document.createElement('div');
                barValue.classList.add('bar-value');
                barValue.textContent = `${value}%`;

                // Append label and value to bar
                bar.appendChild(barValue);
                bar.appendChild(barLabel);

                return { bar, value };
            }

            // Array to hold bar elements and their target heights
            const bars = [];

            // Create bars based on chart data
            chartData.labels.forEach((label, index) => {
                const { bar, value } = createBar(label, chartData.values[index]);
                barChartContainer.appendChild(bar);
                bars.push({ bar, value });
            });

            // Animate bars after a short delay to ensure rendering
            setTimeout(() => {
                bars.forEach(({ bar, value }) => {
                    // Calculate height percentage based on max value
                    const heightPercent = (value / maxValue) * 100;
                    bar.style.height = `${heightPercent}%`;
                });
            }, 100); // 100ms delay

            // Optional: Add dynamic updates or interactivity as needed
        });
    </script>
</body>

</html>
