<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <script type='text/javascript' src="/static/js/jquery.min.js"></script>
    <script type='text/javascript' src="/static/js/ajax.js"></script>

    <style type="text/css">

        div,span,font,a,td{font-size:13px;}

        table{border-collapse:collapse; border-spacing:0; border:1px solid #aaa; background:#efefef;}

        th{border:1px dotted #aaa; padding:3px 15px; text-align:center; font-weight:bold; background:#efefef; font-size:13px;}

        td{border:1px dotted #aaa; padding:3px 15px; text-align:center; color:#3C3C3C; background:white}

    </style>
	<title>短链接</title>
</head>
<body>
<div>
<form action="/LongToShort/addurl" method="post">
    <input type="text" placeholder="请填入要生成短链接的原链接" name="longurl">
    <input type="submit" value="提交">
</form>
</div>
<div id="urlshow" style="width: 500px"></div>
</body>
<script>
    $(document).ready(function(){
        $.ajax({
            url:"/LongToShort/geturl",
            type:"get",
            datatype:"JSON",
            success:function (data) {
                var insertdata=JSON.parse(data);
                if(insertdata.length!=0){
                    var html="<table>" +
                        "<tr><th style='width:200px; overflow: auto'>长链接</th><th>短链接</th></tr>";
                    $.each(insertdata,function(key,value){
                        html+="<tr><td>" +value.longurl+"</td><td><a href='/LongToShort/jumpurl/"+value.shorturl+"'>http://t.cn/"+value.shorturl+"</a></td></tr>";
                    });
                    html+="</table>";
                    $("#urlshow")[0].innerHTML=html;
                }
            }
        });
    });
</script>
</html>