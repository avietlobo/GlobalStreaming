<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>📄 Task Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --bg-color: #f9f9f9;
            --card-bg: #ffffff;
            --text-color: #1a1a1a;
            --label-color: #555;
            --accent-color: #1DA1F2;
            --link-color: #1DA1F2;
        }

        body.dark-mode {
            --bg-color: #121212;
            --card-bg: #1e1e1e;
            --text-color: #f1f1f1;
            --label-color: #cccccc;
            --accent-color: #4ea1ff;
            --link-color: #4ea1ff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            position: relative;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 1.5em;
            margin: 0;
            color: var(--accent-color);
        }

        .toggle-switch {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card {
    background-color: var(--card-bg);
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    max-width: 600px;
    width: 100%;
    margin: 20px auto;
}

        .detail-row {
            margin: 12px 0;
            font-size: 1rem;
        }

        .detail-row strong {
            color: var(--label-color);
            display: inline-block;
            width: 140px;
        }

        a.back-link {
            display: block;
            text-align: center;
            margin-top: 25px;
            font-size: 1em;
            color: var(--link-color);
            text-decoration: none;
        }

        a.back-link:hover {
            text-decoration: underline;
        }

        .toggle-btn {
            appearance: none;
            width: 42px;
            height: 22px;
            background: #ccc;
            border-radius: 20px;
            position: relative;
            cursor: pointer;
            transition: background 0.3s;
        }

        .toggle-btn:checked {
            background: var(--accent-color);
        }

        .toggle-btn::before {
            content: '';
            position: absolute;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: white;
            top: 2px;
            left: 2px;
            transition: transform 0.3s;
        }

        .toggle-btn:checked::before {
            transform: translateX(20px);
        }

        .fab {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 56px;
            height: 56px;
            background-color: #0000ff;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            box-shadow: 0 4px 10px rgba(0,0,0,0.4);
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .fab:hover {
            background-color: #0000cc;
        }

        .fab svg {
            width: 28px;
            height: 28px;
            fill: white;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 99999;
            left: 0; top: 0;
            width: 100%; height: 100%;
            background-color: rgba(0,0,0,0.6);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: var(--card-bg);
            color: var(--text-color);
            padding: 20px;
            border-radius: 12px;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 4px 12px rgba(0,0,0,0.4);
        }

        .modal-content input,
        .modal-content textarea,
        .modal-content select {
            width: 100%;
            padding: 10px;
            margin-bottom: 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 1em;
        }

        .modal-actions {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .tab-btn {
            background-color: var(--accent-color);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.95em;
        }

        .tab-content {
            background: var(--card-bg);
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.1);
        }

        @media (max-width: 600px) {
            body {
                padding: 12px;
            }
             .card {
        padding: 16px;
        width: 100%;
        margin: 10px auto;
    }
            .detail-row {
                font-size: 0.95rem;
                display: flex;
                flex-direction: column;
            }
            .detail-row strong {
                width: 100%;
                margin-bottom: 2px;
            }
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
                margin-bottom: 16px;
            }
            .modal-actions {
                flex-direction: column;
            }
        }

        input[readonly] {
    background-color: #e9ecef;
    color: #6c757d;
    cursor: not-allowed;
}
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: var(--card-bg);
            color: var(--text-color);
            padding: 20px;
            border-radius: 12px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }

        .modal-content select,
        .modal-content input {
            width: 100%;
            margin-bottom: 12px;
            padding: 8px;
            font-size: 1em;
            border-radius: 6px;
            border: 1px solid #ccc;
        }


    </style>
</head>
<body>

<div class="header">
    <h2>📄 Task Details</h2>
    <div class="toggle-switch">
        🌗 Dark Mode
        <input type="checkbox" id="darkToggle" class="toggle-btn">
    </div>
</div>

<!-- Edit Form Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <h3>Edit Task</h3>
        <form id="editForm">
            <label>Mobile*</label>
            <input type="text" name="mobile" id="editMobile" readonly>

            <label>Candidate Name</label>
            <input type="text" name="name" id="editName">

<!--            <label>Country</label>-->
<!--            <input type="text" name="country" id="editCountry" readonly>-->

            <label>Country</label>
            <select name="country" id="editCountry" required>
                <option value="Afghanistan">Afghanistan</option>
                <option value="Albania">Albania</option>
                <option value="Algeria">Algeria</option>
                <option value="Andorra">Andorra</option>
                <option value="Angola">Angola</option>
                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                <option value="Argentina">Argentina</option>
                <option value="Armenia">Armenia</option>
                <option value="Australia">Australia</option>
                <option value="Austria">Austria</option>
                <option value="Azerbaijan">Azerbaijan</option>
                <option value="Bahamas">Bahamas</option>
                <option value="Bahrain">Bahrain</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Barbados">Barbados</option>
                <option value="Belarus">Belarus</option>
                <option value="Belgium">Belgium</option>
                <option value="Belize">Belize</option>
                <option value="Benin">Benin</option>
                <option value="Bhutan">Bhutan</option>
                <option value="Bolivia">Bolivia</option>
                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                <option value="Botswana">Botswana</option>
                <option value="Brazil">Brazil</option>
                <option value="Brunei">Brunei</option>
                <option value="Bulgaria">Bulgaria</option>
                <option value="Burkina Faso">Burkina Faso</option>
                <option value="Burundi">Burundi</option>
                <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                <option value="Cabo Verde">Cabo Verde</option>
                <option value="Cambodia">Cambodia</option>
                <option value="Cameroon">Cameroon</option>
                <option value="Canada">Canada</option>
                <option value="Central African Republic">Central African Republic</option>
                <option value="Chad">Chad</option>
                <option value="Chile">Chile</option>
                <option value="China">China</option>
                <option value="Colombia">Colombia</option>
                <option value="Comoros">Comoros</option>
                <option value="Congo (Congo-Brazzaville)">Congo (Congo-Brazzaville)</option>
                <option value="Costa Rica">Costa Rica</option>
                <option value="Croatia">Croatia</option>
                <option value="Cuba">Cuba</option>
                <option value="Cyprus">Cyprus</option>
                <option value="Czechia (Czech Republic)">Czechia (Czech Republic)</option>
                <option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
                <option value="Denmark">Denmark</option>
                <option value="Djibouti">Djibouti</option>
                <option value="Dominica">Dominica</option>
                <option value="Dominican Republic">Dominican Republic</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Egypt">Egypt</option>
                <option value="El Salvador">El Salvador</option>
                <option value="Equatorial Guinea">Equatorial Guinea</option>
                <option value="Eritrea">Eritrea</option>
                <option value="Estonia">Estonia</option>
                <option value="Eswatini (fmr. 'Swaziland')">Eswatini (fmr. "Swaziland")</option>
                <option value="Ethiopia">Ethiopia</option>
                <option value="Fiji">Fiji</option>
                <option value="Finland">Finland</option>
                <option value="France">France</option>
                <option value="Gabon">Gabon</option>
                <option value="Gambia">Gambia</option>
                <option value="Georgia">Georgia</option>
                <option value="Germany">Germany</option>
                <option value="Ghana">Ghana</option>
                <option value="Greece">Greece</option>
                <option value="Greenland">Greenland</option>
                <option value="Grenada">Grenada</option>
                <option value="Guatemala">Guatemala</option>
                <option value="Guinea">Guinea</option>
                <option value="Guinea-Bissau">Guinea-Bissau</option>
                <option value="Guyana">Guyana</option>
                <option value="Haiti">Haiti</option>
                <option value="Holy See">Holy See</option>
                <option value="Honduras">Honduras</option>
                <option value="Hungary">Hungary</option>
                <option value="Iceland">Iceland</option>
                <option value="Special Case 1">Special Case 1</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Iran">Iran</option>
                <option value="Iraq">Iraq</option>
                <option value="Ireland">Ireland</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Jamaica">Jamaica</option>
                <option value="Japan">Japan</option>
                <option value="Jordan">Jordan</option>
                <option value="Kazakhstan">Kazakhstan</option>
                <option value="Kenya">Kenya</option>
                <option value="Kiribati">Kiribati</option>
                <option value="Kuwait">Kuwait</option>
                <option value="Kyrgyzstan">Kyrgyzstan</option>
                <option value="Laos">Laos</option>
                <option value="Latvia">Latvia</option>
                <option value="Lebanon">Lebanon</option>
                <option value="Lesotho">Lesotho</option>
                <option value="Liberia">Liberia</option>
                <option value="Libya">Libya</option>
                <option value="Liechtenstein">Liechtenstein</option>
                <option value="Lithuania">Lithuania</option>
                <option value="Luxembourg">Luxembourg</option>
                <option value="Madagascar">Madagascar</option>
                <option value="Malawi">Malawi</option>
                <option value="Malaysia">Malaysia</option>
                <option value="Maldives">Maldives</option>
                <option value="Mali">Mali</option>
                <option value="Malta">Malta</option>
                <option value="Marshall Islands">Marshall Islands</option>
                <option value="Mauritania">Mauritania</option>
                <option value="Mauritius">Mauritius</option>
                <option value="Mexico">Mexico</option>
                <option value="Micronesia">Micronesia</option>
                <option value="Moldova">Moldova</option>
                <option value="Monaco">Monaco</option>
                <option value="Mongolia">Mongolia</option>
                <option value="Montenegro">Montenegro</option>
                <option value="Morocco">Morocco</option>
                <option value="Mozambique">Mozambique</option>
                <option value="Myanmar (formerly Burma)">Myanmar (formerly Burma)</option>
                <option value="Namibia">Namibia</option>
                <option value="Nauru">Nauru</option>
                <option value="Nepal">Nepal</option>
                <option value="Netherlands">Netherlands</option>
                <option value="New Zealand">New Zealand</option>
                <option value="Nicaragua">Nicaragua</option>
                <option value="Niger">Niger</option>
                <option value="Nigeria">Nigeria</option>
                <option value="North Korea">North Korea</option>
                <option value="North Macedonia">North Macedonia</option>
                <option value="Norway">Norway</option>
                <option value="Oman">Oman</option>
                <option value="Special Case 2">Special Case 2</option>
                <option value="Palau">Palau</option>
                <option value="Palestine State">Palestine State</option>
                <option value="Panama">Panama</option>
                <option value="Papua New Guinea">Papua New Guinea</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Peru">Peru</option>
                <option value="Philippines">Philippines</option>
                <option value="Poland">Poland</option>
                <option value="Portugal">Portugal</option>
                <option value="Puerto Rico">Puerto Rico</option>
                <option value="Qatar">Qatar</option>
                <option value="Romania">Romania</option>
                <option value="Russia">Russia</option>
                <option value="Rwanda">Rwanda</option>
                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                <option value="Saint Lucia">Saint Lucia</option>
                <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                <option value="Samoa">Samoa</option>
                <option value="San Marino">San Marino</option>
                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                <option value="Saudi Arabia">Saudi Arabia</option>
                <option value="Senegal">Senegal</option>
                <option value="Serbia">Serbia</option>
                <option value="Seychelles">Seychelles</option>
                <option value="Sierra Leone">Sierra Leone</option>
                <option value="Singapore">Singapore</option>
                <option value="Slovakia">Slovakia</option>
                <option value="Slovenia">Slovenia</option>
                <option value="Solomon Islands">Solomon Islands</option>
                <option value="Somalia">Somalia</option>
                <option value="South Africa">South Africa</option>
                <option value="South Korea">South Korea</option>
                <option value="South Sudan">South Sudan</option>
                <option value="Spain">Spain</option>
                <option value="Sri Lanka">Sri Lanka</option>
                <option value="Sudan">Sudan</option>
                <option value="Suriname">Suriname</option>
                <option value="Sweden">Sweden</option>
                <option value="Switzerland">Switzerland</option>
                <option value="Syria">Syria</option>
                <option value="Taiwan">Taiwan</option>
                <option value="Tajikistan">Tajikistan</option>
                <option value="Tanzania">Tanzania</option>
                <option value="Thailand">Thailand</option>
                <option value="Timor-Leste">Timor-Leste</option>
                <option value="Togo">Togo</option>
                <option value="Tonga">Tonga</option>
                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                <option value="Tunisia">Tunisia</option>
                <option value="Turkey">Turkey</option>
                <option value="Turkmenistan">Turkmenistan</option>
                <option value="Tuvalu">Tuvalu</option>
                <option value="Uganda">Uganda</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Arab Emirates">United Arab Emirates</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States of America">United States of America</option>
                <option value="Uruguay">Uruguay</option>
                <option value="Uzbekistan">Uzbekistan</option>
                <option value="Vanuatu">Vanuatu</option>
                <option value="Venezuela">Venezuela</option>
                <option value="Vietnam">Vietnam</option>
                <option value="Yemen">Yemen</option>
                <option value="Zambia">Zambia</option>
            </select>

            <label>City</label>
            <input type="text" name="city" id="editCity">

<!--            <label>Language</label>-->
<!--            <input type="text" name="language" id="editLanguage" readonly>-->

            <label>Language</label>
            <select name="language" id="editLanguage" required>
                <option value="English">English</option>
                <option value="Kannada">Kannada</option>
                <option value="Konkani-Goan">Konkani-Goan</option>
                <option value="Konkani-Mangalore">Konkani-Mangalore</option>
                <option value="Portuguese">Portuguese</option>
                <option value="Hindi">Hindi</option>
                <option value="Italian">Italian</option>
                <option value="Spanish">Spanish</option>
                <option value="Tamil">Tamil</option>
                <option value="Tagalog">Tagalog</option>
                <option value="Arabic">Arabic</option>
                <option value="French">French</option>
            </select>
            <br><br>



            <label>Call Date*</label>
            <input type="date" name="call_date" id="editCallDate">

            <label>Calling Status*</label>
            <select name="status" id="editStatus">
                <option value="">Select</option>
                <option value="Positive">Positive</option>
                <option value="Negative">Negative</option>
                <option value="Neutral">Neutral</option>
                <option value="No response">No response</option>
                <option value="Ready for Sathvartha">Ready for Sathvartha</option>
            </select>

            <label>Remark*</label>
            <textarea name="remark" id="editRemark"></textarea>

            <div class="modal-actions">
                <button type="button" onclick="closeModal()">Cancel</button>
                <button type="submit">Save</button>
            </div>
        </form>
    </div>
</div>

<div style="display: flex; justify-content: center;">
    <div class="card">
        <div class="detail-row">
            <strong>📱 Mobile:</strong> <?= htmlspecialchars($task->mobile) ?>
        </div>
        <div class="detail-row">
            <strong>👤 Name:</strong> <?= htmlspecialchars($task->name) ?>
        </div>
        <div class="detail-row">
            <strong>📅 Record Date:</strong> <?= htmlspecialchars($task->record_date) ?>
        </div>
        <div class="detail-row">
            <strong>🏳️ Country:</strong> <?= htmlspecialchars($task->country) ?>
        </div>
        <div class="detail-row">
            <strong>🏙️ City:</strong> <?= htmlspecialchars($task->city) ?>
        </div>
        <div class="detail-row">
            <strong>🗣️ Language:</strong> <?= htmlspecialchars($task->language) ?>
        </div>
        <div class="detail-row">
            <strong>📞 Status:</strong> <?= htmlspecialchars(!empty($task->status) ? $task->status : 'Unassigned') ?>
        </div>
    </div>
</div>

<?php
$showTabs = isset($task->status) && $task->status === 'Positive';
?>
<?php
$disableOtherTabs = !$alreadyRegistered; // disable if candidate not registered
?>

<div id="tabsContainer" style="<?= $showTabs ? '' : 'display:none;' ?>; margin-top: 30px;">
    <div style="display: flex; gap: 10px; margin-bottom: 10px;">
        <button class="tab-btn" onclick="openTab('tab1')">Register Candidate since Positive</button>
        <button class="tab-btn" onclick="openTab1('tab2')"<?= $disableOtherTabs ? 'disabled style="opacity:0.5;cursor:not-allowed;"' : '' ?>>Streaming Classes</button>
        <button class="tab-btn" onclick="openTab1('tab3')"<?= $disableOtherTabs ? 'disabled style="opacity:0.5;cursor:not-allowed;"' : '' ?>>Word sharing</button>
        <button class="tab-btn" onclick="openTab('tab4')"<?= $disableOtherTabs ? 'disabled style="opacity:0.5;cursor:not-allowed;"' : '' ?>>Home mission</button>
        <button class="tab-btn" onclick="openTab('tab5')"<?= $disableOtherTabs ? 'disabled style="opacity:0.5;cursor:not-allowed;"' : '' ?>>Online Sathvartha</button>
    </div>



   <div id="tab1" class="tab-content">
       <?php if ($alreadyRegistered): ?>
        <div style="padding: 20px; background: #e2f0d9; border-radius: 10px; color: #2e7d32;">
            ✅ Candidate already registered.
        </div>
    <?php else: ?>
    <form id="candidateForm" method="post" action="/saveCandidate">
        <div style="display: flex; flex-wrap: wrap; gap: 20px;">
            <!-- Left Column -->
            <div style="flex: 1; min-width: 300px;">
 <!-- 📱 Mobile -->
<div class="form-group">
    <label>📱 Mobile*</label>
    <input type="text" name="mobile" required readonly value="<?= htmlspecialchars($task->mobile) ?>">
</div>

<!-- 👤 Participant Name -->
<div class="form-group">
    <label>👤 Participant Name*</label>
    <input type="text" name="participantName" required readonly value="<?= htmlspecialchars($task->name) ?>">
</div>
                <div class="form-group">
                    <label>🌎 Country</label>
                    <select name="country" required>
                        <option value="">Select Country</option>
                        <option value="Afghanistan">Afghanistan</option>
                        <option value="Albania">Albania</option>
                        <option value="Algeria">Algeria</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Armenia">Armenia</option>
                        <option value="Australia">Australia</option>
                        <option value="Austria">Austria</option>
                        <option value="Azerbaijan">Azerbaijan</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrain">Bahrain</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Belize">Belize</option>
                        <option value="Benin">Benin</option>
                        <option value="Bhutan">Bhutan</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Brazil">Brazil</option>
                        <option value="Brunei">Brunei</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Burkina Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                        <option value="Cabo Verde">Cabo Verde</option>
                        <option value="Cambodia">Cambodia</option>
                        <option value="Cameroon">Cameroon</option>
                        <option value="Canada">Canada</option>
                        <option value="Central African Republic">Central African Republic</option>
                        <option value="Chad">Chad</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Comoros">Comoros</option>
                        <option value="Congo (Congo-Brazzaville)">Congo (Congo-Brazzaville)</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Croatia">Croatia</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Cyprus">Cyprus</option>
                        <option value="Czechia (Czech Republic)">Czechia (Czech Republic)</option>
                        <option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Djibouti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominican Republic">Dominican Republic</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Egypt">Egypt</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                        <option value="Eritrea">Eritrea</option>
                        <option value="Estonia">Estonia</option>
                        <option value="Eswatini (fmr. &quot;Swaziland&quot;)">Eswatini (fmr. "Swaziland")</option>
                        <option value="Ethiopia">Ethiopia</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>
                        <option value="Gabon">Gabon</option>
                        <option value="Gambia">Gambia</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Germany">Germany</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Greece">Greece</option>
                        <option value="Greenland">Greenland</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guinea">Guinea</option>
                        <option value="Guinea-Bissau">Guinea-Bissau</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Holy See">Holy See</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hungary">Hungary</option>
                        <option value="Iceland">Iceland</option>
                        <option value="Special Case 1">Special Case 1</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Iran">Iran</option>
                        <option value="Iraq">Iraq</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japan">Japan</option>
                        <option value="Jordan">Jordan</option>
                        <option value="Kazakhstan">Kazakhstan</option>
                        <option value="Kenya">Kenya</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="Laos">Laos</option>
                        <option value="Latvia">Latvia</option>
                        <option value="Lebanon">Lebanon</option>
                        <option value="Lesotho">Lesotho</option>
                        <option value="Liberia">Liberia</option>
                        <option value="Libya">Libya</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lithuania">Lithuania</option>
                        <option value="Luxembourg">Luxembourg</option>
                        <option value="Madagascar">Madagascar</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Maldives">Maldives</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marshall Islands">Marshall Islands</option>
                        <option value="Mauritania">Mauritania</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Micronesia">Micronesia</option>
                        <option value="Moldova">Moldova</option>
                        <option value="Monaco">Monaco</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Montenegro">Montenegro</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Myanmar (formerly Burma)">Myanmar (formerly Burma)</option>
                        <option value="Namibia">Namibia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="New Zealand">New Zealand</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Niger">Niger</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="North Korea">North Korea</option>
                        <option value="North Macedonia">North Macedonia</option>
                        <option value="Norway">Norway</option>
                        <option value="Oman">Oman</option>
                        <option value="Special Case 2">Special Case 2</option>
                        <option value="Palau">Palau</option>
                        <option value="Palestine State">Palestine State</option>
                        <option value="Panama">Panama</option>
                        <option value="Papua New Guinea">Papua New Guinea</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Poland">Poland</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Romania">Romania</option>
                        <option value="Russia">Russia</option>
                        <option value="Rwanda">Rwanda</option>
                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                        <option value="Saint Lucia">Saint Lucia</option>
                        <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                        <option value="Samoa">Samoa</option>
                        <option value="San Marino">San Marino</option>
                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Serbia">Serbia</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Sierra Leone">Sierra Leone</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Slovakia">Slovakia</option>
                        <option value="Slovenia">Slovenia</option>
                        <option value="Solomon Islands">Solomon Islands</option>
                        <option value="Somalia">Somalia</option>
                        <option value="South Africa">South Africa</option>
                        <option value="South Korea">South Korea</option>
                        <option value="South Sudan">South Sudan</option>
                        <option value="Spain">Spain</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Syria">Syria</option>
                        <option value="Taiwan">Taiwan</option>
                        <option value="Tajikistan">Tajikistan</option>
                        <option value="Tanzania">Tanzania</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Timor-Leste">Timor-Leste</option>
                        <option value="Togo">Togo</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Turkmenistan">Turkmenistan</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States of America">United States of America</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Uzbekistan">Uzbekistan</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Vietnam">Vietnam</option>
                        <option value="Yemen">Yemen</option>
                        <option value="Zambia">Zambia</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>🗣️ Language</label>
                  <select name="language" required>
                        <option value="English">English</option>
                        <option value="Hindi">Hindi</option>
                        <option value="Kannada">Kannada</option>
                    </select>
                </div>
            </div>

            <!-- Right Column -->
            <div style="flex: 1; min-width: 300px;">
                <div class="form-group">
                    <label>🙏 Evangelist</label>
    <input type="text" name="evangelist" required value="<?= htmlspecialchars($_SESSION['evngName'] ?? '') ?>" readonly>
                </div>
                <div class="form-group">
                    <label>📲 Source</label>
                     <select name="source" required>
                        <option value="Facebook">Facebook</option>
                        <option value="TeleCall">TeleCall</option>
                        <option value="Telegram">Telegram</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>🗓️ Allotted Days</label>
                  <select name="allotedDays" required>
                        <option value="Random">Random Days</option>
                        <option value="Sunday">Sunday</option>
                        <option value="Daily">Daily</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>🎞️ Media Type</label>
                   <select name="mediaType" required>
                        <option value="Web Video">Web Video</option>
                        <option value="Web Audio">Web Audio</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>📌 Active Status</label>
                    <select name="activeStatus" required>
                        <option value="Active">Active</option>
                        <option value="Exit">Exit/Drop-out</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
                <?php
// Pull session data
$evangelistData = \app\core\Application::$app->session->get('evngDashboardData2');

$wgroup = '';
$email = '';

if (!empty($evangelistData) && isset($evangelistData[0]->wgroupId)) {
    $wgroup = $evangelistData[0]->wgroupId;
}

if (!empty($evangelistData) && isset($evangelistData[0]->email)) {
    $email = $evangelistData[0]->email;
}
?>

<!-- 👥 Work Group -->
<div class="form-group">
    <label>👥 Work Group</label>
    <input type="text" name="workGroup_display" value="<?= htmlspecialchars($wgroup) ?>" disabled style="background-color: #e9ecef; color: #6c757d;">
    <input type="hidden" name="workGroup" value="<?= htmlspecialchars($wgroup) ?>">
</div>

<!-- 🆔 User ID -->
<div class="form-group">
    <label>🆔 User ID</label>
    <input type="text" name="userId_display" value="<?= htmlspecialchars($email) ?>" disabled style="background-color: #e9ecef; color: #6c757d;">
    <input type="hidden" name="userId" value="<?= htmlspecialchars($email) ?>">
</div>
                <div class="form-group">
                    <label>💬 Remark</label>
                    <textarea name="remark" rows="3" style="resize: vertical;"></textarea>
                </div>
            </div>
        </div>

        <div style="text-align: right; margin-top: 20px;">
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
            <a href="/evngDashboard1" class="btn btn-secondary btn-sm">Cancel</a>
        </div>
    </form>
         <?php endif; ?>
</div>
    <div id="tab2" class="tab-content" style="display:none;"></div>

    <div id="tab3" class="tab-content" style="display:none;">
        <h3>Word sharing to Candidate</h3>
<!--        <div id="approvalStatus" style="margin-top: 20px;"></div>-->
        <form id="wordSharingForm" method="post" action="/saveWordSharingAssignment">
            <div class="form-group">
                <label for="language">Select Language</label>
                <select name="language" id="language" required>
                    <option value="">-- Select Language --</option>
                    <option value="Hindi">Hindi</option>
                    <option value="English">English</option>
                    <option value="Kannada">Kannada</option>
                    <!-- Add more if needed -->
                </select>
            </div>

            <div class="form-group">
                <label>Assignment Type</label><br>
                <label><input type="radio" name="assignmentType" value="self" checked> I will take the topics</label><br>
                <label><input type="radio" name="assignmentType" value="colleague"> Assign to a colleague</label>
            </div>

            <div class="form-group" id="colleagueSection" style="display: none;">
                <label for="colleague">Select Colleague</label>
                <select name="colleague" id="colleague">
                    <option value="">-- Select Colleague --</option>
                    <option value="Alice">Alice</option>
                    <option value="David">David</option>
                    <!-- Populate dynamically from DB if needed -->
                </select>
                <div class="form-group" id="reassignSection" style="display: none;">
                    <button type="button" class="btn btn-warning" onclick="sendReassignRequest()">🔁 Reassign</button>
                </div>
            </div>

            <div class="form-group" id="addBtnSection">
                <button type="button" class="btn btn-primary" onclick="openSessionModal()">Add</button>
            </div>

            <!-- ✅ MOVE THIS HERE -->
            <div id="approvalStatus" style="margin-top: 20px;"></div>
        </form>

        <!-- ✅ Display approval history here -->
<!--        <div id="approvalStatus" style="margin-top: 20px;"></div>-->
        <div id="sessionModal" class="modal" style="display: none;">
            <div class="modal-content">
                <h3>📆 Schedule Word Session</h3>
                <form id="sessionScheduleForm">
                    <label for="sessionName">Select Session</label>
                    <select id="sessionName" name="sessionName" required>
                        <option value="">-- Select Session --</option>
                        <option value="1">Session 1: SALVATION</option>
                        <option value="2">Session 2: 2ND COMING</option>
                        <option value="3">Session 3: Appa</option>
                        <option value="4">Session 4: Church</option>
                        <option value="5">Session 5: Amma</option>
                    </select>

                    <label for="sessionDate">Select Date & Time</label>
                    <input type="datetime-local" id="sessionDate" name="sessionDate" required>

                    <div class="modal-actions">
                        <button type="button" onclick="closeSessionModal()">Cancel</button>
                        <button type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="savedSessions" style="margin-top: 20px;"></div>
    </div>

    <div id="tab4" class="tab-content" style="display:none;">📕 This is Tab4 content</div>
    <div id="tab5" class="tab-content" style="display:none;">📗 This is Tab5 content</div>
</div>


<a class="back-link" href="/viewMyTasks">← Back to My Tasks</a>

<!-- Floating Edit Button -->
<!-- Floating Edit Button -->
<!-- Floating Edit Button -->
<!-- Floating Edit Button -->
<!-- Floating Edit Button -->
<a href="#" class="fab" title="Edit Task" onclick="openEditForm()">
    <svg xmlns="http://www.w3.org/2000/svg" height="28" viewBox="0 0 24 24" width="28" fill="white">
        <path d="M3 17.25V21h3.75l11.06-11.06-3.75-3.75L3 17.25zM20.71
        7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34a.9959.9959 0
        0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
    </svg>
</a>
<script>
    function sendReassignRequest() {
        const colleague = document.getElementById("colleague").value;
        const language = document.getElementById("language").value;
        if (!colleague) {
            alert("Please select a colleague.");
            return;
        }

        const data = new URLSearchParams();
        data.append("mobile", candidateMobile);
        data.append("candidate_name", candidateName);
        data.append("language", language);
        data.append("assigned_by", "<?= $_SESSION['evngName'] ?? '' ?>");
        data.append("assigned_to", colleague);
        data.append("remarks", "Word sharing reassignment request");

        fetch("/reassignWordSharing", {
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: data
        })
            .then(res => res.json())
            .then(response => {
                if (response.success) {
                    alert("✅ Reassignment request sent successfully!");
                } else {
                    alert("❌ Failed: " + response.message);
                }
            })
            .catch(err => {
                console.error(err);
                alert("An error occurred while sending request.");
            });
    }

</script>

<script>
    document.querySelectorAll('input[name="assignmentType"]').forEach(radio => {
        radio.addEventListener('change', function () {
            const type = this.value;
            document.getElementById('colleagueSection').style.display = (type === 'colleague') ? 'block' : 'none';
            document.getElementById('reassignSection').style.display = (type === 'colleague') ? 'block' : 'none';
            document.getElementById('addBtnSection').style.display = (type === 'self') ? 'block' : 'none';
        });
    });
</script>
<script>
    document.getElementById("sessionScheduleForm").addEventListener("submit", function (e) {
        e.preventDefault();

        const sessionId = document.getElementById("sessionName").value;
        const sessionDate = document.getElementById("sessionDate").value;

        if (!sessionId || !sessionDate) {
            alert("Please fill out all fields.");
            return;
        }

        const data = new URLSearchParams();
        data.append("mobile", "<?= htmlspecialchars($task->mobile) ?>");
        data.append("participant", "<?= htmlspecialchars($task->name) ?>");
        data.append("language", "<?= htmlspecialchars($task->language) ?>");
        data.append("sessionName", sessionId);
        data.append("sessionDate", sessionDate);

        fetch("/saveWordSession", {
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: data
        })
            .then(res => res.json())
            .then(response => {
                if (response.success) {
                    alert("✅ " + response.message);
                    closeSessionModal();
                    // Clear previously loaded data flag so we can reload
                    const tab3 = document.getElementById("tab3");
                    tab3.dataset.loaded = ""; // Clear flag
                    openTab1('tab3'); // Reload the tab content to show updated sessions
                } else {
                    alert("❌ " + response.message);
                }
            })
            .catch(err => {
                console.error(err);
                alert("Error occurred while saving session.");
            });
    });

</script>
<script>
    function openSessionModal() {
        document.getElementById("sessionModal").style.display = "flex";
    }

    function closeSessionModal() {
        document.getElementById("sessionModal").style.display = "none";
    }

    // Handle session schedule form submit
    document.getElementById("sessionScheduleForm").addEventListener("submit", function (e) {
        e.preventDefault();

        const sessionName = document.getElementById("sessionName").value;
        const sessionDate = document.getElementById("sessionDate").value;

        if (!sessionName || !sessionDate) {
            alert("Please fill out all fields.");
            return;
        }

        // ✅ You can use AJAX here to POST to your backend
        // For now, just show a success message
        alert(`Session "${sessionName}" scheduled for ${sessionDate}`);

        // Close the modal
        closeSessionModal();
    });
</script>

<script>
    document.querySelectorAll('input[name="assignmentType"]').forEach(radio => {
        radio.addEventListener('change', function () {
            const type = this.value;

            document.getElementById('colleagueSection').style.display = (type === 'colleague') ? 'block' : 'none';
            document.getElementById('addBtnSection').style.display = (type === 'self') ? 'block' : 'none';
        });
    });
</script>

<script>
    document.getElementById("candidateForm").addEventListener("submit", function(e) {
        e.preventDefault(); // Prevent default form submission

        const form = e.target;
        const formData = new URLSearchParams();
        for (const pair of new FormData(form)) {
            formData.append(pair[0], pair[1]);
        }

        fetch('/saveCandidate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Candidate saved successfully!");
                    window.location.href = "/viewMyTasks";
                } else {
                    alert("Failed: " + data.message);
                }
            })
            .catch(e => {
                console.error("Request failed", e);
                alert("Request failed. Please try again.");
            });
</script>

<script>
    // Embed PHP values as JS variables
    const candidateMobile = "<?= htmlspecialchars($task->mobile) ?>";
    const candidateName = "<?= htmlspecialchars($task->name) ?>";
</script>
<script>
    function openTab(tabId) {
        const allTabs = document.querySelectorAll('.tab-content');
        allTabs.forEach(tab => tab.style.display = 'none');

        const selectedTab = document.getElementById(tabId);
        selectedTab.style.display = 'block';

        // Load candidate form only when opening Tab 1
        if (tabId === 'tab1' && !selectedTab.dataset.loaded) {
            fetch('/candidatePartial')
                .then(response => {
                    if (!response.ok) throw new Error('Failed to load content');
                    return response.text();
                })
                .then(html => {
                    selectedTab.innerHTML = html;
                    selectedTab.dataset.loaded = "true";
                })
                .catch(error => {
                    selectedTab.innerHTML = '<p style="color:red;">Error loading form.</p>';
                    console.error(error);
                });
        }
        // ✅ Tab 3 (Word Sharing Sessions)
        if (tabId === 'tab3' && !selectedTab.dataset.loaded) {

            const sessionContainer = document.getElementById("savedSessions");
            sessionContainer.innerHTML = "<p>🔄 Loading saved sessions...</p>";

            fetch(`/getWordSessions?mobile=${encodeURIComponent(candidateMobile)}`)
                .then(response => response.json())
                .then(data => {
                    sessionContainer.innerHTML = ""; // Clear loading text
                    if (data.success && Array.isArray(data.sessions)) {
                        if (data.sessions.length === 0) {
                            sessionContainer.innerHTML = "<p>📭 No sessions found.</p>";
                        } else {
                            let html = "<h4>📝 My Word Sessions</h4><div style='display: flex; flex-direction: column; gap: 12px;'>";

                            data.sessions.forEach(session => {
                                const div = document.createElement("div");
                                div.className = "form-group";
                                div.innerHTML = `
                                <strong>📖 Session ${session.session_id}</strong> <br>
                                📅 ${session.session_date} <br>
                                📌 Status: ${session.status} <br>
                                📌 Assigned To: ${session.evangelist}
                                <hr>
                            `;
                                html += "</div>";
                                sessionContainer.appendChild(div);
                            });
                        }
                    } else {
                        sessionContainer.innerHTML = "<p style='color:red;'>Failed to load sessions.</p>";
                    }
                })
                .catch(error => {
                    console.error(error);
                    sessionContainer.innerHTML = "<p style='color:red;'>Error occurred while fetching sessions.</p>";
                });

            loadApprovalStatus(); // ✅ Load approval history from DB
            selectedTab.dataset.loaded = "true"; // Prevent reloading unless tab is refreshed
        }
        const statusDiv = document.getElementById("approvalStatus");

    }
</script>

<script>
    function loadApprovalStatus() {
        fetch(`/getApprovals?mobile=${encodeURIComponent(candidateMobile)}`)
            .then(res => res.json())
            .then(data => {
                let html = "<h4>📝 Reassignment History</h4><div style='display: flex; flex-direction: column; gap: 12px;'>";
                const statusDiv = document.getElementById("approvalStatus");
                if (data.success && Array.isArray(data.approvals)) {
                    if (data.approvals.length === 0) {
                        statusDiv.innerHTML = "<p style='color: gray;'>No previous reassignments.</p>";
                    } else {
                        let html = "<h4>📝 Reassignment History</h4>";
                        data.approvals.forEach(item => {
                            const color = item.status === 'Approved' ? 'green' :
                                item.status === 'Rejected' ? 'red' : 'orange';

                            html += `
        <div style="
            border: 1px solid #ccc;
            border-left: 5px solid ${color};
            padding: 12px 16px;
            border-radius: 8px;
            background-color: #f9f9f9;
        ">
            <p><strong>📲 Assigned to:</strong> ${item.assigned_to}</p>
            <p><strong>🔁 Status:</strong> <span style="color: ${color};">${item.status}</span></p>
            <p><strong>🕓 On:</strong> ${new Date(item.created_at).toLocaleString()}</p>
        </div>
    `;
                        });
                        html += "</div>";
                        statusDiv.innerHTML = html;
                    }
                } else {
                    statusDiv.innerHTML = "<p style='color:red;'>Failed to load approvals.</p>";
                }
            })
            .catch(error => {
                console.error(error);
                document.getElementById("approvalStatus").innerHTML = "<p style='color:red;'>Error fetching data.</p>";
            });
    }

</script>

<script>
    function openTab1(tabId) {
        const allTabs = document.querySelectorAll('.tab-content');
        allTabs.forEach(tab => tab.style.display = 'none');

        const selectedTab = document.getElementById(tabId);
        selectedTab.style.display = 'block';

        // 🔵 Streaming Classes Tab
        if (tabId === 'tab2' && !selectedTab.dataset.loaded) {
            const mobile = encodeURIComponent(candidateMobile);
            const username = encodeURIComponent("<?= htmlspecialchars($_SESSION['evngName'] ?? '') ?>");
            const candidate = encodeURIComponent("<?= htmlspecialchars($task->name) ?>");
            const index = encodeURIComponent("<?= htmlspecialchars($task->id ?? 0) ?>");

            const url = `/getClassDetails?username=${username}&candidate=${candidate}&mobile=${mobile}`;

            fetch(url)
                .then(response => {
                    if (!response.ok) throw new Error('Failed to load class details');
                    return response.text();
                })
                .then(html => {
                    selectedTab.innerHTML = html;
                    selectedTab.dataset.loaded = "true";
                })
                .catch(error => {
                    console.error(error);
                    selectedTab.innerHTML = '<p style="color:red;">Error loading class details.</p>';
                });
        }

        // ✅ Tab 3 (Word Sharing Sessions)
        if (tabId === 'tab3' && !selectedTab.dataset.loaded) {
            const sessionContainer = document.getElementById("savedSessions");
            sessionContainer.innerHTML = "<p>🔄 Loading saved sessions...</p>";

            fetch(`/getWordSessions?mobile=${encodeURIComponent(candidateMobile)}`)
                .then(response => response.json())
                .then(data => {
                    sessionContainer.innerHTML = ""; // Clear loading text
                    if (data.success && Array.isArray(data.sessions)) {
                        if (data.sessions.length === 0) {
                            sessionContainer.innerHTML = "<p>📭 No sessions found.</p>";
                        } else {
                            data.sessions.forEach(session => {
                                const div = document.createElement("div");
                                div.className = "form-group";div.innerHTML = `
    <div style="
        border: 1px solid #ddd;
        border-left: 4px solid #1DA1F2;
        background: #f5faff;
        padding: 12px 16px;
        border-radius: 6px;
        margin-bottom: 10px;
    ">
        <p><strong>📖 ID ${session.id}</strong></p>
        <p><strong>📖 Session ${session.session_id}</strong></p>
        <p><strong>📅 Date:</strong> ${session.session_date}</p>
        <p><strong>📌 Status:</strong> ${session.status}</p>
        <p><strong>📌 Assigned To:</strong> ${session.evangelist}</p>
        <p><strong>📌 Remark:</strong> ${session.remark}</p>
 <button class="tab-btn edit-btn"
                onclick="openEditSessionModal(
                    '${session.id}',
                    'Session ${session.session_id}',
                    '${session.session_date}',
                    '${session.status || ""}',
                    '${session.remark || ""}',
                     '${session.evangelist || ""}'
                )">✏️ Edit</button>
    </div>
`;
                                sessionContainer.appendChild(div);
                            });
                        }
                    } else {
                        sessionContainer.innerHTML = "<p style='color:red;'>Failed to load sessions.</p>";
                    }
                })
                .catch(error => {
                    console.error(error);
                    sessionContainer.innerHTML = "<p style='color:red;'>Error occurred while fetching sessions.</p>";
                });
            loadApprovalStatus(); // ✅ <-- THIS WAS MISSING

            selectedTab.dataset.loaded = "true"; // ✅
        }
    }
</script>


<script>
    document.getElementById("editForm").addEventListener("submit", function(e) {
        e.preventDefault();

        const form = this;
        const formData = new FormData(form);
        const status = formData.get("status");

        fetch("/updateTaskDetails", {
            method: "POST",
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert("Updated successfully!");
                    closeModal();

                    // Show tabs if status is Positive
                    if (status === "Positive") {
                        document.getElementById("tabsContainer").style.display = "block";
                    }

                } else {
                    alert("Update failed: " + data.message);
                }
            })
            .catch(err => {
                console.error(err);
                alert("An error occurred while updating.");
            });
    });
</script>

<script>
    function openTab(tabId) {
        const allTabs = document.querySelectorAll('.tab-content');
        allTabs.forEach(tab => tab.style.display = 'none');

        document.getElementById(tabId).style.display = 'block';
    }
</script>

<script>
    function openEditForm() {
        document.getElementById('editModal').style.display = 'flex';

        // Populate form from existing data
        document.getElementById('editMobile').value = "<?= htmlspecialchars($task->mobile) ?>";
        document.getElementById('editName').value = "<?= htmlspecialchars($task->name) ?>";
        document.getElementById('editCountry').value = "<?= htmlspecialchars($task->country) ?>";
        document.getElementById('editCity').value = "<?= htmlspecialchars($task->city) ?>";
        document.getElementById('editLanguage').value = "<?= htmlspecialchars($task->language) ?>";
        document.getElementById('editCallDate').value = "<?= htmlspecialchars($task->record_date) ?>"; // Or blank if separate
    }

    function closeModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    // Optional: Save handler
    document.getElementById("editForm").addEventListener("submit", function(e) {
        e.preventDefault();
        alert("Saving...");
        // TODO: Submit via AJAX or redirect with form values
        closeModal();
    });
</script>

<script>
    const toggle = document.getElementById('darkToggle');
    const savedTheme = localStorage.getItem('theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
        document.body.classList.add('dark-mode');
        toggle.checked = true;
    }

    toggle.addEventListener('change', function () {
        if (this.checked) {
            document.body.classList.add('dark-mode');
            localStorage.setItem('theme', 'dark');
        } else {
            document.body.classList.remove('dark-mode');
            localStorage.setItem('theme', 'light');
        }
    });
</script>
<div id="editSessionModal" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); justify-content:center; align-items:center;">
    <div class="modal-content" style="background:#fff; padding:20px; border-radius:8px; width:400px; position:relative;">
        <span onclick="closeEditSessionModal()" style="position:absolute; top:10px; right:15px; cursor:pointer; font-size:18px;">&times;</span>
        <h3>✏️ Edit Session</h3>
        <form id="editSessionForm">
            <input type="hidden" id="editSessionId" name="sessionId" >

            <label>Date & Time</label>
            <input type="datetime-local" id="editSessionDate" name="sessionDate" required><br><br>

            <label>Status</label>
            <select id="editSessionStatus" name="status" required>
                <option value="Scheduled">Scheduled</option>
                <option value="Completed">Completed</option>
                <option value="Missed">Missed</option>
                <option value="Cancelled">Cancelled</option>
            </select><br><br>

            <label>Assigned To (Evangelist)</label>
            <input type="text" id="editSessionEvangelist" name="evangelist" required readonly><br><br>


            <label>Remark</label>
            <textarea id="editSessionRemark" name="remark" rows="3"></textarea><br><br>

            <button type="submit">Save</button>
        </form>
    </div>
</div>

<script>
    function openEditSessionModal(id, name, dateTime, status, remark, evangelist) {
        document.getElementById("editSessionId").value = id;
        document.getElementById("editSessionDate").value = dateTime;
        document.getElementById("editSessionStatus").value = status;
        document.getElementById("editSessionRemark").value = remark;
        document.getElementById("editSessionEvangelist").value = evangelist;

        document.getElementById("editSessionModal").style.display = "flex";
    }

    function closeEditSessionModal() {
        document.getElementById("editSessionModal").style.display = "none";
    }

    document.getElementById("editSessionForm").addEventListener("submit", function(e) {
        e.preventDefault();

        const data = new URLSearchParams(new FormData(this));

        fetch("/updateSession", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: data
        })
            .then(res => res.json())
            .then(response => {
                if (response.success) {
                    alert("✅ Session updated successfully!");
                    closeEditSessionModal();
                    // reload sessions without switching tabs
                    document.querySelector("#tab3").dataset.loaded = "";
                    openTab1('tab3');
                } else {
                    alert("❌ " + response.message);
                }
            })
            .catch(err => {
                console.error(err);
                alert("An error occurred while updating session.");
            });
    });

</script>



</body>
</html>