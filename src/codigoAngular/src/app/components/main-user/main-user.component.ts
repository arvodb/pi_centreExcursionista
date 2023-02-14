import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { HeaderTitles } from 'src/app/interfaces/headerInterface';
import { Location } from '@angular/common';

@Component({
  selector: 'app-main-user',
  templateUrl: './main-user.component.html',
  styleUrls: ['./main-user.component.css']
})
export class MainUserComponent {

  constructor(private location: Location) {
    let badUrl = location.path().split('');
    badUrl.shift();
    this.currentUrl = badUrl.join('');

    for(let i = 0; i < this.pageHeader.length;i++){
      if(this.pageHeader[i].section === this.currentUrl){
        this.page = i
      }
    }
  }
  public page : number = 0;
  public currentUrl: string;
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

  ngOnInit(){
    console.log(this.currentUrl)
  }
}
