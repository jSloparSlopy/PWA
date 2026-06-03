# LAB4-2 (10 bodova)

## Zadatak

Potrebno je napraviti dva PHP dokumenta. Jedan u kojem se nalazi forma za prijavu i drugi u kojem se provjerava SESSION.

U prvom dokumentu, potrebno je napraviti formu za prijavu koja se sastoji od:
- polja za unos korisničkog imena
- polja za unos lozinke
- gumba za slanje

Korištenjem forme potrebno je napraviti prijavu u bazu (iz prvog zadatka). Prilikom prijave potrebno je provjeriti postoji li korisnik u bazi i koju razinu dozvole posjeduje.

Ako korisnik postoji potrebno je provjeriti razinu dozvole:
- Ako je korisnik administrator na stranici se ispisuje **"Dobro došli. Vaša razina je administrator. NEXT(link na drugu stranicu)"**
- Ako nije administrator, treba ispisati **"Dobro došli. NEXT(link na drugu stranicu)"**

Nakon prijave treba postaviti sessione.

U drugom dokumentu treba napraviti stranicu koja korištenjem sessiona i session varijabli stvorenih na prvoj stranici ispisuje:
- **"Dobro došli $korisnicko_ime. Vaša razina je administrator."** — ako je korisnik administrator
- **"Dobro došli $korisnicko_ime."** — ako korisnik nema potrebnu razinu dozvole

## Napomena
- Za provjeru lozinke koristiti funkciju `password_verify()`
- Sve ukupno je potrebno napraviti dva PHP dokumenta: jedan u kojem se nalazi forma za prijavu i drugi na koji vode linkovi NEXT u kojem se ispisuju poruke ovisno o razini dozvole