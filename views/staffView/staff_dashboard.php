<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
        }
        header, footer {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 10px;
        }
        .button-container {
            margin: 20px auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .button {
            margin: 10px;
            padding: 15px 30px;
            font-size: 16px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #0056b3;
        }
        iframe {
            width: 90%;
            height: 500px;
            border: 1px solid #ccc;
            margin-top: 20px;
            border-radius: 8px;
        }
        .section-header {
            font-size: 24px;
            margin: 20px 0;
            color: #333;
            text-align: left;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 5px;
        }
    </style>
</head>
<body>
    <?php include 'header_staff.php'; ?>
    <?php include 'dashboard.php'; ?>
    <?php include 'staff_session.php'; ?>

    <div class="section-header">General Management</div>
    <div class="button-container">
        <button class="button" onclick="loadPage('../../client_display.php')">Client Display</button>
        <button class="button" onclick="loadPage('../../interview_details.php')">Interview Details</button>
        <button class="button" onclick="loadPage('../../staff.php')">Staff</button>
        <button class="button" onclick="loadPage('../../appointments.php')">Lessons</button>

    </div>

    <div class="section-header">Car Management</div>
    <div class="button-container">
        <button class="button" onclick="loadPage('../../cars.php')">Cars</button>
        <button class="button" onclick="loadPage('../../average_miles.php')">Average Miles Lessons</button>
        <button class="button" onclick="loadPage('../../cars_fault.php')">Cars With Faults</button>
        <button class="button" onclick="loadPage('../../cars_instructor_office.php')">Cars Instructor Assigned</button>
    </div>

    <div class="section-header">Driving Test Management</div>
<div class="button-container">
    <button class="button" onclick="loadPage('../../drivingtest_display.php')">Driving Test Info</button>
    <button class="button" onclick="loadPage('../../add_drivingtest.php')">Add Driving Test Info</button>
</div>

    <div class="iframe-container">
        <iframe id="content-frame" src="../../client_display.php"></iframe>
    </div>

    <script>
        function loadPage(page) {
            document.getElementById('content-frame').src = page;
        }
    </script>

    <?php include '../../footer.php'; ?>
</body>
</html>
