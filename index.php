<?php
include 'views/header.php';
include 'inc/names.php';
include 'inc/functions.php';

$firstLetters = [];
foreach($names AS $nameArray) {
    $nameFirstLetter = $nameArray['name'][0];

    if(empty($firstLetters[$nameFirstLetter])) {
        $firstLetters[$nameFirstLetter] = true;
    }
    
}
?>
       <?php if(empty($_GET['char']) || !is_string($_GET['char'])): ?>
            <h3>Please Select an Alphabet to begin with</h3>
        <?php else: ?>  
            <h3>You have selected the Aplhabet <?php echo $_GET['char'] ?></h3>
        <?php endif; ?>

<nav class="nav">
    <?php foreach($firstLetters AS $firstLetter => $_): ?>
        <a 
            href="index.php?char=<?php echo $firstLetter; ?>"
            <?php if(!empty($_GET['char']) && $_GET['char'] === $firstLetter):?>
                class="selected"
            <?php endif; ?>
        ><?php echo $firstLetter; ?></a>
    <?php endforeach; ?>
</nav>
<?php if(!empty($_GET['char']) && is_string($_GET['char'])): ?>
    <hr />
    <?php
        $char = $_GET['char'][0];
        $filteredNames = [];

        foreach($names AS $nameArray) {
            $currentName = $nameArray['name'];
            if ($currentName[0] !== $char) {
                continue;
            }

            if(empty($filteredNames[$currentName])) {
                $filteredNames[$currentName] = true;
            }
    
        }
    ?>

    <h3>Names, that with  <?php echo e($char); ?> begins:</h3>
    <ul>
        <?php foreach($filteredNames AS $currentName => $_): ?>
            <li>
                <a href="name.php?<?php echo http_build_query(['name' => $currentName]); ?>">
                    <?php echo e($currentName); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php include 'views/footer.php'; ?> 