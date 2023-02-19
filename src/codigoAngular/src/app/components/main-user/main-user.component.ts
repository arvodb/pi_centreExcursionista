import { Component } from '@angular/core';
import { NavigationEnd, Router } from '@angular/router';
import { filter } from 'rxjs/operators';
import { HeaderTitles } from 'src/app/interfaces/headerInterface';
import { StorageService } from 'src/app/services/storage.service';


@Component({
  selector: 'app-main-user',
  templateUrl: './main-user.component.html',
  styleUrls: ['./main-user.component.css']
})
export class MainUserComponent {

  constructor(private router: Router,private headerService : StorageService) {}
  public currentRoute : string = this.headerService.getCurrentHeader().section;
  public userName = 'Dani'
  public pageHeader : HeaderTitles[] = [
    {
      section:'dashboard',
      title: 'Panel de usuario',
      caption: 'Bienvenido'
    },
    {
      section:'calendar',
      title: 'Calendario',
      caption: 'No te pierdas nada'
    },
    {
      section:'bookingMaterial',
      title: 'Reserva de Material',
      caption: 'Prepara tu expedición'
    }
  ];

  ngOnInit(){
    this.router.events
      .pipe(filter((event: any) => event instanceof NavigationEnd))
      .subscribe((event: NavigationEnd) => {
        this.currentRoute = event.url.slice(1);
      });
  }
}
