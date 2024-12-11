# Global Streaming Project

## Overview
Global Streaming is a web-based application designed for evangelists to manage class requests, candidate interactions, and reporting. The platform provides unique functionality for tracking video engagement and managing evangelist registrations.

### Production and UAT Environments
- **Production Website**: [godsownwisdom.com](https://godsownwisdom.com)
- **UAT Website**: [testgow.site](https://testgow.site)

## Key Features

### Candidate Video Access
1. **Class Request and Login:**
   - Evangelists can request a class for a specific candidate through AppSheet.
   - A unique user ID and password are generated for the candidate, specific to a particular class.
2. **Video Viewing:**
   - Candidates log in to watch the video associated with their class.
   - The system tracks the total duration (in seconds) the video is played.
   - Upon logout, the playback duration is stored in the database.

### Evangelist Portal
1. **Evangelist Management:**
   - Evangelists can log in at:
     - **Production**: [godsownwisdom.com/login](https://godsownwisdom.com/login)
     - **UAT**: [testgow.site/login](https://testgow.site/login)
   - Functionality includes:
     - Adding new candidates.
     - Editing candidate details.
     - Requesting classes for candidates.
     - Searching for candidates by name or mobile number.
     - Filtering candidates based on status.

2. **Evangelist Registration:**
   - Evangelists can register new evangelists by submitting a form.
   - View submitted registration requests with statuses: **Approved**, **Rejected**, or **Pending**.

### Role-Based Access
- **Roles in the Application:**
  - **Evangelist**
  - **Management**
  - **Evangelist Coordinator**
  - **Group Leader**

1. **Approval Workflow:**
   - Management and Evangelist Coordinators can:
     - Approve or reject new evangelist registration requests.
     - Provide reasons for rejection.
     - Once approved, a new evangelist is added, and a password is generated.
     - Approved requests cannot be rejected subsequently.

2. **Reports:**
   - Management, Evangelist Coordinators, and Group Leaders can view various reports for monitoring and analysis.

## Repository Structure
- **/src**: Application source code.
- **/public**: Static files for the website.
- **/config**: Configuration files for different environments (e.g., production, UAT).
- **/scripts**: Utility scripts for managing the application.
- **/docs**: Documentation files.

## Setup Instructions
1. Clone the repository:
   ```bash
   git clone <repository-url>
   ```
2. Navigate to the project directory:
   ```bash
   cd global-streaming
   ```
3. Install dependencies:
   ```bash
   composer install
   npm install
   ```
4. Configure environment variables:
   - Copy `.env.example` to `.env`.
   - Update database and environment configurations as needed.
5. Run migrations:
   ```bash
   php artisan migrate
   ```
6. Start the application:
   ```bash
   php artisan serve
   ```

## Contribution Guidelines
1. Create a feature branch for new functionality:
   ```bash
   git checkout -b feature/<feature-name>
   ```
2. Commit changes with clear messages:
   ```bash
   git commit -m "Add feature: <feature-description>"
   ```
3. Push changes to the remote repository:
   ```bash
   git push origin feature/<feature-name>
   ```
4. Submit a pull request for review.

## License
This project is licensed under the MIT License. See the LICENSE file for details.

---

For further details, contact the project administrator.

