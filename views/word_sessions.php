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
            font-family: 'Roboto', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 40px 0 20px 0;
            border-bottom: 2px solid #2980b9;
            padding-bottom: 10px;
            letter-spacing: 0.5px;
        }

        @media (max-width: 768px) {
            h2 {
                font-size: 1.4rem;
                margin: 30px 0 15px 0;
                padding-bottom: 8px;
            }
        }

        @media (max-width: 480px) {
            h2 {
                font-size: 1.2rem;
                margin: 25px 0 10px 0;
                padding-bottom: 6px;
            }
        }

        .table-wrapper {
            overflow-x: auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            background: white;
            padding: 10px;

            scrollbar-width: thin; /* For Firefox */
            scrollbar-color: #2980b9 #f1f1f1;
        }

        /* Chrome, Edge, Safari */
        .table-wrapper::-webkit-scrollbar {
            height: 12px;  /* Thicker scrollbar */
        }

        .table-wrapper::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 6px;
        }

        .table-wrapper::-webkit-scrollbar-thumb {
            background-color: #2980b9;
            border-radius: 6px;
            border: 3px solid #f1f1f1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            /* Removed min-width */
        }

        th, td {
            padding: 12px 10px;
            text-align: left;
            border-bottom: 1px solid #eee;
            white-space: nowrap; /* Prevents buttons from wrapping */
        }

        th {
            background-color: #f1f1f1;
            font-weight: 600;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }

        button {
            padding: 6px 12px;
            font-size: 0.9rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            white-space: nowrap; /* Ensure button text does not break */
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
            }

            th, td {
                padding: 8px;
            }

            .approve-btn, .reject-btn {
                font-size: 0.8rem;
                padding: 5px 10px;
            }
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
        .scroll-hint {
            text-align: center;
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 8px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            user-select: none;
        }

        .header {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 10px 0;
            background: #f4f4f5; /* Optional: to match background */
        }

        .logout-link {
            padding: 8px 16px;
            font-size: 0.95rem;
            background: #007bff;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .logout-link:hover {
            background: #0056b3;
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
    <a class="nav-link logout-link" href="#" id="logout-link">Logout</a>
</div>
<a class="back-link" href="/evngDashboard1">← Back </a>
<h2>📖 Approve / Reject Word Sessions</h2>
<div class="scroll-hint">👉 Swipe right to see all columns</div>
<div class="table-wrapper">
    <table>
        <thead>
        <tr>

            <th>Mobile</th>
            <th>Candidate Name</th>
            <th>Status</th>
            <th>✅ Approve</th>
            <th>❌ Reject</th>
            <th>Remarks</th>
            <th>Language</th>
            <th>Assigned By</th>
            <th>Created At</th>
            <th>ID</th>

        </tr>
        </thead>
        <tbody>
        <?php if (!empty($sessions)): ?>
            <?php foreach ($sessions as $session): ?>
                <tr>

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
                    <td><?= htmlspecialchars($session->remarks) ?></td>
                    <td><?= htmlspecialchars($session->language) ?></td>
                    <td><?= htmlspecialchars($session->assigned_by) ?></td>
                    <td><?= htmlspecialchars($session->created_at) ?></td>
                    <td><?= htmlspecialchars($session->id) ?></td>


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
