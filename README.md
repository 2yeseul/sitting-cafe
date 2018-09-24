## sitting-cafe

### Sitting cafe('앉는 카페') shows the number of people in CAFE in real time. 

I use arduino D1 R1 board that the ESP8266 (wifi module) mounted in it to make connection between arduino and the server by PHP.
(and ACTUALLY I recommend the D1 R1 board who use http requests by WIFI than only using ESP8266 module because of its instability..)

- arduion.ino is the file that we use in arduino. It sends the sensor's data by GET response.
- index.php is the main page's file of the web. This file gets the sensor's data by GET and also sends data to DB (We use mysql).

When you put the keyword in the search box, then the sch.php shows up. This file shows the data searched by keyword in previous page.
- /search/index.php shows the result of what you searched. I use subqueries to select distinct values of the each university in this file.
- android.php is the file that connects the application and the sql. It is almost same with the sch.php but I encoded to JSON because PHP does not allowed to use in android studio. 

