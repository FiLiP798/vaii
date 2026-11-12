INSERT INTO `flights`
    (`flight_number`, `departure_airport_id`, `arrival_airport_id`, `airline_id`, `flight_date`, `distance_km`, `ticket_price`, `payment_method`, `notes`)
SELECT s.flight_number, departure.id, arrival.id, airline.id, s.flight_date, s.distance_km, s.ticket_price, s.payment_method, s.notes
FROM (
    SELECT 'OS721' flight_number, 'VIE' departure_code, 'BCN' arrival_code, 'Austrian Airlines' airline_name, '2026-10-28' flight_date, 1360 distance_km, 148.90 ticket_price, 'Peniaze' payment_method, 'Jesenný výlet do Barcelony.' notes
    UNION ALL SELECT 'FR9462','BTS','STN','Ryanair','2026-10-14',1280,42.50,'Peniaze','Víkendový pobyt v Londýne.'
    UNION ALL SELECT 'LH1243','VIE','FRA','Lufthansa','2026-09-30',620,189.00,'Peniaze','Prestup na ďalší let.'
    UNION ALL SELECT 'OK523','PRG','CDG','Czech Airlines','2026-09-18',885,126.00,'Peniaze','Krátky výlet do Paríža.'
    UNION ALL SELECT 'LO500','WAW','JFK','LOT Polish Airlines','2026-09-02',6850,720.00,'Kombinácia','Dlhý let cez Atlantik.'
    UNION ALL SELECT 'OS739','VIE','ATH','Austrian Airlines','2026-08-21',1280,214.50,'Peniaze','Letná dovolenka v Grécku.'
    UNION ALL SELECT 'FR2315','BTS','MAN','Ryanair','2026-08-08',1470,0.00,'Míle','Let zaplatený míľami.'
    UNION ALL SELECT 'KL1904','VIE','AMS','KLM','2026-07-27',940,176.30,'Peniaze','Prestup v Amsterdame.'
    UNION ALL SELECT 'EW9751','VIE','DUS','Eurowings','2026-07-12',790,98.00,'Peniaze','Pracovná cesta.'
    UNION ALL SELECT 'LX1575','VIE','ZRH','SWISS','2026-06-29',600,232.75,'Peniaze','Návšteva Zürichu.'
    UNION ALL SELECT 'OS453','VIE','LHR','Austrian Airlines','2026-06-15',1235,205.00,'Kombinácia','Časť ceny pokrytá míľami.'
    UNION ALL SELECT 'FR2828','BTS','CIA','Ryanair','2026-06-01',790,67.90,'Peniaze','Predĺžený víkend v Ríme.'
    UNION ALL SELECT 'TK1886','VIE','IST','Turkish Airlines','2026-05-19',1270,258.40,'Peniaze','Prestup na let do Ázie.'
    UNION ALL SELECT 'QR184','VIE','DOH','Qatar Airways','2026-05-04',4230,0.00,'Míle','Odmena za nazbierané míle.'
    UNION ALL SELECT 'AY1472','VIE','HEL','Finnair','2026-04-20',1460,193.20,'Peniaze','Jarná návšteva Fínska.'
    UNION ALL SELECT 'OS705','VIE','BTS','Austrian Airlines','2026-04-05',56,89.00,'Peniaze','Krátky vnútroštátny let.'
    UNION ALL SELECT 'FR8124','BTS','DUB','Ryanair','2026-03-22',1650,54.90,'Peniaze','Návšteva Dublinu.'
    UNION ALL SELECT 'AF1239','VIE','CDG','Air France','2026-03-07',1040,221.00,'Kombinácia','Let s doplatkom k míľam.'
    UNION ALL SELECT 'IB3121','VIE','MAD','Iberia','2026-02-16',1810,167.80,'Peniaze','Zimný pobyt v Madride.'
    UNION ALL SELECT 'OS201','VIE','FRA','Austrian Airlines','2026-01-30',620,0.00,'Míle','Novoročný let za míle.') s
JOIN `airports` departure ON departure.iata_code = s.departure_code
JOIN `airports` arrival ON arrival.iata_code = s.arrival_code
JOIN `airlines` airline ON airline.name = s.airline_name;
