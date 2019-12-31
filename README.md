# Tombola!
Una tombola proiettabile scritta in JavaScript e PHP!

![Logo Tombola!](https://raw.githubusercontent.com/azzlabs/tombola-ajax/master/Logo.png)

## Installazione
Per utilizzarla basta copiare i file in una cartella del webserver e accedervi da client, nessun altro setup richiesto!
Per ora, il tabellone non utilizza un database ma salva tutto su un file `.json` (default: `db.json`): se non dovesse funzionare, accertarsi che il webserver abbia il permesso di scrittura su quel file!

## Utilizzo
E' possibile aprire il tabellone su qualsiasi dispositivo e ogni istanza aperta si sincronizzerà in automatico con le altre: è utile per avere, per esempio, un'istanza su un proiettore o televisore e un'altra istanza su table, telefono o pc, per poter estrarre i numeri.
Tramite il menu in basso, è possibile resettare il tabellone e disabilitare la sincronizzazione automatica (i numeir chimati verranno comunque salvati su file e sincronizzati sulle atre istanze)

![Screenshot Tombola!](https://raw.githubusercontent.com/azzlabs/tombola-ajax/master/screenshot.png)

## TO-DO list
- Aggiungere una schermata iniziale
- Aggiungere la modalità multi-utente
- Aggiungere generazione e visualizzazione di cartelle
