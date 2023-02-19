import { StorageService } from 'src/app/services/storage.service';
import { HeaderTitles } from './../../interfaces/headerInterface';
import { Component, Input } from '@angular/core';
import { UserList } from 'src/app/interfaces/usersInterface';
@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent {
  constructor(private headerService: StorageService) {
    let data = localStorage.getItem('user');
    this.userName = (data) ?
    JSON.parse(data).NOMBRE_USUARIO :
    {  ID:            0,
      NOMBRE_USUARIO: '',
      CONTRASEÑA:     '',
      CORREO:         '',
      PRIVILEGIO:     '',
    };
  }
  public userName : string;
  @Input() currentRoute = '';

  public pageHeaders : HeaderTitles[] = [
    {
      section:'dashboard',
      title: 'Panel de usuario',
      caption: 'Bienvenido'
    },
    {
      section:'calendar',
      title: 'Calendario',
      caption: 'No te pierdas nada'
    }
  ];
  ngOnInit(){

  }
}
