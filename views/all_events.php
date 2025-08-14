<h2 class="text-center mb-4">📅 All Sathvartha Events</h2>

<div class="events-grid">
    <?php if (!empty($events)): ?>
        <?php foreach ($events as $event): ?>
            <div class="event-card">
                <h3><?= htmlspecialchars($event['event_name']) ?></h3>
                <p><strong>Start:</strong> <?= htmlspecialchars($event['start_date']) ?></p>
                <p><strong>End:</strong> <?= htmlspecialchars($event['end_date']) ?></p>
                <p><strong>Main Language:</strong> <?= htmlspecialchars($event['main_language']) ?></p>
                <p><strong>Translation:</strong> <?= htmlspecialchars($event['translation_language']) ?></p>
                <p><strong>Organizer:</strong> <?= htmlspecialchars($event['event_organizer']) ?></p>
                <p><strong>Local Organizer:</strong> <?= htmlspecialchars($event['local_organizer']) ?></p>

                <?php if (!empty($event['event_link'])): ?>
                    <p><a href="<?= htmlspecialchars($event['event_link']) ?>" target="_blank">🌐 Event Link</a></p>
                <?php endif; ?>

                <?php if (!empty($event['attendance_report'])): ?>
                    <p><a href="<?= htmlspecialchars($event['attendance_report']) ?>" download>📥 Attendance Report</a></p>
                <?php endif; ?>

                <p><strong>Total Attended:</strong> <?= (int)$event['total_attended'] ?></p>
                <p><strong>Positive Count:</strong> <?= (int)$event['positive_count'] ?></p>

                <?php if (!empty($event['notes'])): ?>
                    <p><em>📝 <?= htmlspecialchars($event['notes']) ?></em></p>
                <?php endif; ?>

                <!-- Click Here Button -->
                <div class="text-center mt-3">
                    <a href="/organizeEvent?id=<?= $event['id'] ?>&event_name=<?= urlencode($event['event_name']) ?>"
                       class="btn-click">
                        Click Here
                    </a>
                </div>
            </div> <!-- ✅ properly closed -->
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center text-muted">No events found.</p>
    <?php endif; ?>
</div>

<style>
    body {
        background-color: #f4f6f9;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }
    .events-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin: 20px;
    }
    .event-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .event-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    .event-card h3 {
        margin-top: 0;
        margin-bottom: 12px;
        color: #2b7cff;
        font-size: 20px;
    }
    .event-card p {
        margin: 6px 0;
        color: #333;
    }
    .event-card a {
        text-decoration: none;
        color: #2b7cff;
    }
    .btn-click {
        display: inline-block;
        padding: 8px 16px;
        background: #2b7cff;
        color: white !important;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        transition: background 0.2s;
    }
    .btn-click:hover {
        background: #1a5ec9;
    }
</style>
