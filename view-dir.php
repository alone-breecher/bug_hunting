<?php
function listDirectory($dir) {
    $files = scandir($dir);
    echo "<ul>";
    foreach ($files as $file) {
        if ($file == '.' || $file == '..') continue;
        $fullPath = $dir . DIRECTORY_SEPARATOR . $file;
        if (is_dir($fullPath)) {
            echo "<li><strong>[DIR]</strong> <a href='?dir=" . urlencode($fullPath) . "'>$file</a></li>";
        } else {
            echo "<li>$file - <a href='?view=" . urlencode($fullPath) . "'>View</a> | <a href='?download=" . urlencode($fullPath) . "'>Download</a></li>";
        }
    }
    echo "</ul>";
}

function viewFile($file) {
    echo "<h2>Viewing: " . htmlspecialchars(basename($file)) . "</h2>";
    echo "<pre>" . htmlspecialchars(file_get_contents($file)) . "</pre>";
}

function downloadFile($file) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}

$currentDir = isset($_GET['dir']) ? $_GET['dir'] : getcwd();

if (isset($_GET['view'])) {
    viewFile($_GET['view']);
} elseif (isset($_GET['download'])) {
    downloadFile($_GET['download']);
} else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Directory Browser</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; color: #333; }
        .container { width: 80%; margin: 0 auto; }
        h1 { text-align: center; }
        ul { list-style-type: none; padding: 0; }
        li { padding: 8px; background-color: #fff; margin-bottom: 4px; border-radius: 4px; }
        a { text-decoration: none; color: #007bff; }
        a:hover { text-decoration: underline; }
        pre { background-color: #eaeaea; padding: 10px; border-radius: 4px; overflow-x: auto; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Directory Browser</h1>
        <p>Current Directory: <?php echo htmlspecialchars($currentDir); ?></p>
        <p>
            <?php if ($currentDir != getcwd()): ?>
                <a href="?dir=<?php echo urlencode(dirname($currentDir)); ?>">Go Up</a>
            <?php endif; ?>
        </p>
        <?php listDirectory($currentDir); ?>
    </div>
</body>
</html>

<?php
}
?>
