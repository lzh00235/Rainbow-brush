<?php

include '../includes/common.php';
$title = '抽奖配置';
include 'head.php';
if (!($islogin == 1)) {
    exit('<script language=\'javascript\'>window.location.href=\'./login.php\';</script>');
}
$fl = $DB->query('SELECT * FROM shua_class WHERE active=1 order by sort asc');
$select = '<option value="0">请选择分类</option>';
$shua_class[0] = '默认分类';
while (true) {
    $res = $DB->fetch($fl);
    if (!$DB->fetch($fl)) {
        $select2 = '<option value="0">请选择商品</option>';
        echo "<div class=\"modal fade\" id=\"myModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">\r\n    <div class=\"modal-dialog\">\r\n        <div class=\"modal-content\">\r\n            <div class=\"modal-header\">\r\n                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>\r\n                <h4 class=\"modal-title\" id=\"myModalLabel\">添加奖项</h4>\r\n            </div>\r\n            <div class=\"modal-body\">\r\n\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t<div class=\"input-group\">\r\n\t\t\t\t\t\t<div class=\"input-group-addon\">奖品名称</div>\r\n\t\t\t\t\t\t<input type=\"text\" id=\"name\" class=\"form-control\" placeholder=\"请填写奖项名称\">\r\n\t\t\t\t\t</div>\r\n\t\t\t\t</div>\r\n\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t<div class=\"input-group\">\r\n\t\t\t\t\t\t<div class=\"input-group-addon\">中奖几率</div>\r\n\t\t\t\t\t\t<input type=\"number\" id=\"rate\" class=\"form-control\" placeholder=\"请填写中奖几率(百分比)\">\r\n\t\t\t\t\t</div>\r\n\t\t\t\t</div>\r\n\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t<div class=\"input-group\">\r\n\t\t\t\t\t\t<div class=\"input-group-addon\">对应分类</div>\r\n\t\t\t\t\t\t<select id=\"cid\" class=\"form-control\">";
        echo $select;
        echo "</select>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t</div>\r\n\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t<div class=\"input-group\">\r\n\t\t\t\t\t\t<div class=\"input-group-addon\">对应商品</div>\r\n\t\t\t\t\t\t<select id=\"tid\" class=\"form-control\">";
        echo $select2;
        echo "</select>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t</div>\r\n\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t<a class=\"btn btn-info btn-block\" id=\"submit\" data-dismiss=\"modal\">确定添加</a>\r\n\t\t\t\t</div>\r\n\t\t\t</div>\r\n        </div>\r\n    </div>\r\n</div>\r\n<div class=\"modal fade\" id=\"edit_modal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">\r\n    <div class=\"modal-dialog\">\r\n        <div class=\"modal-content\">\r\n            <div class=\"modal-header\">\r\n                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>\r\n                <h4 class=\"modal-title\" id=\"edit_title\">编辑奖项</h4>\r\n            </div>\r\n            <div class=\"modal-body\">\r\n\t\t\t<input type=\"hidden\" id=\"edit_val\">\r\n\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t<div class=\"input-group\">\r\n\t\t\t\t\t\t<div class=\"input-group-addon\">奖品名称</div>\r\n\t\t\t\t\t\t<input type=\"text\" id=\"edit_name\" class=\"form-control\" placeholder=\"请填写奖项名称\">\r\n\t\t\t\t\t</div>\r\n\t\t\t\t</div>\r\n\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t<div class=\"input-group\">\r\n\t\t\t\t\t\t<div class=\"input-group-addon\">中奖几率</div>\r\n\t\t\t\t\t\t<input type=\"number\" id=\"edit_rate\" class=\"form-control\" placeholder=\"请填写中奖几率(百分比)\">\r\n\t\t\t\t\t</div>\r\n\t\t\t\t</div>\r\n\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t<div class=\"input-group\">\r\n\t\t\t\t\t\t<div class=\"input-group-addon\">对应分类</div>\r\n\t\t\t\t\t\t<select id=\"edit_cid\" class=\"form-control\" default=\"\">";
        echo $select;
        echo "</select>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t</div>\r\n\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t<div class=\"input-group\">\r\n\t\t\t\t\t\t<div class=\"input-group-addon\">对应商品</div>\r\n\t\t\t\t\t\t<select id=\"edit_tid\" class=\"form-control\">";
        echo $select2;
        echo "</select>\r\n\t\t\t\t\t</div>\r\n\t\t\t\t</div>\r\n\t\t\t\t<div class=\"form-group\">\r\n\t\t\t\t\t<a class=\"btn btn-info btn-block\" onclick=\"edit_ok(\$('#edit_val').val())\">确定修改</a>\r\n\t\t\t\t</div>\r\n\t\t\t</div>\r\n        </div>\r\n    </div>\r\n</div>\r\n<div class=\"container\" style=\"padding-top:70px;\">\r\n<div class=\"col-xs-12 col-sm-10 col-lg-8 center-block\" style=\"float: none;\" id=\"main\">\r\n<div class=\"panel panel-primary\">\r\n<div class=\"panel-heading\">\r\n<h3 class=\"panel-title\"><b>抽奖配置</b></h3>\r\n</div>\r\n<div class=\"panel-body\">\r\n<div class=\"form-group\">\r\n<div class=\"input-group\">\r\n<div class=\"input-group-addon\">是否开启抽奖</div>\r\n<select id=\"gift_open\" class=\"form-control\" default=\"";
        echo $conf['gift_open'];
        echo "\">\r\n<option value=\"0\">0_关闭</option>\r\n<option value=\"1\">1_开启</option>\r\n</select>\r\n</div>\r\n</div>\r\n<div class=\"form-group\">\r\n<div class=\"input-group\">\r\n<div class=\"input-group-addon\">每日每人抽奖次数</div>\r\n<input class=\"form-control\" type=\"number\" id=\"cishu\" value=\"";
        echo $conf['cjcishu'];
        echo "\">\r\n</div>\r\n</div>\r\n<div class=\"form-group\">\r\n<div class=\"input-group\">\r\n<div class=\"input-group-addon\">抽奖上限提示信息</div>\r\n<input class=\"form-control\" type=\"text\" id=\"cjmsg\" value=\"";
        echo $conf['cjmsg'];
        echo "\">\r\n</div>\r\n</div>\r\n<div class=\"form-group\">\r\n<div class=\"input-group\">\r\n<div class=\"input-group-addon\">抽奖付费金额</div>\r\n<input class=\"form-control\" type=\"text\" id=\"cjmoney\" value=\"";
        echo $conf['cjmoney'];
        echo "\" placeholder=\"填0则不需要付费\">\r\n</div>\r\n</div>\r\n<div class=\"form-group\">\r\n<div class=\"input-group\">\r\n<div class=\"input-group-addon\">是否显示中奖记录</div>\r\n<select id=\"gift_log\" class=\"form-control\" default=\"";
        echo $conf['gift_log'];
        echo "\">\r\n<option value=\"0\">0_关闭</option>\r\n<option value=\"1\">1_开启</option>\r\n</select>\r\n</div>\r\n</div>\r\n<a class=\"btn btn-info btn-block\" id=\"cishu_submit\">保存</a>\r\n</div>\r\n</div>\r\n<div class=\"panel panel-success\">\r\n<div class=\"panel-heading\">\r\n<h3 class=\"panel-title\"><b>抽奖商品列表</b></h3>\r\n</div>\r\n<div class=\"panel-body\">\r\n<a class=\"btn btn-success\" data-toggle=\"modal\" data-target=\"#myModal\">添加一个奖项</a>&nbsp;<a class=\"btn btn-warning\" href=\"choujiang_list.php\">查看中奖记录</a>\r\n</div>\r\n<table class=\"table table-striped\" id=\"tab\">\r\n<thead><tr><th>奖品名称</th><th>对应商品</th><th>中奖几率</th><th>操作</th></tr></thead>\r\n<tbody>\r\n";
        $rs = $DB->query('SELECT a.*,(SELECT b.name FROM shua_tools as b WHERE a.tid=b.tid) as shopname FROM shua_gift as a');
        while (true) {
            $row = $DB->fetch($rs);
            if (!$DB->fetch($rs)) {
                echo "</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n</div>\r\n<script src=\"//lib.baomitu.com/layer/2.3/layer.js\"></script>\r\n<script>\r\nvar items = \$(\"select[default]\");\r\nfor (i = 0; i < items.length; i++) {\r\n\t\$(items[i]).val(\$(items[i]).attr(\"default\")||0);\r\n}\r\n\$(\"#cishu_submit\").click(function(){\r\n\tii=layer.load(1,{shade:0.3});\r\n\t\$.ajax({\r\n\t\ttype:\"get\",\r\n\t\turl:\"ajax.php?act=cishu&cishu=\"+\$(\"#cishu\").val()+\"&gift_open=\"+\$(\"#gift_open\").val()+\"&gift_log=\"+\$(\"#gift_log\").val()+\"&cjmsg=\"+\$(\"#cjmsg\").val()+\"&cjmoney=\"+\$(\"#cjmoney\").val(),\r\n\t\tdataType:\"json\",\r\n\t\tsuccess:function(cishu){\r\n\t\t\tlayer.close(ii);\r\n\t\t\tif(cishu.code==0){\r\n\t\t\t\tlayer.msg('保存成功',{icon:1,time:1000,shade:0.3});\r\n\t\t\t}else{\r\n\t\t\t\tlayer.alert(cishu.msg);\r\n\t\t\t}\r\n\t\t}\r\n\t});\r\n});\r\nfunction editmember(id){\r\n\tii=layer.load(1);\r\n\t\$.ajax({\r\n\t\ttype:\"post\",\r\n\t\turl:\"ajax.php?act=edit_cj\",\r\n\t\tdata:{\r\n\t\t\tid:id\r\n\t\t},\r\n\t\tdataType:\"json\",\r\n\t\tsuccess:function(edit){\r\n\t\t\tlayer.close(ii);\r\n\t\t\tif(edit.code==0){\r\n\t\t\t\t\$(\"#edit_val\").val(edit.id);\r\n\t\t\t\t\$(\"#edit_name\").val(edit.name);\r\n\t\t\t\t\$(\"#edit_rate\").val(edit.rate);\r\n\t\t\t\t\$(\"#edit_cid\").val(edit.cid);\r\n\t\t\t\t\$(\"#edit_tid\").attr('default',edit.tid);\r\n\t\t\t\t\$(\"#edit_modal\").modal('show');\r\n\t\t\t\t\$(\"#edit_cid\").change();\r\n\t\t\t}else{\r\n\t\t\t\tlayer.alert(edit.msg);\r\n\t\t\t}\r\n\t\t}\r\n\t});\r\n}\r\nfunction del_member(id){\r\n\tii=layer.load(1);\r\n\t\$.ajax({\r\n\t\ttype:\"post\",\r\n\t\turl:\"ajax.php?act=del_member\",\r\n\t\tdata:{\r\n\t\t\tid:id\r\n\t\t},\r\n\t\tdataType:\"json\",\r\n\t\tsuccess:function(del){\r\n\t\t\tlayer.close(ii);\r\n\t\t\tif(del.code==0){\r\n\t\t\t\tlayer.msg(del.msg,{icon:1,time:1500,shade:0.3});\r\n\t\t\t\t\$.ajax({\r\n\t\t\t\t\ttype:\"get\",\r\n\t\t\t\t\turl:\"choujiang.php\",\r\n\t\t\t\t\tdataType:\"html\",\r\n\t\t\t\t\tsuccess:function(html){\r\n\t\t\t\t\t\t\$(\"#tab\").html(\$(html).find('#tab').html());\r\n\t\t\t\t\t}\r\n\t\t\t\t});\r\n\t\t\t}else{\r\n\t\t\t\tlayer.alert(del.msg);\r\n\t\t\t}\r\n\t\t}\r\n\t});\r\n}\r\nfunction edit_ok(id){\r\n\tii=layer.load(1);\r\n\tvar name=\$(\"#edit_name\").val();\r\n\tvar cid=\$(\"#edit_cid\").val();\r\n\tvar tid=\$(\"#edit_tid\").val();\r\n\tvar rate=\$(\"#edit_rate\").val();\r\n\tif(!name||tid==0 || rate==''){\r\n\t\tlayer.msg(\"请输入完整！\",{icon:2,time:1000,shade:0.3});\r\n\t\tlayer.close(ii);\r\n\t\treturn false;\r\n\t}\r\n\t\$.ajax({\r\n\t\ttype:\"post\",\r\n\t\turl:\"ajax.php?act=edit_cj_ok\",\r\n\t\tdata:{\r\n\t\t\tid:id,name:name,tid:tid,rate:rate\r\n\t\t},\r\n\t\tdataType:\"json\",\r\n\t\tsuccess:function(add){\r\n\t\t\t\$(\"#edit_modal\").modal('hide');\r\n\t\t\tif(add.code==0){\r\n\t\t\t\tlayer.close(ii);\r\n\t\t\t\tlayer.msg(add.msg,{icon:1,shade:0.3,time:1500});\r\n\t\t\t\twindow.location.href=\"choujiang.php\";\r\n\t\t\t}else{\r\n\t\t\t\tlayer.close(ii);\r\n\t\t\t\tlayer.alert(add.msg);\r\n\t\t\t}\r\n\t\t}\r\n\t});\r\n}\r\n\$(\"#cid\").change(function () {\r\n\tvar cid = \$(this).val();\r\n\tvar ii = layer.load(2, {shade:[0.1,'#fff']});\r\n\t\$(\"#tid\").empty();\r\n\t\$(\"#tid\").append('<option value=\"0\">请选择商品</option>');\r\n\t\$.ajax({\r\n\t\ttype : \"GET\",\r\n\t\turl : \"../ajax.php?act=gettool&cid=\"+cid,\r\n\t\tdataType : 'json',\r\n\t\tsuccess : function(data) {\r\n\t\t\tlayer.close(ii);\r\n\t\t\tif(data.code == 0){\r\n\t\t\t\tvar num = 0;\r\n\t\t\t\t\$.each(data.data, function (i, res) {\r\n\t\t\t\t\t\$(\"#tid\").append('<option value=\"'+res.tid+'\">'+res.name+'</option>');\r\n\t\t\t\t\tnum++;\r\n\t\t\t\t});\r\n\t\t\t\t\$(\"#tid\").val(0);\r\n\t\t\t\tif(num==0 && cid!=0)layer.alert('该分类下没有商品');\r\n\t\t\t}else{\r\n\t\t\t\tlayer.alert(data.msg);\r\n\t\t\t}\r\n\t\t},\r\n\t\terror:function(data){\r\n\t\t\tlayer.msg('服务器错误');\r\n\t\t\treturn false;\r\n\t\t}\r\n\t});\r\n});\r\n\$(\"#edit_cid\").change(function () {\r\n\tvar cid = \$(this).val();\r\n\tvar ii = layer.load(2, {shade:[0.1,'#fff']});\r\n\t\$(\"#edit_tid\").empty();\r\n\t\$(\"#edit_tid\").append('<option value=\"0\">请选择商品</option>');\r\n\t\$.ajax({\r\n\t\ttype : \"GET\",\r\n\t\turl : \"../ajax.php?act=gettool&cid=\"+cid,\r\n\t\tdataType : 'json',\r\n\t\tsuccess : function(data) {\r\n\t\t\tlayer.close(ii);\r\n\t\t\tif(data.code == 0){\r\n\t\t\t\tvar num = 0;\r\n\t\t\t\t\$.each(data.data, function (i, res) {\r\n\t\t\t\t\t\$(\"#edit_tid\").append('<option value=\"'+res.tid+'\">'+res.name+'</option>');\r\n\t\t\t\t\tnum++;\r\n\t\t\t\t});\r\n\t\t\t\t\$(\"#edit_tid\").val(\$(\"#edit_tid\").attr('default'));\r\n\t\t\t\tif(num==0 && cid!=0)layer.alert('该分类下没有商品');\r\n\t\t\t}else{\r\n\t\t\t\tlayer.alert(data.msg);\r\n\t\t\t}\r\n\t\t},\r\n\t\terror:function(data){\r\n\t\t\tlayer.msg('服务器错误');\r\n\t\t\treturn false;\r\n\t\t}\r\n\t});\r\n});\r\nwindow.onload=\$(\"#cid\").change();\r\n\$(\"#submit\").click(function(){\r\n\tii=layer.load(1);\r\n\tvar name=\$(\"#name\").val();\r\n\tvar cid=\$(\"#cid\").val();\r\n\tvar tid=\$(\"#tid\").val();\r\n\tvar rate=\$(\"#rate\").val();\r\n\tif(!name){\r\n\t\tlayer.msg(\"请输入完整！\",{icon:2,time:1000,shade:0.3});\r\n\t\tlayer.close(ii);\r\n\t\treturn false;\r\n\t}\r\n\t\$.ajax({\r\n\t\ttype:\"post\",\r\n\t\turl:\"ajax.php?act=add_member\",\r\n\t\tdata:{\r\n\t\t\tname:name,tid:tid,rate:rate\r\n\t\t},\r\n\t\tdataType:\"json\",\r\n\t\tsuccess:function(add){\r\n\t\t\tif(add.code==0){\r\n\t\t\t\t\$(\".modal-backdrop\").remove();\r\n\t\t\t\tlayer.close(ii);\r\n\t\t\t\tlayer.msg(add.msg,{icon:1,shade:0.3,time:1500});\r\n\t\t\t\t\$.ajax({\r\n\t\t\t\t\ttype:\"get\",\r\n\t\t\t\t\turl:\"choujiang.php\",\r\n\t\t\t\t\tdataType:\"html\",\r\n\t\t\t\t\tsuccess:function(html){\r\n\t\t\t\t\t\t\$(\"#tab\").html(\$(html).find('#tab').html());\r\n\t\t\t\t\t}\r\n\t\t\t\t});\r\n\t\t\t}else{\r\n\t\t\t\tlayer.close(ii);\r\n\t\t\t\tlayer.alert(add.msg);\r\n\t\t\t}\r\n\t\t}\r\n\t});\r\n});\r\n</script>\r\n</body>\r\n</html>";
                return null;
            }
            echo '<tr><td>' . $row['name'] . '</td><td>' . $row['shopname'] . '</td><td>' . $row['rate'] . '%</td><td><a href="javascript:void(0)" onclick="editmember(\'' . $row['id'] . '\')" class="btn btn-info btn-xs">编辑</a>&nbsp;<a href="javascript:void(0)" class="btn btn-xs btn-danger" onclick="del_member(\'' . $row['id'] . '\')">删除</a></td></tr>';
        }
    }
    $shua_class[$res['cid']] = $res['name'];
    $select .= '<option value="' . $res['cid'] . '">' . $res['name'] . '</option>';
}