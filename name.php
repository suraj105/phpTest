<?php
include 'inc/names.php';
include 'inc/functions.php';

$currentName = $_GET['name'] ?? null;
$chartType = $_GET['chart_type'] ?? 'line'; // Default to line chart if not set

$namesFiltered = [];
if ($currentName) {
    foreach($names AS $nameArray) {
        if ($nameArray['name'] !== $currentName) {
            continue;
        }
        $namesFiltered[] = $nameArray;
    }
}

include 'views/header.php'; // Now include the header after defining $currentName so that the title could be changed accordingly to the name of the page or people
?>

<!-- Link to Custom CSS simple css was download , custom css was made according to the demand -->
<link rel="stylesheet" type="text/css" href="styles/simple.css">
<link rel="stylesheet" type="text/css" href="styles/custom.css">

<?php if(!empty($namesFiltered)): ?>
    <h2>Birth statistics for  <?php echo htmlspecialchars($currentName); ?></h2>

    <form method="get">
        <input type="hidden" name="name" value="<?php echo htmlspecialchars($currentName); ?>">
        <label for="chart_type">Select a chart type:</label>
        <select id="chart_type" name="chart_type" onchange="this.form.submit()">
            <option value="line" <?php echo $chartType === 'line' ? 'selected' : ''; ?>>Line Chart</option>
            <option value="bar" <?php echo $chartType === 'bar' ? 'selected' : ''; ?>>Bar Chart</option>
        </select>
    </form>

    <?php
        $chartYears = [];
        $chartCounts = [];
        foreach($namesFiltered AS $nameArray) {
            $chartYears[] = $nameArray['year'];
            $chartCounts[] = $nameArray['count'];
        }
    ?>

    <script type="text/javascript" src="scripts/chart.js"></script>
    <canvas id="myChart" width="400" height="200"></canvas>
    <script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: '<?php echo $chartType; ?>', // Use the selected chart type
        data: {
            labels: <?php echo json_encode($chartYears); ?>,
            datasets: [{
                label: '# of babies',
                data: <?php echo json_encode($chartCounts); ?>,
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: '<?php echo $chartType === 'bar' ? 'rgba(75, 192, 192, 0.2)' : 'transparent'; ?>',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>

    <table>
        <thead>
            <tr>
                <th>Year</th>
                <th>Count</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($namesFiltered AS $nameArray): ?>
                <tr>
                    <td><?php echo $nameArray['year']; ?></td>
                    <td><?php echo $nameArray['count']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<form action="index.php" method="get">
    <button type="submit">Return Homepage</button>
</form>

<?php
include 'views/footer.php';
?>
