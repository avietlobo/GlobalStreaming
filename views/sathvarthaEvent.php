<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Sathvartha Event</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 1rem;
            background-color: #f4f4f5;
            margin: 0;
        }

        h2 {
            text-align: center;
            font-size: 1.6rem;
            margin-bottom: 1rem;
        }

        form {
            background: #fff;
            padding: 1.5rem;
            border-radius: 10px;
            max-width: 700px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.08);
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 1rem;
            font-size: 0.95rem;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 0.3rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        textarea {
            resize: vertical;
        }

        button {
            background: #28a745;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 1.5rem;
            font-size: 1rem;
            width: 100%;
        }

        button:hover {
            background: #218838;
        }

        @media (max-width: 600px) {
            form {
                padding: 1rem;
            }

            h2 {
                font-size: 1.4rem;
            }

            label {
                font-size: 0.9rem;
            }

            input, select, textarea {
                font-size: 0.95rem;
                padding: 8px;
            }

            button {
                font-size: 0.95rem;
                padding: 10px;
            }
        }

        .back-button {
            background-color: #007bff !important;
            color: white;
            padding: 4px 10px !important;
            border: none;
            border-radius: 4px;
            font-size: 0.75rem !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: auto !important;
            cursor: pointer;
            margin-bottom: 1rem;
            transition: background-color 0.3s, transform 0.3s;
        }

        .back-button i {
            margin-right: 5px;
            font-size: 12px;
        }

        .back-button:hover {
            background-color: #0056b3;
            transform: translateY(-1px);
        }

        .back-button:active {
            background-color: #004085;
            transform: translateY(0);
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            padding-top: 80px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 2rem;
            border-radius: 8px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            position: relative;  /* ✅ Important for absolute positioning inside */
        }

        .close {
            position: absolute;
            top: 12px;
            right: 16px;
            width: 34px;
            height: 34px;
            background: #ddd;   /* ✅ darker gray so always visible */
            border: 2px solid #ccc;  /* ✅ clear circle outline */
            border-radius: 50%;
            color: #333;
            font-size: 20px;
            font-weight: bold;
            line-height: 30px;
            text-align: center;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s, color 0.3s;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }

        .close:hover {
            background: #e74c3c;   /* bright red */
            border-color: #c0392b;
            color: #fff;
            transform: scale(1.1);
        }


        .add-event-button {
            background-color: #007bff;
            color: white;
            padding: 6px 14px;
            border: none;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0,0,0,0.15);
            transition: background-color 0.3s, transform 0.2s;
            width: auto;   /* ✅ fixes the large width */
        }

        .add-event-button:hover {
            background-color: #0056b3;
            transform: translateY(-1px);
        }

        .add-event-button:active {
            background-color: #004085;
            transform: translateY(0);
        }

        .logout-button {
            background-color: #007bff;  /* softer red */
            color: white;
            padding: 6px 14px;
            border: none;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0,0,0,0.15);
            transition: background-color 0.3s, transform 0.2s;
            width: auto;   /* ✅ fixes large width */
        }

        .logout-button:hover {
            background-color: #c0392b;
            transform: translateY(-1px);
        }

        .logout-button:active {
            background-color: #96281b;
            transform: translateY(0);
        }

        .header {
            display: flex;
            justify-content: flex-end;  /* aligns logout to top-right */
            padding: 0.5rem 1rem;
        }


    </style>
</head>
<body>

<div class="header">
    <button type="button" id="logout-link" class="logout-button">
        🚪 Logout
    </button>
</div>

<div class="container">
    <button type="button" class="back-button" onclick="window.location.href='/evngDashboard1'">
        <i class="fas fa-arrow-left"></i> Back
    </button>
</div>

<h2>Add New Sathvartha Event</h2>
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
                <input type="date" name="start_date" required>

                <label>End Date *</label>
                <input type="date" name="end_date" required>

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

                <label>Sathvartha Organizer</label>
                <select name="event_organizer" required>
                    <option value="">-- Select Organizer --</option>
                    <?php foreach ($sathvarthaOrganizers as $organizer): ?>
                        <option value="<?= htmlspecialchars($organizer->evngName) ?>"><?= htmlspecialchars($organizer->evngName) ?></option>
                    <?php endforeach; ?>
                </select>

                <label>Local Organizer</label>
                <select name="local_organizer" required>
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
    <h2 style="margin-top: 40px;">📅 All Events</h2>
    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
        <?php foreach ($existingEvents as $event): ?>
            <div style="
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 20px;
            width: 100%;
            max-width: 300px;
            transition: box-shadow 0.2s ease;
            position: relative;
        ">
                <a href="/event-details?id=<?= $event['id'] ?>" style="text-decoration: none; color: inherit;">
                    <h3 style="margin: 0; font-size: 18px;"><?= htmlspecialchars($event['event_name']) ?></h3>
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
                <a href="/edit-event?id=<?= $event['id'] ?>" style="position: absolute; top: 10px; right: 10px; text-decoration: none;">
                    <span style="font-size: 16px;">✏️</span>
                </a>
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

</body>
</html>
