<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/simple.css">
    <link rel="stylesheet" type="text/css" href="./styles/custom.css">
    <title>
    <?php if (!isset($currentName) || empty($currentName)): ?>
        Homepage
    <?php else: ?>
        <?php echo htmlspecialchars($currentName); ?>
    <?php endif; ?>    
</title>

        
</head>
<body>
    <header>
        <h1>Birth Statistiks</h1>
        <p>The website gives you an overview of Birth statistics of USA, relevant to name and the year</p>
    </header>