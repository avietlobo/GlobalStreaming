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

        h4 {
            font-size: 1.2em;
            color: #555;
            margin-bottom: 40px;
            text-align: center;
            font-weight: 300;
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

        .count-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px; /* Consistent gap between cards */
            margin-top: 20px;
        }



        .count-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px; /* Set a fixed width for the cards */
            text-align: center;
            position: relative;
            z-index: 1;
            transition: box-shadow 0.3s ease, transform 0.2s ease;
        }

        .count-card h3 {
            font-size: 1.2em;
            margin-bottom: 10px;
            color: #333;
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

            .card {
                padding: 15px;
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

            .card {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Language Grouping Dashboard</h1>
    <h5>As for you, always be sober, endure suffering, do the work of an evangelist, carry out your ministry fully. (2 Timothy 4:5)</h5>
    <div class="count-container">
        <?php foreach ($data as $item): ?>
            <!--            <a href="canDetails" class="count-card">-->
        <a href="countryGroupingEvngCoord?wgroup=<?php echo $item['wgroup']; ?>" class="count-card">




        <h3 ><?php echo htmlspecialchars($item['wgroup']); ?></h3>
                <p><?php echo htmlspecialchars($item['total']); ?></p>
        </a> <!-- Closing the <a> tag -->
        <?php endforeach; ?>
    </div>

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