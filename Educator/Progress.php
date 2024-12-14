<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Report</title>
    <?php include '../Constants/Combine-educator.php' ?>
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            overflow: scroll;
            font-family: 'Arial', sans-serif;
            color: #e0e0e0; /* Light text for contrast */
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            background: #1e1e1e; /* Darker container background */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5); /* Subtle shadow for depth */
        }

        .header1 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            color: #ffffff; /* White text for headers */
        }

        .quiz-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            background-color: #2c2c2c; /* Slightly lighter than container */
            border-radius: 8px;
        }

        .quiz-info div {
            text-align: center;
        }

        .quiz-info strong {
            display: block;
            font-size: 18px;
            margin-bottom: 5px;
            color: #ffffff;
        }

        .quiz-info p {
            margin: 0;
            font-size: 14px;
            color: #b0b0b0;
        }

        /* Table Styles */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th, .table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #333;
        }

        .table th {
            background-color: #2c2c2c;
            color: #ffffff;
            font-size: 16px;
        }

        .table td {
            color: #e0e0e0;
            font-size: 14px;
        }

        .table tr:hover {
            background-color: #333333;
        }

        .footer {
            margin-bottom: 0%;
        }

        /* Progress Tracker Styles */
        .progress-tracker {
            padding: 4px;
        }

        .progress-bar {
            margin: 12px 0 3rem;
        }

        .progress-bar label {
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
            color: #ffffff;
        }

        .progress-bar .bar {
            width: 100%;
            height: 25px;
            background-color: #2c2c2c;
            border-radius: 12.5px;
            overflow: hidden;
            position: relative;
        }

        .progress-bar .fill {
            height: 100%;
            background-color: #b027f4; /* Neon purple accent */
            width: 0;
            border-radius: 12.5px 0 0 12.5px;
            transition: width 1s ease-out;
        }

        .progress-bar p {
            margin: 8px 0 0 0;
            font-size: 14px;
            color: #b0b0b0;
        }

        .emptyspace {
            padding-bottom: 10%;
            margin-bottom: 20px;
        }

        /* Responsive Design */
        @media (max-width: 915px) {
            .quiz-info {
                flex-direction: column;
                gap: 15px;
            }

            .table th, .table td {
                padding: 10px;
                font-size: 13px;
            }

            .progress-bar label {
                font-size: 14px;
            }

            .progress-bar p {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header1">Reports & Progress</div>

        <div class="quiz-info">
            <div>
                <strong>Quiz Name</strong>
                <p>October 18, 2024, 6:27 PM</p>
            </div>
            <div>
                <strong>50%</strong>
                <p>Progress</p>
            </div>
            <div>
                <strong>10</strong>
                <p>Questions</p>
            </div>
            <div>
                <strong>4</strong>
                <p>Participants</p>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Participants</th>
                    <th>Progress (%)</th>
                    <th>Marks</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Ali</td>
                    <td>60</td>
                    <td>5/10</td>
                </tr>
                <tr>
                    <td>Abu</td>
                    <td>50</td>
                    <td>3/10</td>
                </tr>
                <tr>
                    <td>Akao</td>
                    <td>80</td>
                    <td>8/10</td>
                </tr>
                <tr>
                    <td>Muthu</td>
                    <td>40</td>
                    <td>2/10</td>
                </tr>
            </tbody>
        </table>

        <div class="progress-tracker">
            <div class="progress-bar">
                <label>Quiz 1</label>
                <div class="bar">
                    <div class="fill" id="quiz1-fill"></div>
                </div>
                <p>50% completed</p>
            </div>
            <div class="progress-bar">
                <label>Quiz 2</label>
                <div class="bar">
                    <div class="fill" id="quiz2-fill"></div>
                </div>
                <p>50% completed</p>
            </div>
            <div class="progress-bar">
                <label>Quiz 3</label>
                <div class="bar">
                    <div class="fill" id="quiz3-fill"></div>
                </div>
                <p>50% completed</p>
            </div>
            <div class="progress-bar">
                <label>Quiz 4</label>
                <div class="bar">
                    <div class="fill" id="quiz4-fill"></div>
                </div>
                <p>50% completed</p>
            </div>
            <div class="progress-bar">
                <label>Quiz 5</label>
                <div class="bar">
                    <div class="fill" id="quiz5-fill"></div>
                </div>
                <p>50% completed</p>
            </div>
        </div>
    </div>
    <div class="emptyspace">
        
    </div>

    <script>
        function animateProgress(id, targetWidth) {
            const element = document.getElementById(id);
            let width = 0;
            const step = targetWidth / 50; // Adjust steps for smoother animation
            const interval = setInterval(() => {
                if (width >= targetWidth) {
                    element.style.width = targetWidth + "%";
                    clearInterval(interval);
                } else {
                    width += step;
                    if (width > targetWidth) width = targetWidth;
                    element.style.width = width + "%";
                }
            }, 20); // Adjust timing for desired speed
        }

        document.addEventListener("DOMContentLoaded", () => {
            animateProgress("quiz1-fill", 50);
            animateProgress("quiz2-fill", 50);
            animateProgress("quiz3-fill", 50);
            animateProgress("quiz4-fill", 50);
            animateProgress("quiz5-fill", 50);
        });
    </script>
</body>
</html>
