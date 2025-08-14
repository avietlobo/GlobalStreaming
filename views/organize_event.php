<?php
use app\core\Application;
?>

<h2>Organize Event - Extra Details</h2>

<?php if (Application::$app->session->getFlash('success')): ?>
    <div style="color: green; margin-bottom: 10px;">
        <?= Application::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>

<form method="POST" action="/organizeEvent" style="max-width: 500px;">
    <label for="event_id">Select Event</label>
    <select name="event_id" id="event_id" required>
        <option value="<?= htmlspecialchars($eventId) ?>" selected>
            <?= htmlspecialchars($eventName) ?>
        </option>
    </select>
    <input type="hidden" name="event_name" value="<?= htmlspecialchars($eventName) ?>">

    <label for="speaker_name">Speaker Name</label>
    <input type="text" id="speaker_name" name="speaker_name"
           value="<?= htmlspecialchars($extra['speaker_name'] ?? '') ?>">

    <label for="vmix_operator">Vmix Operator</label>
    <input type="text" id="vmix_operator" name="vmix_operator"
           value="<?= htmlspecialchars($extra['vmix_operator'] ?? '') ?>">

    <label for="keyboard_operator">Keyboard Operator</label>
    <input type="text" id="keyboard_operator" name="keyboard_operator"
           value="<?= htmlspecialchars($extra['keyboard_operator'] ?? '') ?>">

    <label for="monitor">Monitor</label>
    <input type="text" id="monitor" name="monitor"
           value="<?= htmlspecialchars($extra['monitor'] ?? '') ?>">

    <label for="choir_members">Choir Members</label>
    <textarea id="choir_members" name="choir_members" rows="3"
              placeholder="Enter names separated by commas"><?= htmlspecialchars($extra['choir_members'] ?? '') ?></textarea>

    <label for="food_coupons">Food Coupons</label>
    <textarea id="food_coupons" name="food_coupons" rows="3"><?= htmlspecialchars($extra['food_coupons'] ?? '') ?></textarea>

    <br><br>
    <button type="submit">Save Details</button>
</form>
    // Store PHP events array in JS
    const eventsData = <?= json_encode($events) ?>;

    document.getElementById('event_id').addEventListener('change', function() {
        const selectedId = this.value;
        const eventDetails = eventsData.find(e => e.event_id === selectedId);

        // If found, fill the inputs; else clear them
        if (eventDetails) {
            document.getElementById('speaker_name').value = eventDetails.speaker_name || '';
            document.getElementById('vmix_operator').value = eventDetails.vmix_operator || '';
            document.getElementById('keyboard_operator').value = eventDetails.keyboard_operator || '';
            document.getElementById('monitor').value = eventDetails.monitor || '';
            document.getElementById('choir_members').value = eventDetails.choir_members || '';
            document.getElementById('food_coupons').value = eventDetails.food_coupons || '';
        } else {
            document.querySelectorAll('input, textarea').forEach(el => el.value = '');
        }
    });
</script>

<style>
    form label {
        display: block;
        margin-top: 10px;
        font-weight: bold;
    }
    form input, form select, form textarea {
        width: 100%;
        padding: 6px;
        margin-top: 4px;
        box-sizing: border-box;
    }
    button {
        margin-top: 15px;
        padding: 8px 14px;
        background: #2b7cff;
        color: white;
        border: none;
        cursor: pointer;
    }
    button:hover {
        background: #1f5ecb;
    }
</style>
