import { Component, Output, EventEmitter } from '@angular/core';
import { HeaderTitles } from 'src/app/interfaces/headerInterface';
import { StorageService } from 'src/app/services/storage.service';

@Component({
  selector: 'app-dashboard-user',
  templateUrl: './dashboard-user.component.html',
  styleUrls: ['./dashboard-user.component.css']
})
export class DashboardUserComponent {

  constructor(private headerService: StorageService) {}

  public calendarNums : number[][] = [];
  public colsCalendar : number = 7;
  public headerData : HeaderTitles = {
    section:'dashboard',
    title: 'Panel de usuario',
    caption: 'Bienvenido'
  }
  public fillCalendar() : void {
    let num = 30;
    let array = [];
    let row = [];
    for (let i = 1; i <= num; i++) {
      row.push(i);
      if (row.length === this.colsCalendar || i === num) {
        array.push(row);
        row = [];
      }
    }
    this.calendarNums = array;
  }

  public setNewHeader(target : string) : void
  {
    this.headerService.setCurrentHeader(target)
  }

  ngOnInit(){
    this.fillCalendar();

  }
}


