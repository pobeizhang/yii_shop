
        <!-- end sidebar -->
        <link rel="stylesheet" href="assets/admin/css/compiled/user-list.css" type="text/css" media="screen" />
        <!-- main container -->
        <div class="content">
            <div class="container-fluid">
                <div id="pad-wrapper" class="users-list">
                    <div class="row-fluid header">
                        <h3>会员列表</h3>
                        <div class="span10 pull-right">
                            <a href="<?php echo yii\helpers\Url::to(['user/adduser']);?>" class="btn-flat success pull-right">
                                <span>&#43;</span>添加新会员</a></div>
                    </div>
                    <!-- Users table -->
                    <div class="row-fluid table">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="span3 sortable">
                                        <span class="line"></span>用户名</th>
                                    <th class="span3 sortable">
                                        <span class="line"></span>真实姓名</th>
                                    <th class="span2 sortable">
                                        <span class="line"></span>昵称</th>
                                    <th class="span3 sortable">
                                        <span class="line"></span>性别</th>
                                    <th class="span3 sortable">
                                        <span class="line"></span>年龄</th>
                                    <th class="span3 sortable">
                                        <span class="line"></span>生日</th>
                                    <th class="span3 sortable align-right">
                                        <span class="line"></span>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row -->
                                <?php foreach($users as $user):?>
                                <tr class="first">
                                    <td>
                                        <img src="<?php echo Yii::$app->params['defaultValue']['avatar']?>" class="img-circle avatar hidden-phone" />
                                        <a href="#" class="name"><?php echo $user->homename;?></a>
                                        <span class="subtext"><?php echo $user->homeemail;?></span>
                                    </td>
                                    <td><?php echo isset($user->home_profile->truename) ? $user->truename : '未填写';?></td>
                                    <td><?php echo isset($user->home_profile->nickname) ? $user->home_profile->nickname : '未填写';?></td>
                                    <td><?php echo isset($user->home_profile->sex) ? $user->home_profile->sex : '未填写';?></td>
                                    <td><?php echo isset($user->home_profile->age) ? $user->home_profile->age: '未填写';?></td>
                                    <td><?php echo isset($user->home_profile->birthday) ? $user->home_profile->birthday : '未填写'?></td>
                                    <td class="align-right">
                                        <a href="<?php echo yii\helpers\Url::to(['user/deluser', 'uid' => $user->uid]);?>">删除</a></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination pull-right"></div>
                    <!-- end users table --></div>
            </div>
        </div>
        <!-- end main container -->
        <!-- scripts -->