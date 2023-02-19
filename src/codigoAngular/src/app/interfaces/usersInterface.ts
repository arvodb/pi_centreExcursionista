export interface Users {
  userList: UserList[];
}

export interface UserList {
  ID:             number;
  NOMBRE_USUARIO: string;
  CONTRASEÑA:     string;
  CORREO:         string;
  PRIVILEGIO:     string;
}
