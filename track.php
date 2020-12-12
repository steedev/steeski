<?php include 'db.php'; ?>

<?php

$id = $_GET['id'];
$alert = "";

$query = "SELECT * FROM trasy WHERE id_stacji = '{$id}'";
$result_fetch = mysqli_query($conn, $query);
if(!$result_fetch) die("QUERY FAILED" . mysqli_error($conn));

if(isset($_POST['submit'])) {
    $rating = $_POST['rating'];

    if($rating) {
        $query = "SELECT * FROM oceny WHERE id_stacji = '{$id}'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $rowId = $row['id'];
        $rowRating = $row['oceny'];

        if($rowId) {
            $newRating = "$rowRating $rating";
            $query = "UPDATE oceny SET oceny='$newRating' WHERE id='$rowId'";
            $result = mysqli_query($conn, $query);
            if(!$result) die("QUERY FAILED" . mysqli_error($conn));
            else header("Location: scores.php");
        } else {
            $query = "INSERT INTO oceny(id_stacji, oceny) VALUES ('$id','$rating')";
            $result = mysqli_query($conn, $query);
            if(!$result) die("QUERY FAILED" . mysqli_error($conn));
            else header("Location: scores.php");
        }
    } else {
        $alert = "Proszę podać ocenę";
    }
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
            <th>Długość</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result_fetch)) { ?>
            <tr>
                <td><?php echo $row['nazwa']; ?></td>
                <td><?php echo $row['dlugosc']; ?></td>
            </tr>
        <?php } ?>
    </table>

    <div class="form">
        <h2>Ocena stacji</h2>
        <?php if(strlen($alert) > 0) { ?>
            <div class="alerts"><?php echo $alert; ?></div>
        <?php } ?>
        <form action="track.php?id=<?php echo $id; ?>" method="POST">
            <?php for ($i=1; $i < 7; $i++) { ?>
                <div>
                    <label for="rating"><?php echo $i; ?></label>
                    <input type="radio" name="rating" value="<?php echo $i; ?>">
                </div>
            <?php } ?>
                <input type="submit" name="submit" value="Prześlij">
        </form>
    </div>

    <div class="back">
        <a href="index.php" class="backLink">Powrót do strony głównej</a>
    </div>
</body>
</html>