<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointments Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { margin: 0; font-family: Arial, sans-serif; }
        .content { padding: 20px; padding-bottom: 70px; min-height: 70vh; }
        .tab-content { display: none; }
        .tab-content.active { display: block; }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            display: flex;
            background-color: #f1f1f1;
            border-top: 1px solid #ccc;
        }

        .tab {
            flex: 1;
            padding: 10px 0;
            text-align: center;
            cursor: pointer;
            font-size: 14px;
            color: #333;
        }

        .tab.active {
            background-color: #ddd;
            font-weight: bold;
        }

        .loader {
            text-align: center;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="content">
    <div id="candidates" class="tab-content"></div>
    <div id="appointments" class="tab-content"></div>
    <div id="sathvartha" class="tab-content"></div>
    <div id="attendance" class="tab-content"></div>
</div>

<div class="bottom-nav">
    <div class="tab" id="candidates-tab" onclick="navigateToTab('candidates')">Candidates</div>
    <div class="tab" id="appointments-tab" onclick="navigateToTab('appointments')">Appointments</div>
    <div class="tab" id="sathvartha-tab" onclick="navigateToTab('sathvartha')">Sathvartha</div>
    <div class="tab" id="attendance-tab" onclick="navigateToTab('attendance')">Attendance</div>
</div>

<script>
    const tabApis = {
        candidates: '/viewCandidates',
        appointments: '/viewAppointments',
        sathvartha: '/viewSathvartha',
        attendance: '/viewAttendance'
    };

    function showTab(tab) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.tab').forEach(el => el.classList.remove('active'));

        const tabContent = document.getElementById(tab);
        const tabButton = document.getElementById(tab + '-tab');

        if (!tabContent || !tabButton || !tabApis[tab]) {
            console.warn("Tab or API not found:", tab);
            return;
        }

        tabContent.classList.add('active');
        tabButton.classList.add('active');
        tabContent.innerHTML = '<div class="loader">Loading...</div>';

        fetch(tabApis[tab])
            .then(response => response.text())
            .then(html => {
                tabContent.innerHTML = html;
            })
            .catch(err => {
                tabContent.innerHTML = '<div class="loader">Error loading content.</div>';
                console.error(err);
            });
    }

    function navigateToTab(tab) {
        if (!tabApis[tab]) return;
        history.pushState({ tab }, '', '/' + tabApis[tab].replace(/^\/+/, ''));
        showTab(tab);
    }

    window.addEventListener('popstate', (event) => {
        const tab = event.state?.tab || 'candidates';
        showTab(tab);
    });

    window.onload = function () {
        const urlPath = window.location.pathname;
        const match = Object.entries(tabApis).find(([key, path]) => path === urlPath);
        const initialTab = match ? match[0] : 'candidates';
        history.replaceState({ tab: initialTab }, '', tabApis[initialTab]);
        showTab(initialTab);
    };
</script>

</body>
</html>
