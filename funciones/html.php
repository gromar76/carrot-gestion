<?php
 
    function dameOpcionesDelSelect( $registros, $idSeleccionado = NULL, $campoId='id', $campoLeyenda='nombre' ){
        // variables $campoId y $campoLeyenda son opcionales y por default les pongo yo id y nombre

        $opcionesSelect = "";

        foreach ( $registros as $registro)
        {
            $selected = $idSeleccionado == $registro[$campoId] ? "selected" : "";
            
            $opcionesSelect .= '<option value="' . $registro[$campoId] . '"' . $selected . '>' . $registro[$campoLeyenda].'</option>';                                                       
        }

        return  $opcionesSelect;
    }