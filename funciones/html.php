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



    function dameOpcionesDelSelect2( $registros, $idSeleccionado = NULL, $campoId='id', $campoLeyenda='nombre' ){
        // variables $campoId y $campoLeyenda son opcionales y por default les pongo yo id y nombre

        $opcionesSelect = "";

        foreach ( $registros as $registro)
        {
            $selected = $idSeleccionado == $registro[$campoId] ? "selected" : "";
            
            //$opcionesSelect .= '<option value="' . $registro[$campoId] . '"' . $selected . '>' . $registro['apellido'] .' '.$registro['nombre'].' - '.' WS: '.trim($registro['whatsapp']).'</option>';                                                       
            $opcionesSelect .= '<option value="' . $registro[$campoId] . '"' . $selected . '>' . $registro['nombre'] .' '.$registro['apellido'].' - '.' WS: '.trim($registro['whatsapp']).'</option>';                                                       
        }

        return  $opcionesSelect;
    }