<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>📄 Task Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        :root {
            --bg-color: #f9f9f9;
            --card-bg: #ffffff;
            --text-color: #1a1a1a;
            --label-color: #555;
            --accent-color: #1DA1F2;
            --link-color: #1DA1F2;
        }

        body.dark-mode {
            --bg-color: #121212;
            --card-bg: #1e1e1e;
            --text-color: #f1f1f1;
            --label-color: #cccccc;
            --accent-color: #4ea1ff;
            --link-color: #4ea1ff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            position: relative;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 1.5em;
            margin: 0;
            color: var(--accent-color);
        }

        .toggle-switch {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card {
            background-color: var(--card-bg);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            max-width: 600px;
            margin: auto;
        }

        .detail-row {
            margin: 12px 0;
            font-size: 1rem;
        }

        .detail-row strong {
            color: var(--label-color);
            display: inline-block;
            width: 140px;
        }

        a.back-link {
            display: block;
            text-align: center;
            margin-top: 25px;
            font-size: 1em;
            color: var(--link-color);
            text-decoration: none;
        }

        a.back-link:hover {
            text-decoration: underline;
        }

        .toggle-btn {
            appearance: none;
            width: 42px;
            height: 22px;
            background: #ccc;
            border-radius: 20px;
            position: relative;
            cursor: pointer;
            transition: background 0.3s;
        }

        .toggle-btn:checked {
            background: var(--accent-color);
        }

        .toggle-btn::before {
            content: '';
            position: absolute;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: white;
            top: 2px;
            left: 2px;
            transition: transform 0.3s;
        }

        .toggle-btn:checked::before {
            transform: translateX(20px);
        }

        .fab {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 56px;
            height: 56px;
            background-color: #0000ff;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            box-shadow: 0 4px 10px rgba(0,0,0,0.4);
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .fab:hover {
            background-color: #0000cc;
        }

        .fab svg {
            width: 28px;
            height: 28px;
            fill: white;
        }

        @media (max-width: 600px) {
            .card {
                padding: 16px;
            }

            .detail-row strong {
                width: 110px;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 99999;
            left: 0; top: 0;
            width: 100%; height: 100%;
            background-color: rgba(0,0,0,0.6);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: var(--card-bg);
            color: var(--text-color);
            padding: 20px;
            border-radius: 12px;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 4px 12px rgba(0,0,0,0.4);
        }

        .modal-content label {
            display: block;
            margin: 10px 0 4px;
        }

        .modal-content input,
        .modal-content textarea,
        .modal-content select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 1em;
        }

        .modal-actions {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>

<div class="header">
    <h2>📄 Task Details</h2>
    <div class="toggle-switch">
        🌗 Dark Mode
        <input type="checkbox" id="darkToggle" class="toggle-btn">
    </div>
</div>

<!-- Edit Form Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <h3>Edit Task</h3>
        <form id="editForm">
            <label>Mobile*</label>
            <input type="text" name="mobile" id="editMobile" readonly>

            <label>Candidate Name</label>
            <input type="text" name="name" id="editName" readonly>

            <label>Country</label>
            <input type="text" name="country" id="editCountry" readonly>

            <label>City</label>
            <input type="text" name="city" id="editCity" readonly>

            <label>Language</label>
            <input type="text" name="language" id="editLanguage" readonly>

            <label>Call Date*</label>
            <input type="date" name="call_date" id="editCallDate">

            <label>Calling Status*</label>
            <select name="status" id="editStatus">
                <option value="">Select</option>
                <option value="Positive">Positive</option>
                <option value="Negative">Negative</option>
                <option value="Neutral">Neutral</option>
                <option value="No response">No response</option>
                <option value="Ready for Sathvartha">Ready for Sathvartha</option>
            </select>

            <label>Remark*</label>
            <textarea name="remark" id="editRemark"></textarea>

            <div class="modal-actions">
                <button type="button" onclick="closeModal()">Cancel</button>
                <button type="submit">Save</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="detail-row">
        <strong>📱 Mobile:</strong> <?= htmlspecialchars($task->mobile) ?>
    </div>
    <div class="detail-row">
        <strong>👤 Name:</strong> <?= htmlspecialchars($task->name) ?>
    </div>
    <div class="detail-row">
        <strong>📅 Record Date:</strong> <?= htmlspecialchars($task->record_date) ?>
    </div>
    <div class="detail-row">
        <strong>🏳️ Country:</strong> <?= htmlspecialchars($task->country) ?>
    </div>
    <div class="detail-row">
        <strong>🏙️ City:</strong> <?= htmlspecialchars($task->city) ?>
    </div>
    <div class="detail-row">
        <strong>🗣️ Language:</strong> <?= htmlspecialchars($task->language) ?>
    </div>
</div>

<a class="back-link" href="/viewMyTasks">← Back to My Tasks</a>

<!-- Floating Edit Button -->
<!-- Floating Edit Button -->
<!-- Floating Edit Button -->
<!-- Floating Edit Button -->
<!-- Floating Edit Button -->
<a href="#" class="fab" title="Edit Task" onclick="openEditForm()">
    <svg xmlns="http://www.w3.org/2000/svg" height="28" viewBox="0 0 24 24" width="28" fill="white">
        <path d="M3 17.25V21h3.75l11.06-11.06-3.75-3.75L3 17.25zM20.71
        7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34a.9959.9959 0
        0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
    </svg>
</a>

<script>
    function openEditForm() {
        document.getElementById('editModal').style.display = 'flex';

        // Populate form from existing data
        document.getElementById('editMobile').value = "<?= htmlspecialchars($task->mobile) ?>";
        document.getElementById('editName').value = "<?= htmlspecialchars($task->name) ?>";
        document.getElementById('editCountry').value = "<?= htmlspecialchars($task->country) ?>";
        document.getElementById('editCity').value = "<?= htmlspecialchars($task->city) ?>";
        document.getElementById('editLanguage').value = "<?= htmlspecialchars($task->language) ?>";
        document.getElementById('editCallDate').value = "<?= htmlspecialchars($task->record_date) ?>"; // Or blank if separate
    }

    function closeModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    // Optional: Save handler
    document.getElementById("editForm").addEventListener("submit", function(e) {
        e.preventDefault();
        alert("Saving...");
        // TODO: Submit via AJAX or redirect with form values
        closeModal();
    });
</script>

<script>
    const toggle = document.getElementById('darkToggle');
    const savedTheme = localStorage.getItem('theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
        document.body.classList.add('dark-mode');
        toggle.checked = true;
    }

    toggle.addEventListener('change', function () {
        if (this.checked) {
            document.body.classList.add('dark-mode');
            localStorage.setItem('theme', 'dark');
        } else {
            document.body.classList.remove('dark-mode');
            localStorage.setItem('theme', 'light');
        }
    });
</script>

</body>
</html>
