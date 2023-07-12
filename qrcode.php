<?php

require_once 'phpqrcode-master/qrlib.php';
function generate_qr_code($data, $qrconfig = [], $filename = '') {
    // Set up the QR code configuration
    $defaultConfig = [
        'version' => 5,
        'errorCorrectionLevel' => QR_ECLEVEL_Q,
    ];
    $qrconfig = array_merge($defaultConfig, $qrconfig);

    // Check if the QR code image is cached
    if (!$filename) {
        $filename = md5($data . serialize($qrconfig)) . '.png';
    }
    $filepath = __DIR__ . '/qrcodes/' . $filename;
    if (!file_exists($filepath)) {
        // Generate the QR code image
        QRcode::png($data, $filepath, $qrconfig['errorCorrectionLevel'], 10, 2);
    }

    // Output the QR code image on the webpage, along with a download link
    $image_html = sprintf('<img src="data:image/png;base64,%s" />', base64_encode(file_get_contents($filepath)));
    $download_html = sprintf('<a href="%s" download="%s">%s</a>',
        $filepath,
        $filename,
        'Download QR Code'
    );
    return $image_html . '<br />' . $download_html;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
</head>
<body>
    <?php
        if(isset($_POST['qrcode']) && $_POST['qrcode'] !=''){
            $data = $_POST['qrcode'];
            echo generate_qr_code($data);
        } else {
            $data = 'https://algocodersmind.com/';
            echo generate_qr_code($data);
        }
        ?>

<p>Qr generated for <?php echo $data;  ?> </p>
    <form action="" method="post">
        <input type="text" name="qrcode" id="">
        <input type="submit" value="Submit">
    </form>
</body>
</html>
