<?php
// Handle file download
if (isset($_GET['download'])) {
    $file = realpath($_GET['download']);
    if ($file && file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    } else {
        echo "Invalid file!";
        exit;
    }
}

// Get current directory
$currentDir = isset($_GET['dir']) ? realpath($_GET['dir']) : __DIR__;

// Validate directory path to prevent unauthorized access
if (!$currentDir || !is_dir($currentDir)) {
    $currentDir = __DIR__;
}

// List directories and files
function listContents($dir)
{
    $items = scandir($dir);
    $dirs = [];
    $files = [];
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

$contents = listContents($currentDir);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP File Navigator</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        a { color: #007BFF; text-decoration: none; }
        a:hover { text-decoration: underline; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f4f4f4; }
        .back-button { margin: 10px 0; display: inline-block; padding: 8px 15px; background-color: #007BFF; color: #fff; border-radius: 5px; text-decoration: none; }
        .back-button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <h1>PHP File Navigator</h1>
    <p><strong>Current Directory:</strong> <?php echo htmlspecialchars($currentDir); ?></p>

    <!-- Go back to parent directory -->
    <?php if (realpath($currentDir) !== realpath(__DIR__)): ?>
        <a href="?dir=<?php echo urlencode(dirname($currentDir)); ?>" class="back-button">⬅️ Go Back</a>
    <?php endif; ?>

    <!-- Table for directory contents -->
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- List directories -->
            <?php foreach ($contents['dirs'] as $dir): ?>
                <tr>
                    <td>
                        <a href="?dir=<?php echo urlencode($currentDir . DIRECTORY_SEPARATOR . $dir); ?>">
                            📁 <?php echo htmlspecialchars($dir); ?>
                        </a>
                    </td>
                    <td>Directory</td>
                    <td>-</td>
                </tr>
            <?php endforeach; ?>

            <!-- List files -->
            <?php foreach ($contents['files'] as $file): ?>
                <tr>
                    <td><?php echo htmlspecialchars($file); ?></td>
                    <td>File</td>
                    <td>
                        <a href="?download=<?php echo urlencode($currentDir . DIRECTORY_SEPARATOR . $file); ?>">⬇️ Download</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
