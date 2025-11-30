<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Sathvartha Event</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Base Styles */
        * {
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f9fc;
            color: #2d3748;
        }

        h2 {
            text-align: center;
            font-size: 1.8rem;
            margin: 1.5rem 0;
            color: #1a202c;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        /* Header and Buttons */
        .header {
            display: flex;
            justify-content: flex-end;
            background: #fff;
            padding: 0.75rem 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .logout-button {
            background-color: #e53e3e;
            color: white;
            padding: 6px 16px;
            border: none;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .logout-button:hover {
            background-color: #c53030;
            transform: translateY(-1px);
        }

        .container {
            padding: 1rem 2rem;
            max-width: 1200px;
            margin: auto;
        }

        .back-button {
            background-color: #3182ce;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 0.85rem;
            padding: 6px 12px;
            cursor: pointer;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background-color: #2b6cb0;
            transform: translateY(-1px);
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
            overflow: auto;
            padding-top: 80px;
        }

        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 2rem;
            border-radius: 12px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            position: relative;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .close {
            position: absolute;
            top: 14px;
            right: 18px;
            width: 32px;
            height: 32px;
            background: #edf2f7;
            border-radius: 50%;
            color: #2d3748;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            line-height: 30px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .close:hover {
            background: #e53e3e;
            color: #fff;
            transform: scale(1.1);
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        label {
            font-weight: 600;
            font-size: 0.95rem;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #cbd5e0;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #3182ce;
            outline: none;
        }

        button[type="submit"] {
            background-color: #38a169;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #2f855a;
            transform: translateY(-1px);
        }

        /* Add Button */
        .add-event-button {
            background-color: #3182ce;
            color: white;
            padding: 8px 18px;
            border: none;
            border-radius: 20px;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .add-event-button:hover {
            background-color: #2b6cb0;
            transform: translateY(-1px);
        }

        /* Event Cards */
        .event-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 1rem;
        }

        .event-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            padding: 20px;
            max-width: 300px;
            width: 100%;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            position: relative;
        }

        .event-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .event-card h3 {
            margin: 0;
            font-size: 1.1rem;
            color: #2d3748;
        }

        .event-card p {
            margin: 6px 0;
            color: #4a5568;
            font-size: 0.9rem;
        }

        .event-card a {
            text-decoration: none;
            color: inherit;
        }

        .edit-icon {
            position: absolute;
            top: 12px;
            right: 12px;
            font-size: 16px;
        }

        /* Responsive */
        @media (max-width: 600px) {
            h2 {
                font-size: 1.4rem;
            }
            .modal-content {
                padding: 1.5rem;
            }
        }

        h3 {
            word-wrap: break-word;
            overflow-wrap: anywhere;
            white-space: normal;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f4f4f5;
            padding: 10px 16px;
            border-bottom: 1px solid #ddd;
        }

        .back-button,
        .logout-button {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 14px;
            padding: 6px 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.1s ease;
        }

        .back-button {
            background: #e9ecef;
            color: #007bff;
        }

        .back-button:hover {
            background: #dce3eb;
            transform: translateX(-2px);
        }

        .logout-button {
            background: #007bff;
            color: #fff;
        }

        .logout-button:hover {
            background: #0056b3;
            transform: translateY(-1px);
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .header {
                flex-direction: column;
                align-items: stretch;
                gap: 8px;
            }

            .back-button,
            .logout-button {
                width: 100%;
                font-size: 15px;
            }
        }

        .top-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 12px;
            margin-bottom: 10px;
            background: transparent; /* ✅ no container boundary */
        }

        .back-button,
        .logout-button {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 13px;
            padding: 6px 12px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.25s ease, transform 0.15s ease;
        }

        /* Subtle modern button styles */
        .back-button {
            background-color: #f1f3f4;
            color: #007bff;
        }

        .back-button:hover {
            background-color: #e2e6ea;
            transform: translateX(-2px);
        }

        .logout-button {
            background-color: #007bff;
            color: #fff;
        }

        .logout-button:hover {
            background-color: #0056b3;
            transform: translateY(-1px);
        }

        /* ✅ Mobile responsive adjustments */
        @media (max-width: 600px) {
            .top-actions {
                flex-direction: column;
                align-items: stretch;
                gap: 8px;
            }

            .back-button,
            .logout-button {
                width: 100%;
                font-size: 14px;
            }
        }


    </style>
</head>
<body>

<div class="top-actions">
    <button type="button" class="back-button" onclick="window.location.href='/evngDashboard1'">
        ← Back
    </button>

    <button type="button" id="logout-link" class="logout-button">
        Logout
    </button>
</div>


<!-- Modal -->
<div style="text-align: center; margin: 1rem 0;">
    <button id="openModalBtn" class="add-event-button">
        ➕ Add New Event
    </button>
</div>
<div id="eventModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <!-- Your current form goes here -->
        <form method="post" action="" id="eventForm">

                <label>Event Name *</label>
                <input type="text" name="event_name" required value="<?= htmlspecialchars($formData['event_name'] ?? '') ?>">

            <?php if (!empty($errorMessage)): ?>
                <div class="alert alert-danger" style="background-color:#ffe6e6; color:#cc0000; padding:10px; margin-bottom:15px;">
                    <?= htmlspecialchars($errorMessage) ?>
                </div>
            <?php endif; ?>
                <label>Start Date *</label>
                <input type="datetime-local" name="start_date" required>

                <label>End Date *</label>
                <input type="datetime-local" name="end_date" required>

            <label>Main Language *</label>
            <select name="main_language" required>
                <option value="">-- Select Language --</option>
                <option value="English">English</option>
                <option value="Hindi">Hindi</option>
                <option value="Konkani">Konkani</option>
                <option value="Malayalam">Malayalam</option>
                <option value="Portuguese">Portuguese</option>
                <option value="Tamil">Tamil</option>
                <option value="Italian">Italian</option>
                <option value="Tagalog">Tagalog</option>
                <option value="French">French</option>
                <option value="Arabic">Arabic</option>
                <option value="Spanish">Spanish</option>
            </select>

            <label>Translation Language *</label>
            <select name="translation_language" required>
                <option value="">-- Select Language --</option>
                <option value="English">English</option>
                <option value="Hindi">Hindi</option>
                <option value="Konkani">Konkani</option>
                <option value="Malayalam">Malayalam</option>
                <option value="Portuguese">Portuguese</option>
                <option value="Tamil">Tamil</option>
                <option value="Italian">Italian</option>
                <option value="Tagalog">Tagalog</option>
                <option value="French">French</option>
                <option value="Arabic">Arabic</option>
                <option value="Spanish">Spanish</option>
            </select>

                <label>Home Mission Organizer</label>
                <select name="event_organizer">
                    <option value="">-- Select Organizer --</option>
                    <?php foreach ($sathvarthaOrganizers as $organizer): ?>
                        <option value="<?= htmlspecialchars($organizer->evngName) ?>"><?= htmlspecialchars($organizer->evngName) ?></option>
                    <?php endforeach; ?>
                </select>

                <label>Local Organizer</label>
                <select name="local_organizer">
                    <option value="">-- Select Local Organizer --</option>
                    <?php foreach ($localOrganizers as $organizer): ?>
                        <option value="<?= htmlspecialchars($organizer->evngName) ?>"><?= htmlspecialchars($organizer->evngName) ?></option>
                    <?php endforeach; ?>
                </select>

                <label>Event Link (Zoom/Google Meet/Youtube)</label>
                <input type="url" name="event_link" placeholder="https://...">

                <label>Notes</label>
                <textarea name="notes" rows="4" placeholder="Additional event details..."></textarea>

                <button type="submit">Create Event</button>

        </form>
    </div>
</div>
<?php if (!empty($existingEvents)): ?>


    <!-- 🔍 Search Bar -->
    <div style="text-align: center; margin: 1rem 0;">
        <input type="text" id="searchInput" placeholder="Search events by name, language, or organizer..."
               style="padding: 10px 14px; width: 90%; max-width: 400px; border: 1px solid #cbd5e0;
                      border-radius: 20px; font-size: 0.95rem; outline: none;
                      box-shadow: 0 1px 2px rgba(0,0,0,0.05); transition: all 0.3s ease;">
    </div>


<?php endif; ?>

<?php if (!empty($existingEvents)): ?>
    <h2 style="margin-top: 40px;">📅 Home Mission Events</h2>

    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
        <?php foreach ($existingEvents as $event): ?>
            <div class="event-card">
                <a href="/event-details1?id=<?= $event['id'] ?>" style="text-decoration: none; color: inherit;">
                    <h3><?= htmlspecialchars($event['event_name']) ?></h3>
                    <p style="margin: 6px 0; font-size: 14px; color: #555;">
                        🗓 <?= htmlspecialchars($event['start_date']) ?> → <?= htmlspecialchars($event['end_date']) ?><br>
                        🌐 <?= htmlspecialchars($event['main_language']) ?>
                        <?php if (!empty($event['translation_language'])): ?>
                            | 🔁 <?= htmlspecialchars($event['translation_language']) ?>
                        <?php endif; ?>
                    </p>
                    <p style="font-size: 13px; color: #777;">👤 <?= htmlspecialchars($event['event_organizer']) ?></p>
                </a>

                <!-- ✏️ Edit icon -->
                <a href="/edit-event1?id=<?= $event['id'] ?>" class="edit-icon">✏️</a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>


<script>
    const modal = document.getElementById("eventModal");
    const btn = document.getElementById("openModalBtn");
    const span = document.getElementsByClassName("close")[0];

    btn.onclick = () => modal.style.display = "block";

    span.onclick = () => {
        modal.style.display = "none";
        document.querySelector('.alert')?.remove(); // remove alert
        document.getElementById("eventForm").reset(); // clear form
        document.querySelector('[name="event_name"]').value = '';
    };

    window.onclick = (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
            document.querySelector('.alert')?.remove(); // remove alert
            document.getElementById("eventForm").reset(); // clear form
            document.querySelector('[name="event_name"]').value = ''; // clear event name manually
        }
    };

    <?php if (!empty($errorMessage)): ?>
    window.onload = function() {
        modal.style.display = "block";
    };
    <?php endif; ?>
</script>
<script>
    const searchInput = document.getElementById('searchInput');
    const eventCards = document.querySelectorAll('.event-card');

    searchInput?.addEventListener('keyup', function () {
        const query = this.value.toLowerCase().trim();

        eventCards.forEach(card => {
            const text = card.textContent.toLowerCase();
            card.style.display = text.includes(query) ? 'block' : 'none';
        });
    });
</script>


</body>
</html>
