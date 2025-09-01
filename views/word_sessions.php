<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Word Sharing Sessions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f4f5;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .table-wrapper {
            overflow-x: auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            background: white;
            padding: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        th, td {
            padding: 12px 10px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f1f1f1;
            font-weight: 600;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }

        .status-label {
            font-weight: bold;
            border-radius: 5px;
            padding: 3px 8px;
        }

        .status-approved {
            color: #2e7d32;
            background: #c8e6c9;
        }

        .status-rejected {
            color: #c62828;
            background: #ffcdd2;
        }

        button {
            padding: 6px 12px;
            font-size: 0.9rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .approve-btn {
            background-color: #4CAF50;
            color: white;
        }

        .reject-btn {
            background-color: #f44336;
            color: white;
        }

        @media (max-width: 768px) {
            table {
                font-size: 0.85rem;
                min-width: unset;
            }

            th, td {
                padding: 8px;
            }

            .approve-btn, .reject-btn {
                font-size: 0.8rem;
                padding: 5px 10px;
            }
        }
    </style>

    <script>
        function confirmAction(message) {
            return confirm(message);
        }
    </script>
</head>
<body>
<div class="header">
    <a class="nav-link" href="#" id="logout-link">
        <button type="button" class="btn btn-primary">Logout</button>
    </a>
</div>
<a class="back-link" href="/evngDashboard1">← Back </a>
<h2>📖 Word Sharing Sessions Assigned to You</h2>

<div class="table-wrapper">
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Mobile</th>
            <th>Candidate Name</th>
            <th>Status</th>
            <th>Remarks</th>
            <th>Language</th>
            <th>Assigned By</th>
            <th>Created At</th>
            <th>✅ Approve</th>
            <th>❌ Reject</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($sessions)): ?>
            <?php foreach ($sessions as $session): ?>
                <tr>
                    <td><?= htmlspecialchars($session->id) ?></td>
                    <td><?= htmlspecialchars($session->mobile) ?></td>
                    <td><?= htmlspecialchars($session->candidateName) ?></td>
                    <td>
                        <?php if ($session->status === 'Approved'): ?>
                            <span class="status-label status-approved">Approved</span>
                        <?php elseif ($session->status === 'Rejected'): ?>
                            <span class="status-label status-rejected">Rejected</span>
                        <?php else: ?>
                            <span class="status-label">Pending</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($session->remarks) ?></td>
                    <td><?= htmlspecialchars($session->language) ?></td>
                    <td><?= htmlspecialchars($session->assigned_by) ?></td>
                    <td><?= htmlspecialchars($session->created_at) ?></td>

                    <td>
                        <?php if ($session->status !== 'Approved' && $session->status !== 'Rejected'): ?>
                            <form method="post" action="/approveWordSession" onsubmit="return confirmAction('Are you sure you want to APPROVE this session?');">
                                <input type="hidden" name="mobile" value="<?= htmlspecialchars($session->mobile) ?>">
                                <input type="hidden" name="action" value="Approved">
                                <button class="approve-btn" type="submit">Approve</button>
                            </form>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php if ($session->status !== 'Approved' && $session->status !== 'Rejected'): ?>
                            <form method="post" action="/approveWordSession" onsubmit="return confirmAction('Are you sure you want to REJECT this session?');">
                                <input type="hidden" name="mobile" value="<?= htmlspecialchars($session->mobile) ?>">
                                <input type="hidden" name="action" value="Rejected">
                                <button class="reject-btn" type="submit">Reject</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="10" style="text-align: center;">No sessions assigned yet.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
