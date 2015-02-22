<?php

function typeToText($type, $value) {
     switch ($type) {
         case 'temp':
             return 'Odczytano temperaturę (' . $value . ' st C)';
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
         case 'motion':
             return 'Wykryto ruch';

         default:
             return 'Nieznany typ komunikatu (' . $type . ')';
     }
}
