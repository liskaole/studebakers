<?php session_start();
    error_reporting(0);
    $width = 90;                  //Ширина изображения
    $height = 45;                  //Высота изображения
    $font_size = 13;   			//Размер шрифта
    $let_amount = 4;               //Количество символов, которые нужно набрать
    $fon_let_amount = 30;          //Количество символов, которые находятся на фоне
    $path_fonts = './fonts/fonts-captcha/cour.ttf';        //Путь к шрифтам


    $letters = array('a','b','c','d','e','f','g','h','j','k','m','n','p','q','r','s','t','u','v','w','x','y','z','2','3','4','5','6','7','9'); // набор символов для кода
    $colors = array('10','30','50','70','90','110','130','150','170','190','210'); // набор цветов для символов

    $src = imagecreatetruecolor($width,$height);
    $fon = imagecolorallocate($src,244,244,244); // Генерируем белый цвет. Так положено.
    imagefill($src,0,0,$fon);

    $fonts = array();

    @$dir=opendir($path_fonts);
    while($fontName = @readdir($dir))
    {
        if($fontName != "." && $fontName != "..")
        {
            $fonts[] = $fontName;
        }
    }
    @closedir($dir);

    for($i=0;$i<$fon_let_amount;$i++) // добавляем маленькие буковки на фон
    {
        $color = imagecolorallocatealpha($src,rand(0,255),rand(0,255),rand(0,255),105);
        $font = $path_fonts.$fonts[rand(0,sizeof($fonts)-1)];
        $letter = $letters[rand(0,sizeof($letters)-1)];
        $size = rand($font_size-2,$font_size+2);
        imagettftext($src,$size,rand(0,45),rand($width*0.1,$width-$width*0.1),rand($height*0.2,$height),$color,$font,$letter);
    }

    for($i=0;$i<$let_amount;$i++) // тоже самое для основных букв кода
    {
        $color = imagecolorallocatealpha($src,$colors[rand(0,sizeof($colors)-1)],$colors[rand(0,sizeof($colors)-1)],$colors[rand(0,sizeof($colors)-1)],rand(20,40));
        $font = $path_fonts.$fonts[rand(0,sizeof($fonts)-1)];
        $letter = $letters[rand(0,sizeof($letters)-1)];
        $size = rand($font_size*2.3-2,$font_size*2.3+2);
        $x = ($i+1)*$font_size + rand(4,7); // даем каждому символу случайное смещение
        $y = (($height*2)/3) + rand(0,5);
        $cod[] = $letter;   // запоминаем код
        imagettftext($src,$size,rand(0,15),$x,$y,$color,$font,$letter);
    }

    $_SESSION['secpic'] = implode('',$cod); // переводим код в строку

    header ("Content-type: image/gif"); // выводим готовую картинку
    imagegif($src);
?>