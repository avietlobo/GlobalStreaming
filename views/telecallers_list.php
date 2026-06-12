<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Telecallers DataBank</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Global Reset */
        * {
            box-sizing: border-box;
        }
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background: #f5f7fa;
            color: #333;
        }

        .container {
            max-width: 1400px;
            margin: 40px auto;
            padding: 25px;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        h2 {
            text-align: center;
            color: #1e293b;
            font-size: 26px;
            margin-bottom: 25px;
            letter-spacing: 0.5px;
        }

        /* Back button */
        .button-group {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 15px;
        }

        .button-group button {
            background: linear-gradient(135deg, #007bff, #0056d2);
            border: none;
            padding: 8px 18px;
            border-radius: 6px;
            color: white;
            cursor: pointer;
            font-weight: 500;
            transition: 0.3s ease;
        }
        .button-group button:hover {
            opacity: 0.85;
        }

        /* Success Alert */
        .alert {
            background: #e9f7ef;
            color: #1b5e20;
            padding: 12px 15px;
            border-radius: 6px;
            text-align: center;
            margin-bottom: 20px;
            font-weight: 500;
        }

        /* Filter Form */
        form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: flex-end;
            background: #f8fafc;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: inset 0 0 6px rgba(0,0,0,0.05);
        }

        form label {
            display: flex;
            flex-direction: column;
            font-size: 13px;
            color: #475569;
        }

        form input[type="text"] {
            padding: 8px 10px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            background: #fff;
            font-size: 14px;
            width: 180px;
            transition: 0.2s ease;
        }

        form input[type="text"]:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        }

        form button,
        form a {
            padding: 9px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s ease;
        }

        form button {
            background: #007bff;
            color: #fff;
        }

        form button:hover {
            background: #0056d2;
        }

        form a {
            background: #6c757d;
            color: #fff;
        }

        form a:hover {
            background: #5a6268;
        }

        /* Table */
        .table-wrapper {
            overflow-x: auto;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1200px;
            font-size: 14px;
        }

        thead {
            background: #007bff;
            color: white;
        }

        th, td {
            padding: 12px 14px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
            white-space: nowrap;
        }

        tbody tr:hover {
            background: #f1f5ff;
            transition: 0.2s;
        }

        th:first-child, td:first-child {
            text-align: center;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 18px;
        }

        .pagination a {
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            background: #e2e8f0;
            color: #1e293b;
            font-weight: 500;
        }

        .pagination a.active {
            background: #007bff;
            color: #fff;
        }

        /* Action Buttons */
        .text-right {
            text-align: right;
            margin-top: 20px;
        }

        button#assignBtn,
        button#reassignBtn {
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            font-weight: 500;
            cursor: pointer;
            color: #fff;
            transition: 0.3s ease;
        }

        #assignBtn {
            background: linear-gradient(135deg, #28a745, #218838);
        }

        #assignBtn:hover {
            opacity: 0.9;
        }

        #reassignBtn {
            background: linear-gradient(135deg, #fd7e14, #e36414);
            margin-left: 8px;
        }

        #reassignBtn:hover {
            opacity: 0.9;
        }

        button:disabled {
            background: #cbd5e1 !important;
            color: #64748b;
            cursor: not-allowed;
        }

        /* Modal */
        #assignModal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        #assignModal .modal-content {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            min-width: 320px;
            box-shadow: 0 6px 30px rgba(0,0,0,0.1);
            text-align: center;
        }

        #assignModal h3 {
            margin-bottom: 15px;
            color: #1e293b;
        }

        #assignModal select {
            width: 80%;
            padding: 8px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        #assignModal button {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.3s;
        }

        #assignConfirmBtn {
            background: #007bff;
            color: #fff;
        }

        #assignConfirmBtn:hover {
            background: #0056d2;
        }

        #assignModal button:last-child {
            background: #6c757d;
            color: #fff;
            margin-left: 10px;
        }

        /* Spinner */
        #spinner-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(255,255,255,0.8);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            font-size: 22px;
            font-weight: 600;
            color: #007bff;
        }

        /* Mobile tweaks */
        @media (max-width: 768px) {
            form label {
                width: 100%;
            }
            form input[type="text"] {
                width: 100%;
            }
            table {
                font-size: 13px;
            }
        }


    </style>
</head>
<body>

<div class="container">
    <div class="button-group">
        <button type="button" class="back-button" onclick="window.location.href='/evngDashboard1'">Back</button>
    </div>

    <h2>📋 Assign Telecallers</h2>
    <?php if (!empty($_GET['assigned'])): ?>
        <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border-radius: 5px; text-align: center;">
            ✅ Bulk assignment successful!
        </div>
    <?php endif; ?>
    <!-- 🔍 FILTER FORM (GET) -->
    <form method="GET" action="/viewAllTelecallersList">

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
<!--        <label>👨‍💼 Assigned To:-->
<!--            <input type="text" id="assignedToFilter" placeholder="Enter name">-->
<!--            <label style="margin-left: 10px;">-->
<!--                <input type="checkbox" id="assignedToBlankFilter"> 📭 Show Unassigned Only-->
<!--            </label>-->
<!--        </label>-->
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
<!--        <button type="button" onclick="applyFrontendFilters()" style="background-color: #007BFF; color: white;">🔍 Apply Filters</button>-->
<!--        <button type="button" onclick="clearFrontendFilters()" style="background-color: #6c757d; color: white; margin-left: 5px;">❌ Clear All</button>-->

                <label>📌 Status:
                    <input type="text" name="filter[status]" value="<?= htmlspecialchars($_GET['filter']['status'] ?? '') ?>">
                </label>
        <label>📅 Record Date:
            <input type="date"
                   name="filter[record_date]"
                   value="<?= htmlspecialchars($_GET['filter']['record_date'] ?? '') ?>">
        </label>
                <button type="submit" style="background-color: #007BFF; color: white;">🔍 Apply Filters</button>
        <!-- ✅ Clear All Filters button -->
        <a href="/viewAllTelecallersList"
           style="background-color: #6c757d; color: white; padding: 10px 20px; border-radius: 4px; text-decoration: none; margin-left: 5px;">
            ❌ Clear All
        </a>
    </form>
<!--    <form action="/bulkAssignTelecaller" method="POST">-->
        <form id="assignForm" action="/bulkAssignTelecaller" method="POST">
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

                    <th>📧 Email</th>
                    <th>🌐 Source</th>
                    <th>🇮🇳 Country</th>
                    <th>🏙️ City</th>
                    <th>👥 Referred By</th>
                    <th>👥 Referred By Contact</th>
                    <th>👪 Group Name</th>
                    <th>⛪ Fellowship</th>
                    <th>🗣️ Language</th>
                    <th>👨‍💼 Assigned To</th>
                    <th>📞 Call Date</th>
                    <th>📌 Type</th>



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
                            <input type="hidden" name="contacts[<?= $record->mobile ?>][email]" value="<?= htmlspecialchars($record->email) ?>">
                            <input type="hidden" name="contacts[<?= $record->mobile ?>][source]" value="<?= htmlspecialchars($record->source) ?>">
                            <input type="hidden" name="contacts[<?= $record->mobile ?>][country]" value="<?= htmlspecialchars($record->country) ?>">
                            <input type="hidden" name="contacts[<?= $record->mobile ?>][city]" value="<?= htmlspecialchars($record->city) ?>">
                            <input type="hidden" name="contacts[<?= $record->mobile ?>][referred_by]" value="<?= htmlspecialchars($record->referred_by) ?>">
                            <input type="hidden" name="contacts[<?= $record->mobile ?>][referred_by_contact_no]" value="<?= htmlspecialchars($record->referred_by_contact_no) ?>">

                            <input type="hidden" name="contacts[<?= $record->mobile ?>][group_name]" value="<?= htmlspecialchars($record->group_name) ?>">
                            <input type="hidden" name="contacts[<?= $record->mobile ?>][fellowship]" value="<?= htmlspecialchars($record->fellowship) ?>">
                            <input type="hidden" name="contacts[<?= $record->mobile ?>][language]" value="<?= htmlspecialchars($record->language) ?>">
                            <input type="hidden" name="contacts[<?= $record->mobile ?>][type]" value="<?= htmlspecialchars($record->type) ?>">

                        </td>
                        <td><?= htmlspecialchars($record->mobile) ?></td>
                        <td><?= htmlspecialchars($record->name) ?></td>
                        <td><?= htmlspecialchars($record->status ?? '') ?></td>

                        <td><?= htmlspecialchars($record->record_date) ?></td>

                        <td><?= htmlspecialchars($record->email) ?></td>
                        <td><?= htmlspecialchars($record->source) ?></td>
                        <td><?= htmlspecialchars($record->country) ?></td>
                        <td><?= htmlspecialchars($record->city) ?></td>
                        <td><?= htmlspecialchars($record->referred_by) ?></td>
                        <td><?= htmlspecialchars($record->referred_by_contact_no) ?></td>
                        <td><?= htmlspecialchars($record->group_name) ?></td>
                        <td><?= htmlspecialchars($record->fellowship) ?></td>
                        <td><?= htmlspecialchars($record->language) ?></td>
                        <td><?= htmlspecialchars($record->assignedTo ?? '') ?></td>
                        <td><?= htmlspecialchars($record->callDate ?? '') ?></td>
                        <td><?= htmlspecialchars($record->type) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div> <!-- ✅ close table-wrapper -->

        </form> <!-- ✅ close form right after wrapper -->
    <!-- OUTSIDE WRAPPER -->
    <?php
    $totalPages = ceil(($totalRecords ?? 0) / ($limit ?? 50));
    $currentPage = $currentPage ?? 1;
    ?>
    <div style="margin-top: 10px; color: #333;">
        Showing <?= count($records) ?> of <?= $totalRecords ?? 0 ?> records
    </div>
    <?php if ($totalPages > 1): ?>
        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?<?= http_build_query(['filter' => $_GET['filter'] ?? [], 'page' => $i]) ?>"
                   style="padding: 8px 12px; margin: 2px; background: <?= $currentPage == $i ? '#007BFF' : '#ccc' ?>; color: white; border-radius: 5px; text-decoration: none;">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>

    <div class="text-right" style="margin-top: 15px;">
        <button type="button" id="assignBtn" onclick="openAssignModal('assign')" disabled>
            ✅ Bulk Assign Selected
        </button>
        <button type="button" id="reassignBtn" onclick="openAssignModal('reassign')" style="background-color: orange; margin-left: 10px;" disabled>
            ♻️ Bulk Reassign Selected
        </button>
    </div>
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
            const assignedToCell = row.querySelector("td:nth-child(14)"); // 14th column = Assigned To
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
