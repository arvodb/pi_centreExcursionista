import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { HeaderTitles } from 'src/app/interfaces/headerInterface';

@Component({
  selector: 'app-main-user',
  templateUrl: './main-user.component.html',
  styleUrls: ['./main-user.component.css']
})
export class MainUserComponent {
  constructor(private router: Router) { }

  ngOnInit(){
    this.router.navigate(['/user']);
  }
  public userName = 'Dani'
  public pageHeader : HeaderTitles[] = [
    {
      section:'dashboard',
      title: 'Panel de usuario',
      caption: 'Bienvenido'
    }
  ]
}
