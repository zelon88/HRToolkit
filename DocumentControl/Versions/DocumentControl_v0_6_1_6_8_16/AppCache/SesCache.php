<?php

    $FilesToProc = 0; 
    if ($handle1 = opendir($OutputLoc)) {
      while (($TEMPFile = readdir($handle1)) !== false){
        if (!in_array($TEMPFile, array('.', '..')) && !is_dir($OutputLoc.$TEMPFile)) 
            $FilesToProc++; } } 