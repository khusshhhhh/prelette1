<?php
// Function to recursively delete files and folders
function deleteFolder($folderPath)
{
    // Check if the folder exists
    if (!file_exists($folderPath)) {
        echo "Folder does not exist: " . $folderPath;
        return false;
    }

    // Open the directory
    $files = array_diff(scandir($folderPath), array('.', '..'));

    // Loop through the directory contents
    foreach ($files as $file) {
        $filePath = $folderPath . DIRECTORY_SEPARATOR . $file;

        // Check if it's a directory
        if (is_dir($filePath)) {
            // Recursively delete the subfolder
            deleteFolder($filePath);
        } else {
            // Delete the file
            if (!unlink($filePath)) {
                echo "Failed to delete file: " . $filePath . "<br>";
            }
        }
    }

    // Delete the folder itself
    if (!rmdir($folderPath)) {
        echo "Failed to delete folder: " . $folderPath . "<br>";
        return false;
    }

    echo "Deleted folder: " . $folderPath . "<br>";
    return true;
}

// Path to the .git folder in public_html
$gitFolderPath = __DIR__ . '/.git';

// Call the delete function
if (deleteFolder($gitFolderPath)) {
    echo "The .git folder and all its contents have been successfully deleted.";
} else {
    echo "Failed to delete the .git folder.";
}
?>