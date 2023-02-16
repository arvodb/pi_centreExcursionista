import { Component, EventEmitter, Output } from '@angular/core';
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

  constructor(private router: Router) {}
  @Output() reset = new EventEmitter<boolean>()
  public currentRoute : string = '';
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
    }
  ];
  public sendReset() : void
  {
    this.reset.emit();
  }
  ngOnInit(){
    this.router.events
      .pipe(filter((event: any) => event instanceof NavigationEnd))
      .subscribe((event: NavigationEnd) => {
        this.currentRoute = event.url.slice(1);
      });

  }
}
