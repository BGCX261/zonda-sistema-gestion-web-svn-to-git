<?php

    class AgendaPagos extends TableHandler {
        
        public function __construct() {
            parent::__construct();
            $query = "
                SELECT
                    ventas.codigo,
                    clientes.razon,
                    condiciones_venta.descripcion,
                    ventas.fecha,
                    CONCAT(condiciones_venta.cuotas - TRUNCATE(ventas.saldo / ventas.monto * condiciones_venta.cuotas, 0), ' de ', condiciones_venta.cuotas) 'cuotas',
                    DATE_FORMAT(
                        IF(STRCMP(condiciones_venta.intervalo,'DIA') = 0,
                            DATE_ADD(
                                ventas.fecha,
                                INTERVAL
                                condiciones_venta.plazo * (1 + condiciones_venta.cuotas - TRUNCATE(ventas.saldo / ventas.monto, 0) * condiciones_venta.cuotas)
                                DAY
                            ),
                            IF(STRCMP(condiciones_venta.intervalo,'MES') = 0,
                                DATE_ADD(
                                    ventas.fecha,
                                    INTERVAL
                                    condiciones_venta.plazo * (1 + condiciones_venta.cuotas - TRUNCATE(ventas.saldo / ventas.monto, 0) * condiciones_venta.cuotas)
                                    MONTH
                                ),
                                IF(STRCMP(condiciones_venta.intervalo,'ANO') = 0,
                                    DATE_ADD(
                                        ventas.fecha,
                                        INTERVAL
                                        condiciones_venta.plazo * (1 + condiciones_venta.cuotas - TRUNCATE(ventas.saldo / ventas.monto, 0) * condiciones_venta.cuotas)
                                        YEAR
                                    ),
                                    'ERROR'
                                )
                            )
                        ),
                        '%d/%m/%Y'
                    ) 'vencimiento',
                    IF(STRCMP(condiciones_venta.intervalo,'DIA') = 0,
                        IF(DATE_ADD(
                                ventas.fecha,
                                INTERVAL
                                condiciones_venta.plazo * (1 + condiciones_venta.cuotas - TRUNCATE(ventas.saldo / ventas.monto, 0) * condiciones_venta.cuotas)
                                DAY
                            ) < NOW(),
                            'Vencida',
                            'Por vencer'
                        ),
                        IF(STRCMP(condiciones_venta.intervalo,'MES') = 0,
                            IF(DATE_ADD(
                                    ventas.fecha,
                                    INTERVAL
                                    condiciones_venta.plazo * (1 + condiciones_venta.cuotas - TRUNCATE(ventas.saldo / ventas.monto, 0) * condiciones_venta.cuotas)
                                    MONTH
                                ) < NOW(),
                                'Vencida',
                                'Por vencer'
                            ),
                            IF(STRCMP(condiciones_venta.intervalo,'AÑO') = 0,
                                IF(DATE_ADD(
                                        ventas.fecha,
                                        INTERVAL
                                        condiciones_venta.plazo * (1 + condiciones_venta.cuotas - TRUNCATE(ventas.saldo / ventas.monto, 0) * condiciones_venta.cuotas)
                                        YEAR
                                    ) < NOW(),
                                    'Vencida',
                                    'Por vencer'
                                ),
                                'ERROR'
                            )
                        )
                    ) 'estado',
                    ventas.monto,
                    ventas.saldo   
                FROM
                    ventas,
                    clientes,
                    condiciones_venta
                WHERE
                    ventas.cliente = clientes.codigo 
                    AND 
                    ventas.condicion = condiciones_venta.codigo 
                    AND 
                    condiciones_venta.cuotas > 0 
                    AND 
                    ventas.saldo > 0 ";
            parent::set_query($query);
        }
        
    }
    
?>
