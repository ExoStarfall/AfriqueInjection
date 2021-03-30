<?php
  define("PAGE_TITLE", "Traitement");
  require("inc/inc.kickstart.php");
?>

<main class="pays-creer">
<?php
  try{
  // Ta requête pourie là, avec des $_POST là où il faut pas
  $requete = "INSERT INTO `country` (`country_name`, `country_flag`, `country_capital`, `country_area`) 
              VALUES (:country_name, :country_flag, :country_capital, :country_area);"; // EH BAH ELLE EXISTE PLUS 

 // Faut la préparer la requête quand même? ON SECURISE ! Adios les injections 
  $prepare = $pdo->prepare($requete);
  $prepare->execute(array(
    ":country_name" => $_POST['country_name'],
    ":country_flag" => $_POST['country_flag'],
    ":country_capital" => $_POST['country_capital'],
    ":country_area" => $_POST['country_area']
  ));
  // Pourquoi l'executer une autre fois ? IS USELESS but I keep 
  //$pdo->execute($requete);
  } catch (PDOException $e) {
  // en cas d'erreur, on récup et on affiche, grâce à notre try/catch
  exit("❌🙀💀 OOPS :\n" . $e->getMessage());
}  //END
  
  echo "<h3>Merci !</h3>";
  echo "<p>Voici un récapitulatif de votre contribution :</p>";
  echo "<ul>" // REKT la faille XSS 
      ."<li>Nom du pays : " . htmlentities($_POST["country_name"], ENT_QUOTES) . "</li>"
      ."<li>Capitale du pays : " . htmlentities($_POST["country_capital"], ENT_QUOTES) . "</li>"
      ."<li>Drapeau du pays : " . htmlentities($_POST["country_flag"],ENT_QUOTES) . "</li>"
      ."<li>Superficie du pays (en km²) : " . htmlentities($_POST["country_area"],ENT_QUOTES) . "</li>"
      ."<ul>";
  echo "<a href='page-pays-liste-alpha.php'><button>Consulter la liste des pays</button></a>";

?>
</main>

<?php require("inc/inc.footer.php"); ?>
