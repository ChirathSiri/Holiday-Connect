<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Age Calculator</title>
</head>
<body>
    <h1>Enter Your Date of Birth</h1>

    <?php echo form_open('agecal/cal_age'); ?>
    <input type="date" name"dob" required>
    <button type="submit">Calculate Age</button>
    <?php echo form_close();?>
</body>
</html>