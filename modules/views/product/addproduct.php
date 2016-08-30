<!-- end sidebar -->
        <style>.span8 div{ display:inline; } .help-block-error { color:red; display:inline; }</style>
        <link rel="stylesheet" href="assets/admin/css/compiled/new-user.css" type="text/css" media="screen" />
        <!-- main container -->
        <div class="content">
            <div class="container-fluid">
                <div id="pad-wrapper" class="new-user">
                    <div class="row-fluid header">
                        <h3>添加商品</h3></div>
                    <div class="row-fluid form-wrapper">
                        <!-- left column -->
                        <div class="span9 with-sidebar">
                           <?php if(Yii::$app->session->hasFlash('info')) {echo Yii::$app->session->getFlash('info');}?>
                            <div class="container">
                                 <?php
                                      use yii\helpers\Html;
                                      use yii\bootstrap\ActiveForm;
                                      $form = ActiveForm::begin([
                                          'options' => [
                                               'class' => 'new_user_form inline-input',
                                               'enctype' => 'multipart/form-data'
                                       ],
                                          'fieldConfig' => [
                                              'template' => '{error}<div class="span12 field-box">{label}{input}</div>'
                                          ]
                                      ]);

                                     echo $form->field($model, 'cid')->dropDownList($list, ['id' => 'cates']);
                                     echo $form->field($model, 'title')->textInput(['class' => 'span9']);
                                     echo $form->field($model, 'descr')->textarea(['id' => 'wysi', 'class' => 'span9 wysihtml5', 'style' => 'margin-left:120px']);
                                     echo $form->field($model, 'price')->textInput(['class' => 'span9']);
                                     echo $form->field($model, 'ishot')->radioList([0 => '不热卖', 1 => '热卖'], ['class' => 'span8']);
                                     echo $form->field($model, 'issale')->radioList([0 => '不促销', 1 => '促销'], ['class' => 'span8']);
                                     echo $form->field($model, 'saleprice')->textInput(['class' => 'span9']);
                                     echo $form->field($model, 'num')->textInput(['class' => 'span9']);
                                     echo $form->field($model, 'ison')->radioList([0 => '不上架', 1 => '上架'], ['class' => 'span8']);
                                     echo $form->field($model, 'istui')->radioList([0 => '不推荐', 1 => '推荐'], ['class' => 'span8']);
                                     echo $form->field($model, 'cover')->fileInput(['class' => 'span9']);
                                     if(!empty($model->cover)):
                                ?>
                                <img src="<?php echo $model->cover;?>-covermiddle" />
                                <hr />
                                <?php endif;
                                     echo $form->field($model, 'pics[]')->fileInput(['class' => 'span9', 'multiple' => true]);
                                ?>
                                <?php foreach((array)json_decode($model->pics) as $k =>$v): ?>
                                    <img src="<?php echo $v?>-coversmall" />
                                    <a href="<?php echo yii\helpers\Url::to(['product/removepics', 'key' => $k, 'pid' => $model->pid]);?>">删除<a/>
                                <?php endforeach; ?>
                                    <hr>
                                    <input type='button' id="addpic" value='增加一个'>
                                    <div class="span11 field-box actions">
                                        <?php echo Html::submitButton('提交', ['class' => 'btn-glow primary']);?>
                                        <span>OR</span>
                                        <?php echo Html::resetButton('取消', ['class' => 'reset']);?>
                                    </div>
                                <?php ActiveForm::end();?>
                            </div>
                        </div>
                        <!-- side right column -->
                        <div class="span3 form-sidebar pull-right">
                            <div class="alert alert-info hidden-tablet">
                                <i class="icon-lightbulb pull-left"></i>请在左侧表单当中填入要添加的商品信息,包括商品名称,描述,图片等</div>
                            <h6>商城用户说明</h6>
                            <p>可以在前台进行购物</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end main container -->
        <!-- scripts -->
