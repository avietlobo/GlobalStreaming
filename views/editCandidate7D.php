<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Candidate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
            background-color: #fff;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[readonly] {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            color: #6c757d;
            cursor: not-allowed;
        }

        button {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .update-button {
            background-color: #007BFF;
        }

        .back-button {
            background-color: #6c757d;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .button-group button {
            flex: 1;
            margin: 0 10px;
        }

        .button-group button:hover {
            background-color: #0056b3;
        }

        .button-group .back-button:hover {
            background-color: #5a6268;
        }

        /* Align logout to the right */
        .header {
            display: flex;
            justify-content: flex-end;
            padding: 10px;
            background-color: #f8f9fa;
        }

        #logout-link button {
            margin-left: auto;
            background-color: #007bff; /* Logout button in red */
        }

        #logout-link button:hover {
            background-color: #007bff;
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
    <h1>Edit Candidate</h1>
    <form action="/updateCandidate7D" method="post">
        <div class="form-group">
            <label for="participantName">Participant Name:</label>
            <input type="text" id="participantName" name="participantName" value="<?php echo htmlspecialchars($data['participantName'] ?? ''); ?>" readonly>


        </div>


        <div class="form-group">
            <label for="country">Country:</label>
            <select id="country" name="country" required>
                <option value="" disabled <?php echo empty($data['country']) ? 'selected' : ''; ?>>Select country</option>
                <!-- Include all the countries here -->
                <option value="Afghanistan" <?php echo (isset($data['country']) && $data['country'] === 'Afghanistan') ? 'selected' : ''; ?>>Afghanistan</option>
                <option value="Albania" <?php echo (isset($data['country']) && $data['country'] === 'Albania') ? 'selected' : ''; ?>>Albania</option>
                <option value="Algeria" <?php echo (isset($data['country']) && $data['country'] === 'Algeria') ? 'selected' : ''; ?>>Algeria</option>
                <option value="Andorra" <?php echo (isset($data['country']) && $data['country'] === 'Andorra') ? 'selected' : ''; ?>>Andorra</option>
                <option value="Angola" <?php echo (isset($data['country']) && $data['country'] === 'Angola') ? 'selected' : ''; ?>>Angola</option>
                <option value="Antigua and Barbuda" <?php echo (isset($data['country']) && $data['country'] === 'Antigua and Barbuda') ? 'selected' : ''; ?>>Antigua and Barbuda</option>
                <option value="Argentina" <?php echo (isset($data['country']) && $data['country'] === 'Argentina') ? 'selected' : ''; ?>>Argentina</option>
                <option value="Armenia" <?php echo (isset($data['country']) && $data['country'] === 'Armenia') ? 'selected' : ''; ?>>Armenia</option>
                <option value="Australia" <?php echo (isset($data['country']) && $data['country'] === 'Australia') ? 'selected' : ''; ?>>Australia</option>
                <option value="Austria" <?php echo (isset($data['country']) && $data['country'] === 'Austria') ? 'selected' : ''; ?>>Austria</option>
                <option value="Azerbaijan" <?php echo (isset($data['country']) && $data['country'] === 'Azerbaijan') ? 'selected' : ''; ?>>Azerbaijan</option>
                <option value="Bahamas" <?php echo (isset($data['country']) && $data['country'] === 'Bahamas') ? 'selected' : ''; ?>>Bahamas</option>
                <option value="Bahrain" <?php echo (isset($data['country']) && $data['country'] === 'Bahrain') ? 'selected' : ''; ?>>Bahrain</option>
                <option value="Bangladesh" <?php echo (isset($data['country']) && $data['country'] === 'Bangladesh') ? 'selected' : ''; ?>>Bangladesh</option>
                <option value="Barbados" <?php echo (isset($data['country']) && $data['country'] === 'Barbados') ? 'selected' : ''; ?>>Barbados</option>
                <option value="Belarus" <?php echo (isset($data['country']) && $data['country'] === 'Belarus') ? 'selected' : ''; ?>>Belarus</option>
                <option value="Belgium" <?php echo (isset($data['country']) && $data['country'] === 'Belgium') ? 'selected' : ''; ?>>Belgium</option>
                <option value="Belize" <?php echo (isset($data['country']) && $data['country'] === 'Belize') ? 'selected' : ''; ?>>Belize</option>
                <option value="Benin" <?php echo (isset($data['country']) && $data['country'] === 'Benin') ? 'selected' : ''; ?>>Benin</option>
                <option value="Bhutan" <?php echo (isset($data['country']) && $data['country'] === 'Bhutan') ? 'selected' : ''; ?>>Bhutan</option>
                <option value="Bolivia" <?php echo (isset($data['country']) && $data['country'] === 'Bolivia') ? 'selected' : ''; ?>>Bolivia</option>
                <option value="Bosnia and Herzegovina" <?php echo (isset($data['country']) && $data['country'] === 'Bosnia and Herzegovina') ? 'selected' : ''; ?>>Bosnia and Herzegovina</option>
                <option value="Botswana" <?php echo (isset($data['country']) && $data['country'] === 'Botswana') ? 'selected' : ''; ?>>Botswana</option>
                <option value="Brazil" <?php echo (isset($data['country']) && $data['country'] === 'Brazil') ? 'selected' : ''; ?>>Brazil</option>
                <option value="Brunei" <?php echo (isset($data['country']) && $data['country'] === 'Brunei') ? 'selected' : ''; ?>>Brunei</option>
                <option value="Bulgaria" <?php echo (isset($data['country']) && $data['country'] === 'Bulgaria') ? 'selected' : ''; ?>>Bulgaria</option>
                <option value="Burkina Faso" <?php echo (isset($data['country']) && $data['country'] === 'Burkina Faso') ? 'selected' : ''; ?>>Burkina Faso</option>
                <option value="Burundi" <?php echo (isset($data['country']) && $data['country'] === 'Burundi') ? 'selected' : ''; ?>>Burundi</option>
                <option value="Côte d'Ivoire" <?php echo (isset($data['country']) && $data['country'] === 'Côte d\'Ivoire') ? 'selected' : ''; ?>>Côte d'Ivoire</option>
                <option value="Cabo Verde" <?php echo (isset($data['country']) && $data['country'] === 'Cabo Verde') ? 'selected' : ''; ?>>Cabo Verde</option>
                <option value="Cambodia" <?php echo (isset($data['country']) && $data['country'] === 'Cambodia') ? 'selected' : ''; ?>>Cambodia</option>
                <option value="Cameroon" <?php echo (isset($data['country']) && $data['country'] === 'Cameroon') ? 'selected' : ''; ?>>Cameroon</option>
                <option value="Canada" <?php echo (isset($data['country']) && $data['country'] === 'Canada') ? 'selected' : ''; ?>>Canada</option>
                <option value="Central African Republic" <?php echo (isset($data['country']) && $data['country'] === 'Central African Republic') ? 'selected' : ''; ?>>Central African Republic</option>
                <option value="Chad" <?php echo (isset($data['country']) && $data['country'] === 'Chad') ? 'selected' : ''; ?>>Chad</option>
                <option value="Chile" <?php echo (isset($data['country']) && $data['country'] === 'Chile') ? 'selected' : ''; ?>>Chile</option>
                <option value="China" <?php echo (isset($data['country']) && $data['country'] === 'China') ? 'selected' : ''; ?>>China</option>
                <option value="Colombia" <?php echo (isset($data['country']) && $data['country'] === 'Colombia') ? 'selected' : ''; ?>>Colombia</option>
                <option value="Comoros" <?php echo (isset($data['country']) && $data['country'] === 'Comoros') ? 'selected' : ''; ?>>Comoros</option>
                <option value="Congo (Congo-Brazzaville)" <?php echo (isset($data['country']) && $data['country'] === 'Congo (Congo-Brazzaville)') ? 'selected' : ''; ?>>Congo (Congo-Brazzaville)</option>
                <option value="Costa Rica" <?php echo (isset($data['country']) && $data['country'] === 'Costa Rica') ? 'selected' : ''; ?>>Costa Rica</option>
                <option value="Croatia" <?php echo (isset($data['country']) && $data['country'] === 'Croatia') ? 'selected' : ''; ?>>Croatia</option>
                <option value="Cuba" <?php echo (isset($data['country']) && $data['country'] === 'Cuba') ? 'selected' : ''; ?>>Cuba</option>
                <option value="Cyprus" <?php echo (isset($data['country']) && $data['country'] === 'Cyprus') ? 'selected' : ''; ?>>Cyprus</option>
                <option value="Czechia (Czech Republic)" <?php echo (isset($data['country']) && $data['country'] === 'Czechia (Czech Republic)') ? 'selected' : ''; ?>>Czechia (Czech Republic)</option>
                <option value="Democratic Republic of the Congo" <?php echo (isset($data['country']) && $data['country'] === 'Democratic Republic of the Congo') ? 'selected' : ''; ?>>Democratic Republic of the Congo</option>
                <option value="Denmark" <?php echo (isset($data['country']) && $data['country'] === 'Denmark') ? 'selected' : ''; ?>>Denmark</option>
                <option value="Djibouti" <?php echo (isset($data['country']) && $data['country'] === 'Djibouti') ? 'selected' : ''; ?>>Djibouti</option>
                <option value="Dominica" <?php echo (isset($data['country']) && $data['country'] === 'Dominica') ? 'selected' : ''; ?>>Dominica</option>
                <option value="Dominican Republic" <?php echo (isset($data['country']) && $data['country'] === 'Dominican Republic') ? 'selected' : ''; ?>>Dominican Republic</option>
                <option value="Ecuador" <?php echo (isset($data['country']) && $data['country'] === 'Ecuador') ? 'selected' : ''; ?>>Ecuador</option>
                <option value="Egypt" <?php echo (isset($data['country']) && $data['country'] === 'Egypt') ? 'selected' : ''; ?>>Egypt</option>
                <option value="El Salvador" <?php echo (isset($data['country']) && $data['country'] === 'El Salvador') ? 'selected' : ''; ?>>El Salvador</option>
                <option value="Equatorial Guinea" <?php echo (isset($data['country']) && $data['country'] === 'Equatorial Guinea') ? 'selected' : ''; ?>>Equatorial Guinea</option>
                <option value="Eritrea" <?php echo (isset($data['country']) && $data['country'] === 'Eritrea') ? 'selected' : ''; ?>>Eritrea</option>
                <option value="Estonia" <?php echo (isset($data['country']) && $data['country'] === 'Estonia') ? 'selected' : ''; ?>>Estonia</option>
                <option value="Eswatini (fmr. 'Swaziland')" <?php echo (isset($data['country']) && $data['country'] === 'Eswatini (fmr. "Swaziland")') ? 'selected' : ''; ?>>Eswatini (fmr. "Swaziland")</option>
                <option value="Ethiopia" <?php echo (isset($data['country']) && $data['country'] === 'Ethiopia') ? 'selected' : ''; ?>>Ethiopia</option>
                <option value="Fiji" <?php echo (isset($data['country']) && $data['country'] === 'Fiji') ? 'selected' : ''; ?>>Fiji</option>
                <option value="Finland" <?php echo (isset($data['country']) && $data['country'] === 'Finland') ? 'selected' : ''; ?>>Finland</option>
                <option value="France" <?php echo (isset($data['country']) && $data['country'] === 'France') ? 'selected' : ''; ?>>France</option>
                <option value="Gabon" <?php echo (isset($data['country']) && $data['country'] === 'Gabon') ? 'selected' : ''; ?>>Gabon</option>
                <option value="Gambia" <?php echo (isset($data['country']) && $data['country'] === 'Gambia') ? 'selected' : ''; ?>>Gambia</option>
                <option value="Georgia" <?php echo (isset($data['country']) && $data['country'] === 'Georgia') ? 'selected' : ''; ?>>Georgia</option>
                <option value="Germany" <?php echo (isset($data['country']) && $data['country'] === 'Germany') ? 'selected' : ''; ?>>Germany</option>
                <option value="Ghana" <?php echo (isset($data['country']) && $data['country'] === 'Ghana') ? 'selected' : ''; ?>>Ghana</option>
                <option value="Greece" <?php echo (isset($data['country']) && $data['country'] === 'Greece') ? 'selected' : ''; ?>>Greece</option>
                <option value="Greenland" <?php echo (isset($data['country']) && $data['country'] === 'Greenland') ? 'selected' : ''; ?>>Greenland</option>
                <option value="Grenada" <?php echo (isset($data['country']) && $data['country'] === 'Grenada') ? 'selected' : ''; ?>>Grenada</option>
                <option value="Guatemala" <?php echo (isset($data['country']) && $data['country'] === 'Guatemala') ? 'selected' : ''; ?>>Guatemala</option>
                <option value="Guinea" <?php echo (isset($data['country']) && $data['country'] === 'Guinea') ? 'selected' : ''; ?>>Guinea</option>
                <option value="Guinea-Bissau" <?php echo (isset($data['country']) && $data['country'] === 'Guinea-Bissau') ? 'selected' : ''; ?>>Guinea-Bissau</option>
                <option value="Guyana" <?php echo (isset($data['country']) && $data['country'] === 'Guyana') ? 'selected' : ''; ?>>Guyana</option>
                <option value="Haiti" <?php echo (isset($data['country']) && $data['country'] === 'Haiti') ? 'selected' : ''; ?>>Haiti</option>
                <option value="Holy See" <?php echo (isset($data['country']) && $data['country'] === 'Holy See') ? 'selected' : ''; ?>>Holy See</option>
                <option value="Honduras" <?php echo (isset($data['country']) && $data['country'] === 'Honduras') ? 'selected' : ''; ?>>Honduras</option>
                <option value="Hungary" <?php echo (isset($data['country']) && $data['country'] === 'Hungary') ? 'selected' : ''; ?>>Hungary</option>
                <option value="Iceland" <?php echo (isset($data['country']) && $data['country'] === 'Iceland') ? 'selected' : ''; ?>>Iceland</option>
                <option value="Special Case 1" <?php echo (isset($data['country']) && $data['country'] === 'Special Case 1') ? 'selected' : ''; ?>>Special Case 1</option>
                <option value="Indonesia" <?php echo (isset($data['country']) && $data['country'] === 'Indonesia') ? 'selected' : ''; ?>>Indonesia</option>
                <option value="Iran" <?php echo (isset($data['country']) && $data['country'] === 'Iran') ? 'selected' : ''; ?>>Iran</option>
                <option value="Iraq" <?php echo (isset($data['country']) && $data['country'] === 'Iraq') ? 'selected' : ''; ?>>Iraq</option>
                <option value="Ireland" <?php echo (isset($data['country']) && $data['country'] === 'Ireland') ? 'selected' : ''; ?>>Ireland</option>
                <option value="Israel" <?php echo (isset($data['country']) && $data['country'] === 'Israel') ? 'selected' : ''; ?>>Israel</option>
                <option value="Italy" <?php echo (isset($data['country']) && $data['country'] === 'Italy') ? 'selected' : ''; ?>>Italy</option>
                <option value="Jamaica" <?php echo (isset($data['country']) && $data['country'] === 'Jamaica') ? 'selected' : ''; ?>>Jamaica</option>
                <option value="Japan" <?php echo (isset($data['country']) && $data['country'] === 'Japan') ? 'selected' : ''; ?>>Japan</option>
                <option value="Jordan" <?php echo (isset($data['country']) && $data['country'] === 'Jordan') ? 'selected' : ''; ?>>Jordan</option>
                <option value="Kazakhstan" <?php echo (isset($data['country']) && $data['country'] === 'Kazakhstan') ? 'selected' : ''; ?>>Kazakhstan</option>
                <option value="Kenya" <?php echo (isset($data['country']) && $data['country'] === 'Kenya') ? 'selected' : ''; ?>>Kenya</option>
                <option value="Kiribati" <?php echo (isset($data['country']) && $data['country'] === 'Kiribati') ? 'selected' : ''; ?>>Kiribati</option>
                <option value="Kuwait" <?php echo (isset($data['country']) && $data['country'] === 'Kuwait') ? 'selected' : ''; ?>>Kuwait</option>
                <option value="Kyrgyzstan" <?php echo (isset($data['country']) && $data['country'] === 'Kyrgyzstan') ? 'selected' : ''; ?>>Kyrgyzstan</option>
                <option value="Laos" <?php echo (isset($data['country']) && $data['country'] === 'Laos') ? 'selected' : ''; ?>>Laos</option>
                <option value="Latvia" <?php echo (isset($data['country']) && $data['country'] === 'Latvia') ? 'selected' : ''; ?>>Latvia</option>
                <option value="Lebanon" <?php echo (isset($data['country']) && $data['country'] === 'Lebanon') ? 'selected' : ''; ?>>Lebanon</option>
                <option value="Lesotho" <?php echo (isset($data['country']) && $data['country'] === 'Lesotho') ? 'selected' : ''; ?>>Lesotho</option>
                <option value="Liberia" <?php echo (isset($data['country']) && $data['country'] === 'Liberia') ? 'selected' : ''; ?>>Liberia</option>
                <option value="Libya" <?php echo (isset($data['country']) && $data['country'] === 'Libya') ? 'selected' : ''; ?>>Libya</option>
                <option value="Liechtenstein" <?php echo (isset($data['country']) && $data['country'] === 'Liechtenstein') ? 'selected' : ''; ?>>Liechtenstein</option>
                <option value="Lithuania" <?php echo (isset($data['country']) && $data['country'] === 'Lithuania') ? 'selected' : ''; ?>>Lithuania</option>
                <option value="Luxembourg" <?php echo (isset($data['country']) && $data['country'] === 'Luxembourg') ? 'selected' : ''; ?>>Luxembourg</option>
                <option value="Madagascar" <?php echo (isset($data['country']) && $data['country'] === 'Madagascar') ? 'selected' : ''; ?>>Madagascar</option>
                <option value="Malawi" <?php echo (isset($data['country']) && $data['country'] === 'Malawi') ? 'selected' : ''; ?>>Malawi</option>
                <option value="Malaysia" <?php echo (isset($data['country']) && $data['country'] === 'Malaysia') ? 'selected' : ''; ?>>Malaysia</option>
                <option value="Maldives" <?php echo (isset($data['country']) && $data['country'] === 'Maldives') ? 'selected' : ''; ?>>Maldives</option>
                <option value="Mali" <?php echo (isset($data['country']) && $data['country'] === 'Mali') ? 'selected' : ''; ?>>Mali</option>
                <option value="Malta" <?php echo (isset($data['country']) && $data['country'] === 'Malta') ? 'selected' : ''; ?>>Malta</option>
                <option value="Marshall Islands" <?php echo (isset($data['country']) && $data['country'] === 'Marshall Islands') ? 'selected' : ''; ?>>Marshall Islands</option>
                <option value="Mauritania" <?php echo (isset($data['country']) && $data['country'] === 'Mauritania') ? 'selected' : ''; ?>>Mauritania</option>
                <option value="Mauritius" <?php echo (isset($data['country']) && $data['country'] === 'Mauritius') ? 'selected' : ''; ?>>Mauritius</option>
                <option value="Mexico" <?php echo (isset($data['country']) && $data['country'] === 'Mexico') ? 'selected' : ''; ?>>Mexico</option>
                <option value="Micronesia" <?php echo (isset($data['country']) && $data['country'] === 'Micronesia') ? 'selected' : ''; ?>>Micronesia</option>
                <option value="Moldova" <?php echo (isset($data['country']) && $data['country'] === 'Moldova') ? 'selected' : ''; ?>>Moldova</option>
                <option value="Monaco" <?php echo (isset($data['country']) && $data['country'] === 'Monaco') ? 'selected' : ''; ?>>Monaco</option>
                <option value="Mongolia" <?php echo (isset($data['country']) && $data['country'] === 'Mongolia') ? 'selected' : ''; ?>>Mongolia</option>
                <option value="Montenegro" <?php echo (isset($data['country']) && $data['country'] === 'Montenegro') ? 'selected' : ''; ?>>Montenegro</option>
                <option value="Morocco" <?php echo (isset($data['country']) && $data['country'] === 'Morocco') ? 'selected' : ''; ?>>Morocco</option>
                <option value="Mozambique" <?php echo (isset($data['country']) && $data['country'] === 'Mozambique') ? 'selected' : ''; ?>>Mozambique</option>
                <option value="Myanmar (formerly Burma)" <?php echo (isset($data['country']) && $data['country'] === 'Myanmar (formerly Burma)') ? 'selected' : ''; ?>>Myanmar (formerly Burma)</option>
                <option value="Namibia" <?php echo (isset($data['country']) && $data['country'] === 'Namibia') ? 'selected' : ''; ?>>
                <option value="Nauru" <?php echo (isset($data['country']) && $data['country'] === 'Nauru') ? 'selected' : ''; ?>>Nauru</option>
                <option value="Nepal" <?php echo (isset($data['country']) && $data['country'] === 'Nepal') ? 'selected' : ''; ?>>Nepal</option>
                <option value="Netherlands" <?php echo (isset($data['country']) && $data['country'] === 'Netherlands') ? 'selected' : ''; ?>>Netherlands</option>
                <option value="New Zealand" <?php echo (isset($data['country']) && $data['country'] === 'New Zealand') ? 'selected' : ''; ?>>New Zealand</option>
                <option value="Nicaragua" <?php echo (isset($data['country']) && $data['country'] === 'Nicaragua') ? 'selected' : ''; ?>>Nicaragua</option>
                <option value="Niger" <?php echo (isset($data['country']) && $data['country'] === 'Niger') ? 'selected' : ''; ?>>Niger</option>
                <option value="Nigeria" <?php echo (isset($data['country']) && $data['country'] === 'Nigeria') ? 'selected' : ''; ?>>Nigeria</option>
                <option value="North Korea" <?php echo (isset($data['country']) && $data['country'] === 'North Korea') ? 'selected' : ''; ?>>North Korea</option>
                <option value="North Macedonia" <?php echo (isset($data['country']) && $data['country'] === 'North Macedonia') ? 'selected' : ''; ?>>North Macedonia</option>
                <option value="Norway" <?php echo (isset($data['country']) && $data['country'] === 'Norway') ? 'selected' : ''; ?>>Norway</option>
                <option value="Oman" <?php echo (isset($data['country']) && $data['country'] === 'Oman') ? 'selected' : ''; ?>>Oman</option>
                <option value="Special Case 2" <?php echo (isset($data['country']) && $data['country'] === 'Special Case 2') ? 'selected' : ''; ?>>Special Case 2</option>
                <option value="Palau" <?php echo (isset($data['country']) && $data['country'] === 'Palau') ? 'selected' : ''; ?>>Palau</option>
                <option value="Palestine State" <?php echo (isset($data['country']) && $data['country'] === 'Palestine State') ? 'selected' : ''; ?>>Palestine State</option>
                <option value="Panama" <?php echo (isset($data['country']) && $data['country'] === 'Panama') ? 'selected' : ''; ?>>Panama</option>
                <option value="Papua New Guinea" <?php echo (isset($data['country']) && $data['country'] === 'Papua New Guinea') ? 'selected' : ''; ?>>Papua New Guinea</option>
                <option value="Paraguay" <?php echo (isset($data['country']) && $data['country'] === 'Paraguay') ? 'selected' : ''; ?>>Paraguay</option>
                <option value="Peru" <?php echo (isset($data['country']) && $data['country'] === 'Peru') ? 'selected' : ''; ?>>Peru</option>
                <option value="Philippines" <?php echo (isset($data['country']) && $data['country'] === 'Philippines') ? 'selected' : ''; ?>>Philippines</option>
                <option value="Poland" <?php echo (isset($data['country']) && $data['country'] === 'Poland') ? 'selected' : ''; ?>>Poland</option>
                <option value="Portugal" <?php echo (isset($data['country']) && $data['country'] === 'Portugal') ? 'selected' : ''; ?>>Portugal</option>
                <option value="Peurto Rico" <?php echo (isset($data['country']) && $data['country'] === 'Peurto Rico') ? 'selected' : ''; ?>>Peurto Rico</option>
                <option value="Qatar" <?php echo (isset($data['country']) && $data['country'] === 'Qatar') ? 'selected' : ''; ?>>Qatar</option>
                <option value="Romania" <?php echo (isset($data['country']) && $data['country'] === 'Romania') ? 'selected' : ''; ?>>Romania</option>
                <option value="Russia" <?php echo (isset($data['country']) && $data['country'] === 'Russia') ? 'selected' : ''; ?>>Russia</option>
                <option value="Rwanda" <?php echo (isset($data['country']) && $data['country'] === 'Rwanda') ? 'selected' : ''; ?>>Rwanda</option>
                <option value="Saint Kitts and Nevis" <?php echo (isset($data['country']) && $data['country'] === 'Saint Kitts and Nevis') ? 'selected' : ''; ?>>Saint Kitts and Nevis</option>
                <option value="Saint Lucia" <?php echo (isset($data['country']) && $data['country'] === 'Saint Lucia') ? 'selected' : ''; ?>>Saint Lucia</option>
                <option value="Saint Vincent and the Grenadines" <?php echo (isset($data['country']) && $data['country'] === 'Saint Vincent and the Grenadines') ? 'selected' : ''; ?>>Saint Vincent and the Grenadines</option>
                <option value="Samoa" <?php echo (isset($data['country']) && $data['country'] === 'Samoa') ? 'selected' : ''; ?>>Samoa</option>
                <option value="San Marino" <?php echo (isset($data['country']) && $data['country'] === 'San Marino') ? 'selected' : ''; ?>>San Marino</option>
                <option value="Sao Tome and Principe" <?php echo (isset($data['country']) && $data['country'] === 'Sao Tome and Principe') ? 'selected' : ''; ?>>Sao Tome and Principe</option>
                <option value="Saudi Arabia" <?php echo (isset($data['country']) && $data['country'] === 'Saudi Arabia') ? 'selected' : ''; ?>>Saudi Arabia</option>
                <option value="Senegal" <?php echo (isset($data['country']) && $data['country'] === 'Senegal') ? 'selected' : ''; ?>>Senegal</option>
                <option value="Serbia" <?php echo (isset($data['country']) && $data['country'] === 'Serbia') ? 'selected' : ''; ?>>Serbia</option>
                <option value="Seychelles" <?php echo (isset($data['country']) && $data['country'] === 'Seychelles') ? 'selected' : ''; ?>>Seychelles</option>
                <option value="Sierra Leone" <?php echo (isset($data['country']) && $data['country'] === 'Sierra Leone') ? 'selected' : ''; ?>>Sierra Leone</option>
                <option value="Singapore" <?php echo (isset($data['country']) && $data['country'] === 'Singapore') ? 'selected' : ''; ?>>Singapore</option>
                <option value="Slovakia" <?php echo (isset($data['country']) && $data['country'] === 'Slovakia') ? 'selected' : ''; ?>>Slovakia</option>
                <option value="Slovenia" <?php echo (isset($data['country']) && $data['country'] === 'Slovenia') ? 'selected' : ''; ?>>Slovenia</option>
                <option value="Solomon Islands" <?php echo (isset($data['country']) && $data['country'] === 'Solomon Islands') ? 'selected' : ''; ?>>Solomon Islands</option>
                <option value="Somalia" <?php echo (isset($data['country']) && $data['country'] === 'Somalia') ? 'selected' : ''; ?>>Somalia</option>
                <option value="South Africa" <?php echo (isset($data['country']) && $data['country'] === 'South Africa') ? 'selected' : ''; ?>>South Africa</option>
                <option value="South Korea" <?php echo (isset($data['country']) && $data['country'] === 'South Korea') ? 'selected' : ''; ?>>South Korea</option>
                <option value="South Sudan" <?php echo (isset($data['country']) && $data['country'] === 'South Sudan') ? 'selected' : ''; ?>>South Sudan</option>
                <option value="Spain" <?php echo (isset($data['country']) && $data['country'] === 'Spain') ? 'selected' : ''; ?>>Spain</option>
                <option value="Sri Lanka" <?php echo (isset($data['country']) && $data['country'] === 'Sri Lanka') ? 'selected' : ''; ?>>Sri Lanka</option>
                <option value="Sudan" <?php echo (isset($data['country']) && $data['country'] === 'Sudan') ? 'selected' : ''; ?>>Sudan</option>
                <option value="Suriname" <?php echo (isset($data['country']) && $data['country'] === 'Suriname') ? 'selected' : ''; ?>>Suriname</option>
                <option value="Sweden" <?php echo (isset($data['country']) && $data['country'] === 'Sweden') ? 'selected' : ''; ?>>Sweden</option>
                <option value="Switzerland" <?php echo (isset($data['country']) && $data['country'] === 'Switzerland') ? 'selected' : ''; ?>>Switzerland</option>
                <option value="Syria" <?php echo (isset($data['country']) && $data['country'] === 'Syria') ? 'selected' : ''; ?>>Syria</option>
                <option value="Taiwan" <?php echo (isset($data['country']) && $data['country'] === 'Taiwan') ? 'selected' : ''; ?>>Taiwan</option>
                <option value="Tajikistan" <?php echo (isset($data['country']) && $data['country'] === 'Tajikistan') ? 'selected' : ''; ?>>Tajikistan</option>
                <option value="Tanzania" <?php echo (isset($data['country']) && $data['country'] === 'Tanzania') ? 'selected' : ''; ?>>Tanzania</option>
                <option value="Thailand" <?php echo (isset($data['country']) && $data['country'] === 'Thailand') ? 'selected' : ''; ?>>Thailand</option>
                <option value="Timor-Leste" <?php echo (isset($data['country']) && $data['country'] === 'Timor-Leste') ? 'selected' : ''; ?>>Timor-Leste</option>
                <option value="Togo" <?php echo (isset($data['country']) && $data['country'] === 'Togo') ? 'selected' : ''; ?>>Togo</option>
                <option value="Tonga" <?php echo (isset($data['country']) && $data['country'] === 'Tonga') ? 'selected' : ''; ?>>Tonga</option>
                <option value="Trinidad and Tobago" <?php echo (isset($data['country']) && $data['country'] === 'Trinidad and Tobago') ? 'selected' : ''; ?>>Trinidad and Tobago</option>
                <option value="Tunisia" <?php echo (isset($data['country']) && $data['country'] === 'Tunisia') ? 'selected' : ''; ?>>Tunisia</option>
                <option value="Turkey" <?php echo (isset($data['country']) && $data['country'] === 'Turkey') ? 'selected' : ''; ?>>Turkey</option>
                <option value="Turkmenistan" <?php echo (isset($data['country']) && $data['country'] === 'Turkmenistan') ? 'selected' : ''; ?>>Turkmenistan</option>
                <option value="Tuvalu" <?php echo (isset($data['country']) && $data['country'] === 'Tuvalu') ? 'selected' : ''; ?>>Tuvalu</option>
                <option value="Uganda" <?php echo (isset($data['country']) && $data['country'] === 'Uganda') ? 'selected' : ''; ?>>Uganda</option>
                <option value="Ukraine" <?php echo (isset($data['country']) && $data['country'] === 'Ukraine') ? 'selected' : ''; ?>>Ukraine</option>
                <option value="United Arab Emirates" <?php echo (isset($data['country']) && $data['country'] === 'United Arab Emirates') ? 'selected' : ''; ?>>United Arab Emirates</option>
                <option value="United Kingdom" <?php echo (isset($data['country']) && $data['country'] === 'United Kingdom') ? 'selected' : ''; ?>>United Kingdom</option>
                <option value="United States of America" <?php echo (isset($data['country']) && $data['country'] === 'United States of America') ? 'selected' : ''; ?>>United States of America</option>
                <option value="Uruguay" <?php echo (isset($data['country']) && $data['country'] === 'Uruguay') ? 'selected' : ''; ?>>Uruguay</option>
                <option value="Uzbekistan" <?php echo (isset($data['country']) && $data['country'] === 'Uzbekistan') ? 'selected' : ''; ?>>Uzbekistan</option>
                <option value="Vanuatu" <?php echo (isset($data['country']) && $data['country'] === 'Vanuatu') ? 'selected' : ''; ?>>Vanuatu</option>
                <option value="Venezuela" <?php echo (isset($data['country']) && $data['country'] === 'Venezuela') ? 'selected' : ''; ?>>Venezuela</option>
                <option value="Vietnam" <?php echo (isset($data['country']) && $data['country'] === 'Vietnam') ? 'selected' : ''; ?>>Vietnam</option>
                <option value="Yemen" <?php echo (isset($data['country']) && $data['country'] === 'Yemen') ? 'selected' : ''; ?>>Yemen</option>
                <option value="Zambia" <?php echo (isset($data['country']) && $data['country'] === 'Zambia') ? 'selected' : ''; ?>>Zambia</option>

            </select>
        </div>




                <div class="form-group">
            <label for="mobile">Mobile:</label>
            <input type="text" id="mobile" name="mobile" value="<?php echo htmlspecialchars($data['mobile'] ?? ''); ?>" readonly>
        </div>

        <div class="form-group">
            <label for="evangelist">Evangelist:</label>
            <input type="text" id="evangelist" name="evangelist" value="<?php echo htmlspecialchars($data['evangelist'] ?? ''); ?>" readonly>
        </div>


        <div class="form-group">
            <label for="language">Language:</label>
            <select id="language" name="language" required>
                <option value="" disabled <?php echo empty($data['language']) ? 'selected' : ''; ?>>Select language</option>
                <option value="English" <?php echo (isset($data['language']) && $data['language'] === 'English') ? 'selected' : ''; ?>>English</option>
                <option value="Kannada" <?php echo (isset($data['language']) && $data['language'] === 'Kannada') ? 'selected' : ''; ?>>Kannada</option>
                <option value="Konkani-Goan" <?php echo (isset($data['language']) && $data['language'] === 'Konkani-Goan') ? 'selected' : ''; ?>>Konkani-Goan</option>
                <option value="Konkani-Mangalore" <?php echo (isset($data['language']) && $data['language'] === 'Konkani-Mangalore') ? 'selected' : ''; ?>>Konkani-Mangalore</option>
                <option value="Portuguese" <?php echo (isset($data['language']) && $data['language'] === 'Portuguese') ? 'selected' : ''; ?>>Portuguese</option>
                <option value="Hindi" <?php echo (isset($data['language']) && $data['language'] === 'Hindi') ? 'selected' : ''; ?>>Hindi</option>
                <option value="Italian" <?php echo (isset($data['language']) && $data['language'] === 'Italian') ? 'selected' : ''; ?>>Italian</option>
                <option value="Malayalam" <?php echo (isset($data['language']) && $data['language'] === 'Malayalam') ? 'selected' : ''; ?>>Malayalam</option>
                <option value="Spanish" <?php echo (isset($data['language']) && $data['language'] === 'Spanish') ? 'selected' : ''; ?>>Spanish</option>
                <option value="Tamil" <?php echo (isset($data['language']) && $data['language'] === 'Tamil') ? 'selected' : ''; ?>>Tamil</option>
                <option value="Tagalog" <?php echo (isset($data['language']) && $data['language'] === 'Tagalog') ? 'selected' : ''; ?>>Tagalog</option>
                <option value="Arabic" <?php echo (isset($data['language']) && $data['language'] === 'Arabic') ? 'selected' : ''; ?>>Arabic</option>
                <option value="French" <?php echo (isset($data['language']) && $data['language'] === 'French') ? 'selected' : ''; ?>>French</option>
            </select>
        </div>


        <div class="form-group">
            <label for="source">Source:</label>
            <select id="source" name="source" required>
                <option value="" disabled <?php echo empty($data['source']) ? 'selected' : ''; ?>>Select source</option>
                <option value="Facebook" <?php echo (isset($data['source']) && $data['source'] === 'Facebook') ? 'selected' : ''; ?>>Facebook</option>
                <option value="TeleCall" <?php echo (isset($data['source']) && $data['source'] === 'TeleCall') ? 'selected' : ''; ?>>TeleCall</option>
                <option value="Telegram" <?php echo (isset($data['source']) && $data['source'] === 'Telegram') ? 'selected' : ''; ?>>Telegram</option>
                <option value="Twitter" <?php echo (isset($data['source']) && $data['source'] === 'Twitter') ? 'selected' : ''; ?>>Twitter</option>
            </select>
        </div>


        <div class="form-group">
            <label for="mediaType">Media Type:</label>
            <select id="mediaType" name="mediaType" required>
                <option value="" disabled <?php echo empty($data['mediaType']) ? 'selected' : ''; ?>>Select media type</option>
                <option value="Web Video" <?php echo (isset($data['mediaType']) && $data['mediaType'] === 'Web Video') ? 'selected' : ''; ?>>Web Video</option>
                <option value="Web Audio" <?php echo (isset($data['mediaType']) && $data['mediaType'] === 'Web Audio') ? 'selected' : ''; ?>>Web Audio</option>
            </select>
        </div>

        <div class="form-group">
            <label for="activeStatus">Active Status:</label>
            <select id="activeStatus" name="activeStatus" required>
                <option value="" disabled <?php echo empty($data['activeStatus']) ? 'selected' : ''; ?>>Select active status</option>
                <option value="Active" <?php echo (isset($data['activeStatus']) && $data['activeStatus'] === 'Active') ? 'selected' : ''; ?>>Active</option>
                <option value="Exit/Drop-out" <?php echo (isset($data['activeStatus']) && $data['activeStatus'] === 'Exit/Drop-out') ? 'selected' : ''; ?>>Exit/Drop-out</option>
                <option value="Completed" <?php echo (isset($data['activeStatus']) && $data['activeStatus'] === 'Completed') ? 'selected' : ''; ?>>Completed</option>
                <option value="Withdrawn" <?php echo (isset($data['activeStatus']) && $data['activeStatus'] === 'Withdrawn') ? 'selected' : ''; ?>>Withdrawn</option>
                <option value="InActive" <?php echo (isset($data['activeStatus']) && $data['activeStatus'] === 'InActive') ? 'selected' : ''; ?>>InActive</option>
            </select>
        </div>



        <!-- Add more fields as needed -->

        <input type="hidden" name="index" value="<?php echo htmlspecialchars($data['index'] ?? ''); ?>">

        <div class="button-group">
            <button type="submit" class="update-button">Update</button>
            <button type="button" class="back-button" onclick="window.location.href='/evngDashboard1'">Back</button>
        </div>
    </form>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function () {

        var video = document.getElementById("video");

        var timeStarted = -1;
        var timePlayed = 0;
        var duration = 0;

        var timeEnded = 0;
        var playTimestamp = null;
        var logoutTimestamp = null;
        var videoPaused = -1;



        const logoutLink = document.getElementById('logout-link');


        logoutLink.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default click behavior

            // Capture the logout timestamp
            logoutTimestamp = new Date().toISOString();


            fetch('/logout', {
                method: 'POST', // or 'GET' if your API supports GET requests for logout
                headers: {
                    'Content-Type': 'application/json', // Adjust the content type as needed
                    // You may include any necessary headers, such as CSRF tokens or authentication tokens, here.
                },
            })
                .then(response => {
                    if (response.status === 200) {
                        // Logout was successful
                        // You can redirect the user to the homepage or perform any other actions.
                        window.location.href = '/login'; // Redirect to the homepage
                    } else {
                        // Handle logout failure or errors
                        console.error('Logout failed');
                        // You can display an error message to the user or take appropriate action.
                    }
                })
                .catch(error => {
                    console.error('Error during logout:', error);
                    // Handle network errors or other issues
                });
        });
    });
</script>





</body>
</html>
