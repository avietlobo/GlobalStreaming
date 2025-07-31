function loadCountryView(language) {
    const container = document.getElementById('dynamic-container');
    container.innerHTML = `<div class="loader">Loading countries for <strong>${language}</strong>...</div>`;

    fetch('/getCandidatesByLanguage?lang=' + encodeURIComponent(language))
        .then(response => {
            if (!response.ok) throw new Error("HTTP error " + response.status);
            return response.json();
        })
        .then(data => renderCountries(data, language))
        .catch(err => {
            container.innerHTML = `<p style="color:red;">Failed to load data: ${err.message}</p>`;
            console.error(err);
        });
}

function renderCountries(data, language) {
    const container = document.getElementById('dynamic-container');
    const countries = {};
    data.forEach(c => {
        countries[c.country] = (countries[c.country] || 0) + 1;
    });

    container.innerHTML = `<h3>${language} - Select Country</h3>`;
    for (const [country, count] of Object.entries(countries)) {
        const btn = document.createElement('button');
        btn.textContent = `${country} (${count})`;
        btn.onclick = () => renderEvangelists(data, language, country);
        container.appendChild(btn);
    }
}

function renderEvangelists(data, language, country) {
    const container = document.getElementById('dynamic-container');
    const filtered = data.filter(c => c.country === country);
    const evangelists = {};
    filtered.forEach(c => {
        evangelists[c.evangelist] = (evangelists[c.evangelist] || 0) + 1;
    });

    container.innerHTML = `<h3>${country} - Select Evangelist</h3>`;
    for (const [evangelist, count] of Object.entries(evangelists)) {
        const btn = document.createElement('button');
        btn.textContent = `${evangelist} (${count})`;
        btn.onclick = () => renderParticipants(filtered, evangelist);
        container.appendChild(btn);
    }
}

function renderParticipants(data, evangelist) {
    const container = document.getElementById('dynamic-container');
    const participants = data.filter(c => c.evangelist === evangelist);

    container.innerHTML = `<h3>${evangelist} - Participants</h3>`;
    participants.forEach(p => {
        const div = document.createElement('div');
        div.innerHTML = `<p><strong>${p.participantName}</strong></p>`;
        div.style.border = "1px solid #ccc";
        div.style.padding = "10px";
        div.style.margin = "5px 0";
        div.onclick = () => showParticipantDetails(p, participants);
        container.appendChild(div);
    });
}

function showParticipantDetails(participant, allParticipants) {
    const container = document.getElementById('dynamic-container');
    container.innerHTML = `<h3>Details of ${participant.participantName}</h3>
        <p><strong>Mobile:</strong> ${participant.mobile}</p>
        <p><strong>Country:</strong> ${participant.country}</p>
        <p><strong>Language:</strong> ${participant.language}</p>
        <p><strong>Evangelist:</strong> ${participant.evangelist}</p>
        <p><strong>Media Type:</strong> ${participant.mediaType}</p>
        <p><strong>Remark:</strong> ${participant.remark}</p>
        <button onclick='renderParticipants(${JSON.stringify(allParticipants)}, "${participant.evangelist}")'>⬅ Back</button>`;
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.lang-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            loadCountryView(this.dataset.lang);
        });
    });
});
