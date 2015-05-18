<?php

 echo Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> Privacy Statement', ['/site/mpdf-demo-1'], [
    'class'=>'btn btn-danger', 
    'target'=>'_blank', 
    'data-toggle'=>'tooltip', 
    'title'=>'Will open the generated PDF file in a new window'
]);
 
/**
 * THE CONTROLLER ACTION
 */
use kartik\mpdf\Pdf;
 
// Privacy statement output demo


?>
