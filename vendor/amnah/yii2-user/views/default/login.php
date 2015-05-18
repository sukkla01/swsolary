<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\LoginForm $model
 */

$this->title = Yii::t('user', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-login">

	

	<p><?= Yii::t("user", "กรุณาเข้าระบบ:") ?></p>

	<?php $form = ActiveForm::begin([
		'id' => 'login-form',
		'options' => ['class' => 'form-horizontal'],
		'fieldConfig' => [
			'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
			'labelOptions' => ['class' => 'col-lg-2 control-label'],
		],

	]); ?>

	<?= $form->field($model, 'username') ?>
	<?= $form->field($model, 'password')->passwordInput() ?>
	<?= $form->field($model, 'rememberMe', [
		'template' => "{label}<div class=\"col-lg-offset-2 col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
	])->checkbox() ?>

	<div class="form-group">
		<div class="col-lg-offset-2 col-lg-10">
			<?= Html::submitButton(Yii::t('user', 'Login'), ['class' => 'btn btn-primary']) ?>

            <br/><br/>
            
		</div>
	</div>

	<?php ActiveForm::end(); ?>

   
	

</div>

<div class="col-lg-offset-1" style="color:#dc143c;">
    <h4><span class="label label-danger">วัตถุประสงค์</span></h4>
   
    1.เพื่อแจ้งรายละเอียดการโอนเงินดือน ค่าจ้าง ค่าตอบแทนเข้าบัญชีของข้าราชการ ลูกจ้างประจำ และพนักงานราชการของสำนักงานปลัดกระทรวงสาธารณสุข (ส่วนกลาง) <br>
    2.เพื่อลดการใช้กระดาษ ทดแทนการแจกกระดาษสลิปเงินเดือน
</div>