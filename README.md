# Užsakymų valdymo užduotis
Užsakymų valdymo sistema leidžianti pridėti, šalinti, redaguoti užsakymus.

## Diegimo instrukcija

• Reikia **sukurti lokalų serverį** ir **paleisti MySQL**, tai galima padaryti naudojant **XAMPP** programinę įranga.<br />
Atsisiuntimo nuoroda: https://www.apachefriends.org/download.html 

• Atsisiunčiamas kodas į norimą direktoriją su komanda: **git clone https://github.com/MartynasVenckus/Crud-task.git**

• Atsidarius lokalią duomenų bazių valdymo sistemą reikia sukurti duomenų bazę pavadinimu **crud**, koduotė **utf8_general_ci**.
Sukūrus duomenų bazę ir į ją įėjus, spaudžiama **Import -> Choose file**. 
Nunaviguojama į atsisiųsto kodo dierektoriją **..\Crud-task\Database** ir pasirenkamas **orders.sql** failas

• **..\Crud-task\action.php** faile pirmoje eilutėje įvedami prisijungimai prie lokalios duomenų bazės.
Kode palikti standartiniai prisijungimo duomenys: **username="root", password=""**.<br />
![image](https://user-images.githubusercontent.com/48094203/123248968-2d785600-d4f1-11eb-9139-f2339eed56e7.png)

• **..\Crud-task** direktorijoje, komandinėje eilutėje įvedama komanda **php -S localhost:8080**

• Naršyklėje atsidarius http://localhost:8080/ matoma užsakymų valdymo užduotis

