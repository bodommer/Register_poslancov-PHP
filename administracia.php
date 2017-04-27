<?php
session_start();
$nazov = 'Administrácia';
include('funkcie.php');
include('hlavicka.php');
?>
<section>
  <h3>Administrácia</h3>
  <?php if (isset($_POST['meno'])) {
    $prihlasenie = spravne_prihlasenie($_POST['meno'], $_POST['heslo']);
    if (!($prihlasenie==False)) {
      //echo 'prihlasenie=' . $prihlasenie;
      $_SESSION['meno'] = $_POST['meno'];
      $_SESSION['id'] = $prihlasenie;
    } else {
      echo "<p>Nesprávne zadané meno alebo heslo</p>"; }
    }
  if (isset($_SESSION['meno']) && !isset($_POST['odhlas'])) {
    if (isset($_POST['pridaj'])) {
     $nespravne = array();
     if (!((isset($_POST['datum']) && spravny_datum($_POST['datum'])))) {
       $nespravne[] = 'datum';
     }
     if (!((isset($_POST['prichod']) && spravny_cas($_POST['prichod'])))) {
       $nespravne[] = 'prichod';
     }
     if (!((isset($_POST['odchod']) && spravny_cas($_POST['odchod'])))) {
       $nespravne[] = 'odchod';
     }
     if (!((casy_po_sebe($_POST['prichod'], $_POST['odchod'])))) {
       $nespravne[] = 'čas odchodu je skôr, ako čas príchodu';
     }
     if (!((isset($_POST['popis'])))) {
       $popis = '';
     } else {
       $popis =addslashes(htmlspecialchars(strip_tags( $_POST['popis'])));
     }
     if (count($nespravne)==0) {
        $vloz = vloz_casy($_SESSION['id'], $_POST['datum'], $_POST['prichod'], $_POST['odchod'], $popis);
        if ($vloz == True) {
          echo "<p>Udaje boli uspesne vlozene do databazy</p>";
          $_POST = array();
        } else {
          echo "<p>Nieco neprebehlo dobre. Skuste znova. Je mozne, ze zadavate rovnaky udaj druhykrat!</p>";
        }
     } else {
          $chyby = implode(', ', $nespravne);
          echo "<p>Nasledujuce udaje boli nespravne zadane: " . $chyby ."</p>";
     }
   } elseif (isset($_POST['zmaz'])) {
        $zmaz = vymaz_zaznamy($_POST['zmazat']);
        if ($zmaz) {
          $_POST['zmazat'] = array();
          unset($_POST['zmaz']);
          echo "<p>Zaznamy boli uspesne vymazane.</p>";
        } else {
          echo "<p>Zaznamy neboli vymazane. Nieco neprebehlo v poriadku.</p>";
        }
      }
  ?>

    <h4>Vkladanie príchodov a odchodov</h4>
    <form method="post">
      <fieldset>
        <legend>Nový záznam</legend>
        <!--<label for="nazov">Názov/typ udalosti:</label> <input type="text" name="nazov" id="nazov" size="25" maxlength="70" <?php //if (isset($_POST['nazov'])) {echo "value=" . $_POST['nazov'];} else { echo 'placeholder=" max. 70 znakov"';} ?> required><br>-->
        <label for="datum">Dátum:</label> <input type="date" name="datum" id="datum"  <?php if (isset($_POST['datum'])) {echo "value=" . $_POST['datum'];} else { echo 'placeholder="dd.mm.yyyy"';}?> required><br>
        <label for="prichod">Čas príchodu:</label> <input type="time" name="prichod" <?php if (isset($_POST['prichod'])) {echo "value=" . $_POST['prichod'];} else { echo 'placeholder="hh:mm"';} ?>><br>
        <label for="odchod">Čas odchodu:</label> <input type="time" name="odchod" <?php if (isset($_POST['odchod'])) {echo "value=" . $_POST['odchod'];} else { echo 'placeholder="hh:mm"';} ?>><br>
        <label for="popis">Poznámka:</label> <textarea name="popis" id="popis" rows="3" cols="30" <?php if (isset($_POST['popis'])) {echo "value=" . $_POST['popis'];} else { echo 'placeholder="max. 100 znakov"';} ?>></textarea><br>
      </fieldset>
      <input type="submit" name="pridaj" class="button" id="pridaj" value="Pridať">
    </form>
    <form method="post">
       <input type="submit" name="odhlas" class="button" id="odhlas" value="Odhlásiť">
    </form>
  <?php
  vypis_zaznamy($_SESSION['id'], True);
  } else {
  if (isset($_POST['odhlas'])) {
    session_unset();
  	session_destroy();
    echo "<p>Odhlasenie prebehlo uspesne.</p>";
  } ?>
  <p>Pre pokračovanie sa najprv prihláste.</p>
  <form method="post">
    <fieldset>
      <legend>Prihlasovacie údaje</legend>
      <label for="meno">Meno:</label> <input type="text" name="meno" id="meno" size="15" maxlength="12" placeholder=" 3-12zn." required><br>
    	<label for="heslo">Heslo:</label> <input type="password" name="heslo" id="heslo" size="16" placeholder=" 8-16zn., 1číslo" required>
    </fieldset>
    <input type="submit" name="prihlas" id="prihlas" class="button" value="Prihlásiť">
  </form>
<?php } ?>

</section>
<?php
include('pata.php')
?>
