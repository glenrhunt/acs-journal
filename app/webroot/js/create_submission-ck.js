$(document).ready(function(){$(".right a.btn").click(function(a){a.preventDefault();var b=$(this),c=$(".right .coauthor:last").clone().removeClass("base");c.find("input").each(function(){var a=$(this).attr("name"),b=$(this).attr("id"),c=parseInt(a.match(/[0-9]+/)[0]),d=c++;a=a.replace(c,d);b=b.replace(c,d);$(this).attr({name:a,id:b});console.log($(this))})})});