<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>✝️ Word Sessions - <?= htmlspecialchars($candidate->name) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        .back-btn {
            background: #6c757d;    /* Gray background */
            color: #fff;
            padding: 0.5em 1em;
            border: none;
            border-radius: 6px;
            font-size: 0.9em;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .back-btn:hover {
            background: #5a6268;
            transform: translateY(-1px);
        }

        body {
            font-family: 'Inter', Arial, sans-serif;
            background: #f4f6f9;
            color: #333;
            margin: 0;
            padding: 1.5em;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            padding: 1.5em;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 1em;
        }
        .header-left { display: flex; flex-direction: column; gap: 4px; }
        .header-left h2 { margin: 0; color: #1e90ff; font-weight: 600; }
        .participant-badge {
            background: #eaf3ff; color: #1e90ff;
            padding: 4px 8px; border-radius: 6px;
            font-size: 0.9em; font-weight: 600;
        }
        .header-left h3 { margin: 0; font-size: 1em; color: #555; font-weight: 600; }

        .btn {
            background: #1e90ff; color: #fff;
            padding: 0.5em 1em; border: none;
            border-radius: 6px; cursor: pointer;
            font-size: 0.9em; font-weight: 600;
            transition: 0.3s ease;
        }
        .btn:hover { background: #006fdd; transform: translateY(-1px); }
        .add-btn { background: #0d6efd; }

        .table-container { overflow-x: auto; display: none; }
        table { width: 100%; border-collapse: collapse; margin-top: 1em; font-size: 0.9em; border-radius: 8px; overflow: hidden; }
        thead { background: #1e90ff; color: white; }
        th, td { padding: 10px; text-align: center; }
        tr:nth-child(even) { background: #f9fbfd; }
        tr:hover { background: #eef5ff; }

        .badge { padding: 4px 8px; border-radius: 6px; color: white; font-size: 0.8em; font-weight: 600; }
        .badge.scheduled { background: #1e90ff; }
        .badge.completed { background: #28a745; }

        .card-container { display: flex; flex-direction: column; gap: 12px; margin-top: 1em; }
        .card { background: #fff; border-left: 5px solid #1e90ff; border-radius: 8px; padding: 0.8em; box-shadow: 0 2px 6px rgba(0,0,0,0.08); }
        .card.completed { border-left-color: #28a745; }
        .card h4 { margin: 0; font-size: 1em; color: #1e90ff; font-weight: 600; display: flex; justify-content: space-between; align-items: center; }
        .card p { margin: 4px 0; font-size: 0.85em; color: #555; }

        @media (min-width: 768px) { .table-container { display: block; } .card-container { display: none; } }
        @media (max-width: 600px) { .header { flex-direction: column; align-items: flex-start; } .add-btn { width: 100%; margin-top: 0.8em; } }

        .modal {
            display: none; position: fixed; top: 0; left: 0;
            width: 100%; height: 100%; background: rgba(0,0,0,0.5);
            justify-content: center; align-items: center; z-index: 999;
        }
        .modal-content {
            background: #ffffff; padding: 2em; border-radius: 12px;
            width: 90%; max-width: 420px; box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            position: relative; animation: fadeIn 0.3s ease;
        }
        .modal-content h3 { text-align: center; color: #1e90ff; margin-top: 0; font-weight: 600; margin-bottom: 1em; }
        .form-group { margin-bottom: 1em; }
        label { display: block; margin-bottom: 0.4em; font-weight: 600; color: #555; font-size: 0.9em; }
        select, input[type="datetime-local"], textarea, input[type="text"] {
            width: 100%; padding: 0.7em; border: 1px solid #ccc;
            border-radius: 6px; font-size: 0.9em; background: #f8f9fa;
        }
        .modal-actions { margin-top: 1.5em; display: flex; justify-content: space-between; }
        .cancel-btn { background: #e2e6ea; color: #333; }
        .cancel-btn:hover { background: #d6dade; }
        .close-btn { position: absolute; top: 12px; right: 14px; font-size: 1.4em; color: #999; cursor: pointer; }
        @keyframes fadeIn { from { opacity: 0; transform: scale(0.9); } to { opacity: 1; transform: scale(1); } }
    </style>
</head>
<body>

<div class="container">

    <div class="button-group">
        <button type="button" class="btn back-btn" onclick="window.location.href='/getWordSessionsApproved'">← Back</button>
    </div>
    <div class="header">
        <div class="header-left">
            <h2>✝️ Word Sessions</h2>
            <span class="participant-badge">👤 <?= htmlspecialchars($participant) ?></span>
            <h3>📜 Previous Sessions</h3>

        </div>
        <button class="btn add-btn" onclick="openSessionModal()">➕ Add Word Session</button>
    </div>

    <div class="card-container" id="wordSessionsCards">
        <p style="text-align:center;color:#666;">Loading...</p>
    </div>

    <div class="table-container">
        <table id="wordSessionsTable">
            <thead>
            <tr>
                <th>Session</th>
                <th>Date</th>
                <th>Status</th>
                <th>Participant</th>
                <th>Language</th>
                <th>Remark</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr><td colspan="6" style="padding:10px; text-align:center;">Loading...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Session Modal -->
<div id="sessionModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeSessionModal()">✖</span>
        <h3>📆 Schedule Word Session</h3>
        <form id="sessionScheduleForm">
            <input type="hidden" name="mobile" value="<?= htmlspecialchars($mobile) ?>">
            <input type="hidden" name="participant" value="<?= htmlspecialchars($participant) ?>">
            <input type="hidden" name="language" value="<?= htmlspecialchars($language) ?>">
            <input type="hidden" name="evangelist" value="<?= htmlspecialchars($evangelist) ?>">

            <div class="form-group">
                <label for="sessionName">Select Session</label>
                <select id="sessionName" name="sessionName" required>
                    <option value="">-- Select Session --</option>
                    <option value="1">Session 1: Salvation, incl plan and 1st coming</option>
                    <option value="2">Session 2: God the Father</option>
                    <option value="3">Session 3: Second coming incl Signs of Times</option>
                    <option value="4">Session 4: He has come, new name</option>
                    <option value="5">Session 5: Messenger sent by God</option>
                    <option value="6">Session 6: Righteousness</option>
                    <option value="7">Session 7: Zion, true Zion</option>
                    <option value="8">Session 8: Holy Mother</option>
                    <option value="9">Session 9: Church</option>
                    <option value="10">Session 10: Good News Retreat</option>
                </select>
            </div>

            <div class="form-group">
                <label for="sessionDate">Select Date & Time</label>
                <input type="datetime-local" id="sessionDate" name="sessionDate" required>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn cancel-btn" onclick="closeSessionModal()">Cancel</button>
                <button type="submit" class="btn">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Session Modal -->
<div id="editSessionModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeEditSessionModal()">✖</span>
        <h3>✏️ Edit Session</h3>
        <form id="editSessionForm">
            <input type="hidden" id="editSessionId" name="sessionId">

            <div class="form-group">
                <label>Date & Time</label>
                <input type="datetime-local" id="editSessionDate" name="sessionDate" required>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select id="editSessionStatus" name="status" required>
                    <option value="Scheduled">Scheduled</option>
                    <option value="Completed">Completed</option>
                    <option value="Missed">Missed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>

            <div class="form-group">
                <label>Assigned To</label>
                <input type="text" id="editSessionEvangelist" name="evangelist" readonly>
            </div>

            <div class="form-group">
                <label>Remark</label>
                <textarea id="editSessionRemark" name="remark" rows="3"></textarea>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn cancel-btn" onclick="closeEditSessionModal()">Cancel</button>
                <button type="submit" class="btn">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", loadWordSessions);

    function openSessionModal() { document.getElementById('sessionModal').style.display = 'flex'; }
    function closeSessionModal() { document.getElementById('sessionModal').style.display = 'none'; }
    function closeEditSessionModal() { document.getElementById('editSessionModal').style.display = 'none'; }

    document.getElementById('sessionScheduleForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('/saveWordSessionByReassignedEvangelist', { method: 'POST', body: formData })
            .then(response => response.json())
            .then(data => {
                if (data.success) { closeSessionModal(); loadWordSessions(); }
                else { alert(data.message); }
            })
            .catch(err => alert("Error: " + err));
    });

    function loadWordSessions() {
        //fetch('/getWordSessionsOfAssignedEvng?mobile=<?= $mobile ?>')
        fetch('/getWordSessionsOfAssignedEvng?mobile=<?= urlencode($mobile) ?>')

                .then(response => response.json())
            .then(data => {
                const tbody = document.querySelector("#wordSessionsTable tbody");
                const cardContainer = document.getElementById("wordSessionsCards");
                tbody.innerHTML = ""; cardContainer.innerHTML = "";

                if (!data.success || !data.sessions.length) {
                    tbody.innerHTML = `<tr><td colspan="6" style="padding:10px; text-align:center;">No sessions found yet.</td></tr>`;
                    cardContainer.innerHTML = `<p style="text-align:center;color:#666;">No sessions found yet.</p>`;
                    return;
                }

                data.sessions.forEach(ws => {
                    const badgeClass = ws.status.toLowerCase() === 'completed' ? 'completed' : 'scheduled';
                    const badge = `<span class="badge ${badgeClass}">${ws.status}</span>`;

                    // Table row
                    tbody.innerHTML += `
                    <tr>
                        <td>${ws.session_name}</td>
                        <td>📅 ${ws.session_date}</td>
                        <td>${badge}</td>
                        <td>${ws.participant || '-'}</td>
                        <td>${ws.language || '-'}</td>
                         <td>${ws.remark || '-'}</td>
                        <td>
                          <button class="btn" onclick="openEditSessionModal(
                            '${ws.id}', '${ws.session_date}', '${ws.status || ""}', '${ws.remark || ""}', '<?= htmlspecialchars($evangelist) ?>'
                          )">✏️ Edit</button>
                        </td>

                    </tr>`;

                    // Card view
                    cardContainer.innerHTML += `
                    <div class="card ${badgeClass}">
                        <h4>${ws.session_name} ${badge}</h4>
                        <p>📅 ${ws.session_date}</p>
                        <p><strong>Participant:</strong> ${ws.participant || '-'}</p>
                        <p><strong>Language:</strong> ${ws.language || '-'}</p>
                          <p><strong>Remark:</strong> ${ws.remark ? ws.remark : '-'}</p>
                        <button class="btn" onclick="openEditSessionModal(
                          '${ws.id}', '${ws.session_date}', '${ws.status || ""}', '${ws.remark || ""}', '<?= htmlspecialchars($evangelist) ?>'
                        )">✏️ Edit</button>
                    </div>`;
                });
            })
            .catch(() => {
                document.querySelector("#wordSessionsTable tbody").innerHTML =
                    `<tr><td colspan="6" style="padding:10px; text-align:center;">Error loading sessions.</td></tr>`;
                document.getElementById("wordSessionsCards").innerHTML =
                    `<p style="text-align:center;color:#666;">Error loading sessions.</p>`;
            });
    }

    function openEditSessionModal(id, dateTime, status, remark, evangelist) {
        document.getElementById("editSessionId").value = id;
        document.getElementById("editSessionDate").value = dateTime;
        document.getElementById("editSessionStatus").value = status;
        document.getElementById("editSessionRemark").value = remark;
        document.getElementById("editSessionEvangelist").value = evangelist;
        document.getElementById("editSessionModal").style.display = "flex";
    }

    document.getElementById("editSessionForm").addEventListener("submit", function(e) {
        e.preventDefault();
        const data = new URLSearchParams(new FormData(this));

        fetch("/updateSession", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: data
        })
            .then(res => res.json())
            .then(response => {
                if (response.success) {
                    alert("✅ Session updated successfully!");
                    closeEditSessionModal();
                    loadWordSessions();
                } else { alert("❌ " + response.message); }
            })
            .catch(err => { console.error(err); alert("An error occurred while updating session."); });
    });
</script>

</body>
</html>
