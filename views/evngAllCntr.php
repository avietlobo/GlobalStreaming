<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Evangelists & Country Preferences</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f1f5f9;
            margin: 0;
            padding: 0;
            color: #1e293b;
        }

        .back-link {
            display: inline-block;
            margin: 20px 0 0 20px;
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            background-color: #e0f2fe;
            padding: 6px 12px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .back-link:hover {
            background-color: #bfdbfe;
            color: #1d4ed8;
        }

        .container {
            max-width: 1100px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        h2 {
            text-align: center;
            color: #0f172a;
            font-size: 28px;
            margin-bottom: 25px;
        }

        .search-container {
            text-align: right;
            margin-bottom: 20px;
        }

        .search-container input {
            width: 280px;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .search-container input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 4px rgba(37, 99, 235, 0.4);
        }

        .table-wrapper {
            overflow-x: auto;
            border-radius: 12px;
            position: relative;
        }

        /* Scroll indicator arrow */
        .scroll-indicator {
            display: none;
            text-align: center;
            color: #64748b;
            font-size: 14px;
            margin-bottom: 10px;
            animation: bounce 1.2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateX(0); }
            50% { transform: translateX(5px); }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        thead {
            background-color: #2563eb;
            color: white;
        }

        th, td {
            padding: 14px 18px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
            font-size: 15px;
            white-space: nowrap;
        }

        th {
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        tr:hover {
            background-color: #f1f5ff;
        }

        .no-country {
            color: #9ca3af;
            font-style: italic;
        }

        .country-badge {
            display: inline-block;
            background-color: #e0f2fe;
            color: #0369a1;
            padding: 4px 10px;
            border-radius: 20px;
            margin: 2px;
            font-size: 13px;
            font-weight: 500;
        }

        .footer-note {
            text-align: center;
            color: #94a3b8;
            margin-top: 30px;
            font-size: 13px;
        }

        /* 🌐 Responsive Styles */
        @media (max-width: 992px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 24px;
            }

            .search-container {
                text-align: center;
            }

            .search-container input {
                width: 100%;
                margin-top: 10px;
                margin-bottom: 15px;
            }

            th, td {
                padding: 10px 12px;
                font-size: 14px;
            }
        }

        @media (max-width: 600px) {
            body {
                background-color: #f8fafc;
            }

            .container {
                padding: 15px;
                border-radius: 10px;
                box-shadow: none;
            }

            h2 {
                font-size: 20px;
                margin-bottom: 15px;
            }

            .scroll-indicator {
                display: block;
            }

            .search-container input {
                font-size: 13px;
                padding: 8px 10px;
            }

            .country-badge {
                font-size: 12px;
                padding: 3px 8px;
            }

            th, td {
                font-size: 13px;
                padding: 8px 10px;
            }

            table {
                min-width: 100%;
            }

            .footer-note {
                font-size: 12px;
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>
<a class="back-link" onclick="window.location.href='/evngDashboard1'">← Back</a>

<div class="container">
    <h2>🌍 Evangelists and Their Allocated Countries</h2>

    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search evangelist or country... 🔍">
    </div>

    <!-- Scroll indicator for mobile -->
    <div class="scroll-indicator" id="scrollIndicator">
        👉 Scroll horizontally to view all columns
    </div>

    <div class="table-wrapper" id="tableWrapper">
        <table id="evangelistTable">
            <thead>
            <tr>
                <th>Evangelist Name</th>
                <th>Email</th>
                <th>Countries</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($evangelists as $evng): ?>
                <tr>
                    <td><?= htmlspecialchars($evng['evngName']) ?></td>
                    <td><?= htmlspecialchars($evng['email']) ?></td>
                    <td>
                        <?php if ($evng['countries'] === 'No country allocated yet'): ?>
                            <span class="no-country"><?= $evng['countries'] ?></span>
                        <?php else:
                            $countries = explode(',', $evng['countries']);
                            foreach ($countries as $country): ?>
                                <span class="country-badge"><?= htmlspecialchars(trim($country)) ?></span>
                            <?php endforeach;
                        endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="footer-note">
        © <?= date('Y') ?> Evangelist Management System — Powered by Faith & Technology
    </div>
</div>

<script>
    // Live search filter
    const searchInput = document.getElementById('searchInput');
    const tableRows = document.querySelectorAll('#evangelistTable tbody tr');

    searchInput.addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        tableRows.forEach(row => {
            const name = row.cells[0].innerText.toLowerCase();
            const email = row.cells[1].innerText.toLowerCase();
            const countries = row.cells[2].innerText.toLowerCase();
            row.style.display = (name.includes(filter) || email.includes(filter) || countries.includes(filter))
                ? '' : 'none';
        });
    });

    // Scroll indicator hide logic
    const tableWrapper = document.getElementById('tableWrapper');
    const scrollIndicator = document.getElementById('scrollIndicator');

    tableWrapper.addEventListener('scroll', function() {
        if (tableWrapper.scrollLeft > 10) {
            scrollIndicator.style.display = 'none';
        } else {
            scrollIndicator.style.display = 'block';
        }
    });
</script>
</body>
</html>
