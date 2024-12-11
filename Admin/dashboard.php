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
            margin-top: 100px;
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
        }

        .chart-container h2 {
            color: #fff;
            font-size: 1.2rem;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .chart-placeholder {
            width: 100%;
            height: 250px;
            background: #222;
            border-radius: 6px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #555;
            font-size: 1rem;
            font-style: italic;
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

        <!-- Big box: Could hold a chart and recent activity -->
        <div class="dashboard-box dashboard-big">
            <div class="chart-container">
                <h2>Player Performance Trend</h2>
                <div class="chart-placeholder">Chart Placeholder</div>
                <p style="margin-top:10px;font-size:0.9rem;color:#ccc;text-align:center;">
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
</body>

</html>
