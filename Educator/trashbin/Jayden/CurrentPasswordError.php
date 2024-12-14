<?php
    include("Combine-educator.php");
    include("Bg-Animation.php");
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Error Message</title>
 
  <style>
    /* General reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Background styling */
    body, html {
      height: 100%;
      font-family: Arial, sans-serif;
      background-color: #f2f2f2; /* Light grey background */
      display: flex;
      justify-content: center;
      align-items: center;
    }

    /* Message styling */
    .message {
      background-color: white;
      border-radius: 10px;
      padding: 20px 30px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
      text-align: center;
      width: 300px;
    }

    .message h2 {
      font-size: 22px;
      color: red;
      margin-bottom: 15px;
    }

    .message p {
      font-size: 16px;
      margin-bottom: 20px;
      color: #333;
    }

    .close-button {
      background-color: red;
      color: white;
      border: none;
      padding: 8px 16px;
      font-size: 14px;
      border-radius: 5px;
      cursor: pointer;
    }

    .close-button:hover {
      background-color: darkred;
    }
  </style>
</head>
<body>
  <div class="message">
    <h2>Error</h2>
    <p>The password that you entered is incorrect. Please try again.</p>
    <button class="close-button" onclick="closeModal()">Close</button>
  </div>

  <script>
    function closeModal() {
      alert('You can add closing logic here!');
    }
  </script>
</body>
</html>
