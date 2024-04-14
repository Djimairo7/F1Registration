# Installatie
Wij gaan er hier vanuit dat npm is geinstalleerd op het apparaat en dat er kennis is van het aanmaken van een SQL database. zo niet installeer het [hier](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm) 
## Het verkijgen van het projectbestand
### Git
1. Navigeer naar de locatie waar je het project wilt hebben en open daar een terminal window
2. copieer deze regel en plak het in de terminal 
`git clone https://github.com/Djimairo7/F1Registration.git`
### Brightspace
1. Download het ingeleverde bestand

> Nu staat het project op je systeem!
### Project bestanden
1. Pak het ZIP bestand uit op een plek naar keuze. 
2. Open daarna de folder genaamd `F1Registration`. 
3. Open het project in een code editor naar keuze.
- Voordat de server gestart kan worden moeten er eerst nog een paar andere dingen gedaan worden.
4. Open het .env bestand, en zoek naar het volgende
```
DB_USERNAME=root
DB_PASSWORD=
```
- verander hier de gegevens naar de gegevens van de sql database configuratie
5. Nu kan de database aangemaakt worden. Maak een SQL database met de naam `f1registration`
6. voordat de volgende stap uitgevoerd kan worden, moet composer en npm eerst geinstalleerd worden, dit kan met deze regel in een terminal window in dezelfde locatie `composer install` en daarna `npm install`
7. Nu moeten de migrations gerunt worden en moeten alle Tables en gegevens in de database komen, dit kan door eerst deze regel te copieeren en te plakken in een terminal window `php artisan migrate` en daarna deze regel `php artisan db:seed`
- Wanneer deze opdracht is uitgevoerd zal alle benodigde informatie beschikbaar zijn
8. Start de server door 2 terminal windows in dezelfde locatie te openen, en copieer deze regel in een
`php artisan serve`
- en deze regel in de andere
`npm run dev`
9. Wanneer de eerste regel is uitgevoerd komt er een link tevoorschijn, als je daarop ctrl+lmb dan opent de link in een nieuw tablad in je browser. Als je het project voor het eerst runt dan verschijnt er een bericht dat er nog geen Key is. Dit los je op door op de knop `GENERATE APP KEY` te klikken en daarna de pagina te refreshen

Nu is het mogelijk om de applicatie te gebruiken. Veel plezier!
