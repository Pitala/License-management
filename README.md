<h1>License-management-PHP</h1>

Start of Development:   05.12.2018                              <br>
Authors:                Immanuel Schranz, Alexander Kreimer     <br>
Project:                License-management-PHP                  <br>
Version:                V01                                     <br>
Deadline:               10.04.2019                              <br>
Topic: Verwaltung von Lizenzen von verschiedenen Firmen / Produkten <br>
	   mit Einfügen und Suchen Funktion. Inklusive User Login / Registration <br>
--------------------------------------------------------------------------------<br>
<h3>Installation:</h3><br>

 1- XAMPP installieren:<br>
     <a href="https://www.apachefriends.org/de/download.html">https://www.apachefriends.org/de/download.html</a><br><br>


 2- "license.management-php" Ordner in folgenden Ordner speichern:<br>
     C:\xampp\htdocs\<br><br>

 3- XAMPP starten und "Starten" bei "Apache" und "MySQL" anklicken.<br>
     "Apache" und "MySQL" solte jetzt GRÜN hinterlegt sein.<br><br>

 4- Bei XAMPP "Shell" öffnen und folgendes reinkopieren: <br>
	"mysql -u root"<br>
	"grant all privileges on *.* to 'name'@'localhost' identified by 'passwort';"<br>
	"source C:\xampp\htdocs\license-management-php\database\license.sql"<br><br>
	
 5- Folgendes File mit Editor (Notepad++, Editor, Atom,...) editieren:<br>
	"C:\xampp\htdocs\license-management-php\Code\config.php" <br><br>
	
	Username & Passwort anpassen:<br>
	<img src="screenshot.png" ><br><br>

 6- Webbrowser (Chrome, Edge, Firefox) öffnen und folgendes in die URL kopieren:<br>
    http://localhost/license-management-php/Code/index.php<br><br>

--------------------------------------------------------------------------------<br>
<h3>Funktionen zum Überprüfen:</h3><br>

  Mit dem Logo links oben gelangt man immer wieder zurück zur Startseite.<br><br>

  1- User Register: Neuer Benutzer anlegbar<br><br>

  2- User Login: Anmeldung mit erstelltem User <br>
  Bereits erstellter User unter:  <br><br>Name: admin<br>
                                          Passwort: admin123<br><br>
												 
                 Wenn man bereits angemeldet ist muss man keine Login Daten mehr<br>
                 eingeben und wird direkt auf die main.php Seite weitergeleitet.<br>
                 Bei jedem Versuch auf die main.php Seite als nicht angemeldeter<br>
                 User zu kommen wird man auf die Startseite umgeleitet.<br><br>

  3- Sobald man auf der main.php page ist:<br><br>
                -Passwort Reset vom angemeldeten Account<br><br>
                -Logout vom angemeldeten Account -> man landet wieder auf der
                 Startseite<br><br>

  4- Oberer Tab zeigt 3/4 Tabellen an. Die 4. Tabelle ist die mit den User Daten<br>
     (Passwort natürlich verschlüsselt!)<br><br>

  5- Einfügen: <br><br> Firma, Produkt, Anzahl, Stückpreis, Ablaufdatum müssen<br>
                ausgefüllt werden. Pro Firma wird immer nur eine Ansprechperson<br>
                zugelassen.<br><br>

  6- Suche:    <br><br> -Suchen nach Firma:   -Man kann nach nichts suchen <br>-> ganze
                                       Tabelle wird ausgegeben<br>
                                      -Man kann nach nur einem Buchstaben suchen<br>
                                       ->Alle Firmen die diesen einen Buchstaben
                                       beinhalten werden ausgegeben.<br>
                -Suchen nach Produkt: -Man kann nach nichts suchen -> ganze
                                       Tabelle wird ausgegeben<br>
                                      -Man kann nach nur einem Buchstaben suchen<br>
                                       ->Alle Produkte die diesen einen
                                       Buchstaben beinhalten werden ausgegeben.<br><br><br>
