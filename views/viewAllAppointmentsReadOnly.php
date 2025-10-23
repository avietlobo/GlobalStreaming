<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Appointments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --page-bg: #f5f5f7;
            --header-bg: #1e293b;
            --header-text: #ffffff;
            --table-bg: #ffffff;
            --table-header-bg: #0d9488;
            --table-header-text: #ffffff;
            --row-bg: #ffffff;
            --row-hover: #d1fae5;
            --text-color: #111827;
            --btn-primary-bg: #0d9488;
            --btn-primary-hover: #0f766e;
            --btn-text: #ffffff;
            --btn-back-bg: #ede9fe;
            --btn-back-hover: #ddd6fe;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--page-bg);
            color: var(--text-color);
            margin: 0;
            padding: 0;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background-color: var(--header-bg);
            color: var(--header-text);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }

        .header-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-primary {
            background: var(--btn-primary-bg);
            color: var(--btn-text);
        }

        .btn-primary:hover {
            background: var(--btn-primary-hover);
        }

        .back-button {
            background: var(--btn-back-bg);
            color: #7c3aed;
        }

        .back-button:hover {
            background: var(--btn-back-hover);
        }

        .container {
            padding: 20px 40px;
        }

        .table-card {
            overflow-x: auto;
            background-color: var(--table-bg);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
            position: relative;
        }

        /* Scroll fade indicator */
        .table-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 40px;
            height: 100%;
            pointer-events: none;
            background: linear-gradient(to left, var(--page-bg), rgba(245,245,247,0));
            transition: opacity 0.3s;
        }

        .table-card.scrolled::after {
            opacity: 0;
        }

        .table-card table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1400px;
            font-size: 13px;
        }

        th, td {
            padding: 10px 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            background-color: var(--row-bg);
        }

        th {
            position: sticky;
            top: 0;
            background-color: var(--table-header-bg);
            color: var(--table-header-text);
            z-index: 2;
            text-transform: uppercase;
            font-size: 12px;
        }

        tr:hover {
            background-color: var(--row-hover);
        }

        td:last-child {
            text-align: center;
        }

        .search-input {
            margin-bottom: 15px;
            padding: 6px 12px;
            width: 250px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .pagination {
            margin-top: 15px;
            display: flex;
            justify-content: center;
            gap: 5px;
        }

        .page-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            background-color: #f3f3f3;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }

        .page-btn.active {
            background-color: var(--btn-primary-bg);
            color: #fff;
        }

        .page-btn:hover:not(.active) {
            background-color: #e5e5e5;
        }

        @media(max-width:1024px){
            header, .container {
                padding: 15px 20px;
            }
            .table-card table {
                font-size: 12px;
            }
            .btn {
                padding: 6px 12px;
                font-size: 13px;
            }
            .search-input {
                width: 100%;
            }
        }

        ::-webkit-scrollbar {
            height: 8px;
        }
        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }




    </style>
</head>

<body>

<header>
    <h1><?= htmlspecialchars($pageTitle) ?></h1>

    <div class="header-actions">
        <button class="btn btn-primary" onclick="window.location.href='/login'">Logout</button>
        <button class="btn back-button" onclick="window.location.href='/evngDashboard1'">
            <i class="fas fa-arrow-left"></i> Back
        </button>
    </div>
</header>



<div class="container">
    <p style="text-align:center; font-size:14px; color:#555; margin-bottom:5px;">
        👉 Swipe to see more
    </p>
    <input type="text" id="searchInput" class="search-input" placeholder="Search appointments...">

    <div class="table-card">


        <table id="appointmentsTable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Candidate Mobile</th>
                <th>Sathavartha Event</th>
                <th>Appointment (IST)</th>
                <th>Appointment (Candidate Zone)</th>
                <th>Country</th>
                <th>Place</th>
                <th>Class Status</th>
                <th>Sathvartha Organizer</th>
                <th>Panel Member</th>
                <th>Caring Team Member</th>
                <th>Local Organizer</th>
                <th>Google Meet Status</th>
                <th>Faith Status</th>
                <th>Sathvartha Ready Status</th>
                <th>Fellowship Status</th>
                <th>Evangelist Feedback</th>
                <th>Panel Feedback</th>
                <th>Local Organizer Feedback</th>
                <th>Final Feedback</th>
                <th>Sathvartha Attendance Status</th>
                <th>Sathvartha Feedback</th>
                <th>Caring Google Meet Status</th>
                <th>Caring Status</th>
                <th>Travel Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Transport Required</th>
                <th>Caring Google Meet Date</th>
                <th>Home Mission Event</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($appointments)): ?>
                <?php foreach ($appointments as $appointment): ?>
                    <tr>
                        <td><?= htmlspecialchars($appointment['id']) ?></td>
                        <td><?= htmlspecialchars($appointment['candidate_mobile']) ?></td>
                        <td><?= htmlspecialchars($appointment['event_name']) ?></td>
                        <td><?= htmlspecialchars($appointment['appointment_datetime_ist']) ?></td>
                        <td><?= htmlspecialchars($appointment['appointment_datetime_candidate_zone']) ?></td>
                        <td><?= htmlspecialchars($appointment['candidate_country']) ?></td>
                        <td><?= htmlspecialchars($appointment['place']) ?></td>
                        <td><?= htmlspecialchars($appointment['class_status']) ?></td>
                        <td><?= htmlspecialchars($appointment['sathvartha_organizer_name']) ?></td>
                        <td><?= htmlspecialchars($appointment['panel_member_name']) ?></td>
                        <td><?= htmlspecialchars($appointment['caring_team_member_name']) ?></td>
                        <td><?= htmlspecialchars($appointment['local_organizer_name']) ?></td>
                        <td><?= htmlspecialchars($appointment['google_meet_status']) ?></td>
                        <td><?= htmlspecialchars($appointment['faith_status']) ?></td>
                        <td><?= htmlspecialchars($appointment['sathvartha_ready_status']) ?></td>
                        <td><?= htmlspecialchars($appointment['fellowship_status']) ?></td>
                        <td><?= htmlspecialchars($appointment['evangelist_feedback']) ?></td>
                        <td><?= htmlspecialchars($appointment['panel_feedback']) ?></td>
                        <td><?= htmlspecialchars($appointment['local_organizer_feedback']) ?></td>
                        <td><?= htmlspecialchars($appointment['final_feedback']) ?></td>
                        <td><?= htmlspecialchars($appointment['sathvartha_attendance_status']) ?></td>
                        <td><?= htmlspecialchars($appointment['sathvartha_feedback']) ?></td>
                        <td><?= htmlspecialchars($appointment['caring_google_meet_status']) ?></td>
                        <td><?= htmlspecialchars($appointment['caring_status']) ?></td>
                        <td><?= htmlspecialchars($appointment['travel_status']) ?></td>
                        <td><?= htmlspecialchars($appointment['created_at']) ?></td>
                        <td><?= htmlspecialchars($appointment['updated_at']) ?></td>
                        <td><?= htmlspecialchars($appointment['transport_required']) ?></td>
                        <td><?= htmlspecialchars($appointment['caring_google_meet_date']) ?></td>
                        <td><?= htmlspecialchars($appointment['event_name_hs']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="31" style="text-align:center;padding:20px;">No appointments found.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="pagination" id="pagination"></div>
</div>

<script>
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('appointmentsTable');
    const allRows = [...table.getElementsByTagName('tbody')[0].getElementsByTagName('tr')];

    const rowsPerPage = 10;
    let currentPage = 1;

    // ----- Search Filter -----
    searchInput.addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        allRows.forEach(row => {
            row.dataset.visible = [...row.cells].some(cell =>
                cell.textContent.toLowerCase().includes(filter)
            ) ? "true" : "false";
        });
        currentPage = 1;
        setupPagination();
    });

    function getVisibleRows() {
        return allRows.filter(r => r.dataset.visible !== "false");
    }

    // ----- Pagination -----
    function setupPagination() {
        const visibleRows = getVisibleRows();
        const totalPages = Math.ceil(visibleRows.length / rowsPerPage);
        const pagination = document.getElementById('pagination');
        pagination.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement('button');
            btn.textContent = i;
            btn.className = 'page-btn' + (i === currentPage ? ' active' : '');
            btn.addEventListener('click', () => {
                currentPage = i;
                displayPage();
            });
            pagination.appendChild(btn);
        }
        displayPage();
    }

    function displayPage() {
        const visibleRows = getVisibleRows();

        // Hide all
        allRows.forEach(r => r.style.display = 'none');

        // Show only rows for this page
        visibleRows.forEach((row, index) => {
            if (index >= (currentPage - 1) * rowsPerPage && index < currentPage * rowsPerPage) {
                row.style.display = '';
            }
        });

        // Active page button
        const buttons = document.querySelectorAll('.page-btn');
        buttons.forEach((btn, i) => btn.classList.toggle('active', i + 1 === currentPage));
    }

    // Mark all as visible initially
    allRows.forEach(r => r.dataset.visible = "true");
    setupPagination();

    // ----- Scroll indicator -----
    const tableCard = document.querySelector('.table-card');
    function updateScrollIndicator() {
        if (tableCard.scrollLeft + tableCard.clientWidth >= tableCard.scrollWidth - 1) {
            tableCard.classList.add('scrolled');
        } else {
            tableCard.classList.remove('scrolled');
        }
    }
    tableCard.addEventListener('scroll', updateScrollIndicator);
    updateScrollIndicator();
</script>


</body>
</html>
