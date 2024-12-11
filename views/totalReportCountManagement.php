<?php
use app\models\CandidateModel;
use app\models\LoginForm;
use app\models\EvangelistModel;

// Check if there are any candidates in the array

// Ensure $data is available
$data = $data ?? []; // Default to an empty array if not set

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Management</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f5;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            font-size: 2.5em;
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }

        h5 {
            font-size: 1.2em;
            color: #555;
            margin-bottom: 40px;
            text-align: center;
            font-weight: 300;
        }

        .count-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }

        .count-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
            flex: 1 1 calc(25% - 20px); /* 4 cards per row */
            text-align: center;
            transition: box-shadow 0.3s ease, transform 0.2s ease;
        }

        .count-card h3 {
            font-size: 1.2em;
            margin-bottom: 10px;
            color: #333;
        }

        .count-card p {
            font-size: 3em; /* Increased font size for counts */
            font-weight: bold;
            margin: 0;
            color: #007BFF; /* Color for numbers to make them stand out */
        }

        .button-container {
            text-align: center;
            margin-bottom: 40px;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.2s ease;
            display: inline-block;
            margin: 0;
        }

        .btn-secondary {
            display: inline-block;
            background-color: #6c757d;
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin-top: 20px; /* Add margin to the top */
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
        }

        button.primary {
            background-color: #007BFF;
        }

        button.primary:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
            position: relative;
            transition: box-shadow 0.3s ease, transform 0.2s ease;
        }

        .card:hover {
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
            transform: translateY(-4px);
        }

        .card p {
            margin: 8px 0;
            font-size: 1em;
            color: #555;
        }

        .card p strong {
            color: #333;
        }

        .edit-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #28a745;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9em;
            transition: background-color 0.3s ease;
        }

        .edit-button:hover {
            background-color: #218838;
        }

        .hidden {
            display: none;
        }

        /* Responsive Design */
        @media only screen and (max-width: 768px) {
            h1 {
                font-size: 2em;
            }

            h5 {
                font-size: 1em;
            }

            .container {
                padding: 15px;
            }

            button {
                padding: 10px 18px;
                font-size: 0.9em;
            }

            .count-card {
                flex: 1 1 calc(50% - 20px); /* 2 cards per row on medium screens */
            }

            .count-card h3 {
                font-size: 1em;
            }

            .count-card p {
                font-size: 2.5em; /* Adjusted font size for counts */
            }
        }

        @media only screen and (max-width: 480px) {
            h1 {
                font-size: 1.5em;
            }

            h5 {
                font-size: 0.9em;
            }

            button {
                padding: 8px 14px;
                font-size: 0.8em;
            }

            .count-card {
                flex: 1 1 calc(100% - 20px); /* 1 card per row on small screens */
            }

            .count-card h3 {
                font-size: 0.9em;
            }

            .count-card p {
                font-size: 2em; /* Adjusted font size for counts */
            }
        }
    </style>
</head>
<body>
<div class="container">
<!--    <div class="container">-->
<!--        <a class="nav-link" href="#" id="logout-link">-->
<!---->
<!--            <button type="button" class="btn btn-primary">Logout</button>-->
<!--        </a>-->
    <h1>Reporting Dashboard</h1>
    <h5>As for you, always be sober, endure suffering, do the work of an evangelist, carry out your ministry fully. (2 Timothy 4:5)</h5>
    <div class="count-container">
        <div class="count-card">
            <h3>Total Countries</h3>
            <p><?php echo htmlspecialchars($data['total_countries']); ?></p>
        </div>
        <div class="count-card">
            <h3>Total Participants</h3>
            <p><?php echo htmlspecialchars($data['total_participants']); ?></p>
        </div>
        <div class="count-card">
            <h3>Total Part - (Withdrawn - Exit - InActive)</h3>
            <p><?php echo htmlspecialchars($data['total_part_withdrawn_exit_inactive']); ?></p>
        </div>
        <div class="count-card">
            <h3>Completed</h3>
            <p><?php echo htmlspecialchars($data['completed']); ?></p>
        </div>
        <div class="count-card">
            <h3>Active</h3>
            <p><?php echo htmlspecialchars($data['active']); ?></p>
        </div>
        <div class="count-card">
            <h3>InActive</h3>
            <p><?php echo htmlspecialchars($data['inactive']); ?></p>
        </div>
        <div class="count-card">
            <h3>Withdrawn</h3>
            <p><?php echo htmlspecialchars($data['withdrawn']); ?></p>
        </div>
        <div class="count-card">
            <h3>Exit/Drop-Out</h3>
            <p><?php echo htmlspecialchars($data['exit_drop_out']); ?></p>
        </div>
    </div>
    <div class="button-container">
        <a href="/reportManagement" class="btn btn-secondary">Back</a>
    </div>
</div>
</body>
</html>