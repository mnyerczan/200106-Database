<?php
    use Database\LoadIni;
        
    require_once 'Database/loadIni.php';

    define("DB", "Database\\");


    $l = new LoadIni();
    $l->loadDatas(DB."db.ini");

    //Adatbázis kapcsolat létrehozása    
    //$db = new mysqli($l->host,$l->name,$l->pass);   
    //Kapcsolat leellenőrzése
    /*if(!$db)
    {
        echo mysqli_connect_error();
        echo $db->error_list;        
    }
    */
    //Adatbázis kivállasztása
    //$db->query("USE mnyerczans");
    /**
     * Tábla lekérdezése
     * A fetch_array a tábla rekordjait egyenként adja
     * vissza asszociatív tombbe csomagolva. 
     */
    //$query = $db->query('SELECT * FROM $hajo_osztalyok');

    /**
     * Egy while ciklussal addig megyunk, míg a fetch_array metódus
     * hamissal nem tér vissza.
     */
?>

<pre>
    <?php //while($row = $query->fetch_array()):?>
        <?php //print_r($row);?>
    <?php //endwhile;?>
</pre>

<?php
    //Bezárjuk a mysqli kapcsolatot
    //$db->close();
?>

<?php
    /**
     * A querystring els része az adatbázist specifikálja
     * 2. a host "vendéglátó" megadása
     * 3. adatbázis neve.
     * 
     * Madj második és harmadik paraméterként megadjuk a 
     * felhasználónevet és a jelszót.
     */
    //print_r($l);
    try
    {
        $pdo = new PDO("mysql:host={$l->host};dbname={$l->db}", $l->name, $l->pass);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }

    /**
     * Lekérdezés PDO-val
     */
    $query = $pdo->query('SELECT * FROM $hajok');
    /**
     * A fetch all egyetlen lépésben lekéri a tábla tartalmát  
     */  
?>
<pre>
    <?php //print_r($query->fetchAll());?>
</pre>
<?php
    
    //$query = $pdo->query('SELECT * FROM $hajo_osztalyok');
    /*
     * A Fetch soronként kéri be a rekordokat, így ahhoz ciklust kell használni.
     *
    while($row = $query->fetch())
    {
        print_r($row);
        echo "<br>";
    }*/
    /**
     * SQL INJECTION kivédése
     */
    /*
    $data = "'' OR 1=1";
    $query = $pdo->query('SELECT * FROM $hajo_osztalyok WHERE vizkiszoritas = '.$data);

    print_r($query);
    while($row = $query->fetch())
    {
        //print_r($row);
        echo "<br>";
    }
    */
    /**
     * Folyt köv.
     */
    $data1 = "'körte'";
    $data2 = "Alma, '";
    $query = $pdo->prepare('INSERT INTO t VALUES (?, ?)');

    $query->bindParam(1, $data1);
    $query->bindParam(2, $data2);


    print_r($query->execute());
?>
<?php
    $pdo = NULL;
?>