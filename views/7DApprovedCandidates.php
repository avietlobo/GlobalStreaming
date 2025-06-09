<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>7D Approved Candidates</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
            background: #eef2f5;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 26px;
            color: #2c3e50;
        }

        .back-button {
            display: inline-block;
            padding: 10px 18px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #2980b9;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1000px;
        }

        th, td {
            padding: 14px 18px;
            text-align: center;
            border-bottom: 1px solid #e0e0e0;
        }

        th {
            background-color: #3498db;
            color: #fff;
            font-size: 14px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        td {
            font-size: 14px;
            color: #555;
        }

        .no-data {
            text-align: center;
            margin-top: 50px;
            font-size: 20px;
            color: #999;
        }

        @media (max-width: 768px) {
            table {
                min-width: 700px;
            }
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
</div>

<div class="search-bar" style="margin: 20px 0;">
    <input type="text" id="searchInput" placeholder="Search by Mobile or Participant Name..." style="width: 100%; padding: 12px; font-size: 14px; border-radius: 8px; border: 1px solid #ccc;">
</div>

<div class="container">

    <div class="header">
        <h1>7D Approved Candidates</h1>
    </div>

    <?php if (!empty($models)): ?>
        <div class="table-wrapper">
            <table>
                <thead>
                <tr>
                    <th>Mobile</th>
                    <th>Record Date</th>
                    <th>Participant Name</th>
                    <th>Country</th>
                    <th>Language</th>
                    <th>Evangelist</th>
                    <th>Source</th>
                    <th>Alloted Days</th>
                    <th>Media Type</th>
                    <th>Active Status</th>
                    <th>User ID</th>
                    <th>Remark</th>
                    <th>WhatsApp Group</th>
                    <th>Caretaker Email</th>
                    <th>Updated By</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($models as $model): ?>
                    <tr>
                        <td><?= htmlspecialchars($model->mobile) ?></td>
                        <td><?= htmlspecialchars($model->recordDate) ?></td>
                        <td><?= htmlspecialchars($model->participantName) ?></td>
                        <td><?= htmlspecialchars($model->country) ?></td>
                        <td><?= htmlspecialchars($model->language) ?></td>
                        <td><?= htmlspecialchars($model->evangelist) ?></td>
                        <td><?= htmlspecialchars($model->source) ?></td>
                        <td><?= htmlspecialchars($model->allotedDays) ?></td>
                        <td><?= htmlspecialchars($model->mediaType) ?></td>
                        <td><?= htmlspecialchars($model->activeStatus) ?></td>
                        <td><?= htmlspecialchars($model->userid) ?></td>
                        <td><?= htmlspecialchars($model->remark) ?></td>
                        <td><?= htmlspecialchars($model->wgroup) ?></td>
                        <td><?= htmlspecialchars($model->caretaker_email) ?></td>
                        <td><?= htmlspecialchars($model->updatedBy) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="no-data">No approved candidates found.</div>
    <?php endif; ?>

</div>
<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        var input = this.value.toLowerCase();
        var rows = document.querySelectorAll('table tbody tr');
        rows.forEach(function (row) {
            var mobile = row.cells[0].textContent.toLowerCase();
            var name = row.cells[2].textContent.toLowerCase();
            if (mobile.includes(input) || name.includes(input)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>
