import { Component } from '@angular/core';
import { CalendarInfo } from 'src/app/interfaces/CalendarInfoInterface';
import { HeaderTitles } from 'src/app/interfaces/headerInterface';
import { StorageService } from 'src/app/services/storage.service';
@Component({
  selector: 'app-events-calendar',
  templateUrl: './events-calendar.component.html',
  styleUrls: ['./events-calendar.component.css']
})
export class EventsCalendarComponent {

  constructor(private headerService: StorageService) {}

  public calendarNums : number[][] = [];
  public colsCalendar : number = 7;
  public headerData : HeaderTitles = {
    section:'calendar',
    title: 'Calendario',
    caption: 'No te pierdas nada'
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

  public calendarInfo : CalendarInfo[] = [
    {
      type:'Evento',
      titular:'Trail 30k Benimodo',
      body:'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.'
    },
    {
      type:'Evento',
      titular:'Trail 30k Benimodo',
      body:'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.'
    },
    {
      type:'Evento',
      titular:'Trail 30k Benimodo',
      body:'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.'
    },
    {
      type:'Evento',
      titular:'Trail 30k Benimodo',
      body:'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.'
    },
    {
      type:'Evento',
      titular:'Trail 30k Benimodo',
      body:'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.'
    },
  ]

  ngOnInit(){
    this.fillCalendar();
  }

}
