<?php

function typeToText($type, $value) {
     switch ($type) {
         case 'temp':
             return 'Odczytano temperaturę (' . $value . ' st C)';
         case 'foto':
             return 'Odczytano jasność (' . $value . ')';
         case 'light1':
             if ($value == 1) {
                 return 'Zapalono światło 1';
             } else {
                 return 'Zgaszono światło 1';
             }
         case 'light2':
             if ($value == 1) {
                 return 'Zapalono światło 2';
             } else {
                 return 'Zgaszono światło 2';
             }
         case 'outlet1':
             if ($value == 1) {
                 return 'Załączono kontakt 1';
             } else {
                 return 'Wyłączono kontakt 1';
             }
         case 'outlet2':
             if ($value == 1) {
                 return 'Załączono kontakt 2';
             } else {
                 return 'Wyłączono kontakt 2';
             }
         case 'window':
             if ($value == 1) {
                 return 'Otworzono okno';
             } else {
                 return 'Zamknięto okno';
             }
         case 'motion':
             return 'Wykryto ruch';

         default:
             return 'Nieznany typ komunikatu (' . $type . ')';
     }
}
