<?php
use app\core\Application;
?>

<a class="back-link" href="/allEvents">← Back </a>

<h2>Sathvartha Event Details - <?= urlencode($eventName) ?></h2>

<?php if (Application::$app->session->getFlash('success')): ?>
    <div style="color: green; margin-bottom: 10px;">
        <?= Application::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>

<form method="POST" action="/organizeEvent?id=<?= urlencode($eventId) ?>&event_name=<?= urlencode($eventName) ?>" style="max-width: 500px;">
    <input type="hidden" name="event_id" value="<?= htmlspecialchars($eventId) ?>">
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
