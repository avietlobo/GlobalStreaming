<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Event</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f2f5;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #2c3e50;
            font-size: 1.4rem;
            word-wrap: break-word;         /* ✅ Allows long words to wrap */
            overflow-wrap: break-word;     /* ✅ Modern browsers */
            white-space: normal;           /* ✅ Allows wrapping */
            line-height: 1.4;
            max-width: 100%;               /* ✅ Prevent overflow from container */
            padding: 0 10px;               /* ✅ Adds breathing space on sides */
            word-break: break-word;        /* ✅ Handles very long URLs/names */
        }


        label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            margin-top: 15px;
            color: #34495e;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccd1d9;
            border-radius: 6px;
            font-size: 16px;
            background-color: #f9f9f9;
            transition: border 0.3s ease;
        }

        input:focus {
            border-color: #2980b9;
            background-color: #fff;
            outline: none;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
            flex-wrap: wrap;
            gap: 10px;
        }

        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

        a.back-link {
            text-decoration: none;
            color: #2c3e50;
            font-size: 16px;
            padding: 12px 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background-color: #ecf0f1;
            transition: background-color 0.2s ease;
        }

        a.back-link:hover {
            background-color: #dfe6e9;
        }

        @media (max-width: 480px) {
            .actions {
                flex-direction: column;
                align-items: stretch;
            }
        }
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccd1d9;
            border-radius: 6px;
            font-size: 16px;
            background-color: #f9f9f9;
            transition: border 0.3s ease;
            appearance: none; /* optional, removes default OS styling */
        }

        select:focus {
            border-color: #2980b9;
            background-color: #fff;
            outline: none;
        }
        select, input {
            margin-bottom: 15px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccd1d9;
            border-radius: 6px;
            font-size: 16px;
            background-color: #f9f9f9;
            transition: border 0.3s ease;
            resize: vertical;
        }

        textarea:focus {
            border-color: #2980b9;
            background-color: #fff;
            outline: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>✏️ Edit Event: <?= htmlspecialchars($event['event_name']) ?></h2>

    <form method="POST" enctype="multipart/form-data">
        <label>Event Name</label>
        <input name="event_name" value="<?= htmlspecialchars($event['event_name']) ?>" required>

        <label>Start Date</label>
        <input type="datetime-local" name="start_date" value="<?= $event['start_date'] ?>" required>

        <label>End Date</label>
        <input type="datetime-local" name="end_date" value="<?= $event['end_date'] ?>" required>



        <!-- Local Organizer Dropdown -->
        <label for="local_organizer">Local Organizer</label><br>
        <select name="local_organizer" id="local_organizer" required>
            <option value="">-- Select Local Organizer --</option>
            <?php foreach ($localOrganizers as $organizer): ?>
                <?php $name = htmlspecialchars($organizer->evngName); ?>
                <option value="<?= $name ?>" <?= ($event['local_organizer'] === $organizer->evngName) ? 'selected' : '' ?>>
                    <?= $name ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Sathvartha Organizer Dropdown -->
        <!-- Sathvartha Organizer Dropdown -->
        <label for="event_organizer">Sathvartha Organizer</label><br>
        <select name="event_organizer" id="event_organizer" required>
            <option value="">-- Select Sathvartha Organizer --</option>
            <?php foreach ($sathvarthaOrganizers as $organizer): ?>
                <?php $name = htmlspecialchars($organizer->evngName); ?>
                <option value="<?= $name ?>" <?= ($event['event_organizer'] === $organizer->evngName) ? 'selected' : '' ?>>
                    <?= $name ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Main Language</label>
        <select name="main_language" required>
            <option value="">-- Select Language --</option>
            <?php
            $languages = ['English', 'Hindi', 'Konkani', 'Malayalam', 'Portuguese', 'Tamil', 'Italian', 'Tagalog', 'French', 'Arabic', 'Spanish'];
            $currentLanguage = htmlspecialchars($event['main_language']);

            // If current language is not in list, add it as the first option
            if (!in_array($event['main_language'], $languages)) {
                echo '<option value="' . $currentLanguage . '" selected>' . $currentLanguage . ' (Other)</option>';
            }

            foreach ($languages as $lang) {
                $selected = ($event['main_language'] === $lang) ? 'selected' : '';
                echo '<option value="' . $lang . '" ' . $selected . '>' . $lang . '</option>';
            }
            ?>
        </select>

        <label>Translation Language</label>
        <select name="translation_language" required>
            <option value="">-- Select Language --</option>
            <?php
            $languages = ['English', 'Hindi', 'Konkani', 'Malayalam', 'Portuguese', 'Tamil', 'Italian', 'Tagalog', 'French', 'Arabic', 'Spanish'];
            $currentLanguage = htmlspecialchars($event['translation_language']);

            // If current language is not in list, add it as the first option
            if (!in_array($event['translation_language'], $languages)) {
                echo '<option value="' . $currentLanguage . '" selected>' . $currentLanguage . ' (Other)</option>';
            }

            foreach ($languages as $lang) {
                $selected = ($event['translation_language'] === $lang) ? 'selected' : '';
                echo '<option value="' . $lang . '" ' . $selected . '>' . $lang . '</option>';
            }
            ?>
        </select>

        <label for="event_link">Event Link (Zoom/Google Meet/Youtube)</label>
        <input type="url" name="event_link" id="event_link"
               placeholder="https://..."
               value="<?= htmlspecialchars($event['event_link'] ?? '') ?>">

        <label for="notes">Notes</label>
        <?php
        $notes = $event['notes'] ?? '';
        // Convert encoded line breaks back to real newlines
        $notes = str_replace(["&#13;", "&#10;", "&#13;&#10;"], "\n", htmlspecialchars_decode($notes, ENT_QUOTES));
        ?>
        <textarea name="notes" id="notes" rows="4" placeholder="Additional event details..."><?= htmlspecialchars($notes) ?></textarea>


        <!-- Total Attended -->
        <label for="total_attended">Total Attended</label>
        <input type="number" name="total_attended" id="total_attended" min="0" value="<?= htmlspecialchars($event['total_attended'] ?? 0) ?>" required>

        <!-- Positive Count -->
        <label for="positive_count">Positive Count</label>
        <input type="number" name="positive_count" id="positive_count" min="0" value="<?= htmlspecialchars($event['positive_count'] ?? 0) ?>" required>

        <!-- Attendance Report Upload -->
        <label for="attendance_report">Attendance Report (Excel/CSV/TXT/ZIP)</label>
        <input type="file" name="attendance_report" id="attendance_report" accept=".csv,.xlsx,.xls,.txt,.zip">

        <div class="actions">
            <button type="submit">💾 Update Event</button>
            <a href="/addNewSathEvent" class="back-link">⬅️ Back to All Events</a>
        </div>
    </form>
</div>

</body>
</html>
