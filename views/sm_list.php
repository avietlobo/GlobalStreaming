<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Telecallers DataBank</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * { box-sizing: border-box; }

        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f9fafb, #eef2ff);
            margin: 0;
            color: #1e293b;
        }

        .container {
            max-width: 96%;
            margin: 40px auto;
        }

        h2 {
            text-align: center;
            color: #1e293b;
            font-size: 26px;
            font-weight: 600;
            margin-bottom: 25px;
            letter-spacing: 0.3px;
        }

        /* Buttons */
        button, a.button {
            display: inline-block;
            padding: 9px 18px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.25s ease;
        }
        button:hover, a.button:hover { transform: translateY(-1px); opacity: 0.9; }
        button:disabled {
            background-color: #d1d5db;
            color: #6b7280;
            cursor: not-allowed;
        }

        .btn-primary { background-color: #2563eb; color: #fff; }
        .btn-secondary { background-color: #6b7280; color: #fff; }
        .btn-success { background-color: #22c55e; color: #fff; }
        .btn-warning { background-color: #f59e0b; color: #fff; }

        /* Back button */
        .button-group {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 15px;
        }

        .back-button {
            background-color: #475569;
            color: white;
        }

        /* Filter Section */
        form {
            background: #fff;
            border-radius: 16px;
            padding: 22px;
            margin-bottom: 30px;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.06);
        }

        .filters {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: flex-end;
        }

        .filters label {
            display: flex;
            flex-direction: column;
            font-size: 13px;
            color: #475569;
            min-width: 160px;
        }

        .filters input[type="text"],
        .filters select {
            padding: 8px 10px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: #f9fafb;
            transition: 0.2s;
        }

        .filters input:focus, .filters select:focus {
            border-color: #3b82f6;
            background: #fff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
        }

        /* Table Wrapper */
        .table-wrapper {
            background: rgba(255,255,255,0.9);
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            min-width: 1200px;
        }

        thead {
            background: #2563eb;
            color: #fff;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        th, td {
            padding: 10px 12px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
            white-space: nowrap;
        }

        tbody tr:hover {
            background: #f1f5f9;
        }

        /* Success Message */
        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 12px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
        }

        /* Pagination */
        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            display: inline-block;
            margin: 3px;
            padding: 8px 12px;
            border-radius: 8px;
            text-decoration: none;
            color: white;
            background: #94a3b8;
            font-size: 13px;
            transition: all 0.25s;
        }
        .pagination a.active {
            background: #2563eb;
            font-weight: 600;
        }
        .pagination a:hover {
            background: #1d4ed8;
        }

        .text-right {
            text-align: right;
            margin-top: 25px;
        }

        /* Modal */
        #assignModal {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        #assignModal .modal-content {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            width: 340px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.3s ease;
        }

        #assignModal h3 {
            margin-bottom: 15px;
            color: #1e293b;
        }

        #assignModal select {
            width: 100%;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            margin-bottom: 20px;
            background: #f9fafb;
        }

        /* Spinner Overlay */
        #spinner-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(255, 255, 255, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 9999;
            font-size: 22px;
            font-weight: 600;
            color: #1e293b;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        @media (max-width: 768px) {
            .filters {
                flex-direction: column;
                align-items: stretch;
            }
            .filters label { min-width: 100%; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="button-group">
        <button type="button" class="back-button" onclick="window.location.href='/evngDashboard1'">Back</button>
    </div>
    <h2>📱 Assign Social Media Links</h2>
    <?php if (!empty($_GET['assigned'])): ?>
        <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border-radius: 5px; text-align: center;">
            ✅ Bulk assignment successful!
        </div>
    <?php endif; ?>
    <!-- 🔍 FILTER FORM (GET) -->
    <form method="GET" action="/viewAllSMList">
        <div class="table-wrapper">
            <div style="margin-bottom: 20px;">
                <label>🌐 Source:
                    <input type="text" name="filter[source]" value="<?= htmlspecialchars($_GET['filter']['source'] ?? '') ?>">
                </label>
                <label>👤 Name:
                    <input type="text" name="filter[name]"
                           value="<?= htmlspecialchars($_GET['filter']['name'] ?? '') ?>">
                </label>

                <label>📱 Mobile:
                    <input type="text" name="filter[mobile]" value="<?= htmlspecialchars($_GET['filter']['mobile'] ?? '') ?>">
                </label>

                <label>🇮🇳 Country:
                    <input type="text" name="filter[country]" value="<?= htmlspecialchars($_GET['filter']['country'] ?? '') ?>">
                </label>
                <label>🏙️ City:
                    <input type="text" name="filter[city]" value="<?= htmlspecialchars($_GET['filter']['city'] ?? '') ?>">
                </label>
                <label>👪 Group Name:
                    <input type="text" name="filter[group_name]" value="<?= htmlspecialchars($_GET['filter']['group_name'] ?? '') ?>">
                </label>
                <label>⛪ Fellowship:
                    <input type="text" name="filter[fellowship]" value="<?= htmlspecialchars($_GET['filter']['fellowship'] ?? '') ?>">
                </label>
                <label>🗣️ Language:
                    <input type="text" name="filter[language]" value="<?= htmlspecialchars($_GET['filter']['language'] ?? '') ?>">
                </label>

                <label>👨‍💼 Assigned To:
                    <input type="text" name="filter[assignedTo]"
                           value="<?= htmlspecialchars($_GET['filter']['assignedTo'] ?? '') ?>"
                           placeholder="Enter name">
                </label>
                <label style="margin-left: 10px;">
                    <input type="checkbox" name="filter[unassignedOnly]"
                           value="1" <?= isset($_GET['filter']['unassignedOnly']) ? 'checked' : '' ?>>
                    📭 Show Unassigned Only
                </label>

<!--                <label>👨‍💼 Assigned To:-->
<!--                    <input type="text" id="assignedToFilter" placeholder="Enter name">-->
<!--                    <label style="margin-left: 10px;">-->
<!--                        <input type="checkbox" id="assignedToBlankFilter"> 📭 Show Unassigned Only-->
<!--                    </label>-->
<!--                </label>-->
<!---->
<!--                <button type="button" onclick="applyFrontendFilters()" style="background-color: #007BFF; color: white;">🔍 Apply Filters</button>-->


                <label>📌 Status:
                    <input type="text" name="filter[status]" value="<?= htmlspecialchars($_GET['filter']['status'] ?? '') ?>">
                </label>
                <label>📅 Record Date:
                    <input type="date"
                           name="filter[record_date]"
                           value="<?= htmlspecialchars($_GET['filter']['record_date'] ?? '') ?>">
                </label>
                <button type="submit" style="background-color: #007BFF; color: white;">🔍 Apply Filters</button>
                <a href="/viewAllSMList"
                   style="background-color: #6c757d; color: white; padding: 10px 20px; border-radius: 4px; text-decoration: none; margin-left: 5px;">
                    ❌ Clear All
                </a>
            </div>
        </div>
    </form>
    <!--    <form action="/bulkAssignTelecaller" method="POST">-->
    <form id="assignForm" action="/bulkAssignSm" method="POST">
        <input type="hidden" name="assignedTo" id="assignedToInput">
        <div class="table-wrapper">

            <table>
                <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>📱 Mobile</th>
                    <th>👤 Name</th>
                    <th>📌 Status</th>
                    <th>📅 Record Date</th>
                    <th>📌 Type</th>
                    <th>📧 Email</th>
                    <th>🌐 Source</th>
                    <th>🇮🇳 Country</th>
                    <th>🏙️ City</th>
                    <th>👥 Referred By</th>
                    <th>👪 Group Name</th>
                    <th>⛪ Fellowship</th>
                    <th>🗣️ Language</th>
                    <th>👨‍💼 Assigned To</th>
                    <th>📞 Call Date</th>

                </tr>
                </thead>
                <tbody>
                <?php foreach ($records as $record): ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="selected_contacts[]" value="<?= htmlspecialchars($record->mobile) ?>"
                                   onchange="evaluateAssignButtons()"
                                   data-assigned="<?= !empty($record->assignedTo) ? '1' : '0' ?>">
                            <!-- Hidden fields to submit all details -->
                            <input type="hidden" name="contacts[<?= $record->mobile ?>][name]" value="<?= htmlspecialchars($record->name) ?>">
                            <input type="hidden" name="contacts[<?= $record->mobile ?>][record_date]" value="<?= htmlspecialchars($record->record_date) ?>">
                            <input type="hidden" name="contacts[<?= $record->mobile ?>][type]" value="<?= htmlspecialchars($record->type) ?>">
                            <input type="hidden" name="contacts[<?= $record->mobile ?>][email]" value="<?= htmlspecialchars($record->email) ?>">
                            <input type="hidden" name="contacts[<?= $record->mobile ?>][source]" value="<?= htmlspecialchars($record->source) ?>">
                            <input type="hidden" name="contacts[<?= $record->mobile ?>][country]" value="<?= htmlspecialchars($record->country) ?>">
                            <input type="hidden" name="contacts[<?= $record->mobile ?>][city]" value="<?= htmlspecialchars($record->city) ?>">
                            <input type="hidden" name="contacts[<?= $record->mobile ?>][referred_by]" value="<?= htmlspecialchars($record->referred_by) ?>">
                            <input type="hidden" name="contacts[<?= $record->mobile ?>][group_name]" value="<?= htmlspecialchars($record->group_name) ?>">
                            <input type="hidden" name="contacts[<?= $record->mobile ?>][fellowship]" value="<?= htmlspecialchars($record->fellowship) ?>">
                            <input type="hidden" name="contacts[<?= $record->mobile ?>][language]" value="<?= htmlspecialchars($record->language) ?>">

                        </td>
                        <td><?= htmlspecialchars($record->mobile) ?></td>
                        <td><?= htmlspecialchars($record->name) ?></td>
                        <td><?= htmlspecialchars($record->status ?? '') ?></td>
                        <td><?= htmlspecialchars($record->record_date) ?></td>
                        <td><?= htmlspecialchars($record->type) ?></td>
                        <td><?= htmlspecialchars($record->email) ?></td>
                        <td><?= htmlspecialchars($record->source) ?></td>
                        <td><?= htmlspecialchars($record->country) ?></td>
                        <td><?= htmlspecialchars($record->city) ?></td>
                        <td><?= htmlspecialchars($record->referred_by) ?></td>
                        <td><?= htmlspecialchars($record->group_name) ?></td>
                        <td><?= htmlspecialchars($record->fellowship) ?></td>
                        <td><?= htmlspecialchars($record->language) ?></td>
                        <td><?= htmlspecialchars($record->assignedTo ?? '') ?></td>
                        <td><?= htmlspecialchars($record->callDate ?? '') ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php
            $totalPages = ceil(($totalRecords ?? 0) / ($limit ?? 50));
            $currentPage = $currentPage ?? 1;
            ?>

            <!-- Record Summary -->
            <div style="margin-top: 10px; color: #333;">
                Showing <?= count($records) ?> of <?= $totalRecords ?? 0 ?> records
            </div>

            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <div style="margin-top: 15px; text-align: center;">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?<?= http_build_query(['filter' => $_GET['filter'] ?? [], 'page' => $i]) ?>"
                           style="padding: 8px 12px; margin: 2px; background: <?= $currentPage == $i ? '#007BFF' : '#ccc' ?>; color: white; border-radius: 5px; text-decoration: none;">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        </div>

        <br>
        <div class="text-right">
            <button type="button" id="assignBtn" onclick="openAssignModal('assign')" disabled>
                ✅ Bulk Assign Selected
            </button>

            <button type="button" id="reassignBtn" onclick="openAssignModal('reassign')" style="background-color: orange; margin-left: 10px;" disabled>
                ♻️ Bulk Reassign Selected
            </button>
        </div>
    </form>
</div>


<script>
    document.getElementById('select-all').addEventListener('change', function () {
        const checkboxes = document.querySelectorAll('input[name="selected_contacts[]"]');
        checkboxes.forEach(cb => cb.checked = this.checked);
        evaluateAssignButtons(); // ✅ Add this line to re-check assign/reassign logic
    });

</script>

<script>
    function evaluateAssignButtons() {
        const checkboxes = document.querySelectorAll('input[name="selected_contacts[]"]');
        let hasAssigned = false;
        let hasUnassigned = false;

        checkboxes.forEach(cb => {
            if (cb.checked) {
                const isAssigned = cb.getAttribute('data-assigned') === '1';
                if (isAssigned) {
                    hasAssigned = true;
                } else {
                    hasUnassigned = true;
                }
            }
        });

        const assignBtn = document.getElementById('assignBtn');
        const reassignBtn = document.getElementById('reassignBtn');

        if (hasAssigned && hasUnassigned) {
            // Mixed selection: disable both
            assignBtn.disabled = true;
            reassignBtn.disabled = true;
        } else if (hasAssigned) {
            // Only assigned leads selected → enable Reassign
            assignBtn.disabled = true;
            reassignBtn.disabled = false;
        } else if (hasUnassigned) {
            // Only unassigned leads selected → enable Assign
            assignBtn.disabled = false;
            reassignBtn.disabled = true;
        } else {
            // No selection
            assignBtn.disabled = true;
            reassignBtn.disabled = true;
        }
    }

    // Run on page load to ensure both are disabled
    window.onload = evaluateAssignButtons;
</script>

<script>
    let assignMode = 'assign'; // global

    function openAssignModal(mode) {
        assignMode = mode;

        const selected = document.querySelectorAll('input[name="selected_contacts[]"]:checked');
        if (selected.length === 0) {
            alert('Please select at least one contact.');
            return;
        }

        const assignTitle = document.getElementById('assignModalTitle');
        const confirmBtn = document.getElementById('assignConfirmBtn');

        if (mode === 'reassign') {
            assignTitle.innerText = '♻️ Reassign Selected Leads';
            confirmBtn.innerText = '♻️ Confirm Reassign';
        } else {
            assignTitle.innerText = '✅ Assign Selected Leads';
            confirmBtn.innerText = '✅ Confirm Assign';
        }

        document.getElementById('assignModal').style.display = 'flex';
    }

    function confirmAssign() {
        //const selectedName = document.getElementById('telecallerSelect').value;
        const selectedName = document.getElementById('evangelist').value; // ✅ fixed id
        if (!selectedName) {
            alert("Please select a telecaller to assign.");
            return;
        }

        // Set who to assign to
        document.getElementById('assignedToInput').value = selectedName;

        // Optional: pass assignMode as hidden input (useful if needed in backend)
        //const form = document.querySelector('form');
        const form = document.getElementById('assignForm');
        let modeInput = document.getElementById('assignModeInput');
        if (!modeInput) {
            modeInput = document.createElement('input');
            modeInput.type = 'hidden';
            modeInput.name = 'assignMode';
            modeInput.id = 'assignModeInput';
            form.appendChild(modeInput);
        }
        modeInput.value = assignMode;

        // Submit
        document.getElementById('assignModal').style.display = 'none';
        document.getElementById('spinner-overlay').style.display = 'flex';
        form.submit();
    }
</script>

<script>
    // Select/Deselect all checkboxes
    document.getElementById('select-all').addEventListener('change', function () {
        const checkboxes = document.querySelectorAll('input[name="selected_contacts[]"]');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });
    // Show spinner on form submit
    document.querySelector('form').addEventListener('submit', function () {
        document.getElementById('spinner-overlay').style.display = 'flex';
    });

    // function openAssignModal() {
    //     const selected = document.querySelectorAll('input[name="selected_contacts[]"]:checked');
    //     if (selected.length === 0) {
    //         alert('Please select at least one contact.');
    //         return;
    //     }
    //     document.getElementById('assignModal').style.display = 'flex';
    // }

    function openAssignModal(mode) {
        const selected = document.querySelectorAll('input[name="selected_contacts[]"]:checked');
        if (selected.length === 0) {
            alert('Please select at least one contact.');
            return;
        }

        assignMode = mode; // set global assign mode

        const assignTitle = document.getElementById('assignModalTitle');
        const confirmBtn = document.getElementById('assignConfirmBtn');

        if (mode === 'reassign') {
            assignTitle.innerText = '♻️ Reassign Selected Leads';
            confirmBtn.innerText = '♻️ Confirm Reassign';
        } else {
            assignTitle.innerText = '✅ Assign Selected Leads';
            confirmBtn.innerText = '✅ Confirm Assign';
        }

        document.getElementById('assignModal').style.display = 'flex';
    }

    function closeAssignModal() {
        document.getElementById('assignModal').style.display = 'none';
    }

    // function confirmAssign() {
    //     const selectedName = document.getElementById('telecallerSelect').value;
    //     if (!selectedName) {
    //         alert("Please select a telecaller to assign.");
    //         return;
    //     }
    //     document.getElementById('assignedToInput').value = selectedName;
    //     document.getElementById('assignModal').style.display = 'none';
    //     document.getElementById('spinner-overlay').style.display = 'flex';
    //     document.querySelector('form').submit();
    // }

</script>
<!-- Modal -->
<div id="assignModal" style="
    display: none;
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 10000;
    justify-content: center;
    align-items: center;
">
    <div style="background: white; padding: 20px; border-radius: 10px; min-width: 300px; text-align: center;">
        <h3 id="assignModalTitle">Select Telecaller</h3>
        <select name="evangelist" id="evangelist">
            <?php foreach ($telecallers as $telecaller): ?>
<!--                <option value="--><?php //= htmlspecialchars($telecaller['evngName']) ?><!--">-->
<!--                    --><?php //= htmlspecialchars($telecaller['evngName']) ?><!-- (--><?php //= $telecaller['unassigned_count'] ?><!--)-->
<!--                </option>-->
                <option value="<?= htmlspecialchars($telecaller['evngName']) ?>">
                    <?= htmlspecialchars($telecaller['evngName']) ?>
                    <?= !empty($telecaller['languages']) ? ' (' . htmlspecialchars($telecaller['languages']) . ')' : '' ?>
                    (<?= $telecaller['unassigned_count'] ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <br><br>
        <!--        <button onclick="confirmAssign()" style="background: #007BFF;">✅ Confirm Assign</button>-->
        <button id="assignConfirmBtn" onclick="confirmAssign()" style="background: #007BFF;">✅ Confirm Assign</button>
        <button onclick="closeAssignModal()" style="background: #6c757d; margin-left: 10px;">❌ Cancel</button>
    </div>
</div>


<!-- Spinner overlay -->
<div id="spinner-overlay" style="
    display: none;
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(255, 255, 255, 0.7);
    z-index: 9999;
    justify-content: center;
    align-items: center;
">
    <div style="font-size: 30px; font-weight: bold;">
        ⏳ Assigning... Please wait
    </div>
</div>
<script>
    function applyFrontendFilters() {
        const assignedToValue = document.getElementById('assignedToFilter').value.toLowerCase();
        const showUnassigned = document.getElementById('assignedToBlankFilter').checked;

        const rows = document.querySelectorAll("table tbody tr");

        rows.forEach(row => {
            const assignedToCell = row.querySelector("td:nth-child(15)"); // 14th column = Assigned To
            const assignedToText = (assignedToCell.textContent || "").trim().toLowerCase();

            let visible = true;

            if (showUnassigned) {
                // Only show rows where AssignedTo is blank
                visible = assignedToText === "";
            } else if (assignedToValue) {
                // Filter by entered text
                visible = assignedToText.includes(assignedToValue);
            }

            row.style.display = visible ? "" : "none";
        });
    }

    function clearFrontendFilters() {
        document.getElementById('assignedToFilter').value = "";
        document.getElementById('assignedToBlankFilter').checked = false;

        // Reset all rows
        const rows = document.querySelectorAll("table tbody tr");
        rows.forEach(row => row.style.display = "");
    }
</script>
</body>
</html>
