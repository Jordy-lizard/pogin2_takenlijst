<?php
session_start();
require_once __DIR__ . '/../../../config/config.php';
if (!isset($_SESSION['user_id'])) {
    $msg = "Je moet eerst inloggen!";
    header("location: $base_url/resources/views/login/login.php?msg=$msg");
    exit;
}
?>
<!doctype html>
<html lang="nl">

<head>
    <title>Taken / Takenlijst</title>
    <?php require_once __DIR__ . '/../components/head.php'; ?>
</head>

<body>

    <?php require_once __DIR__ . '/../components/header.php'; ?>

    <div class="container">
        <h1>Takenlijst</h1>
        <div class="a-tags">
            <a href="<?php echo $base_url; ?>/resources/views/taken/create.php">Nieuwe taak </a>
            <a href="<?php echo $base_url; ?>/resources/views/taken/index.php">Alle taken </a>
            <a href="<?php echo $base_url; ?>/resources/views/components/todo.php">TO DO</a>
            <a href="<?php echo $base_url; ?>/resources/views/components/doing.php">Doing</a>
            <a href="<?php echo $base_url; ?>/resources/views/components/done.php">Done</a>
        </div>

        <?php if (isset($_GET['msg'])) {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>

        <div class="form-table">
            <?php
            require_once '../../../config/conn.php';                               //1. Vebinding
            $query = "SELECT * FROM taken";                                             //2. Query schrijven
            $statement = $conn->prepare($query);                                            //3. Van query naar statement
            $statement->execute();                                                          //4. Statement uitvoern
            $taken = $statement->fetchAll(PDO::FETCH_ASSOC);                            //5. Resultaat ophalen
            ?>
            <table>
                <tr>
                    <th>Titel</th>
                    <th>Afdeling</th>
                    <th>Categorie</th>
                    <th>Status</th>
                    <th>Deadline</th>
                    <th>Created_by</th>
                    <th>Beschrijving</th>
                    <th>Aanpassen/Verwijderen</th>
                </tr>
                <?php foreach ($taken as $taak): ?>
                    <?php if ($taak['created_by'] == $_SESSION['user_name']): ?>
                        <tr>
                            <td><?php echo $taak['titel']; ?></td>
                            <td><?php echo $taak['afdeling']; ?></td>
                            <td><?php echo $taak['categorie']; ?></td>
                            <td> <?php require '../components/status.php' ?></td>
                            <td><?php echo $taak['deadline']; ?></td>
                            <td><?php echo $taak['created_by']; ?></td>
                            <td><?php echo $taak['beschrijving']; ?></td>
                            <td><a href="edit.php?id=<?php echo $taak['id'] ?>" class="a-tag">aanpassen</a></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

</body>

</html>