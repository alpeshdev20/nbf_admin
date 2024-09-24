<?php

// Database connection
$host = 'localhost';
$db = 'ebook_live_3_sep_2024';
$user = 'root';
$pass = 'password';

// Create connection
$mysqli = new mysqli($host, $user, $pass, $db);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} else {
    echo "Connection successful.\n \t" . "</br>";
}

$query = "SELECT id, book_name FROM books WHERE slug_created_id IS NULL LIMIT 100";
// Fetch a maximum of 5 books
$result = $mysqli->query($query);

if (!$result) {
    // Query failed, print error message
    die("Error executing query: " . $mysqli->error);
}

// Check if any records were found
if ($result->num_rows === 0) {
    echo "No records available." . "<br>";
} else {
    while ($book = $result->fetch_assoc()) {
        var_dump($book);
        
        // Use 'book_name' instead of 'title'
        $slug = generateUniqueSlug($mysqli, $book['book_name']);

        // Update the slug and slug_created_id in the database
        $updateStmt = $mysqli->prepare("UPDATE books SET     = ?, slug_created_id = ? WHERE id = ?");
        $updateStmt->bind_param('sii', $slug, $book['id'], $book['id']);
        $updateStmt->execute();
        
        echo "Updated book ID {$book['id']} with slug: {$slug}\n" . "<br>";
    }
}


$result->free();
$mysqli->close();

function generateUniqueSlug($mysqli, $title) {
    // Convert title to slug format (replace spaces with dashes and remove unwanted characters)
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));

    // Base slug for checking duplicates
    $baseSlug = $slug;
    $count = 1;

    // Check for uniqueness
    while (true) {
        // Check if slug already exists
        $stmt = $mysqli->prepare("SELECT COUNT(*) FROM books WHERE slug = ?");
        $stmt->bind_param('s', $slug);
        $stmt->execute();
        $stmt->bind_result($slugCount);
        $stmt->fetch();
        $stmt->close();

        if ($slugCount == 0) {
            // Slug is unique
            return $slug;
        }

        // If slug exists, append a number to make it unique
        $slug = $baseSlug . '-' . $count;
        $count++;
    }
}

?>
