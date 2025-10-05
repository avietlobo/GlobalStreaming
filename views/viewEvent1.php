<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>📋 Event Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f7fa;
        }

        .card {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            padding: 30px;
        }

        .card h2 {
            margin-top: 0;
            font-size: 22px;
            color: #2c3e50;
            text-align: center;
            background: #eef4fc;
            padding: 12px;
            border-radius: 8px;
            border-bottom: 2px solid #4a90e2;
        }


        .detail-item {
            margin: 15px 0;
            font-size: 16px;
        }

        .detail-item strong {
            display: inline-block;
            width: 160px;
            color: #555;
        }

        .actions {
            display: flex;
            justify-content: center;
            margin-top: 30px;
            gap: 15px;
            flex-wrap: wrap;
        }

        .actions a {
            text-decoration: none;
            color: #fff;
            background-color: #4a90e2;
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 15px;
            transition: background-color 0.3s;
        }

        .actions a:hover {
            background-color: #357ab8;
        }

        @media screen and (max-width: 600px) {
            .detail-item strong {
                width: 100%;
                display: block;
                margin-bottom: 5px;
            }

            .detail-item {
                font-size: 15px;
            }

            .actions {
                flex-direction: column;
                gap: 10px;
            }
        }

        .event-title {
            background: #f9fafb;
            border-left: 4px solid #4a90e2;
            padding: 10px;
            border-radius: 6px;
            font-weight: 500;
            color: #444;
            line-height: 1.4;
            word-break: break-word;
            white-space: normal;
            overflow-wrap: break-word;
        }

    </style>
</head>
<body>

<div class="card">
    <h2>📋 Event Details</h2>

    <div class="detail-item event-name">
        <strong>Event:</strong>
        <div class="event-title">
            <?= htmlspecialchars($event['event_name']) ?>
        </div>
    </div>
    <div class="detail-item">
        <strong>Dates:</strong> <?= $event['start_date'] ?> → <?= $event['end_date'] ?>
    </div>
    <div class="detail-item">
        <strong>Home Mission Organizer:</strong> <?= htmlspecialchars($event['event_organizer']) ?>
    </div>
    <div class="detail-item">
        <strong>Local Organizer:</strong> <?= htmlspecialchars($event['local_organizer']) ?>
    </div>
    <div class="detail-item">
        <strong>Main Language:</strong> <?= htmlspecialchars($event['main_language']) ?>
    </div>
    <div class="detail-item">
        <strong>Translation Language:</strong> <?= htmlspecialchars($event['translation_language']) ?>
    </div>
    <div class="detail-item">
        <strong>Notes:</strong> <?= htmlspecialchars($event['notes']) ?>
    </div>
    <div class="detail-item">
        <strong>Created By:</strong> <?= htmlspecialchars($event['created_by']) ?>
    </div>
    <div class="detail-item">
        <strong>Updated By:</strong> <?= htmlspecialchars($event['updated_by']) ?>
    </div>
    <div class="detail-item">
        <strong>Created Date:</strong> <?= htmlspecialchars($event['created_at']) ?>
    </div>
    <div class="detail-item">
        <strong>Updated Date:</strong> <?= htmlspecialchars($event['updated_at']) ?>
    </div>
    <div class="detail-item">
        <strong>Event Link:</strong> <?= htmlspecialchars($event['event_link']) ?>
    </div>
    <div class="detail-item">
        <strong>Total Attended:</strong> <?= htmlspecialchars($event['total_attended']) ?>
    </div>
    <div class="detail-item">
        <strong>Total Positive:</strong> <?= htmlspecialchars($event['positive_count']) ?>
    </div>

    <?php if (!empty($event['attendance_report'])): ?>
        <div class="detail-item">
            <strong>Attendance Report:</strong>
            <a href="<?= htmlspecialchars($event['attendance_report']) ?>" target="_blank" style="color: #4a90e2;">
                📄 View / Download Report
            </a>
        </div>
    <?php endif; ?>

    <div class="actions">
        <a href="/edit-event1?id=<?= $event['id'] ?>">✏️ Edit Event</a>
        <a href="/addNewHomeEvent">⬅️ Back to All Events</a>
    </div>
</div>

</body>
</html>
