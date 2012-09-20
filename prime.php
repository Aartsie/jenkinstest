<?php 

    function next_prime($now) {
    
        // Deze functie zoekt het eerst volgende priemgetal op na $now
        // Voorbeeld: $now = 2
        // next_prime(2) geeft 3 terug
        
        // Definitie van priemgetal:
        // Een priemgetal is een natuurlijk getal groter dan 1 dat slechts deelbaar is door 1 en door zichzelf.
        // http://nl.wikipedia.org/wiki/Priemgetal
        
        // Controleer $now:
        // - Als $now negatief is, verander $now in 1
        // - Als $now 0 is, verander $now in 1
        // - Als $now type float is, geef FALSE terug
        
        if($now < 1) {
            $now = 1;
        }
        
        if(round($now, 0) != $now) {
            return FALSE;
        }
        
        // Ga alle getallen van 2 t/m $now af
        for($i = 2; $i < ($now + 1); $i++) {
        
            // Kijk of het delen van ($now + 1) door $i een geheel getal oplevert
            if(round(($now + 1) / $i) == ($now + 1) / $i) {
            
                // ($now + 1) is geen priemgetal, omdat het deelbaar is door $i
                // Voer de functie opnieuw uit met $now = $now + 1;
                return next_prime(($now + 1));
            
            }
            
        }
        
        // De for-loop is niet onderbroken, dus $now is door geen één getal te delen
        // Priemgetal is dus gevonden: geef het priemgetal terug
        return ($now + 1);
        
    }
    
    echo next_prime(2);

?>