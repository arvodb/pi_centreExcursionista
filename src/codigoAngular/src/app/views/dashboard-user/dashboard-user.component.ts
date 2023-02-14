import { Component } from '@angular/core';

@Component({
  selector: 'app-dashboard-user',
  templateUrl: './dashboard-user.component.html',
  styleUrls: ['./dashboard-user.component.css']
})
export class DashboardUserComponent {
  public calendarNums : number[][] = [];
  public colsCalendar : number = 7
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
  ngOnInit(){
    this.fillCalendar();
  }
}


