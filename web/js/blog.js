// 模拟文件上传操作 并将上传文件提交到iframe
var form;
// 点击上传按钮 - 获取表单对象 - 执行file按钮
$(".btn-form-img").click(function () {
    form = $(this).parents("form");
    $(form).find("#uploadform-imagefiles").click();

    // 如果表单域内容发生改变，给表单添加属性
    $(".upload-blog-input").change(function () {
        $(form).attr('action', '?r=upload/blog');
        $(form).attr('target', 'upload-iframe');
        $(form).submit();
    });
});

function preview(filenames) {
    var images = input = '';
    // 遍历显示文件信息
    $($.parseJSON(filenames)).each(function (i, k) {
        // 添加一个图片标签，为它设置服务器返回的图片 src
        images += "<img class='preview-img' src='images/upload/" + k + "'>";
        input += "<input type='hidden' name='filenames[]' value='" + k + "'>";
    })

    // 将 img 组合放入窗口中，显示多张图片
    $(form).find(".upload-images").html(images + input).css("clear", "both");
    $(".upload-form").attr('target', '');
    // 更换表单提交路由
    $(".upload-blog-form").attr('action', '?r=blog/repost');
}