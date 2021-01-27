<!-- A supprimer ? -->

<div class="container-fluid main-page d-flex justify-content-center align-items-center">
    <div class="card text-center shadow-lg border-0" style="width: 25rem;">
        <div class="card-header fw-bold">
            Je suis inscrit à :
        </div>
        <div class="card-body py-5">
            <div class="row">
                <div class="col-sm">
                    <!-- <a href="index.php?page=connexion" class="btn me-sm-2 mb-sm-0 mb-4 rounded-0">
                        La Longue
                    </a> -->
                    <form action="index.php?page=connexion" method="post">
                        <input type="hidden" name="longue_input" value="la_longue_copie">
                        <button type="submit" name="longue" class="btn me-sm-2 mb-sm-0 mb-4 rounded-0">
                            La Longue
                        </button>
                    </form>
                </div>
                <div class="col-sm">
                    <!-- <a href="#" class="btn ms-sm-2 mt-sm-0 mt-4 rounded-0">
                        La Courte
                    </a> -->
                    <form action="index.php?page=connexion" method="post">
                        <input type="hidden" name="longue_input" value="la_courte_copie">
                        <button type="submit" name="courte" class="btn ms-sm-2 mt-sm-0 mt-4 rounded-0">
                            La Courte
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            Lorem ipsum dolor sit amet.
        </div>
    </div>
</div>