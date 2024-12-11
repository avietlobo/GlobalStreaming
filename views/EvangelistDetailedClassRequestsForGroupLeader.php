<?php
use app\models\CandidateModel;
use app\models\LoginForm;
use app\models\EvangelistModel;

// Check if there are any candidates in the array
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .button-container {
            text-align: center;
            margin: 40px 0;
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

        button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Language Grouping Dashboard</h1>
    <h5>As for you, always be sober, endure suffering, do the work of an evangelist, carry out your ministry fully. (2 Timothy 4:5)</h5>

    <table>
        <thead>
        <tr>
            <th>Participant Name</th>
            <th>Country</th>
            <th>Language</th>
            <th>Evangelist</th>
            <th>Class Number</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['participantName']); ?></td>
                <td><?php echo htmlspecialchars($item['country']); ?></td>
                <td><?php echo htmlspecialchars($item['language']); ?></td>
                <td><?php echo htmlspecialchars($item['evangelist']); ?></td>
                <td><?php echo htmlspecialchars($item['classFrom']); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div class="button-container">
        <button onclick="goBack()" class="btn btn-secondary">Back</button>
    </div>
</div>
<script>
    function goBack() {
        window.history.back();
    }
</script>

</body>
</html>
