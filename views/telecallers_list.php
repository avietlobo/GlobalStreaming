<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Telecallers DataBank</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f5;
        }
        .container {
            max-width: 100%;
            margin: 40px auto;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .table-wrapper {
            overflow-x: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.05);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            min-width: 1200px; /* Ensures scroll on mobile */
        }
        thead {
            background: #007BFF;
            color: white;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
            white-space: nowrap;
        }
        tbody tr:hover {
            background: #f1f7ff;
        }
        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .text-right {
            text-align: right;
        }

        button:disabled {
            background-color: #cccccc !important;
            color: #666666;
            cursor: not-allowed;
            opacity: 0.7;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="button-group">
        <button type="button" class="back-button" onclick="window.location.href='/evngDashboard1'">Back</button>
    </div>

    <h2>📋 Telecallers List</h2>
    <?php if (!empty($_GET['assigned'])): ?>
        <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border-radius: 5px; text-align: center;">
            ✅ Bulk assignment successful!
        </div>
    <?php endif; ?>
    <!-- 🔍 FILTER FORM (GET) -->
    <form method="GET" action="/viewAllTelecallersList">
        <div class="table-wrapper">
            <div style="margin-bottom: 20px;">
                <label>🌐 Source:
                    <input type="text" name="filter[source]" value="<?= htmlspecialchars($_GET['filter']['source'] ?? '') ?>">
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
                    <input type="text" name="filter[assignedTo]" value="<?= htmlspecialchars($_GET['filter']['assignedTo'] ?? '') ?>">
                </label>

                <label>📌 Status:
                    <input type="text" name="filter[status]" value="<?= htmlspecialchars($_GET['filter']['status'] ?? '') ?>">
                </label>
                <button type="submit" style="background-color: #007BFF; color: white;">🔍 Apply Filters</button>
            </div>
        </div>
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
                    <th>📌 Status</th>
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
                        <td><?= htmlspecialchars($record->status ?? '') ?></td>
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
                <option value="<?= htmlspecialchars($telecaller['evngName']) ?>">
                    <?= htmlspecialchars($telecaller['evngName']) ?> (<?= $telecaller['unassigned_count'] ?>)
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
</body>
</html>
