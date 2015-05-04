<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use kongoon\theme\material;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

//AppAsset::register($this);
material\MaterialAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => '<span class="glyphicon glyphicon-phone"> ระบบเงินเดือนออนไลน์</span>',
                //'brandLabel' => 'ระบบเงินเดือนออนไลน์',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-info navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'หน้าหลัก', 'url' => ['/site/index']],
                    ['label' => 'รายงาน',
                        'items'=>[
                            ['label'=>'รายงาน1','url'=>['/report/report/report1']],
                            ['label'=>'รายงาน2','url'=>['/report/report/report2']],
                            ['label'=>'รายงาน3','url'=>['/report/report/report3']],
                        ]
                    ],
                    ['label' => 'เกี่ยวกับเรา', 'url' => ['/site/about']],
                    ['label' => 'ติดต่อ', 'url' => ['/site/contact']],
                  
                    Yii::$app->user->isGuest ?
                        ['label' => 'เข้าสู่ระบบ', 'url' => ['/user/login']] :
                        ['label' => 'ออกจากระบบ (' . Yii::$app->user->displayName . ')',
                            'url' => ['/user/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
<?php
foreach(Yii::$app->session->getAllFlashes() as $key=>$message){
    echo '<div class="alert alert-'.$key.'" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        '.ucfirst($key).'! '.$message.'</div>';
}
?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; โรงพยาบาลศรีสังวรสุโขทัย <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
