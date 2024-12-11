<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve/Reject Form</title>

    <!-- Include Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
            z-index: 1;
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
            margin: 15% auto;
            display: block;
            width: 80%;
            max-width: 700px;
            max-height: 80%;
        }

        /* Close button for modal */
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
    </style>
</head>
<body>

<div class="container">
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
            </tr>
            </thead>
            <tbody>
            <!-- Loop through each member in the 'members' array -->
            <?php foreach ($members as $member): ?>
                <tr>
                    <td class="photo-column">
                        <img src="uploads/photos/<?= htmlspecialchars($member['photo']) ?>" alt="<?= htmlspecialchars($member['photo']) ?>" onclick="openModal(this)">
                    </td>
                    <td><?= $member['zion_id'] ?></td>
                    <td><?= $member['evngName'] ?></td>
                    <td><?= $member['mobile'] ?></td>
                    <td><?= $member['fellowship'] ?></td>
                    <td><?= $member['email'] ?></td>
                    <td><?= $member['referredBy'] ?></td>
                    <td><?= $member['status'] ?></td>
                    <td><?= isset($member['reject_reason']) ? $member['reject_reason'] : 'N/A' ?></td> <!-- Check if the rejected_reason exists -->

                    <td>
                        <div class="button-group">
                            <button class="approve-button" onclick="approveRow(this)">
                                <i class="fas fa-check"></i> <!-- Approve icon -->
                            </button>
                            <button class="reject-button" onclick="rejectRow(this)">
                                <i class="fas fa-times-circle"></i> <!-- Reject icon -->
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Structure -->
<div id="photoModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImage" alt="Modal Photo">
</div>

<script>
    // Function to open the modal and display the clicked photo
    function openModal(imageElement) {
        const modal = document.getElementById("photoModal");
        const modalImage = document.getElementById("modalImage");

        modal.style.display = "block"; // Show the modal
        modalImage.src = imageElement.src; // Set the source of the modal image to the clicked image
    }

    // Function to close the modal
    function closeModal() {
        const modal = document.getElementById("photoModal");
        modal.style.display = "none"; // Hide the modal
    }

    // Function to handle the "Approve" button click
    function approveRow(button) {
        const row = button.closest('tr');
        row.querySelector('td:nth-child(7)').textContent = 'Approved'; // Set the status to "Approved"
        row.querySelector('td:nth-child(8)').textContent = 'N/A'; // Clear rejected reason
        row.querySelector('.approve-button').disabled = true; // Disable the approve button
        row.querySelector('.reject-button').disabled = true; // Disable the reject button
    }

    // Function to handle the "Reject" button click
    // Function to handle the "Reject" button click
    // Function to handle the "Reject" button click
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
                        console.log('Rejection status updated successfully');
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
