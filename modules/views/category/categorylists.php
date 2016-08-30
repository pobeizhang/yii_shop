
        <!-- end sidebar -->
        <link rel="stylesheet" href="assets/admin/css/compiled/user-list.css" type="text/css" media="screen" />
        <!-- main container -->
        <div class="content">
            <div class="container-fluid">
                <div id="pad-wrapper" class="users-list">
                    <div class="row-fluid header">
                        <h3>分类列表</h3>
                        <div class="span10 pull-right">
                            <a href="/index.php?r=admin%2Fcategory%2Fadd" class="btn-flat success pull-right">
                                <span>&#43;</span>添加新分类</a></div>
                    </div>
                    <!-- Users table -->
                    <div class="row-fluid table">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="span3 sortable">
                                        <span class="line"></span>分类ID</th>
                                    <th class="span3 sortable">
                                        <span class="line"></span>分类名称</th>
                                    <th class="span3 sortable align-right">
                                        <span class="line"></span>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row -->
				<?php foreach($cates as $k=>$v):?>
                                <tr class="first">
                                    <td><?php echo $v['cid']?></td>
                                    <td><?php echo $v['_title']?></td>
                                    <td class="align-right">
                                        <a href="<?php echo yii\helpers\Url::to(['category/editcategory', 'cid' => $v['cid']]);?>">编辑</a>
                                        <a href="<?php echo yii\helpers\Url::to(['category/delcategory', 'cid' => $v['cid']]);?>">删除</a></td>
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
