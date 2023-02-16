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
