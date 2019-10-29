<!DOCTYPE html>
<html lang="DE">
  <head>
    <meta charset="utf-8">
    <title>Bestellseite</title>
  </head>
  <body>
    <h1>Bestellung</h1>
    <h1>Speisekarte</h1>

    <figure>
      <img src="Pics/margherita.png" alt="Margherita"> <br/>
        <figcaption> Margherita</figcaption> <br/>
          4.00 €
    </figure>
    <br/>
    <figure>
      <img src="Pics/Salami.png" alt="Salamipizza"> <br/>
      <figcaption>Salami</figcaption> <br/>
      4.50 €
    </figure>

  <br/>
  <figure>
    <img src="Pics/Hawaii.png" alt="Hawaii">  <br/>
    <figcaption>Hawaii</figcaption> <br/>
    5.50 €
  </figure>
  <br/>
  <h1> Warenkorb </h1>
  <form class="pizzaBestellung"  method="post">
    <select size="5" tabindex="0" name= "PizzenAuswahl[]" multiple="multiple" >
      <option  selected="selected" value="Margherita">Margherita</option>
      <option value="Salami">Salami</option>
      <option  value="Hawaii">Hawaii</option>
    </select>
    <input type= "submit" name= "submit" value="pijhkjhkjkkkjhzza">
    </form>


    <?php
if(isset($_POST["submit"])){
  if(isset($_POST["PizzenAuswahl"])){
    foreach ($_POST ["PizzenAuswahl"] as $pizzen)
      echo "$pizzen" ;
  }
}
?>
    <br/>
14.50 €
  <br/>
  <form action ="https://enoegkjubosyl.x.pipedream.net" method="post">  <--! test für network traffic-->
  <input type="text" value="Email-Adresse" name="Ihre Email-Adresse"  placeholder="Ihre Email-Adresse"> <br/>
</form>
<input type="button" name=" delete all" value="Alle Löschen" >
<input type="button" name="delete choice " value="Auswahl Löschen">
<input type="button" name="order" value="Bestellen">
<textarea accesskey="y" id="textbereich" tabindex="5" name="iwas" cols="10" rows="10" placeholder="cool"> fgfdg</textarea>
<form action="test.php" method="get" id="auchTest">
</form>
  </body>
</html>
