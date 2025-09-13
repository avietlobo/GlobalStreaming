<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CSV Upload Tracker</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7fafc;
            margin: 0;
            padding: 40px 20px;
            color: #2d3748;
        }

        .container {
            max-width: 960px;
            margin: auto;
        }

        .upload-form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            margin-bottom: 30px;
        }

        .upload-form h2 {
            font-size: 26px;
            margin-bottom: 20px;
            color: #2c5282;
        }

        .upload-form label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .upload-form input[type="file"] {
            display: block;
            padding: 10px;
            border: 1px solid #cbd5e0;
            border-radius: 8px;
            margin-bottom: 20px;
            width: 100%;
        }

        .upload-form button {
            background-color: #2b6cb0;
            color: #fff;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        .upload-form button:hover {
            background-color: #2c5282;
        }

        .status-box {
            background-color: #e6fffa;
            border: 1px solid #b2f5ea;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            color: #22543d;
        }

        .file-links a {
            display: inline-block;
            margin-right: 15px;
            color: #2b6cb0;
            font-weight: 600;
            text-decoration: none;
        }

        .file-links a:hover {
            text-decoration: underline;
        }

        .section-title {
            font-size: 22px;
            margin: 40px 0 20px;
            color: #2b6cb0;
            border-left: 5px solid #2b6cb0;
            padding-left: 12px;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        th, td {
            padding: 14px 16px;
            text-align: center;
        }

        thead {
            background-color: #2b6cb0;
            color: white;
            text-transform: uppercase;
            font-size: 14px;
        }

        tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }

        tbody tr:hover {
            background-color: #edf2f7;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-success { background-color: #c6f6d5; color: #22543d; }
        .badge-error   { background-color: #fed7d7; color: #742a2a; }
        .badge-pending { background-color: #bee3f8; color: #2a4365; }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }
            thead tr {
                display: none;
            }
            tbody td {
                position: relative;
                padding-left: 50%;
                text-align: left;
            }
            tbody td::before {
                position: absolute;
                left: 10px;
                top: 50%;
                transform: translateY(-50%);
                font-weight: bold;
                color: #4a5568;
                content: attr(data-label);
            }
        }
    </style>
</head>
<body>
<div class="container">

    <div class="button-group">
        <button type="button" class="back-button" onclick="window.location.href='/evngDashboard1'">Back</button>
    </div>

    <?php if (isset($errorMessage) && $errorMessage): ?>
        <div class="status-box" style="background-color: #fed7d7; border-color: #feb2b2; color: #742a2a;">
            ❌ <?= htmlspecialchars($errorMessage) ?>
        </div>
    <?php endif; ?>

    <div class="upload-form">
        <h2>📤 Upload CSV File</h2>
        <form action="/process_upload" method="post" enctype="multipart/form-data">
            <label for="csv_file">Select CSV File</label>
            <input type="file" name="csv_file" id="csv_file" required>
            <button type="submit">Upload</button>
        </form>
    </div>

    <?php if (isset($processId)): ?>
        <div class="status-box">
            ✅ File uploaded successfully with <strong>Process ID:</strong> <?= htmlspecialchars($processId) ?>
        </div>
    <?php endif; ?>

    <?php if (isset($errorFilePath) || isset($outputFilePath)): ?>
        <div class="file-links">
            <?php if (isset($errorFilePath)): ?>
                <a href="<?= htmlspecialchars($errorFilePath) ?>" download>📄 Download Error File</a>
            <?php endif; ?>
            <?php if (isset($outputFilePath)): ?>
                <a href="<?= htmlspecialchars($outputFilePath) ?>" download>📄 Download Output File</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($allUploads) && count($allUploads) > 0): ?>
        <h3 class="section-title">📋 Past Uploads</h3>
        <table>
            <thead>
            <tr>
                <th>Process ID</th>
                <th>Uploaded By</th>
                <th>Upload Time</th>
                <th>Status</th>
                <th>Total Rows</th>
                <th>Inserted</th>
                <th>Skipped</th>
                <th>Error File</th>
                <th>Output File</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($allUploads as $upload): ?>
                <tr>
                    <td data-label="Process ID"><?= htmlspecialchars($upload->process_id) ?></td>
                    <td data-label="Uploaded By"><?= htmlspecialchars($upload->uploadedBy) ?></td>
                    <td data-label="Upload Time"><?= htmlspecialchars($upload->upload_time) ?></td>
                    <td data-label="Status">
                        <?php
                        $status = strtolower($upload->status);
                        $class = 'badge-pending';
                        if ($status === 'success' || $status === 'completed') {
                            $class = 'badge-success';
                        } elseif ($status === 'failed' || $status === 'error') {
                            $class = 'badge-error';
                        }
                        ?>
                        <span class="badge <?= $class ?>">
    <?= htmlspecialchars(ucfirst($upload->status)) ?>
</span>
                    </td>
                    <td data-label="Total Rows"><?= htmlspecialchars($upload->total_rows) ?></td>
                    <td data-label="Inserted"><?= htmlspecialchars($upload->inserted_rows) ?></td>
                    <td data-label="Skipped"><?= htmlspecialchars($upload->skipped_rows) ?></td>
                    <td data-label="Error File">
                        <?php if (!empty($upload->error_file) && file_exists($upload->error_file)): ?>
                            <a href="<?= $upload->error_file ?>" download>Download</a>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>
                    <td data-label="Output File">
                        <?php if (!empty($upload->output_file) && file_exists($upload->output_file)): ?>
                            <a href="<?= $upload->output_file ?>" download>Download</a>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</div>
</body>
</html>
