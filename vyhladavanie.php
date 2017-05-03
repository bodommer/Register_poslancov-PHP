<?php
$nazov = 'Vyhľadávanie';
include('funkcie.php');
include('hlavicka.php');
$ine = False;
?>
<section>
  <?php
  if (isset($_GET['poslanec'])) {
    vypis_zaznamy($_GET['poslanec'], False, $_GET['mposlanca']);
  } else {
    if (isset($_GET['tr'])) {
      $ine = True;
    } ?>
    <h4>Vyhľadávanie v záznamoch o poslancoch</h4>
    <form method='get'>
      <fieldset>
        <legend>Hľadanie podľa stranníckej príslušnosti</legend>
        <label for="strana">Skratka strany: </label> <input type="text" name="strana" id="meno" size="10" maxlength="12" <?php if (isset($_GET['strana'])) {echo "value=" . $_GET['strana'];} else { echo 'placeholder=" napr. ABC"';}?>><br>
        <input type="radio" name="strana_smer" class="radio" id="strana_vz" value="vzostupne"<?php if (isset($_GET['p_strany']) && $_GET["strana_smer"]=="vzostupne") echo ' checked'; ?>> <label for="strana_vz">Vzostupne</label><br>
        <input type="radio" name="strana_smer" class="radio" id="strana_z" value="zostupne"<?php if (isset($_GET['p_strany']) && $_GET["strana_smer"]=="zostupne") echo ' checked'; ?>> <label for="strana_z">Zostupne</label><br>
        <input type="submit" name="p_strany" id="p_strany" class="button" value="Hľadať členov"><br>
      </fieldset>
      <fieldset>
        <legend>Iné vyhľadávanie</legend>
        <span>Zoradiť: </span><br>
        <input type="radio" name="ine_smer" class="radio" id="vz" value="vzostupne"<?php if ($ine && $_GET["ine_smer"]=="vzostupne") echo ' checked'; ?>> <label for="vz">Vzostupne</label><br>
        <input type="radio" name="ine_smer" class="radio" id="z" value="zostupne"<?php if ($ine && $_GET["ine_smer"]=="zostupne") echo ' checked'; ?>> <label for="z">Zostupne</label><br>
        <span>Podľa: </span><br>
        <input type="submit" name="tr" id="meno" class="button" value="mena">
        <input type="submit" name="tr" id="vek" class="button" value="veku">
        <input type="submit" name="tr" id="absencie" class="button" value="počtu absencií">
        <input type="submit" name="tr" id="p_zvoleni" class="button" value="počtu zvolení">
        <input type="submit" name="tr" id="str" class="button" value="strán"><br>
      </fieldset>
    </form>
    <?php
      $poziadavka = ' WHERE id>0';
      if (isset($_GET['p_strany'])) {
        if (isset($_GET['strana_smer']) && isset($_GET['strana'])) {
          $poziadavka .= ' AND strana="';
          $poziadavka .= $_GET['strana'];
          if ($_GET['strana_smer'] == 'vzostupne') {
            $poziadavka .= '" ORDER BY meno ASC';
          } else {
            $poziadavka .= '" ORDER BY meno DESC';
          }
        }
      } elseif (isset($_GET['tr'])) {
          if (isset($_GET['ine_smer'])) {
            if ($_GET['tr'] == 'mena') {
              $poziadavka .= ' ORDER BY meno';
            }  elseif ($_GET['tr'] == 'veku') {
              $poziadavka .= ' ORDER BY vek';
            }  elseif ($_GET['tr'] == 'počtu absencií') {
              $poziadavka .= ' ORDER BY pocet_absencii';
            }  elseif ($_GET['tr'] == 'počtu zvolení') {
              $poziadavka .= ' ORDER BY pocet_zvoleni';
            }  elseif ($_GET['tr'] == 'strán') {
              $poziadavka .= ' ORDER BY strana';
            }
            if ($_GET['ine_smer'] == 'vzostupne') {
              $poziadavka .= ' ASC';
            } else {
              $poziadavka .= ' DESC';
            }
          }
        }
      vypis_triedenie($poziadavka);
  }
?>
</section>
<?php
include('pata.php')
?>
