<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $situation = $_POST['situation'] ?? '';
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $adresse = $_POST['adresse'] ?? '';
    $codepostal = $_POST['codepostal'] ?? '';
    $emailprive = $_POST['emailprive'] ?? '';
    $telperso = $_POST['telperso'] ?? '';
    $telportable = $_POST['telportable'] ?? '';
    $dateNaissance = $_POST['dateNaissance'] ?? '';
    $profil = $_POST['profil'] ?? '';
    $emailEcole = $_POST['emailEcole'] ?? '';
    $nivDiplome = $_POST['nivDiplome'] ?? '';
    $raisonSociale = $_POST['raisonSociale'] ?? '';
    $adresseSociete = $_POST['adresseSociete'] ?? '';
    $siret = $_POST['siret'] ?? '';
    $emailSociete = $_POST['emailSociete'] ?? '';
    $telSociete = $_POST['telSociete'] ?? '';
    $fonction = $_POST['fonction'] ?? '';
    $media = $_POST['media'] ?? '';
    $numActivite = $_POST['numActivite'] ?? '';
    $bic = $_POST['bic'] ?? '';
    $iban = $_POST['iban'] ?? '';
    $autoEntrepreneur = isset($_POST['autoEntrepreneur']) ? true : false;
    $regimeTva = isset($_POST['regimeTva']) ? true : false;
    $commentaire = $_POST['commentaire'] ?? '';
    $photo = $_POST['photo'] ?? null;

    // Validation des champs
    if (!empty($nom) && !empty($prenom) && !empty($adresse) && !empty($codepostal) && !empty($emailprive)) {

        
        $data = [
            'situation' => $situation,
            'nom' => $nom,
            'prenom' => $prenom,
            'adresse' => $adresse,
            'codepostal' => $codepostal,
            'emailprive' => $emailprive,
            'telperso' => $telperso,
            'telportable' => $telportable,
            'dateNaissance' => $dateNaissance,
            'profil' => $profil,
            'emailEcole' => $emailEcole,
            'nivDiplome' => $nivDiplome,
            'raisonSociale' => $raisonSociale,
            'adresseSociete' => $adresseSociete,
            'siret' => $siret,
            'emailSociete' => $emailSociete,
            'telSociete' => $telSociete,
            'fonction' => $fonction,
            'media' => $media,
            'numActivite' => $numActivite,
            'bic' => $bic,
            'iban' => $iban,
            'autoEntrepreneur' => $autoEntrepreneur,
            'regimeTva' => $regimeTva,
            'commentaire' => $commentaire,
            'photo' => $photo, 
        ];

        header('Content-Type: application/json');
        echo json_encode($data);

    } else {
        header('Content-Type: application/json', true, 400);
        echo json_encode(['error' => 'Tous les champs sont requis.']);
    }

} else {
    header('Content-Type: application/json', true, 405);
    echo json_encode(['error' => 'Méthode non autorisée.']);
}

