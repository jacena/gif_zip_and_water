<?php 

//eg: IMG_sks2xd.gif

//遍历文件下下的gif图片
$list = glob('IMG_*.gif');

foreach($list as $key => $value){
    //获取图片的宽高
    $com = 'ffmpeg -i '.$value.' 2>&1 | grep "Stream" | grep "Video" | cut -d"," -f 3';
    $re = exec($com);
    if($re) $wid_hei = explode('x',$re);  

    //文件名规则，自己修改
    $ext = substr($value,4,6);
    //如果宽度480，否则270,否则203
    if($wid_hei[0] == 480) {
        $comm = 'ffmpeg -i '.$value.' -strict -2 -vf delogo=x=390:y=230:w=80:h=35:show=0 IMG_'.$ext.'_1_no_water.gif';
    }elseif($wid_hei[0] == 270){
        $comm = 'ffmpeg -i '.$value.' -strict -2 -vf delogo=x=220:y=440:w=49:h=38:show=0 IMG_'.$ext.'_1_no_water.gif';
    }else{
        $comm = 'ffmpeg -i '.$value.' -strict -2 -vf delogo=x=165:y=335:w=36:h=23:show=0 IMG_'.$ext.'_1_no_water.gif';
    }
    exec($comm);
        
    $command = 'convert IMG_'.$ext.'_1_no_water.gif -fuzz 18% -layers Optimize IMG_'.$ext.'_1.gif';
    exec($command);
    echo '第'.$key.'个执行完毕\n';
}
echo 'done';



