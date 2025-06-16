<?php
function EXPLORE($way) {
    if (is_dir($way)) {
        echo "Contenu css génerator $way\n";
        echo "--------------------------\n";

    
        $contenu = glob($way . '*'); 

        foreach ($contenu as $élément) {
            if (is_dir($élément)) {
               
                echo "[Dossier] : " . ($élément) . "\n"; 
               
            } elseif (is_file($élément)) {
                
                echo "[Fichier] : " . ($élément) . "\n";
            }
        }
    } else {
        echo "chemin invalide ou non un répertoire : $way\n";
    }
    
}

$wayDepart = 'assets/'; 
 EXPLORE($wayDepart);


if ($argc > 1) {
    if ($argv[1] === '-r') {
        $way = $argv[1];
        EXPLORE($way);
        echo "Argument -r utilisé! /W-PHP-501-PAR-1-1-cssgenerator-tiana.mury\n";
    } else {
    }
} else {
    echo "Aucun argument utilisé.\n";
    return false;
}


$imgs = ['assets/ekko0.png',
         'assets/ekko1.png', 
         'assets/ekko2.png', 
         'assets/ekko3.png',
         'assets/ekko4.png',
         'assets/ekko5.png'];

$largeursprite = 0;
$hauteursprite = 0;
$imgsArray = [];


foreach ($imgs as $extension)
    { 
  
    if (pathinfo($extension, PATHINFO_EXTENSION) !== 'png') { 
        echo "Ca va pas etre possible, faut etre un png \n";
        continue;
    }
    
   
    $img = imagecreatefrompng($extension);
    if ($img) { 
        $imgsArray[] = $img;
        $largeur = imagesx($img); 
        $hauteur = imagesy($img); 
        
       
        $largeursprite += $largeur; 
        $hauteursprite = max($hauteursprite, $hauteur); 
       
    } else {
        echo "Impossible de charger l'image $extension.\n"; //RIP.
    }
}


$sprite = imagecreatetruecolor($largeursprite, $hauteursprite);


$transparentColor = imagecolorallocatealpha($sprite, 0, 0, 0, 127); 
imagefill($sprite, 0, 0, $transparentColor); 
imagesavealpha($sprite, true); 

$xOffset = 0;

foreach ($imgsArray as $img) {
    imagecopy($sprite, $img, $xOffset, 0, 0, 0, imagesx($img), imagesy($img));
    
    
    
    $xOffset += imagesx($img);
}


$supremeSpritePath = 'sprite.png'; 
imagepng($sprite, $supremeSpritePath);


foreach ($imgsArray as $img) { 
    imagedestroy($img);
}
imagedestroy($sprite); 

//Phrase poétique pour finir

//echo "EH vos daronnes elles boivent du Sprite sa mère. $supremeSpritePath\n"


?>