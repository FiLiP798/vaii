# mySkyLog – Osobný denník letov

Filip Vacula

5ZYI32

## Stručný opis projektu

mySkyLog je webová aplikácia určená pre cestovateľov, nadšencov letectva a ľudí, ktorí si chcú evidovať svoje absolvované lety a mať prehľad o svojich cestách. Hlavným účelom aplikácie je umožniť používateľom vytvárať a spravovať vlastný digitálny denník letov, do ktorého si môžu zaznamenávať informácie o absolvovaných letoch, odletových a príletových letiskách, leteckých spoločnostiach a zážitkoch z cestovania. Ku každému letu bude možné pridať poznámky, hodnotenie a fotografie. Používateľ bude môcť evidovať aj cenu letenky, menu, spôsob úhrady a prípadné poplatky. Okrem klasicky platených letov bude aplikácia podporovať aj lety zaplatené míľami alebo kombináciou míľ a peňažného doplatku.

Aplikácia bude poskytovať prehľadnú históriu letov, vyhľadávanie a filtrovanie záznamov a štatistiky o cestovaní. Používateľ bude môcť sledovať napríklad počet absolvovaných letov, celkovú nalietanú vzdialenosť, najčastejšie využívané letecké spoločnosti, celkové výdavky na letenky, priemernú cenu letu a počet použitých míľ. Registrovaní používatelia budú môcť spravovať svoje záznamy a nastavovať ich viditeľnosť. Súčasťou aplikácie bude aj administrátorská časť určená na správu používateľov, letísk a leteckých spoločností.

## Role v projekte

### 1. Návštevník

Návštevník je neprihlásený používateľ aplikácie. Môže si prezerať verejne dostupné informácie o aplikácii, katalóg letísk a leteckých spoločností a verejné profily používateľov, ktorí sa rozhodli sprístupniť svoje údaje. Nemá oprávnenie vytvárať, upravovať ani mazať záznamy o letoch.

### 2. Registrovaný používateľ

Registrovaný používateľ môže vytvárať a spravovať svoj osobný denník letov. Má možnosť pridávať, zobrazovať, upravovať a mazať vlastné lety, pridávať fotografie a poznámky, hodnotiť svoje lety a prezerať si štatistiky o cestovaní a výdavkoch. Pri jednotlivých letoch môže dobrovoľne evidovať cenu letenky, menu, počet použitých míľ a prípadné poplatky. Môže upravovať svoj profil a nastaviť viditeľnosť svojich údajov. Nemôže upravovať ani mazať záznamy patriace iným používateľom.

### 3. Administrátor

Administrátor zodpovedá za správu a správne fungovanie aplikácie. Má prístup do administrátorskej časti, v ktorej môže zobrazovať a spravovať používateľské účty, letiská a letecké spoločnosti. Môže vytvárať, upravovať a mazať záznamy v katalógoch, kontrolovať obsah aplikácie a odstraňovať nevhodné alebo nesprávne údaje. Jeho oprávnenia budú kontrolované na serverovej strane.

## Prípady použitia podľa rolí

### Návštevník
- Prezrie si úvodnú stránku aplikácie.
- Prehliada verejne dostupné profily a denníky letov.
- Prezrie si katalóg letísk a leteckých spoločností.
- Vyhľadáva verejne dostupné informácie o letiskách.
- Zaregistruje sa alebo sa prihlási do aplikácie.

### Registrovaný používateľ
- Prihlási sa do aplikácie a odhlási sa z používateľského účtu.
- Vytvorí nový záznam o absolvovanom lete.
- Zobrazí si detail konkrétneho letu.
- Upraví alebo vymaže vlastný záznam o lete.
- Vyhľadáva a filtruje svoje lety podľa dátumu, letiska alebo leteckej spoločnosti.
- Eviduje cenu letenky a menu, v ktorej bola zaplatená.
- Označí let ako platený peniazmi, zaplatený míľami alebo zaplatený kombináciou míľ a peňazí.
- Zaznamená počet použitých míľ a prípadné dane a poplatky.
- Pridá fotografie, poznámky a hodnotenie k letu.
- Spravuje fotografie a ďalšie súbory priradené k svojim letom.
- Prezrie si štatistiky počtu letov, nalietanej vzdialenosti a cestovateľských nákladov.
- Sleduje celkové výdavky na letenky, priemernú cenu plateného letu a celkový počet použitých míľ.
- Upraví svoje profilové údaje a nastavenia súkromia.

### Administrátor
- Prihlási sa do administrátorskej časti aplikácie.
- Zobrazí zoznam registrovaných používateľov.
- Spravuje používateľské účty a ich oprávnenia.
- Vytvára, zobrazuje, upravuje a maže záznamy o letiskách.
- Vytvára, zobrazuje, upravuje a maže záznamy o leteckých spoločnostiach.
- Kontroluje údaje v databáze a odstraňuje nevhodný obsah.
- Spravuje katalógy letísk a leteckých spoločností používané pri vytváraní letov.

## Plánované entity

### 1. Používateľ (User)

Predstavuje registrovaného používateľa aplikácie. Prihlasovanie a správu používateľov bude zabezpečovať používateľský systém frameworku VAJKO.

**Hlavné atribúty:** identifikátor, používateľské meno alebo e-mail, zahashované heslo, rola, profilová fotografia a nastavenie viditeľnosti profilu.

**Vzťahy:** jeden používateľ môže vlastniť viacero letov a ku svojim letom môže pridávať fotografie a hodnotenia.

### 2. Let (Flight)

Predstavuje jeden absolvovaný let používateľa a obsahuje základné informácie o jeho trase, priebehu a nákladoch.

**Hlavné atribúty:** identifikátor, identifikátor používateľa, číslo letu, odletové letisko, príletové letisko, letecká spoločnosť, dátum a čas odletu, dátum a čas príletu, dĺžka letu, poznámka, nastavenie viditeľnosti, spôsob úhrady, cena letenky, mena, počet použitých míľ a prípadné dane a poplatky.

**Vzťahy:** každý let patrí jednému používateľovi, má jedno odletové a jedno príletové letisko a môže byť priradený jednej leteckej spoločnosti. K jednému letu môže patriť viacero fotografií a jedno hodnotenie.

### 3. Letisko (Airport)

Predstavuje letisko, z ktorého používateľ odlietal alebo na ktoré priletel.

**Hlavné atribúty:** identifikátor, názov letiska, IATA kód, ICAO kód, mesto, krajina, zemepisná šírka a zemepisná dĺžka.

**Vzťahy:** jedno letisko môže byť odletovým alebo príletovým letiskom pri viacerých letoch.

### 4. Letecká spoločnosť (Airline)

Predstavuje leteckú spoločnosť, s ktorou používateľ absolvoval let.

**Hlavné atribúty:** identifikátor, názov spoločnosti, IATA kód, ICAO kód, krajina pôvodu a logo spoločnosti.

**Vzťahy:** jedna letecká spoločnosť môže byť priradená k viacerým letom.

### 5. Fotografia letu (FlightPhoto)

Predstavuje fotografiu alebo obrázok priradený ku konkrétnemu letu.

**Hlavné atribúty:** identifikátor, identifikátor letu, názov súboru, cesta k súboru na serveri, popis a dátum nahratia.

**Vzťahy:** každá fotografia patrí jednému letu a jeden let môže obsahovať viacero fotografií.

### 6. Hodnotenie letu (FlightReview)

Predstavuje používateľské hodnotenie konkrétneho letu.

**Hlavné atribúty:** identifikátor, identifikátor letu, identifikátor používateľa, číselné hodnotenie a textová recenzia.

**Vzťahy:** každé hodnotenie patrí jednému letu a jednému používateľovi. V základnej verzii bude možné vytvoriť najviac jedno hodnotenie na jeden let.

## Vzťahy medzi entitami

- **Používateľ – Let (1:N):** jeden používateľ môže evidovať viacero letov, pričom každý let patrí konkrétnemu používateľovi.
- **Letisko – Let (1:N):** jedno letisko môže byť odletovým alebo príletovým letiskom pri viacerých letoch. V entite Let budú dva samostatné cudzie kľúče odkazujúce na letiská.
- **Letecká spoločnosť – Let (1:N):** jedna letecká spoločnosť môže byť priradená k viacerým letom.
- **Let – Fotografia letu (1:N):** jeden let môže mať viacero fotografií, ale každá fotografia patrí iba jednému letu.
- **Let – Hodnotenie letu (1:0..1):** jeden let môže mať najviac jedno hodnotenie. Hodnotenie bude môcť vytvoriť iba oprávnený používateľ.

## Hlavné stránky aplikácie

### 1. Úvodná stránka

Predstavuje aplikáciu mySkyLog, vysvetľuje jej účel a umožňuje návštevníkovi prejsť na registráciu, prihlásenie alebo verejne dostupný obsah.

### 2. Prihlásenie a registrácia

Obsahuje formuláre na vytvorenie používateľského účtu a bezpečné prihlásenie do aplikácie. Formuláre budú obsahovať klientsku aj serverovú validáciu a zrozumiteľné chybové hlásenia.

### 3. Používateľský dashboard

Zobrazuje prehľad používateľových letov, počet absolvovaných letov, celkovú nalietanú vzdialenosť, najčastejšie využívané letecké spoločnosti a finančné štatistiky. Súčasťou budú celkové výdavky na letenky, priemerná cena plateného letu, počet letov zaplatených míľami a celkový počet použitých míľ.

### 4. Môj denník letov

Zobrazuje tabuľku vlastných letov s možnosťou vyhľadávania, filtrovania a stránkovania. Používateľ môže prejsť na detail letu alebo vykonať povolené úpravy a mazanie záznamov.

### 5. Pridanie a úprava letu

Obsahuje formulár na vytvorenie nového letu alebo úpravu existujúceho záznamu. Používateľ vyberá letiská a leteckú spoločnosť z databázy a zadáva dátumy, časy a ďalšie údaje. Súčasťou formulára bude aj voliteľná sekcia na evidenciu ceny letenky, meny, spôsobu úhrady, počtu použitých míľ a poplatkov.

### 6. Detail letu

Zobrazuje podrobné informácie o konkrétnom lete, trase, letiskách, leteckej spoločnosti, poznámkach, fotografiách a hodnotení. Ak používateľ evidoval aj cenu alebo míle, zobrazia sa aj tieto údaje.

### 7. Katalóg letísk a leteckých spoločností

Umožňuje prehliadať, vyhľadávať a filtrovať letiská a letecké spoločnosti. Administrátor môže jednotlivé záznamy spravovať.

### 8. Profil používateľa

Zobrazuje profilové informácie a podľa nastavenia súkromia aj verejne dostupné údaje z denníka letov. Prihlásený používateľ môže upravovať vlastný profil a nastavenia viditeľnosti.

### 9. Administrácia

Obsahuje rozhranie určené administrátorovi na správu používateľov, letísk a leteckých spoločností a na kontrolu obsahu aplikácie.

## Rozdelenie funkcionality

### Základné funkcie

- Registrácia, prihlásenie a odhlásenie používateľa.
- Rozdelenie oprávnení podľa rolí a ochrana stránok určených prihláseným používateľom.
- Vytváranie, zobrazovanie, úprava a mazanie vlastných letov.
- Výpočet vzdialenosti medzi letiskami a celkovej nalietanej vzdialenosti.
- Kompletné CRUD operácie nad entitami Let a Letisko.
- Správa letísk a leteckých spoločností administrátorom.
- Vyhľadávanie, filtrovanie a stránkovanie záznamov o letoch.
- Voliteľná evidencia ceny letenky, meny a spôsobu úhrady.
- Evidencia letov zaplatených peniazmi, míľami alebo kombináciou oboch spôsobov.
- Evidencia počtu použitých míľ a prípadných daní a poplatkov.
- Zobrazovanie finančných štatistík vrátane celkových výdavkov, priemernej ceny plateného letu a celkového počtu použitých míľ.
- Pridávanie, zobrazovanie a mazanie fotografií priradených k letom.
- Základné hodnotenie a textová recenzia letu.
- Zobrazovanie štatistík o počte letov a nalietanej vzdialenosti.
- Klientska a serverová validácia formulárov.
- Ochrana pred SQL injection, bezpečné ukladanie hesiel a kontrola oprávnení pri práci s dátami.
- Minimálne dve zmysluplné AJAX funkcionality, napríklad filtrovanie letov bez obnovenia stránky a asynchrónne odosielanie formulára na pridanie alebo úpravu letu.
- Responzívne používateľské rozhranie pre počítače, tablety a mobilné zariadenia.
- Spustenie aplikácie prostredníctvom Dockeru vrátane inicializácie databázy a vloženia ukážkových dát.

### Rozširujúce funkcie

- Interaktívna mapa letov zobrazujúca trasy medzi letiskami.
- Grafické štatistiky podľa rokov, letísk a leteckých spoločností.
- Porovnávanie priemernej ceny letov medzi leteckými spoločnosťami.
- Sledovanie vývoja výdavkov v čase a porovnávanie nákladov podľa rokov.
- Evidencia odhadovanej peňažnej hodnoty využitých míľ a orientačný výpočet ich hodnoty.
- Verejné profily cestovateľov s možnosťou nastavenia súkromia.
- Pokročilejšia fotogaléria s náhľadmi obrázkov.
- Automatické dopĺňanie údajov o letiskách alebo letoch prostredníctvom externého API.
- Export denníka letov do súboru CSV alebo PDF.
- Pokročilé filtrovanie a triedenie záznamov.
- Vlastný vizuálny dizajn s využitím SCSS a pokročilých responzívnych prvkov.