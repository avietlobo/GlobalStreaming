<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>7D Sathvartha Approval List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .table-container {
            width: 100%;
            overflow-x: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        thead {
            background-color: #007bff;
            color: white;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            white-space: nowrap; /* Prevents text wrapping in small screens */
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tbody tr:hover {
            background-color: #f1f1f1;
        }
        .action-buttons a {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            font-weight: bold;
            margin: 2px;
            display: inline-block;
            text-align: center;
        }
        .approve-btn {
            background-color: #28a745;
            color: white;
        }
        .reject-btn {
            background-color: #dc3545;
            color: white;
        }
        .approve-btn:hover {
            background-color: #218838;
        }
        .reject-btn:hover {
            background-color: #c82333;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .table-container {
                overflow-x: auto;
                padding: 10px;
            }
            table {
                font-size: 14px;
                width: 100%;
            }
            th, td {
                padding: 8px;
            }
            h2 {
                font-size: 20px;
            }
            .action-buttons a {
                padding: 6px 10px;
                font-size: 12px;
            }
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;  /* Smaller padding */
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;  /* Smaller border radius */
            cursor: pointer;
            text-decoration: none;
            font-size: 13px;  /* Smaller font size */
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-top: 15px;
        }

        .back-button:hover {
            background-color: #0056b3;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
        }

        .back-button i {
            margin-right: 5px;  /* Adjusted margin for a tighter look */
        }

        .header {
            display: flex;
            justify-content: flex-end;
            padding: 10px 20px;
            background-color: #ffffff; /* Optional: set to transparent or the same as the body background */
            box-shadow: none; /* Remove the box-shadow to eliminate the gray line */
        }

    </style>
</head>
<body>
<div class="header">
    <a class="nav-link" href="#" id="logout-link">
        <button type="button" class="btn btn-primary">Logout</button>
    </a>
</div>

<div class="container">
    <button type="button" class="back-button" onclick="window.location.href='/evngDashboard1'">
        <i class="fas fa-arrow-left"></i> Back
    </button>
</div>


<h2>7D Sathvartha Approval List</h2>

<div class="table-container">
    <table>
        <thead>
        <tr>
            <th>Mobile</th>
            <th>Record Date</th>
            <th>Participant Name</th>
            <th>Country</th>
            <th>Language</th>
            <th>Evangelist</th>
            <th>Source</th>
            <th>Alloted Days</th>
            <th>Media Type</th>
            <th>Active Status</th>
            <th>User ID</th>
            <th>Remark</th>
            <th>Work Group</th>
            <th>Action</th>
            <th>Approved By</th> <!-- Added this line -->
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($models)): ?>
            <?php foreach ($models as $candidate): ?>
                <tr>
                    <td><?= htmlspecialchars($candidate->mobile) ?></td>
                    <td><?= htmlspecialchars($candidate->recordDate) ?></td>
                    <td><?= htmlspecialchars($candidate->participantName) ?></td>
                    <td><?= htmlspecialchars($candidate->country) ?></td>
                    <td><?= htmlspecialchars($candidate->language) ?></td>
                    <td><?= htmlspecialchars($candidate->evangelist) ?></td>
                    <td><?= htmlspecialchars($candidate->source) ?></td>
                    <td><?= htmlspecialchars($candidate->allotedDays) ?></td>
                    <td><?= htmlspecialchars($candidate->mediaType) ?></td>
                    <td><?= htmlspecialchars($candidate->activeStatus) ?></td>
                    <td><?= htmlspecialchars($candidate->userid) ?></td>
                    <td><?= htmlspecialchars($candidate->remark) ?></td>
                    <td><?= htmlspecialchars($candidate->wgroup) ?></td>
                    <td class="action-buttons">
                        <button type="button" class="approve-btn" onclick='openCaretakerModal(<?= json_encode($candidate) ?>)'>Approve</button>
                        <a href="/rejectCandidate?id=<?= $candidate->mobile ?>" class="reject-btn">Reject</a>
                    </td>
                    <td><?= htmlspecialchars($candidate->approvedBy ?? '') ?></td> <!-- Added this line -->
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="14" style="text-align: center; color: #666;">No candidates available for approval.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>



<!-- Modal -->
<!-- Modal -->
<div id="caretakerModal" style="
    display: none;
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 1000;
    padding: 20px;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
">
    <div style="
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        width: 100%;
        max-width: 400px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        animation: fadeIn 0.3s ease-in-out;
    ">
        <h3 style="margin-top: 0; margin-bottom: 15px; font-size: 20px; color: #333;">Approve Candidate</h3>
        <form method="POST" action="approveCandidate.php">
            <input type="hidden" name="candidate_mobile" id="candidate_mobile">

            <label for="caretaker_email" style="display: block; margin-bottom: 5px; color: #444; font-weight: bold;">
                Caretaker Email:
            </label>
            <select name="caretaker_email" id="caretaker_email" required style="
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 6px;
                font-size: 14px;
                margin-bottom: 20px;
            ">
                <option value="">-- Select Caretaker Email --</option>
                <option value="joalencheril@gmail.com">Joan Lencheril (joalencheril@gmail.com)</option>
                <option value="priyankay@caretaker.com">Priyanka (priyankay@caretaker.com)</option>
                <option value="xyz@gmail.com">John Doe (xyz@gmail.com)</option>
            </select>

            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeCaretakerModal()" class="reject-btn" style="
                    background-color: #6c757d;
                    border: none;
                    color: white;
                    padding: 10px 16px;
                    border-radius: 5px;
                    font-weight: bold;
                    cursor: pointer;
                ">Cancel</button>
                <button type="submit" class="approve-btn" style="
                    background-color: #28a745;
                    border: none;
                    color: white;
                    padding: 10px 16px;
                    border-radius: 5px;
                    font-weight: bold;
                    cursor: pointer;
                ">Submit</button>
            </div>
        </form>
    </div>
</div>

<!-- Optional: Fade In Animation -->
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
</style>

<script>
    function openCaretakerModal(candidate) {
        document.getElementById('caretakerModal').style.display = 'flex';

        const form = document.querySelector('#caretakerModal form');
        form.innerHTML = ''; // Clear existing form

        // Start fresh form content
        form.innerHTML += `
        <input type="hidden" name="mobile" value="${candidate.mobile || ''}">
        <input type="hidden" name="recordDate" value="${candidate.recordDate || ''}">
        <input type="hidden" name="participantName" value="${candidate.participantName || ''}">
        <input type="hidden" name="country" value="${candidate.country || ''}">
        <input type="hidden" name="language" value="${candidate.language || ''}">
        <input type="hidden" name="evangelist" value="${candidate.evangelist || ''}">
        <input type="hidden" name="source" value="${candidate.source || ''}">
        <input type="hidden" name="allotedDays" value="${candidate.allotedDays || ''}">
        <input type="hidden" name="mediaType" value="${candidate.mediaType || ''}">
        <input type="hidden" name="activeStatus" value="${candidate.activeStatus || ''}">
        <input type="hidden" name="userid" value="${candidate.userid || ''}">
        <input type="hidden" name="remark" value="${candidate.remark || ''}">
        <input type="hidden" name="wgroup" value="${candidate.wgroup || ''}">

        <label for="caretaker_email" style="display: block; margin-bottom: 5px; color: #444; font-weight: bold;">
            Caretaker Email:
        </label>
        <select name="caretaker_email" id="caretaker_email" required style="
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            margin-bottom: 20px;
        ">
            <option value="">-- Select Caretaker Email --</option>
    <option value="josseyalencheril@gmail.com">Jossey Jommon (joalencheril@gmail.com)</option>
    <option value="yesuelizabethemmanuel2021@gmail.com">Liza Elizabeth (priyankay@caretaker.com)</option>
        </select>

        <div style="display: flex; justify-content: flex-end; gap: 10px;">
            <button type="button" onclick="closeCaretakerModal()" class="reject-btn" style="
                background-color: #6c757d;
                border: none;
                color: white;
                padding: 10px 16px;
                border-radius: 5px;
                font-weight: bold;
                cursor: pointer;
            ">Cancel</button>
            <button type="submit" class="approve-btn" style="
                background-color: #28a745;
                border: none;
                color: white;
                padding: 10px 16px;
                border-radius: 5px;
                font-weight: bold;
                cursor: pointer;
            ">Submit</button>
        </div>
    `;

        form.setAttribute("action", "/approve7DCandidate");
        form.setAttribute("method", "POST");
    }

    function closeCaretakerModal() {
        document.getElementById('caretakerModal').style.display = 'none';
    }
</script>
</body>

</html>
