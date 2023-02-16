import { StorageService } from 'src/app/services/storage.service';
import { HeaderTitles } from './../../interfaces/headerInterface';
import { Component, Input } from '@angular/core';
@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent {
  constructor(private headerService: StorageService) {}
  @Input() userName = '';
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
