<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve/Reject Form</title>

    <!-- Include Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Include Roboto Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #333;
            text-align: center;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
            white-space: nowrap;
        }

        th {
            background-color: #f8f9fa;
        }

        td {
            background-color: #fff;
        }

        /* Styling for the photo column */
        .photo-column img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 2;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            width: 80%;
            text-align: center;
        }

        /* Close button for photo modal */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #fff;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #f1f1f1;
            text-decoration: none;
            cursor: pointer;
        }

        /* Button Group */
        .button-group {
            display: flex;
            justify-content: space-between;
            gap: 5px;
            width: 100%;
        }

        .approve-button, .reject-button {
            padding: 10px;
            border: none;
            border-radius: 50%;
            font-size: 18px;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .approve-button {
            background-color: #28a745;
            color: white;
        }

        .approve-button:hover {
            background-color: #218838;
        }

        .reject-button {
            background-color: #dc3545;
            color: white;
        }

        .reject-button:hover {
            background-color: #c82333;
        }

        /* Adjustments for smaller screen sizes */
        @media screen and (max-width: 768px) {
            table {
                width: 100%;
                overflow-x: auto;
                display: block;
            }

            th, td {
                font-size: 12px;
                padding: 8px;
                word-wrap: break-word;
            }

            .approve-button, .reject-button {
                width: 35px;
                height: 35px;
                font-size: 16px;
            }

            .button-group {
                flex-direction: column;
                gap: 10px;
            }
        }

        td:last-child {
            width: 120px;
        }

        .table-container {
            overflow-x: auto;
        }
        .header {
            display: flex;
            justify-content: flex-end;
            padding: 10px 20px;
            background-color: #ffffff; /* Optional: set to transparent or the same as the body background */
            box-shadow: none; /* Remove the box-shadow to eliminate the gray line */
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
    <h1>Global Member Registration</h1>

    <!-- Table of members in a scrollable container -->
    <div class="table-container">
        <table>
            <thead>
            <tr>
                <th>Photo</th>
                <th>Zion ID</th>
                <th>Evangelist</th>
                <th>Mobile</th>
                <th>Fellowship</th>
                <th>Email</th>
                <th>Referred By</th>
                <th>Status</th>
                <th>Rejected Reason</th>
                <th>Actions</th>
                <th>Designation</th>
                <th>Approved/Rejected By</th>
                <th>Work group ID</th>
            </tr>
            </thead>
            <tbody>
            <!-- Loop through each member in the 'members' array -->
            <?php use app\core\Application;

            foreach ($members as $member): ?>
                <tr>
                    <td class="photo-column">
                        <img src="uploads/photos/<?= htmlspecialchars($member['photo']) ?>" alt="<?= htmlspecialchars($member['photo']) ?>" onclick="openModal(this)">
                    </td>
                    <td><?= $member['zion_id'] ?></td>
                    <td><?= $member['evngName'] ?></td>
                    <td><?= $member['mobile'] ?></td>
                    <td><?= $member['fellowship'] ?></td>
                    <td><?= $member['email'] ?></td>
                    <td><?= Application::$app->session->get('loginForm')->username; ?></td>
                    <td><?= $member['status'] ?></td>
                    <td><?= isset($member['reject_reason']) ? $member['reject_reason'] : 'N/A' ?></td>

                    <td>
                        <div class="button-group">
                            <?php if ($member['status'] !== 'Approved'): ?>
                                <!-- Show Approve and Reject buttons if not Approved -->
                                <button class="approve-button" onclick="approveRow(this)">
                                    <i class="fas fa-check"></i> <!-- Approve icon -->
                                </button>
                                <button class="reject-button" onclick="rejectRow(this)">
                                    <i class="fas fa-times-circle"></i> <!-- Reject icon -->
                                </button>
                            <?php endif; ?>
                        </div>
                    </td>
                    <td><?= isset($member['designation']) ? $member['designation'] : 'N/A' ?></td>
                    <td><?= isset($member['updatedBy']) ? $member['updatedBy'] : 'N/A' ?></td>
                    <td><?= $member['wgroupId'] ?></td>

                </tr>
            <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</div>

<!-- Photo Modal Structure -->
<div id="photoModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImage" alt="Modal Photo">
</div>

<!-- Confirmation Modal Structure -->
<div id="confirmApproveModal" class="modal">
    <div class="modal-content">
        <h3>Confirm Approval</h3>
        <p>Are you sure you want to approve this member?</p>
        <div style="text-align: right;">
            <button id="cancelButton" style="margin-right: 10px;">Cancel</button>
            <button id="confirmButton" style="background-color: #28a745; color: white; padding: 10px; border: none; border-radius: 5px;">Approve</button>
        </div>
    </div>
</div>

<script>
    function openModal(imgElement) {
        var modal = document.getElementById("photoModal");
        var modalImg = document.getElementById("modalImage");
        modal.style.display = "flex";
        modalImg.src = imgElement.src;
    }

    function closeModal() {
        var modal = document.getElementById("photoModal");
        modal.style.display = "none";
    }

    function approveRow(button) {
        const row = button.closest("tr");
        const memberId = row.cells[1].textContent; // Get the Zion ID from the second column
        if (confirm('Are you sure you want to approve this member?')) {
            // Implement the approve logic (e.g., send an AJAX request to update the status)
            alert(`Approved member with Zion ID: ${memberId}`);
            row.cells[7].textContent = 'Approved'; // Update status
        }
    }

    function rejectRow(button) {
        const row = button.closest("tr");
        const memberId = row.cells[1].textContent; // Get the Zion ID from the second column
        if (confirm('Are you sure you want to reject this member?')) {
            // Implement the reject logic (e.g., send an AJAX request to update the status)
            alert(`Rejected member with Zion ID: ${memberId}`);
            row.cells[7].textContent = 'Rejected'; // Update status
        }
    }
</script>
</body>
</html>




<script>
    function goBack() {
        window.history.back();
    }

    // Function to open the photo modal and display the clicked photo
    function openModal(imageElement) {
        const modal = document.getElementById("photoModal");
        const modalImage = document.getElementById("modalImage");

        modal.style.display = "block"; // Show the modal
        modalImage.src = imageElement.src; // Set the source of the modal image to the clicked image
    }

    // Function to close the photo modal
    function closeModal() {
        const modal = document.getElementById("photoModal");
        modal.style.display = "none"; // Hide the modal
    }

    function approveRow(button) {
        const row = button.closest('tr');
        const memberId = row.querySelector('td:nth-child(2)').textContent; // Assuming Zion ID is in the second column
        const mobile = row.querySelector('td:nth-child(4)').textContent;   // Mobile is in the fourth column
        const evngName = row.querySelector('td:nth-child(3)').textContent; // Evangelist name is in the third column
        const email = row.querySelector('td:nth-child(6)').textContent;    // Email is in the sixth column
        const designation = row.querySelector('td:nth-child(11)').textContent;
        const workgroup = row.querySelector('td:nth-child(13)').textContent;   // Email is in the sixth column
        // Show the confirmation modal
        const modal = document.getElementById('confirmApproveModal');
        modal.style.display = 'flex';

        // Handle confirmation button click
        const confirmButton = document.getElementById('confirmButton');
        const cancelButton = document.getElementById('cancelButton');

        // Define a function to handle the approval process
        function confirmApproval() {
            // Disable the buttons after clicking
            row.querySelector('.approve-button').disabled = true;
            row.querySelector('.reject-button').disabled = true;

            // Prepare data for the API call
            const data = {
                member_id: memberId,
                status: 'Approved',
                mobile: mobile,
                evangelist: evngName,
                emailID: email,
                designation: designation,
                workgroup: workgroup
            };

            // Send the data to the server via API (POST request)
            fetch('approveRegistration', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }

                    // Update the UI directly if the approval was successful
                    row.querySelector('td:nth-child(8)').textContent = 'Approved';
                    row.querySelector('td:nth-child(9)').textContent = '';
                })
                .catch(error => {
                    console.error('Error during API call:', error);
                    alert(`An error occurred while approving the record: ${error.message}`);
                })
                .finally(() => {
                    // Close the confirmation modal
                    modal.style.display = 'none';
                });
        }

        // Attach event listeners
        confirmButton.onclick = confirmApproval;
        cancelButton.onclick = () => {
            modal.style.display = 'none'; // Close the modal if Cancel is clicked
        };
    }
    function rejectRow(button) {
        const row = button.closest('tr');
        const memberId = row.querySelector('td:nth-child(2)').textContent; // Assuming Zion ID is in the second column
        const rejectedReason = prompt('Please enter the reason for rejection:');

        if (rejectedReason) {
            // Disable the buttons after clicking
            row.querySelector('.approve-button').disabled = true;
            row.querySelector('.reject-button').disabled = true;

            // Prepare data for the API call
            const data = {
                member_id: memberId,
                status: 'Rejected',
                rejected_reason: rejectedReason
            };

            // Send the data to the server via API (POST request)
            fetch('rejectRegistration', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            })
                .then(response => {
                    // Handle non-2xx HTTP responses (e.g., 4xx, 5xx)
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }

                    // Check the response content type
                    const contentType = response.headers.get("Content-Type");

                    if (contentType && contentType.includes("application/json")) {
                        // Only parse as JSON if the content type is application/json
                        return response.json();
                    } else {
                        // Otherwise, read as plain text
                        return response.text().then(text => ({ success: true, message: text }));
                    }
                })
                .then(result => {
                    console.log('API response:', result);

                    // Handle valid response (either success or no content)
                    if (result.success) {
                        // Update the UI directly if the rejection was successful
                        row.querySelector('td:nth-child(8)').textContent = 'Rejected'; // Update status to 'Rejected'
                        row.querySelector('td:nth-child(9)').textContent = rejectedReason; // Set rejected reason
                    } else {
                        alert(`Failed to update rejection status: ${result.message || 'Unknown error'}`);
                    }
                })
                .catch(error => {
                    // Log any other errors
                    console.error('Error during API call:', error);

                    // Enhanced alert to show the error message
                    alert(`An error occurred while rejecting the record: ${error.message}`);
                });
        }
    }

</script>

</body>
</html>
