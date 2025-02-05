<?php
include "../Backend/auth.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IntervenantP1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        // Injection de la variable PHP en JavaScript
        const privileges = <?php echo $privilegesJson; ?>;

        document.addEventListener('DOMContentLoaded', function () {
            const tabsContainer = document.getElementById('tabs-container');
            const newTabs = document.createElement('ul');
            newTabs.classList.add('nav', 'nav-tabs');

            privileges.forEach((privilege) => {
                const tab = document.createElement('li');
                tab.classList.add('nav-item');

                const tabLink = document.createElement('a');
                tabLink.classList.add('nav-link');

                const pageName = privilege.toLowerCase();
                tabLink.href = pageName + '.html';

                tabLink.innerText = privilege;

                tab.appendChild(tabLink);
                newTabs.appendChild(tab);
            });
            tabsContainer.insertBefore(newTabs, tabsContainer.firstChild);
        });
    </script>

    <script>
        $(document).ready(function () {
            $.ajax({
                url: 'https://contractualisation.ecollage.eu/rawintervenant',
                method: 'GET',
                dataType: 'json', 
                success: function (data) {
                    var value = data[0];

                    //Informations générales
                    $('#recruteur').prop('checked', value.Recruteur);
                    $('#administratif').prop('checked', value.Administratif);
                    $('#archive').prop('checked', value.Archivé);
                    //$('#salarie').prop('checked', value.Formateur);
                    
                    $('#nom').val(value.Nom);
                    $('#prenom').val(value.Prénom);
                    $('#adresse').val(value.Adresse);
                    $('#codepostal').val((value.CP) + ' ' + (value.Ville));
                    $('#emailprive').val(value.EMail);
                    // $('#telperso').val(value.Téléphone);
                    // $('#telportable').val(value.Tel_Prof);         
                    $('#nivDiplome').val(value.Niveau_Diplôme);
                    
                    //Société
                    $('#adresseSociete').val(value.Société_Adr);
                    $('#siret').val(value.SiretEntrepreneur);
                    $('#emailSociete').val(value.eMail_pro);
                    $('#fonction').val(value.Fonction);
                    $('#media').val(value.Media);
                    $('#iban').val(value.RIB_IBAN);
                    $('#bic').val(value.RIB_BIC);

                    $('#autoEntrepreneur').prop('checked', value.autoentrepreneur);
                    $('#regimeTva').prop('checked', value.AutoEnt_OK_TVA);

                },
                error: function (error) {
                    alert('Erreur de récupération des données');
                }
            });
        });
    </script>

</head>


<body>
    <div class="container mt-4">
        <!-- header -->
        <div id="tabs-container">
            <ul class="nav nav-tabs" id="tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="page1.html">Infos générales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="page2.html">Plus...</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="page3.html">Cours</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="page4.html">Documents financiers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="page5.html">Documents pédagogiques</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="page6.html">E-mails envoyés</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="page7.html">Courriers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="page8.html">Pièces</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="page9.html">Edusign</a>
                </li>
            </ul>

        <form action="serveur.php" method="POST">
            <div class="row">
                <!-- section info générales -->
                <div class="col-md-6">
                    <h5>Informations générales</h5>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="situation" id="salarie" value="salarie" checked>
                        <label class="form-check-label" for="salarie">Salarié</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="situation" id="recruteur" value="recruteur">
                        <label class="form-check-label" for="recruteur">Recruteur</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="situation" id="administratif" value="administratif">
                        <label class="form-check-label" for="administratif">Administratif</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="situation" id="archive" value="archive">
                        <label class="form-check-label" for="archive">Archivé</label>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" placeholder="ex: 120 boulevard George Gus">
                    </div>
                    <div class="mb-3">
                        <label for="codepostal" class="form-label">Code Postal et Ville</label>
                        <input type="text" class="form-control" id="codepostal" name="codepostal" placeholder="ex: 75001 Paris">
                    </div>
                    <div class="mb-3">
                        <label for="emailprive" class="form-label">Email Privé</label>
                        <input type="email" class="form-control" id="emailprive" name="emailprive" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="telperso" class="form-label">Téléphone Perso</label>
                        <input type="text" class="form-control" id="telperso" name="telperso" placeholder="">
                    </div>
                    <div>
                        <label for="telportable" class="form-label">Téléphone Portable</label>
                        <input type="text" class="form-control" id="telportable" name="telportable" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="dateNaissance" class="form-label">Date de Naissance</label>
                        <input type="date" class="form-control" id="dateNaissance" name="dateNaissance">
                    </div>
                    <div class="mb-3">
                        <label for="profil" class="form-label">Profil</label>
                        <input type="text" class="form-control" id="profil" name="profil" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="emailEcole" class="form-label">E-mail de l'école</label>
                        <input type="text" class="form-control" id="emailEcole" name="emailEcole" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="nivDiplome" class="form-label">Niveau du diplôme</label>
                        <input type="text" class="form-control" id="nivDiplome" name="nivDiplome" placeholder="ex: Bac +2">
                    </div>
                </div>

                 <!-- section société -->
                 <div class="col-md-6">
                    <h5>Société</h5>
                    <div class="mb-3">
                        <label for="raisonSociale" class="form-label">Raison Sociale</label>
                        <input type="text" class="form-control" id="raisonSociale" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="adresseSociete" class="form-label">Adresse complète</label>
                        <input type="text" class="form-control" id="adresseSociete"
                            placeholder="ex: 12 rue Liberté 75008 Paris">
                    </div>
                    <div class="mb-3">
                        <label for="siret" class="form-label">SIRET</label>
                        <input type="text" class="form-control" id="siret" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="emailSociete" class="form-label">Email Société</label>
                        <input type="email" class="form-control" id="emailSociete" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="telSociete" class="form-label">Tel. Société</label>
                        <input type="text" class="form-control" id="telSociete" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="fonction" class="form-label">Fonction</label>
                        <input type="text" class="form-control" id="fonction" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="media" class="form-label">Média</label>
                        <input type="text" class="form-control" id="media" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="numActivite" class="form-label">N° Activité</label>
                        <input type="text" class="form-control" id="numActivite" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="iban" class="form-label">BIC / IBAN</label>
                        <div class="row g-2">
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="bic" placeholder="BIC">
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="iban" placeholder="IBAN">
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="autoEntrepreneur">
                        <label class="form-check-label" for="autoEntrepreneur">Auto-entrepreneur</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="regimeTva">
                        <label class="form-check-label" for="regimeTva">Régime TVA</label>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="commentaire" class="form-label">Commentaire</label>
                        <textarea class="form-control" id="commentaire" rows="5"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <input class="form-control" type="file" id="photo">
                    </div>
                </div>
            </div>

            <div class="text-end mb-4">
                <button type="submit" class="btn btn-primary">OK</button>
                <button type="reset" class="btn btn-secondary">Annuler</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
