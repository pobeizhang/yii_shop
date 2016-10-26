<?php
	use yii\bootstrap\ActiveForm;
	use yii\helpers\Html;
?>
<!-- ============================================================= HEADER : END ============================================================= -->		<!-- ========================================= MAIN ========================================= -->
<main id="authentication" class="inner-bottom-md">
	<div class="container">
		<div class="row">

			<div class="col-md-6">
				<section class="section sign-in inner-right-xs">
                    <h2 class="bordered">
                        <img src = "<?= Yii::$app->session['userinfo']['figureurl_qq_1']?>">
                        请完善您的信息
                    </h2>
					<p>欢迎您回来，请您输入您的账户名密码</p>

					<div class="social-auth-buttons">
					</div>
					<?php $form = ActiveForm::begin([
						'action' => ['member/qqreg'],
						'options' => ['class' => 'login-form cf-style-1'],
						'fieldConfig' => [
							'template' => '{error}<div class="field-row">{label}{input}</div>'
						]
                    ]);?>
                    <input class = 'le-input' value = "<?= Yii::$app->session['userinfo']['nickname']?>" type = "text"><br>
					<?php echo $form->field($model, 'homename')->textInput(['class' => 'le-input']);?>
					<?php echo $form->field($model, 'homepwd')->passwordInput(['class' => 'le-input']);?>
                    <?php echo $form->field($model, 'rehomepwd')->passwordInput(['class' => 'le-input']);?>
                    <div class="field-row clearfix">
                    </div>

                        <div class="buttons-holder">
                        	<?php echo Html::submitButton('完善信息', ['class' => 'le-button huge']);?>
                        </div><!-- /.buttons-holder -->
					<?php ActiveForm::end();?>
					<!-- /.cf-style-1 -->

				</section><!-- /.sign-in -->
			</div><!-- /.col -->

			<div class="col-md-6">
				

			</div><!-- /.col -->

		</div><!-- /.row -->
	</div><!-- /.container -->
</main><!-- /.authentication -->
<!-- ========================================= MAIN : END ========================================= -->		<!-- ============================================================= FOOTER ============================================================= -->


    <script>
        var login_qq = document.getElementById('login_qq');
    login_qq.onclick = function(){
        window.location.href = "<?= yii\helpers\Url::to(['member/qqlogin']);?>";
    }
    </script>
