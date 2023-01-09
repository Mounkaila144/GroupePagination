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
            <table class="table">
                <thead>
                <th>ID</th>
                <th>nom</th>
                </thead>
                <tbody>
                <?php
                foreach($Pagination->getLeads() as $lead){
                    ?>
                    <tr>
                        <td><?= $lead['id'] ?></td>
                        <td><?= $lead['nom'] ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <nav>
                <ul class="pagination">
                    <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                    <li  class="page-item <?= ($Pagination->getPage()== 1) ? "disabled" : "" ?>">
                        <a href="?page=<?= $Pagination->getPreview() ?>&pagemin=<?= $Pagination->getMin() ?>&pagemax=<?= $Pagination->getMax() ?>&groupe=<?= $groupe ?>" class="page-link">Précédente</a>
                    </li>
                    <?php for($page = 1; $page <= $Pagination->getTotalPageByGroupe(); $page++): ?>
                    <?php if (fmod($page+($Pagination->getMin()-1),10)==0){ ?>
                        <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                        <li class="page-item <?= ($Pagination->getPage()== $page) ? "active" : "" ?>">
                            <a href="?page=<?= $page ?>&pagemin=<?= $Pagination->getMin() ?>&pagemax=<?= $Pagination->getMax() ?>&groupe=<?= $groupe ?>" class="page-link"><?= $page+($Pagination->getMin()-1) ?></a>
                        </li>
                        <?php } ?>
                    <?php endfor ?>
                    <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                    <li class="page-item <?= ($Pagination->getPage()== $Pagination->getTotalPage()) ? "disabled" : "" ?>">
                        <a href="?page=<?= $Pagination->getNext() ?>&pagemin=<?= $Pagination->getMin() ?>&pagemax=<?= $Pagination->getMax() ?>&groupe=<?= $groupe ?>" class="page-link">Suivante</a>
                    </li>
                </ul>
            </nav>
            <div class="row">
            <form action="index.php" method="post">
                <p>groupe : <input type="number" style="width: 90px" name="groupe" /></p>
                <p><input type="submit" value="OK"></p>
            </form>
            <nav>
                <ul class="pagination">
                    <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                    <li class="page-item">
                        <a href="?pagemin=<?= $Groupe->getPreviewroupe()[0] ?>&pagemax=<?= $Groupe->getPreviewroupe()[1] ?>&groupe=<?= $groupe ?>" class="page-link">Précédente</a>
                    </li>
                    <?php foreach($Groupe->getAllGroupes() as $pages){ ?>
                        <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                        <li class="page-item <?= ($pages[0]== $Groupe->getCurentGroupe()[0] and $pages[1]==$Groupe->getCurentGroupe()[1]) ? "active" : "" ?>">
                        <a href="?pagemin=<?= $pages[0] ?>&pagemax=<?=$pages[1] ?>&groupe=<?= $groupe ?>"  class="page-link ">
                            <span style="font-size: 13px"><?= $pages[0] ?> a <?= $pages[1] ?></span>
                        </a>
                        </li>
                    <?php } ?>
                    <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                    <li class="page-item">
                        <a href="?pagemin=<?= $Groupe->getNextGroupe()[0] ?>&pagemax=<?= $Groupe->getNextGroupe()[1] ?>&groupe=<?= $groupe ?>" class="page-link">Suivante</a>
                    </li>
                </ul>
            </nav>
            </div>
        </section>
    </div>
</main>
</body>
</html>