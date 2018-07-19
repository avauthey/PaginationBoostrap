# PaginationBoostrap

Classe PHP Objet Permettant de créer un système de pagination de Boostrap en fonction de données venant de tableaux PHP

Compatible avec PHP 5 et +
Créé par Antoine Vauthey le 16/02/2018


## Exemple d'usage
```php
    require_once 'Pagination.php';
    $array = array (
      1 => array("id" => 1, "nom" => "john", "prenom" => "doe"),
      2 => array("id" => 2, "nom" => "foo", "prenom" => "bar"),
      3 => array("id" => 3, "nom" => "a", "prenom" => "b")
    );
    // Récupération de la page
    if(isset($_GET["page"]) && $_GET["page"] != ""){
      $page = $_GET["page"];
    } else{
      $page = 1;
    }
    //Création de la class Pagination pour l'affichage des données
    $pagination = new Pagination($array);
    // Définit la limite
    $pagination->setLimit(1);
    // Définit le nombre de page
    $pagination->setPage();
    // Tableau avec les données de la page courante
    $lesPersonnes = $pagination->getArray($page);
    // Obtention du code de la pagination
    $pagin = $pagination->getBootstrapPaginationCode($page);
    
    //!\\ NE PAS OUBLIER LES SCRIPTS JS ET CSS BOOTSTRAP //!\\
    
    // Affichage des données sous forme de tableau html avec les données formatées en fonction de la limite et de la page
    echo '<table class="table"><thead><tr><td>ID</td><td>Nom</td><td>Prenom</td></tr></thead><tbody>';
    $tab = "";
    foreach($lesPersonnes as $unePersonne){
         $tab .= '<tr><td>'.$unePersonne['id'].'</td><td>'.$unePersonne['nom'].'</td><td>'.$unePersonne['prenom'].'</td></tr>';
    }
    echo $tab.'</tbody></table>';
    // Code html de la pagination
    echo $pagin; ?>
```
