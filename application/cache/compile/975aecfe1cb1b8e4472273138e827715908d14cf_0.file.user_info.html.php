<?php
/* Smarty version 3.1.36, created on 2020-12-18 15:36:12
  from '/home/wyf/project/phptest/yaf/application/modules/Admin/views/user/user_info.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fdc5bec471801_23822594',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '975aecfe1cb1b8e4472273138e827715908d14cf' => 
    array (
      0 => '/home/wyf/project/phptest/yaf/application/modules/Admin/views/user/user_info.html',
      1 => 1608276952,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fdc5bec471801_23822594 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(Yaf\Application::app()->getConfig()->user->header_html, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</head>
<body>

<div class="ok-body">
    <ul class="layui-tab-title">
        <li class="layui-this">
            <a href="/admin/User/user_info">修改个人信息</a>
        </li>
        <li>
            <a href="/admin/Setting/password">修改密码</a>
        </li>
    </ul>
    <!--form表单-->
    <div class="layui-tab-content" style="height: 100px;">
        <div class="layui-tab-item layui-show">
            <form class="layui-form ok-form" lay-filter="filter">
                <div class="layui-form-item">
                    <label class="layui-form-label">昵称</label>
                    <div class="layui-input-block">
                        <input type="text" name="user_nickname" placeholder="请输入昵称" autocomplete="off" class="layui-input" lay-verify="required">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">性别</label>
                    <div class="layui-input-block">
                        <input type="radio" name="sex" value="0" title="保密" checked>
                        <input type="radio" name="sex" value="1" title="男">
                        <input type="radio" name="sex" value="2" title="女">
                    </div>
                </div>


                <div class="layui-upload">
                    <label class="layui-form-label">上传</label>
                    <div class="layui-input-block">
                        <button type="button" class="layui-btn" id="file">上传图片头像</button>
                        <div class="layui-upload-list">
                            <img class="layui-upload-img" id="avatar-img">
                            <input type="hidden" name="avatar" value="">
                            <p id="avatar-text"></p>
                        </div>
                    </div>
                </div>


                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="edit">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php echo '<script'; ?>
 src="<?php echo __STATIC__;?>
/lib/layui/layui.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    layui.use(["form", "okLayer", "okUtils",'upload','jquery'], function () {
        let form = layui.form;
        let $ = layui.jquery;
        let okLayer = layui.okLayer;
        let okUtils = layui.okUtils;
        let upload = layui.upload;
        okLoading.close();

        //普通图片上传
        var uploadInst = upload.render({
            elem: '#file'
            ,url: '/admin/Asset/upload' //改成您自己的上传接口
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#avatar-img').attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res){
                //如果上传失败
                if(res.code != 1){
                    return layer.msg('上传失败');
                }
                $("input[name='avatar']").val(res.data.url);
                //上传成功
            }
            ,error: function(){
                //演示失败状态，并实现重传
                var avatarText = $('#avatar-text');
                avatarText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs avatar-reload">重试</a>');
                avatarText.find('.avatar-reload').on('click', function(){
                    uploadInst.upload();
                });
            }
        });


        form.on("submit(edit)", function (data) {
            okUtils.ajax("/admin/setting/password_post", "post", data.field, true).done(function (response) {
                console.log(response);
                okLayer.greenTickMsg(response.msg, function () {
                    parent.layer.close(parent.layer.getFrameIndex(window.name));
                });
            }).fail(function (error) {
                console.log(error)
            });
            return false;
        });
    })


<?php echo '</script'; ?>
>

</body>

</html><?php }
}
