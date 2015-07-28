# bbcode2html
Bbcode to html for Wecenter

原来Wecenter保存编辑数据是BBCODE，中途更换Ueditor编辑器导致不一致，所以写了个小程序把BBCODE转换成HTML
###思路
![cmd-markdown-logo](http://ww4.sinaimg.cn/mw690/b03d2261gw1euih339376j20ig0i1dgg.jpg)

###使用方法
* 附件中的图片[attach]$id[/attach] - > img标签(具体的生成格式可以修改/view/question/ajax/load_atach.tpl.html)
* 文章转换:访问http://youdomain/bbcode2html
* 问答转换:访问http://youdomain/bbcode2html/1
* * 读取 htmlspecialchars_decode
