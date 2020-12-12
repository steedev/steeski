<?php include 'db.php'; ?>

<?php

$query = "SELECT * FROM stacje";
$result = mysqli_query($conn, $query);
if(!$result) die("QUERY FAILED" . mysqli_error($conn));

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
            <th>Id</th>
            <th>Nazwa</th>
            <th>Orczyki</th>
            <th>Krzesełka</th>
            <th>Gondole / Kolejki</th>
            <th>Naśnieżanie</th>
            <th>Oświetlenie</th>
            <th>Trasy</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['id_stacji']; ?></td>
                <td><?php echo $row['nazwa']; ?></td>
                <td><?php echo $row['orczyki']; ?></td>
                <td><?php echo $row['krzeselka']; ?></td>
                <td><?php echo $row['gondole/kolejki']; ?></td>
                <td class='ok'><?php if($row['nasniezanie'] === "tak") { ?>
                    <div class="blockYes"></div>
                <?php } else { ?>
                    <div class="blockNo"></div>
                <?php } ?></td>
                <td><?php if($row['oswietlenie'] === "tak") { ?>
                    <div class="blockYes"></div>
                <?php } else { ?>
                    <div class="blockNo"></div>
                <?php } ?></td>
                <td><a href="track.php?id=<?php echo $row['id_stacji']; ?>" class="enterLink">więcej</a></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>