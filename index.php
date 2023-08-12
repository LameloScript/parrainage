<?php
session_start();

// Initialiser la liste des parrains et leurs détails (à ajouter manuellement)
$parrainsDetails = array(
    'Kabran Ehui-Akoua Ghislaine' => array(
        'genre' => 'Féminin',
        'mail' => 'kabranehuiakouaghislaine@gmail.com',
        'filleuls' => array()
    ),
    'HESSOU NONVIGNON BENJAMIN' => array(
        'genre' => 'Masculin',
        'mail' => 'hessoubenjamin@gmail.com',
        'filleuls' => array()
    ),
    'EKOUN Ya Gustave' => array(
        'genre' => 'Masculin',
        'mail' => 'gustaveekoun07@gmail.com',
        'filleuls' => array()
    ),
    'Boka Boua Emmanuelle' => array(
        'genre' => 'Féminin',
        'mail' => 'bokaboua18@gmail.com',
        'filleuls' => array()
    ),
    'Yao Amenan Modestine Grace' => array(
        'genre' => 'Féminin',
        'mail' => 'yaomodestine350@gmail.com',
        'filleuls' => array()
    ),
    'Barro Aboubakar' => array(
        'genre' => 'Masculin',
        'mail' => 'aboubakarbarro23@gmail.com',
        'filleuls' => array()
    ),
    'YORO Melaine Gilsas' => array(
        'genre' => 'Masculin',
        'mail' => 'yoro.mg03@gmail.com',
        'filleuls' => array()
    ),
    'Tanoh Kouassi Krappa Anderson' => array(
        'genre' => 'Masculin',
        'mail' => 'andersontanoh06@gmail.com',
        'filleuls' => array()
    ),
    'Coulibaly Mamadou' => array(
        'genre' => 'Masculin',
        'mail' => 'mamadoucoulibaly444@gmail.com',
        'filleuls' => array()
    ),
    'N\'DRI Marcelle Annick' => array(
        'genre' => 'Féminin',
        'mail' => 'marcelleannickn@gmail.com',
        'filleuls' => array()
    ),
    'Konan Kassé Beranger' => array(
        'genre' => 'Masculin',
        'mail' => 'kasseberangerkonan@gmail.com',
        'filleuls' => array()
    ),
    'Kouakou Amenan Christelle Andrea' => array(
        'genre' => 'Féminin',
        'mail' => 'Andreakouakou38@gmail.com',
        'filleuls' => array()
    ),
    'Brou n\'dri Andersonn' => array(
        'genre' => 'Masculin',
        'mail' => 'Andersonndri56@gmail.com',
        'filleuls' => array()
    ),
    'Angui David Hermas' => array(
        'genre' => 'Masculin',
        'mail' => 'anguidave@gmail.com',
        'filleuls' => array()
    ),
    'Bello Ariké Harissatou' => array(
        'genre' => 'Féminin',
        'mail' => 'belloharissa@gmail.com',
        'filleuls' => array()
    ),
    'KABA Hawa' => array(
        'genre' => 'Féminin',
        'mail' => 'kabah446@gmail.com',
        'filleuls' => array()
    ),
    'Kouadio Aurélie Flora Ekoya' => array(
        'genre' => 'Féminin',
        'mail' => 'aurelieflora93@gmail.com',
        'filleuls' => array()
    ),
    'DIABATÉ KARIDJA' => array(
        'genre' => 'Féminin',
        'mail' => 'karidjadiabate0304@gmail.com',
        'filleuls' => array()
    ),
    'Dolo Aïssa' => array(
        'genre' => 'Féminin',
        'mail' => 'aissafirdaws08@gmail.com',
        'filleuls' => array()
    ),
    'BROU AHJA GRACE ERMADINE' => array(
        'genre' => 'Féminin',
        'mail' => 'ahjagraceermadinebrou@gmail.com',
        'filleuls' => array()
    ),
    'Kouassi N\'guessan Anselme Joseph' => array(
        'genre' => 'Masculin',
        'mail' => 'nguessankouassi0303@gmail.com',
        'filleuls' => array()
    ),
    'KRA Nathanaël' => array(
        'genre' => 'Masculin',
        'mail' => 'nth.free@gmail.com',
        'filleuls' => array()
    ),
    'KINDO ADAMA' => array(
        'genre' => 'Masculin',
        'mail' => 'adama.kin6@gmail.com',
        'filleuls' => array()
    ),
    'Kouassi Gbamble Ange Herve' => array(
        'genre' => 'Masculin',
        'mail' => 'kouassigbambleangeherve@gmail.com',
        'filleuls' => array()
    ),
    'Fofana Nenin' => array(
        'genre' => 'Féminin',
        'mail' => 'fofananenin9@gmail.com',
        'filleuls' => array()
    ),
    'Dié Grâce Espoir' => array(
        'genre' => 'Féminin',
        'mail' => 'diegraceespoir@gmail.com',
        'filleuls' => array()
    )
    // ... Ajoutez les autres parrains ici ...
);

// Gérer le choix de parrain
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $parrainChoisi = $_POST['parrain'];

    // Vérifier si le parrain a déjà 3 filleuls
    if (count($parrainsDetails[$parrainChoisi]['filleuls']) < 3) {
        $newFilleul = array(
            'nom' => $nom,
            'prenom' => $prenom
        );

        // Enregistrement des données dans Firebase (vous devez adapter cette partie en fonction de votre configuration Firebase)
        // ...

        // Enregistrement des données dans la session
        $_SESSION['parrain'] = $parrainChoisi;
        $parrainsDetails[$parrainChoisi]['filleuls'][] = $newFilleul;
    } else {
        $erreurMessage = "Ce parrain a déjà atteint le maximum de filleuls (3).";
    }
}

// Fonction pour générer et télécharger le fichier CSV
function downloadCSV($data) {
    $csvFileName = 'parrains.csv';
    $csvFile = fopen('php://output', 'w');

    // En-têtes CSV
    $headers = array('Nom Prénom Parrain', 'Filleuls');
    fputcsv($csvFile, $headers);

    // Données
    foreach ($data as $parrain => $details) {
        $row = array(
            "$parrain",
            implode(', ', array_map(function($filleul) {
                return "{$filleul['prenom']} {$filleul['nom']}";
            }, $details['filleuls']))
        );
        fputcsv($csvFile, $row);
    }

    // Fermeture du fichier CSV
    fclose($csvFile);

    // Envoi du fichier CSV en tant que téléchargement
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $csvFileName . '"');
    exit;
}

if (isset($_POST['download_csv'])) {
    downloadCSV($parrainsDetails);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Plateforme de Parrainage</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        min-height: 100vh;
        background-color: #f9f9f9;
    }

    .container {
        width: 100%;
        max-width: 800px;
        margin: 20px;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    h1 {
        font-size: 24px;
        text-align: center;
        margin-bottom: 20px;
    }

    form label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    form input,
    form select,
    form button {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f0f0f0;
    }

    .error {
        color: red;
        margin-bottom: 10px;
    }

    @media (max-width: 600px) {
        form input,
        form select,
        form button {
            margin-bottom: 10px;
        }
    }
</style>

    <script type="module">
        // Importez les fonctions dont vous avez besoin des SDKs que vous utilisez
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-app.js";
import { getFirestore, collection, addDoc } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-firestore.js";

        // TODO: Ajoutez les SDKs des produits Firebase que vous souhaitez utiliser
        // https://firebase.google.com/docs/web/setup#available-libraries

        // Configuration Firebase de votre application web
        const firebaseConfig = {
  apiKey: "AIzaSyAvcwHT8dPYtS2Jt3fvvOCFt3BI_bevytk",
  authDomain: "parrainage-120ef.firebaseapp.com",
  projectId: "parrainage-120ef",
  storageBucket: "parrainage-120ef.appspot.com",
  messagingSenderId: "903100632591",
  appId: "1:903100632591:web:8fae823ff487bac37e9d7a"
     };
        // Initialisez Firebase
        const app = initializeApp(firebaseConfig);

        function choisirParrain(parrainChoisi) {
    var nom = document.getElementById('nom').value;
    var prenom = document.getElementById('prenom').value;

    // Enregistrer le choix dans la base de données Firebase
    const db = firebase.firestore();
    db.collection('parrain').add({
        nom: nom,
        prenom: prenom,
        parrainChoisi: parrainChoisi
    })
    .then(function(docRef) {
        console.log("Document enregistré avec ID: ", docRef.id);
    })
    .catch(function(error) {
        console.error("Erreur lors de l'enregistrement du document: ", error);
    });

    // Afficher le bouton d'envoi de mail
    var envoyerMailBtn = document.getElementById('envoyerMailBtn');
    envoyerMailBtn.style.display = 'block';
     }

    function envoyerMail(email) {
    window.location.href = "mailto:" + 'mail';
    }

    </script>
</head>
<body>
    <div class="container">
        <h1>Parrainage</h1>
        <?php if (isset($erreurMessage)): ?>
            <div class="error"><?php echo $erreurMessage; ?></div>
        <?php endif; ?>
        <form method="post">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>
            <label for="parrain">Choisissez votre Parrain :</label>
            <select id="parrain" name="parrain" required>
                <option value="">Sélectionnez un Parrain</option>
                <?php
                foreach ($parrainsDetails as $parrain => $details) {
                    if (count($details['filleuls']) < 3) {
                        echo "<option value=\"$parrain\">$parrain</option>";
                    }
                }
                ?>
            </select>
            <button type="submit">Choisir</button>
        </form>
    </div>

    <div class="container">
    <h1>Parrains Disponibles</h1>
    <table>
        <thead>
            <tr>
                <th>Nom & Prénom Parrain</th>
                <th>Genre</th>
                <th>Email</th>
                <th>Filleuls</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
    <?php
    foreach ($parrainsDetails as $parrain => $details) {
        echo "<tr>";
        echo "<td>$parrain</td>";
        echo "<td>{$details['genre']}</td>";
        echo "<td>{$details['mail']}</td>";
        echo "<td>" . implode(', ', array_map(function($filleul) {
            return "{$filleul['prenom']} {$filleul['nom']}";
        }, $details['filleuls'])) . "</td>";
        
        // Vérifier si le parrain a été choisi par l'utilisateur
        if (isset($_SESSION['parrain']) && $_SESSION['parrain'] === $parrain) {
            echo "<td><button onclick=\"envoyerMail('{$details['mail']}')\">Envoyer un mail</button></td>";
        } else {
            echo "<td></td>";
        }
        
        echo "</tr>";
    }
    ?>
</tbody>

    </table>
    <form method="post">
        <button type="submit" name="download_csv">Télécharger CSV</button>
    </form>
</div>
</body>
</html>
