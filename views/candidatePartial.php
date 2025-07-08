<?php
/** @var $model \app\models\CandidateModel */
use app\core\Application;
use app\core\form\Form;
?>

<?php $form = Form::begin('', "post") ?>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'mobile') ?>
        <input type="hidden" name="recordDate" value="<?= htmlspecialchars($model->recordDate) ?>">
        <?= $form->field($model, 'participantName') ?>
        <?= $form->field($model, 'country')->dropdownField([
            '' => 'Select Country',
            'India' => 'India',
            'United States' => 'United States of America',
            'United Kingdom' => 'United Kingdom',
            // Add other relevant countries...
        ]) ?>
        <?= $form->field($model, 'language')->dropdownField([
            'English' => 'English',
            'Hindi' => 'Hindi',
            'Kannada' => 'Kannada',
            // Add others as needed
        ]) ?>
    </div>

    <div class="col-md-6">
        <?php
        $evangelistData = Application::$app->session->get('evngDashboardData') ?? [];
        $evangelist2 = Application::$app->session->get('evngName') ?? '';
        ?>
        <?= $form->field($model, 'evangelist')->dropdownField([
            $evangelist2 => $evangelist2,
        ]) ?>
        <?= $form->field($model, 'source')->dropdownField([
            'Facebook' => 'Facebook',
            'TeleCall' => 'TeleCall',
            'Telegram' => 'Telegram',
        ]) ?>
        <?= $form->field($model, 'allotedDays')->dropdownField([
            'Random' => 'Random Days',
            'Sunday' => 'Sunday',
            'Daily' => 'Daily',
        ]) ?>
        <?= $form->field($model, 'mediaType')->dropdownField([
            'Web Video' => 'Web Video',
            'Web Audio' => 'Web Audio',
        ]) ?>
        <?= $form->field($model, 'activeStatus')->dropdownField([
            'Active' => 'Active',
            'Exit' => 'Exit/Drop-out',
            'Completed' => 'Completed',
        ]) ?>
        <?php
        $evangelistData2 = Application::$app->session->get('evngDashboardData2') ?? [];
        $wgroup = $evangelistData2[0]->wgroupId ?? '';
        $email = $evangelistData2[0]->email ?? '';
        ?>
        <?= $form->field($model, 'wgroup')->dropdownField([$wgroup => $wgroup]) ?>
        <?= $form->field($model, 'userid')->dropdownField([$email => $email]) ?>
        <?= $form->field($model, 'remark') ?>
    </div>
</div>

<div class="text-end mt-3">
    <button type="submit" class="btn btn-primary btn-sm">Save</button>
    <a href="/evngDashboard1" class="btn btn-secondary btn-sm">Cancel</a>
</div>

<?php Form::end() ?>
