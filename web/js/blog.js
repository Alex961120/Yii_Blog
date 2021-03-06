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

var previewObj;

function replaceImg(obj) {
    var src = $(obj).find('img').attr('src');
    if (src != undefined) {
        $(".previewModal-img").attr('src', src);
        previewObj = obj;
    }
}

$('#previewModal').on('show.bs.modal', function (e) {
    replaceImg(e.relatedTarget);
});
$(".next-img").click(function () {
    // 寻找当前对象的下一个对象
    replaceImg($(previewObj).next());
});
$(".prev-img").click(function () {
    replaceImg($(previewObj).prev());
});

$(".comment-reply").click(function () {
    var id = $(this).attr('data-id');
    var name = $(this).attr('data-name');
    $('#comment-parent_id').val(id);
    $('#comment-content').attr('placeholder', '回复@' + name + ':').focus();
});

$(".btn-form-topic").click(function () {
    $(this).parents("form").find("textarea").val("#话题内容# ").focus();
});

// 实现刷新话题列表
$(".refresh").click(function () {
    var page = $(".menu-topic").attr("data-page");
    ++page;
    $.ajax({
        url: "?=topic/list",
        type: "POST",
        dataType: "json",
        data: {'page': page},
        success: function (data) {
            var topic = '';
            $(data.topics).each(function (i, k) {
                topic += "<p><a href='?r=topic/show&id=" + k['id'] + "'>" + k['name'] + "</a></p>"
            });
            $(".menu-topic-list").html(topic);
            $(".menu-topic").attr("data-page", data.page);
        }
    });
});