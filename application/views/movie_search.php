<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Movies</title>
</head>
<body>
    <h1>
        Search Movies
    </h1>
    <form action="<?php echo site_url('Movies/search'); ?>" action="post">
        <label for="genre">Search by Genre:</label>
        <input type="text" name="genre" id="genre">
        <button type="submit">Search</button>
    </form>
    <a href="<?php echo site_url('Movies/allmovies'); ?>">View All Movies</a>

</body>
</html>