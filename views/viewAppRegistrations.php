<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve/Reject Form</title>

    <!-- Include Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Include Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif; /* Apply Roboto font to the whole page */
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #333;
            text-align: center;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-family: 'Roboto', sans-serif; /* Apply Roboto font to the table */
            font-size: 14px; /* Adjust the font size for better readability */
        }

        th, td {
            padding: 12px; /* Increased padding for better spacing */
            text-align: left;
            border: 1px solid #ddd;
            white-space: nowrap;
        }

        th {
            background-color: #f1f1f1;
            font-weight: 500; /* Use medium weight for headers */
        }

        td {
            background-color: #fff;
        }

        .table-container {
            overflow-x: auto;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;  /* Smaller padding */
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;  /* Smaller border radius */
            cursor: pointer;
            text-decoration: none;
            font-size: 13px;  /* Smaller font size */
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-top: 15px;
        }

        .back-button:hover {
            background-color: #0056b3;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
        }

        .back-button i {
            margin-right: 5px;  /* Adjusted margin for a tighter look */
        }

        .header {
            display: flex;
            justify-content: flex-end;
            padding: 10px 20px;
            background-color: #ffffff; /* Optional: set to transparent or the same as the body background */
            box-shadow: none; /* Remove the box-shadow to eliminate the gray line */
        }
    </style>
</head>
<body>
<div class="header">
    <a class="nav-link" href="#" id="logout-link">
        <button type="button" class="btn btn-primary">Logout</button>
    </a>
</div>

<div class="container">
    <button type="button" class="back-button" onclick="window.location.href='/evngDashboard1'">
        <i class="fas fa-arrow-left"></i> Back
    </button>
    <h1>Global Member Registration</h1>

    <!-- Table of members in a scrollable container -->
    <div class="table-container">
        <table>
            <thead>
            <tr>
                <th>Entry Date</th>
                <th>Zion ID</th>
                <th>Evangelist</th>
                <th>Mobile</th>
                <th>Fellowship</th>
                <th>Email</th>
                <th>Status</th>
                <th>Rejected Reason</th>
                <th>Updated By</th>
                <th>Designation</th>
            </tr>
            </thead>
            <tbody>
            <!-- Loop through each member in the 'members' array -->
            <?php use app\core\Application;

            foreach ($members as $member): ?>
                <tr>
                    <td><?= $member['entryDate'] ?></td>
                    <td><?= $member['zion_id'] ?></td>
                    <td><?= $member['evngName'] ?></td>
                    <td><?= $member['mobile'] ?></td>
                    <td><?= $member['fellowship'] ?></td>
                    <td><?= $member['email'] ?></td>
                    <td><?= $member['status'] ?></td>
                    <td><?= isset($member['reject_reason']) ? $member['reject_reason'] : 'N/A' ?></td>
                    <td><?= $member['updatedBy'] ?></td>
                    <td><?= isset($member['designation']) ? $member['designation'] : 'N/A' ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
