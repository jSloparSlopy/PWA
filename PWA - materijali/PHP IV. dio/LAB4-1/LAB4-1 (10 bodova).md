# LAB4-1 (10 bodova)

## Zadatak

Napravite proizvoljnu bazu podataka s pripadajućom tablicom `users`. Tablica `users` treba imati:
- `id` (autoincrement)
- korisničko ime (unique)
- lozinku (255)
- razinu dozvole

Napraviti formu za registraciju koja se sastoji od polja za unos korisničkog imena i polja za unos lozinke, te gumba za slanje.

Napraviti PHP skriptu koja unosi nove korisnike u tablicu `users`, koristeći se `password_hash()` funkcijom za unos lozinke.

Prilikom registracije treba se provjeriti postoji li u tablici `users` uneseno korisničko ime:
- Ako je registracija uspješna treba ispisati **"Registracija je uspješna"**
- Ako nije (ako već postoji takvo korisničko ime) **"Korisničko ime se već koristi"**