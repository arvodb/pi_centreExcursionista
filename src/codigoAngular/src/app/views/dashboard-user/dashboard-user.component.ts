import { Component, Output, EventEmitter } from '@angular/core';
import { Reserva, Reservas } from 'src/app/interfaces/ReservasInterface';
import { HeaderTitles } from 'src/app/interfaces/headerInterface';
import { ServiceService } from 'src/app/services/service.service';
import { StorageService } from 'src/app/services/storage.service';


@Component({
  selector: 'app-dashboard-user',
  templateUrl: './dashboard-user.component.html',
  styleUrls: ['./dashboard-user.component.css']
})
export class DashboardUserComponent {

  constructor(private userData: StorageService,private servicio : ServiceService) {}

  public loading : boolean = false;
  public calendarNums : number[][] = [];
  public colsCalendar : number = 7;
  public headerData : HeaderTitles = {
    section:'dashboard',
    title: 'Panel de usuario',
    caption: 'Bienvenido'
  }
  public userBooking : Reserva[] =[
    {
      USUARIO_NOMBRE:   '',
      MATERIAL_NOMBRE:  '',
      CANTIDAD:         0,
      ESTADO:           '',
      FECHA_RESERVA:    '',
      FECHA_DEVOLUCION: '',
    }
  ]
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

  public getBooking() : void
  {
    this.loading = (this.userBooking[0].USUARIO_NOMBRE != '') ? false : true;
    this.servicio.getReservaMaterial().subscribe((response) => {
      this.userBooking = response.reservas.filter((booking) => {return booking.USUARIO_NOMBRE === this.userData.getUser().NOMBRE_USUARIO});
      console.log(this.userBooking,this.userData.getUser());
      this.loading = false;
    });
  }
  public formatDate(date : string) : string
  {
    // Analizar la fecha en un objeto Date
    const partesFecha = date.split('/');
    const dia = +partesFecha[0];
    const mes = +partesFecha[1];
    const anio = +partesFecha[2];
    const dateFormat = new Date(anio, mes - 1, dia);

    // Formatear la fecha en "d mes"
    const opcionesFecha : Intl.DateTimeFormatOptions = { day: 'numeric', month: 'long' };
    const fechaFormateada = dateFormat.toLocaleDateString('es-ES', opcionesFecha);

    return fechaFormateada
  }

  ngOnInit(){
    this.fillCalendar();
    this.getBooking();
  }
}


