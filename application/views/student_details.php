<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF - 8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            Student Deatils Page
        </title>
    </head>
    <body>
        <h1>
            Student Details
        </h1>

        <h2> <?php echo $title ?> was written by <?php echo $author ?> 
        </h2> 
        <p>
            <strong> 
                Name: 
            </strong> <?php echo $student['name']; ?>
        </p>
        <p>
            <strong>
                Age:
            </strong><?php echo $student['age'];?>
        </p>
        <p>
            <strong>
                Grade:
            </strong><?php echo $student['grade'];?>
        </p>
    </body>
</html>