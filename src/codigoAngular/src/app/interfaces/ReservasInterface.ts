export interface Reservas {
  reservas: Reserva[];
}

export interface Reserva {
  USUARIO_NOMBRE:   string;
  MATERIAL_NOMBRE:  string;
  CANTIDAD:         number;
  ESTADO:           string;
  FECHA_RESERVA:    string;
  FECHA_DEVOLUCION: string;
}

export interface InsertReserva {
  USUARIO_ID:       number;
  MATERIAL_ID:      number;
  CANTIDAD:         number;
  ESTADO:           string;
  FECHA_RESERVA:    string;
  FECHA_DEVOLUCION: string;
}
/*
    let fechaReserva = this.dia1+'/'+this.mes1+'/'+this.anyo1+'/';
    let fechaDevolucion = this.dia2+'/'+this.mes2+'/'+this.anyo2+'/';
*/
