<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<main class="container">
    <div class="row">
        <section class="col-12">
            <h1>Liste des lead</h1>
            <table class="table">
                <thead>
                <th>ID</th>
                <th>nom</th>
                </thead>
                <tbody>
                </tbody>
            </table>
            <nav>
                <ul class="pagination">
                    <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                    <li class="page-item">
                        <a href="index.php?min=<?= $Groupe->getPreviewroupe()[0] ?>&max=<?= $Groupe->getPreviewroupe()[1] ?>" class="page-link">Précédente</a>
                    </li>
                    <?php foreach($Groupe->getAllGroupes() as $page){ ?>
                        <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                        <li class="page-item">
                            <a href="index.php?min=<?= $page[0] ?>&max=<?=$page[1] ?>" class="page-link">
                                <?=$page[0]?>...<?=$page[1]?>
                            </a>
                        </li>
                    <?php } ?>
                    <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                    <li class="page-item">
                        <a href="index.php?min=<?= $Groupe->getNextGroupe()[0] ?>&max=<?= $Groupe->getNextGroupe()[1] ?>" class="page-link">Suivante</a>
                    </li>
                </ul>
            </nav>
        </section>
    </div>
</main>
</body>
</html>