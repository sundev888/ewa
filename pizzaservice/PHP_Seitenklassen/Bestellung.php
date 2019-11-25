<?php	// UTF-8 marker äöüÄÖÜß€

/**
 * Class PageTemplate for the exercises of the EWA lecture
 * Demonstrates use of PHP including class and OO.
 * Implements Zend coding standards.
 * Generate documentation with Doxygen or phpdoc
 *
 * PHP Version 5
 *
 * @category File
 * @package  Pizzaservice
 * @author   Bernhard Kreling, <b.kreling@fbi.h-da.de>
 * @author   Ralf Hahn, <ralf.hahn@h-da.de>
 * @license  http://www.h-da.de  none
 * @Release  1.2
 * @link     http://www.fbi.h-da.de
 */

// to do: change name 'PageTemplate' throughout this file
require_once 'Page.php';

/**
 * This is a template for top level classes, which represent
 * a complete web page and which are called directly by the user.
 * Usually there will only be a single instance of such a class.
 * The name of the template is supposed
 * to be replaced by the name of the specific HTML page e.g. baker.
 * The order of methods might correspond to the order of thinking
 * during implementation.

 * @author   Bernhard Kreling, <b.kreling@fbi.h-da.de>
 * @author   Ralf Hahn, <ralf.hahn@h-da.de>
 */
 /**
  *
  */
 class Pizza
 {
   var $ID;
   var $bezeichnung;
   var $pizzaPreis;
   var $imgpath;

   function __construct( $ID, $pizzaBezeichung, $pizzaPreis, $imgpath)
   {
     $this->ID = $ID;
     $this->pizzaBezeichung = $pizzaBezeichung;
     $this->pizzaPreis = $pizzaPreis;
     $this->imgpath = $imgpath;

   }
 }

class Bestellung extends Page
{


    // to do: declare reference variables for members
    // representing substructures/blocks

    /**
     * Instantiates members (to be defined above).
     * Calls the constructor of the parent i.e. page class.
     * So the database connection is established.
     *
     * @return none
     */
     protected function __construct()
     {
         parent::__construct();
         // to do: instantiate members representing substructures/blocks
     }

    /**
     * Cleans up what ever is needed.
     * Calls the destructor of the parent i.e. page class.
     * So the database connection is closed.
     *
     * @return none
     */
    protected function __destruct()
    {
        parent::__destruct();
    }

    /**
     * Fetch all data that is necessary for later output.
     * Data is stored in an easily accessible way e.g. as associative array.
     *
     * @return none
     */
    protected function getViewData()

    {
        // to do: fetch data for this view from the database
        //sql query to database
        $sql = "SELECT * FROM angebot";
        $Recordset = $this->connect ->query($sql);
        return $Recordset;

    }

    /**
     * First the necessary data is fetched and then the HTML is
     * assembled for output. i.e. the header is generated, the content
     * of the page ("view") is inserted and -if avaialable- the content of
     * all views contained is generated.
     * Finally the footer is added.
     *
     * @return none
     */
    protected function generateView(){
  //      $Recordset = $this->getViewData();
        $this->generatePageHeader('');
        $pizzaarray = array();
        $pizzenarray = $this->giveArray();


$img1 = (string) $pizzenarray[0]->imgpath;
$img2 = (string) $pizzenarray[1]->imgpath;
$img3 = (string) $pizzenarray[2]->imgpath;

$pizzaBezeichung1 = (string) $pizzenarray[0]->pizzaBezeichung;
$pizzaBezeichung2 = (string) $pizzenarray[1]->pizzaBezeichung;
$pizzaBezeichung3 = (string) $pizzenarray[2]->pizzaBezeichung;

$pizzaPreis1 = (string) $pizzenarray[0]->pizzaPreis;
$pizzaPreis2 = (string) $pizzenarray[1]->pizzaPreis;
$pizzaPreis3 = (string) $pizzenarray[2]->pizzaPreis;
echo <<<HTML
     <form action="Bestellung.php" method="POST">
        <img src="$img1" alt="pizza">
        <figcaption>$pizzaBezeichung1</figcaption>
        $pizzaPreis1 <br/>
        <input type="text" name="pizza1" placeholder="menge">

      <figure>
        <img src="$img2" alt="pizza">
        <figcaption>$pizzaBezeichung2</figcaption>
        $pizzaPreis2 <br/>
        <input type="text" name="pizza2"   placeholder="menge">
      </figure>

      <figure>
        <img src="$img3" alt="pizza">
        <figcaption>$pizzaBezeichung3</figcaption>
        $pizzaPreis3 <br/>
        <input type="text" name="pizza3"  placeholder="menge">
      </figure>
<br><br>
            <table>
              <caption>Ihre Daten Zum Versenden</caption>
            <td> <input type="text" name="adress"  placeholder="Ihre Adresse"></td></td>  <td>
              </tr>
            </table>
            <button type="submit" name="bestättigen" value="Bestättigen">Bestättigen</button>
            <button type="submit" name="Löschen" value="Eingabe löschen">Löschen</button>
        </form>
HTML;




        // to do: call generateView() for all members
        // to do: output view of this page
        $this->generatePageFooter();
        return $pizzenarray;
    }

    /**
     * Processes the data that comes via GET or POST i.e. CGI.
     * If this page is supposed to do something with submitted
     * data do it here.
     * If the page contains blocks, delegate processing of the
	 * respective subsets of data to them.
     *
     * @return
     */
    protected function processReceivedData()
    {
      include_once 'Bestellung.php';

        parent::processReceivedData();

        if(isset ($_POST['adress'])){
          $adress = $_POST['adress'];
          $timestamp = date("Y-m-d H:i:s");
#insert tabelle "bestellung"
        $sql = "INSERT INTO bestellung (BestellungID,Adresse, Bestellzeitpunkt) VALUES
        ('', '$adress', '$timestamp')";
        mysqli_query($this->connect, $sql);
        header('Location: Bestellung.php');

      }


      #get last insert ID -> BestellungID
      #insert Tabelle "bestelltepizza"

        $lastId= $this->connect->insert_id;
         $status = "bestellt";
         $pizzenarray = array();
         $pizzenarray = $this->giveArray();


         $pizzaAnzahl1 = $_POST['pizza1'];
         $pizzaAnzahl2 = $_POST['pizza2'];
         $pizzaAnzahl3 = $_POST['pizza3'];

         if($pizzaAnzahl1 !=''){
         $pizzaBezeichung1 = (string) $pizzenarray[0]->pizzaBezeichung;
          $sql2 = "INSERT INTO bestelltepizza (PizzaID, fBestellungID, fPizzaName, Status) VALUES
          ('', '$lastId', '$pizzaBezeichung1', '$status')";
          mysqli_query($this->connect, $sql2);
         }

         if($pizzaAnzahl2 !=''){
         $pizzaBezeichung2 = (string) $pizzenarray[1]->pizzaBezeichung;
          $sql2 = "INSERT INTO bestelltepizza (PizzaID, fBestellungID, fPizzaName, Status) VALUES
          ('', '$lastId', '$pizzaBezeichung2', '$status')";
          mysqli_query($this->connect, $sql2);
         }
         if($pizzaAnzahl3 !=''){
         $pizzaBezeichung3 = (string) $pizzenarray[2]->pizzaBezeichung;
          $sql2 = "INSERT INTO bestelltepizza (PizzaID, fBestellungID, fPizzaName, Status) VALUES
          ('', '$lastId', '$pizzaBezeichung3', '$status')";
          mysqli_query($this->connect, $sql2);
         }




    }


    protected function giveArray(){
      $Recordset = $this->getViewData();
      $pizzenarray = array();
      if($Recordset){
        $Record = $Recordset-> fetch_assoc();

        while($Record){
          $pizzaID = htmlspecialchars($Record["Pizzanummer"], ENT_QUOTES);
          $pizzaBezeichung = htmlspecialchars($Record["PizzaName"], ENT_QUOTES);
          $pizzaPreis = htmlspecialchars($Record["Preis"], ENT_QUOTES);
          $imgpath = htmlspecialchars($Record["Bild"], ENT_QUOTES);
          $pizzenarray[$pizzaBezeichung] = $pizzaPreis;
          $pizza = new Pizza ($pizzaID,$pizzaBezeichung, $pizzaPreis, $imgpath);
          array_push($pizzenarray, $pizza);

          $Record = $Recordset -> fetch_assoc();
        }
        $Recordset ->free();
      }
      return $pizzenarray;

    }


    /**
     * This main-function has the only purpose to create an instance
     * of the class and to get all the things going.
     * I.e. the operations of the class are called to produce
     * the output of the HTML-file.
     * The name "main" is no keyword for php. It is just used to
     * indicate that function as the central starting point.
     * To make it simpler this is a static function. That is you can simply
     * call it without first creating an instance of the class.
     *
     * @return none
     */
    public static function main()
    {
        try {
            $page = new Bestellung();
            $page->processReceivedData();
            $page->generateView();
        }
        catch (Exception $e) {
            header("Content-type: text/plain; charset=UTF-8");
            echo $e->getMessage();
        }
    }
}

// This call is starting the creation of the page.
// That is input is processed and output is created.
Bestellung::main();

// Zend standard does not like closing php-tag!
// PHP doesn't require the closing tag (it is assumed when the file ends).
// Not specifying the closing ? >  helps to prevent accidents
// like additional whitespace which will cause session
// initialization to fail ("headers already sent").
//? >
