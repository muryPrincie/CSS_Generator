<?php

function exploreRecursive($dir) {
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        $path = $dir . DIRECTORY_SEPARATOR . $item;
        if (is_dir($path)) {
            echo "[Dossier] : $path\n";
            exploreRecursive($path);
        } elseif (is_file($path)) {
            echo "[Fichier] : $path\n";
        }
    }
}

function createSpriteFromImages($images, $outputImage = "sprite.png") {
    $imgsArray = [];
    $totalWidth = 0;
    $maxHeight = 0;

    foreach ($images as $imgPath) {
        if (pathinfo($imgPath, PATHINFO_EXTENSION) !== 'png') {
            echo "Mauvais format : $imgPath\n";
            continue;
        }

        $img = @imagecreatefrompng($imgPath);
        if (!$img) {
            echo "Impossible de charger : $imgPath\n";
            continue;
        }

        $width = imagesx($img);
        $height = imagesy($img);
        $totalWidth += $width;
        $maxHeight = max($maxHeight, $height);
        $imgsArray[] = ['img' => $img, 'width' => $width, 'height' => $height];
    }

    if (empty($imgsArray)) {
        echo "Aucune image valide pour créer un sprite.\n";
        return;
    }

    $sprite = imagecreatetruecolor($totalWidth, $maxHeight);
    imagealphablending($sprite, false);
    imagesavealpha($sprite, true);
    $transparent = imagecolorallocatealpha($sprite, 0, 0, 0, 127);
    imagefill($sprite, 0, 0, $transparent);

    $x = 0;
    foreach ($imgsArray as $entry) {
        imagecopy($sprite, $entry['img'], $x, 0, 0, 0, $entry['width'], $entry['height']);
        $x += $entry['width'];
        imagedestroy($entry['img']);
    }

    imagepng($sprite, $outputImage);
    imagedestroy($sprite);
    echo "Sprite généré : $outputImage\n";
}

$recursive = in_array("-r", $argv);
$imgNameIndex = array_search("-i", $argv);

if ($imgNameIndex !== false) {
    $outputImage = isset($argv[$imgNameIndex + 1]) && $argv[$imgNameIndex + 1][0] !== '-'
        ? $argv[$imgNameIndex + 1]
        : 'sprite.png';
} else {
    $outputImage = 'image.png';
}

if ($recursive && $argc === 2) {
    echo "Liste récursive des fichiers dans assets/ :\n";
    exploreRecursive("assets");
    exit;
}

if (!$recursive) {
    $imgs = [
        'assets/ekko0.png',
        'assets/ekko1.png',
        'assets/ekko2.png',
        'assets/ekko3.png',
        'assets/ekko4.png',
        'assets/ekko5.png'
    ];
    createSpriteFromImages($imgs, $outputImage);
    exit;
}
