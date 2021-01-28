<?php include 'functions/logout.php' ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">Tableau de bord administrateur</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <form action="<?= logout() ?>" method="post">
                <button type="submit" name="deconnexion" id="btn_deco_admin" class="btn rounded-0 mx-lg-4 mt-lg-0 mt-4 h-100">
                    Déconnexion
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <ul class="nav nav-tabs nav-fill mt-5 pt-5" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bold active" id="a-valider-tab" data-bs-toggle="tab" href="#a-valider" role="tab" aria-controls="a-valider" aria-selected="true">
                À valider <span class="badge ms-2">4</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link fw-bold" id="non-valide-tab" data-bs-toggle="tab" href="#non-valide" role="tab" aria-controls="non-valide" aria-selected="false">
                Non validé <span class="badge ms-2">4</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link fw-bold" id="valide-tab" data-bs-toggle="tab" href="#valide" role="tab" aria-controls="valide" aria-selected="false">
                Validé <span class="badge ms-2">4</span>
            </a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active mt-5" id="a-valider" role="tabpanel" aria-labelledby="a-valider-tab">
            <div class="table-responsive mb-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Coureur 1</th>
                            <th scope="col">Coureur 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Nom</th>
                            <td>Mark</td>
                            <td>Otto</td>
                        </tr>
                        <tr>
                            <th scope="row">Prénom</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                        </tr>
                        <tr>
                            <th scope="row">Sexe</th>
                            <td>Larry the Bird</td>
                            <td>Larry the Bird</td>
                        </tr>
                        <tr>
                            <th scope="row">Taille de t-shirt</th>
                            <td>Larry the Bird</td>
                            <td>Larry the Bird</td>
                        </tr>
                        <tr>
                            <th scope="row">Année de naissance</th>
                            <td>Larry the Bird</td>
                            <td>Larry the Bird</td>
                        </tr>
                        <tr>
                            <th scope="row">Téléphone</th>
                            <td>Larry the Bird</td>
                            <td>Larry the Bird</td>
                        </tr>
                        <tr>
                            <th scope="row">Type de licence</th>
                            <td>Larry the Bird</td>
                            <td>Larry the Bird</td>
                        </tr>
                        <tr>
                            <th scope="row">Numéro de licence</th>
                            <td>Larry the Bird</td>
                            <td>Larry the Bird</td>
                        </tr>
                        <tr>
                            <th scope="row">Nom du club</th>
                            <td>Larry the Bird</td>
                            <td>Larry the Bird</td>
                        </tr>
                    </tbody>
                </table>
                <form action="" method="post">
                    <button type="submit" class="btn rounded-0 me-4">Valider</button>
                    <button type="submit" class="btn rounded-0">Ne pas valider</button>
                </form>
            </div>
            <div class="table-responsive mb-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Coureur 1</th>
                            <th scope="col">Coureur 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Nom</th>
                            <td>Mark</td>
                            <td>Otto</td>
                        </tr>
                        <tr>
                            <th scope="row">Prénom</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                        </tr>
                        <tr>
                            <th scope="row">Sexe</th>
                            <td>Larry the Bird</td>
                            <td>Larry the Bird</td>
                        </tr>
                        <tr>
                            <th scope="row">Taille de t-shirt</th>
                            <td>Larry the Bird</td>
                            <td>Larry the Bird</td>
                        </tr>
                        <tr>
                            <th scope="row">Année de naissance</th>
                            <td>Larry the Bird</td>
                            <td>Larry the Bird</td>
                        </tr>
                        <tr>
                            <th scope="row">Téléphone</th>
                            <td>Larry the Bird</td>
                            <td>Larry the Bird</td>
                        </tr>
                        <tr>
                            <th scope="row">Type de licence</th>
                            <td>Larry the Bird</td>
                            <td>Larry the Bird</td>
                        </tr>
                        <tr>
                            <th scope="row">Numéro de licence</th>
                            <td>Larry the Bird</td>
                            <td>Larry the Bird</td>
                        </tr>
                        <tr>
                            <th scope="row">Nom du club</th>
                            <td>Larry the Bird</td>
                            <td>Larry the Bird</td>
                        </tr>
                    </tbody>
                </table>
                <form action="" method="post">
                    <button type="submit" class="btn rounded-0 me-4">Valider</button>
                    <button type="submit" class="btn rounded-0">Ne pas valider</button>
                </form>
            </div>
        </div>
        <div class="tab-pane fade mt-5" id="non-valide" role="tabpanel" aria-labelledby="non-valide-tab">
            <div class="tab-pane fade show active mt-5" id="a-valider" role="tabpanel" aria-labelledby="a-valider-tab">
                <div class="table-responsive mb-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Coureur 1</th>
                                <th scope="col">Coureur 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Nom</th>
                                <td>Mark</td>
                                <td>Otto</td>
                            </tr>
                            <tr>
                                <th scope="row">Prénom</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                            </tr>
                            <tr>
                                <th scope="row">Sexe</th>
                                <td>Larry the Bird</td>
                                <td>Larry the Bird</td>
                            </tr>
                            <tr>
                                <th scope="row">Taille de t-shirt</th>
                                <td>Larry the Bird</td>
                                <td>Larry the Bird</td>
                            </tr>
                            <tr>
                                <th scope="row">Année de naissance</th>
                                <td>Larry the Bird</td>
                                <td>Larry the Bird</td>
                            </tr>
                            <tr>
                                <th scope="row">Téléphone</th>
                                <td>Larry the Bird</td>
                                <td>Larry the Bird</td>
                            </tr>
                            <tr>
                                <th scope="row">Type de licence</th>
                                <td>Larry the Bird</td>
                                <td>Larry the Bird</td>
                            </tr>
                            <tr>
                                <th scope="row">Numéro de licence</th>
                                <td>Larry the Bird</td>
                                <td>Larry the Bird</td>
                            </tr>
                            <tr>
                                <th scope="row">Nom du club</th>
                                <td>Larry the Bird</td>
                                <td>Larry the Bird</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade mt-5" id="valide" role="tabpanel" aria-labelledby="valide-tab">
            <div class="tab-pane fade show active mt-5" id="a-valider" role="tabpanel" aria-labelledby="a-valider-tab">
                <div class="table-responsive mb-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Coureur 1</th>
                                <th scope="col">Coureur 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Nom</th>
                                <td>Mark</td>
                                <td>Otto</td>
                            </tr>
                            <tr>
                                <th scope="row">Prénom</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                            </tr>
                            <tr>
                                <th scope="row">Sexe</th>
                                <td>Larry the Bird</td>
                                <td>Larry the Bird</td>
                            </tr>
                            <tr>
                                <th scope="row">Taille de t-shirt</th>
                                <td>Larry the Bird</td>
                                <td>Larry the Bird</td>
                            </tr>
                            <tr>
                                <th scope="row">Année de naissance</th>
                                <td>Larry the Bird</td>
                                <td>Larry the Bird</td>
                            </tr>
                            <tr>
                                <th scope="row">Téléphone</th>
                                <td>Larry the Bird</td>
                                <td>Larry the Bird</td>
                            </tr>
                            <tr>
                                <th scope="row">Type de licence</th>
                                <td>Larry the Bird</td>
                                <td>Larry the Bird</td>
                            </tr>
                            <tr>
                                <th scope="row">Numéro de licence</th>
                                <td>Larry the Bird</td>
                                <td>Larry the Bird</td>
                            </tr>
                            <tr>
                                <th scope="row">Nom du club</th>
                                <td>Larry the Bird</td>
                                <td>Larry the Bird</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>