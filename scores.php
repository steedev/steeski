<?php include 'db.php'; ?>

<?php

$query = "SELECT * FROM oceny";
$result = mysqli_query($conn, $query);
if(!$result) die("QUERY FAILED" . mysqli_error($conn));

$arr = [];

while($row = mysqli_fetch_assoc($result)) {
    $subArr = [];
    $id = $row['id_stacji'];
    $rating = $row['oceny'];
    $q = explode(" ", $rating);
    $sum = array_sum($q) / count($q);
    array_push($arr,[$id, $sum]);
}

usort($arr, function($a, $b) {
    return $b[1] <=> $a[1];
});

$mainArr = [];

for ($i=0; $i < count($arr); $i++) { 
    $query = "SELECT * FROM stacje WHERE id_stacji = '{$arr[$i][0]}'";
    $result = mysqli_query($conn, $query);
    if(!$result) die("QUERY FAILED" . mysqli_error($conn));
    $row = mysqli_fetch_assoc($result);
    array_push($mainArr, [$row['nazwa'], $arr[$i][1]]);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SteeSki</title>
    <style><?php include 'index.css'; ?></style>
</head>
<body>
    <table>
        <tr>
            <th>Nazwa</th>
            <th>Średnia ocen</th>
        </tr>
            <?php for ($i=0; $i < 3 ; $i++) { ?> 
                    <tr>
                        <td><?php echo $mainArr[$i][0]; ?></td>
                        <td><?php echo $mainArr[$i][1]; ?></td>
                    </tr>
            <?php } ?>
    </table>
    <div class="back">
        <a href="index.php" class="backLink">Powrót do strony głównej</a>
    </div>
</body>
</html>