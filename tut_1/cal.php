<!DOCTYPE html>
<html>
<head>
    <title>Students with Mark and Above</title>
</head>
<body>
    <h2>Students with Mark and Above</h2>
    <?php
    // Student data array
    $students = array(
        "Samwise Gamgee" => 88,
        "Frodo Baggins" => 56,
        "Elrond Half-Elven" => 92,
        "Gandalf Mithrandir" => 35,
        "Merry Brandybuck" => 41,
        "Pippin Took" => 25,
        "Legolas Greenleaf" => 67
    );

    // Retrieve the mark entered by the user from the form
    $search_mark = isset($_POST['mark']) ? $_POST['mark'] : null;

    if ($search_mark !== null) {
        // Display students with marks equal to or above the search mark
        echo "<h3>Students with $search_mark and Above</h3>";
        $found = false;
        foreach ($students as $student => $mark) {
            if ($mark >= $search_mark) {
                echo "<p>$student - Mark: $mark</p>";
                $found = true;
            }
        }
        if (!$found) {
            echo "<p>No students found with a mark of $search_mark or above.</p>";
        }
    } else {
        echo "<p>Please enter a mark in the search form.</p>";
    }
    ?>
</body>
</html>