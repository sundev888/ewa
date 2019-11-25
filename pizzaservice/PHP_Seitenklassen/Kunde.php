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
require_once './Page.php';

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
 class BestelltePizza
 {
   var $pizzaID;
   var $fBestellungID;
   var $fPizzaname;
   var $status;

   function __construct( $ID, $fBestellungID, $fPizzaname, $status)
   {
     $this->ID = $ID;
     $this->fBestellungID = $fBestellungID;
     $this->fPizzaname = $fPizzaname;
     $this->status = $status;

   }
 }
class Kunde extends Page
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
        $sql = "SELECT * FROM bestelltepizza";
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
    protected function generateView()
    {
      //  $this->getViewData();
        $this->generatePageHeader('to do: change headline');


        $this->generatePageHeader('to do: change headline');
         echo "<br/>";
        // to do: call generateView() for all members
        // to do: output view of this page
        $pizzenarray = array();
        $pizzenarray = $this->giveArray();

        $ID = (string) $pizzenarray[0]->pizzaID;
        $fBestellungID =  (string) $pizzenarray[0]->fBestellungID;
        $fPizzaname = (string) $pizzenarray[0]->fPizzaname;
        $status = (string) $pizzenarray[0]->status;


        $lastId= $this->connect->insert_id;


        $arraySize =  count($pizzenarray);
        echo "Alle Pizzen aus der DB";
        echo "<br/>";
        for ($i=0; $i <$arraySize ; $i++) {
        echo '<form class="" action="update.php" method="POST">';
        $fPizzaname = (string) $pizzenarray[$i]->fPizzaname;
        $status = (string) $pizzenarray[$i]->status;
        $radioRow = "radioRoww".$i;
        if($status ==="bestellt"){
         echo <<<HTML
      $fPizzaname:  bestellt <input type="radio" name="$radioRow" value="bestellt" checked ="checked">
                     im Ofen <input type="radio" name="$radioRow" value="imOfen" >
                     fertig <input type="radio" name="$radioRow" value="fertig">
                   <button type="submit" name="test" value="test">Test</button>
                     </form>

HTML;
}

           if($status ==="imOfen"){
            echo <<<HTML
         $fPizzaname:  bestellt <input type="radio" name="$radioRow" value="bestellt" >
                        im Ofen <input type="radio" name="$radioRow" value="imOfen" checked ="checked">
                        fertig <input type="radio" name="$radioRow" value="fertig">
                      <button type="submit" name="test" value="test">Test</button>
                        </form>

HTML;
}
if($status ==="fertig"){
            echo <<<HTML
                $fPizzaname:  bestellt  <input type="radio" name="$radioRow" value="bestellt">
                                im Ofen <input type="radio" name="$radioRow" value="imOfen">
                fertig <input type="radio" name="$radioRow" value="fertig" checked ="checked">
              <button type="submit" name="test" value="test">Test</button>
                  </form>

HTML;
}

}
        // to do: call generateView() for all members
        // to do: output view of this page
        $this->generatePageFooter();
    }

    /**
     * Processes the data that comes via GET or POST i.e. CGI.
     * If this page is supposed to do something with submitted
     * data do it here.
     * If the page contains blocks, delegate processing of the
	 * respective subsets of data to them.
     *
     * @return none
     */
    protected function processReceivedData()
    {
        parent::processReceivedData();
        // to do: call processReceivedData() for all members
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
     protected function giveArray(){
       $Recordset = $this->getViewData();
       $pizzenarray = array();
       if($Recordset){
         $Record = $Recordset-> fetch_assoc();

         while($Record){
           $pizzaID = htmlspecialchars($Record["PizzaID"], ENT_QUOTES);
           $fBestellungID = htmlspecialchars($Record["fBestellungID"], ENT_QUOTES);
           $fPizzaname = htmlspecialchars($Record["fPizzaName"], ENT_QUOTES);
           $status = htmlspecialchars($Record["Status"], ENT_QUOTES);
           $bestelltepizza = new BestelltePizza ($pizzaID,$fBestellungID, $fPizzaname, $status);
           array_push($pizzenarray, $bestelltepizza);

           $Record = $Recordset -> fetch_assoc();
         }
         $Recordset ->free();
       }
       return $pizzenarray;

     }
    public static function main()
    {
        try {
            $page = new Kunde();
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
Kunde::main();

// Zend standard does not like closing php-tag!
// PHP doesn't require the closing tag (it is assumed when the file ends).
// Not specifying the closing ? >  helps to prevent accidents
// like additional whitespace which will cause session
// initialization to fail ("headers already sent").
//? >
