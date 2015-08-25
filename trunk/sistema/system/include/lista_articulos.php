<?php

    class ListaArticulos {
        
        const ANULADO = -1;
        
        var $articulos;
        var $id_articulos;
        var $num_items;
        
        function __construct() {
            $this->clear();
        }
        
        function add($codigo, $descripcion, $precio, $alicuota, $cantidad) {
            if ($this->exists($codigo)) {
                $this->articulos[$this->id_articulos[$codigo]]['cantidad'] += $cantidad;
            }
            else {
                $this->articulos[] = array(
                    'codigo' => $codigo,
                    'descripcion' => $descripcion,
                    'precio' => $precio,
                    'alicuota' => $alicuota,
                    'cantidad' => $cantidad
                );
                $this->id_articulos[$codigo] = sizeof($this->articulos) - 1;
                $this->num_items++;
            }
        }
        
        function remove($codigo){
            $this->articulos[$this->id_articulos[$codigo]] = NULL;
            $this->id_articulos[$codigo] = self::ANULADO;
            unset($this->articulos[$this->id_articulos[$codigo]]);
            unset($this->id_articulos[$codigo]);
            $this->num_items--;
        }
        
        function clear() {
            $this->articulos = array();
            $this->id_articulos = array();
            $this->num_items = 0;
        }
        
        function change_quantity($codigo, $cantidad) {
            if ($this->exists($codigo)) {
                $this->articulos[$this->id_articulos[$codigo]]['cantidad'] = $cantidad;
            }
        }
        
        function exists($codigo) {
            if(array_key_exists($codigo, $this->id_articulos)) {
                if ($this->id_articulos[$codigo] != self::ANULADO) {
                    return TRUE;
                }
            }
            return FALSE;
        }
        
        function get_item($codigo) {
            if (isset($this->id_articulos[$codigo]) && $this->id_articulos[$codigo] != self::ANULADO) {
                return $this->articulos[$this->id_articulos[$codigo]];
            }
            return NULL;
        }
        
        function get_items_ids() {
            return $this->id_articulos;
        }
        
        function num_items() {
            return $this->num_items;
        }
        
        function total_items() {
            $total = array();
            for ($i = 0; $i < sizeof($this->articulos); $i++) {
                if ($this->articulos[$i] != NULL && $this->id_articulos[$this->articulos[$i]['codigo']] != self::ANULADO) {
                    $total += $this->articulos[$i]['cantidad'];
                }
            }
            return $total;
        }
        
        function get_items() {
            $arr_art = array();
            for ($i = 0; $i < sizeof($this->articulos); $i++) {
                if ($this->articulos[$i] != NULL && $this->id_articulos[$this->articulos[$i]['codigo']] != self::ANULADO) {
                    $arr_art[] = $this->articulos[$i];
                }
            }
            return $arr_art;
        }
        
        function get_importe($codigo) {
            $art = $this->id_articulos[$codigo];
            return $this->articulos[$art]['cantidad'] * $this->articulos[$art]['precio'];
        }
        
        function get_iva($codigo) {
            $art = $this->id_articulos[$codigo];
            return $this->articulos[$art]['cantidad'] * $this->articulos[$art]['precio'] * $this->articulos[$art]['alicuota'] / 100;
        }
        
        function get_total() {
            $total = 0;
            foreach ($this->articulos as $art) {
                $total += $art['cantidad'] * $art['precio'];
            }
            return $total;
        }
        
        function get_total_iva() {
            $total = 0;
            foreach ($this->articulos as $art) {
                $total += $art['cantidad'] * $art['precio'] * $art['alicuota'] / 100;
            }
            return $total;
        }
        
    }
    
?>