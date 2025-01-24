<?php
// Set the default directory
$baseDir = realpath(__DIR__);
$currentDir = isset($_GET['dir']) ? realpath($_GET['dir']) : $baseDir;

// Ensure the current directory stays within the base directory
if (strpos($currentDir, $baseDir) !== 0) {
    $currentDir = $baseDir;
}

// Handle file download
if (isset($_GET['download'])) {
    $file = realpath($_GET['download']);
    if (file_exists($file) && strpos($file, $baseDir) === 0) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    } else {
        echo "Invalid file!";
        exit;
    }
}

// List directories and files
function listItems($dir)
{
    $items = scandir($dir);
    $files = [];
    $dirs = [];

    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }
        $path = $dir . DIRECTORY_SEPARATOR . $item;
        if (is_dir($path)) {
            $dirs[] = $item;
        } elseif (is_file($path)) {
            $files[] = $item;
        }
    }

    return ['dirs' => $dirs, 'files' => $files];
}

$items = listItems($currentDir);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Directory Browser</title>
    <style>
        body { font-family: Arial, sans-serif; }
        a { text-decoration: none; color: blue; }
        a:hover { text-decoration: underline; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h1>Directory Browser</h1>
    <p>Current Directory: <?php echo htmlspecialchars($currentDir); ?></p>
    <?php if ($currentDir !== $baseDir): ?>
        <p><a href="?dir=<?php echo urlencode(dirname($currentDir)); ?>">Go Up</a></p>
    <?php endif; ?>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items['dirs'] as $dir): ?>
                <tr>
                    <td><a href="?dir=<?php echo urlencode($currentDir . DIRECTORY_SEPARATOR . $dir); ?>"><?php echo htmlspecialchars($dir); ?></a></td>
                    <td>Directory</td>
                    <td>-</td>
                </tr>
            <?php endforeach; ?>
            <?php foreach ($items['files'] as $file): ?>
                <tr>
                    <td><?php echo htmlspecialchars($file); ?></td>
                    <td>File</td>
                    <td><a href="?download=<?php echo urlencode($currentDir . DIRECTORY_SEPARATOR . $file); ?>">Download</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
