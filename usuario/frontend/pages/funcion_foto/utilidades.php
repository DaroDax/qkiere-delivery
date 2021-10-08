<?php
/*
 *  Funciones varias que se implementaran en el sistema. 
 */

/*
 * Funcion resizeToVariable para redimensionar las imagenesque se subiran al servidor
 */

function resizeToVariable($sourceImage,$newHeight,$newWidth,$destImage)
{
	list($width,$height) = getimagesize($sourceImage);
	if ($width > $height) {$mayor = true;}else {$mayor = false;}

	if ($mayor)
	{
		$porc = $newWidth/ $width;
		$newHeight = $height * $porc;
	}else{
		$porc = $newHeight/ $height;
		$newWidth = $width * $porc;
	}

	$img = imagecreatefromjpeg($sourceImage);
	
	// create a new temporary image
	$tmp_img = imagecreatetruecolor($newWidth,$newHeight);
	// copy and resize old image into new image
	imagecopyresized( $tmp_img, $img, 0, 0, 0, 0,$newWidth,$newHeight, $width, $height );
	
	// use output buffering to capture outputted image stream
	ob_start();
	imagejpeg($tmp_img);
	$i = ob_get_clean();
	
	// Guardar la imagen
	$fp = fopen ($destImage,'w');
	fwrite ($fp, $i);
	fclose ($fp);
}

function crop($filename, $width, $height, $destImage)
{
    // image resource, assuming it's JPG
		$resource = imagecreatefromjpeg($filename);
    // resource dimensions
    $size = array(
        0 => imagesx($resource),
        1 => imagesy($resource),
    );
    // sides
    $longer  = (int)($size[0]/$width > $size[1]/$height);
    $shorter = (int)(!$longer);
    // ugly hack to avoid condition for imagecopyresampled()
    $src = array(
        $longer  => 0,
        $shorter => ($size[$shorter]-$size[$longer])/2,
    );
    // new image resource
    $new = imagecreatetruecolor($width, $height);
    // do the magic
    imagecopyresampled($new, $resource,
        0,  0,
        $src[0], $src[1],
        $width, $height,
        $size[$longer], $size[$longer]
    );

    // save it or something else :)
    ob_start();
	imagejpeg($new);
	$i = ob_get_clean();
	
	// Guardar la imagen
	$fp = fopen ($destImage,'w');
	fwrite ($fp, $i);
	fclose ($fp);
}

?>