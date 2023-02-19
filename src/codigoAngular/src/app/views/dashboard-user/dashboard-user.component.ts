import { Component } from '@angular/core';
import { Reserva } from 'src/app/interfaces/ReservasInterface';
import { HeaderTitles } from 'src/app/interfaces/headerInterface';
import { MaterialsService } from 'src/app/services/materials.service';
import { StorageService } from 'src/app/services/storage.service';


@Component({
  selector: 'app-dashboard-user',
  templateUrl: './dashboard-user.component.html',
  styleUrls: ['./dashboard-user.component.css']
})
export class DashboardUserComponent {

  constructor(private storageService: StorageService,private materialsService : MaterialsService) {
    this.currentDate = this.setCurrentDate();
    this.calendarNums = this.fillCalendar( this.currentDate.month, this.currentDate.year );
    this.currentCalendar = { month:this.currentDate.month, year:this.currentDate.year }
  }

  ngOnInit(){
    //Obtiene las reservas del material del usuario
    let data = localStorage.getItem('materialBookings');
    if(data == null){
      this.getBooking();
    } else {
      this.userBooking = JSON.parse(data);
    }
    this.getDatesForCalendar();
  }
  public currentDate : { day:number, month:string, year:number };//constructed
  public currentCalendar : { month:string, year:number };//constructed
  public loading : boolean = false;
  public calendarNums : number[][];//constructed
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
      CANTIDAD:          0,
      ESTADO:           '',
      FECHA_RESERVA:    '',
      FECHA_DEVOLUCION: '',
    }
  ]
  public bookingFormated : { user:string, material: {name:string , quantity:number}[], bDate:string, dDate:string }[] = [];
  public currentBookingDates : { month:string, bDate:number, dDate:number }[] = []

  public fillCalendar(monthName : string, year:number) :number[][] {
    //Máximo de días del mes
    let maxDays = this.monthMaxDays(monthName, year);
    //Número en tre el 0 y el 7 que determina la posición de un array con días de la semana
    const auxFirstDay = new Date(year,this.monthToNumber(monthName), 1).getDay();
    //Ajuste para que la semana comience en Lunes y no en domingo.
    let firstDay = auxFirstDay === 0 ? 7 : auxFirstDay;
    let calendar = []
    let row = []
    let firstWeek = true;
    for (let day = 1; day <= maxDays; day++) {
      if (row.length < firstDay - 1 && calendar.length < 1 && firstWeek) {
        // Si todavía no llegamos al primer día del mes pon un 0
        row.push(0);
        day --;
      } else {
        // Agregar primer día del mes
        firstWeek = false;
        row.push(day);
      }

      // Si se llegó al final de la semana, agregar la semana al calendario
      if (row.length === 7) {
        calendar.push(row);
        row = [];
      }
    }
    if (row.length > 0) {
      // Si quedaron días sin agregar a la última semana, agregar la semana al calendario
      for (let i = row.length; i < 7; i++) {
        // Completar los días faltantes con 0
        row.push(0);
      }
      calendar.push(row);
    }

    console.log(calendar);
    return calendar;
  }

  public getBooking() : void
  {
    this.loading = (this.userBooking[0].USUARIO_NOMBRE != '') ? false : true;
    this.materialsService.getBookingMaterial().subscribe((response) => {
      this.userBooking = response.reservas.filter((booking) => {return booking.USUARIO_NOMBRE === this.storageService.getUser().NOMBRE_USUARIO});
      this.currentBookingDates = this.getDatesForCalendar();

      /* for(let booking of this.userBooking){
        let groupBooking : { user:string, material: {name:string , quantity:number}[], bDate:string, dDate:string } | undefined;

        for (let group of this.bookingFormated) {
          if(
            group.bDate === booking.FECHA_RESERVA &&
            group.dDate === booking.FECHA_DEVOLUCION
          ) {
            groupBooking = group;
            break;
          }
        }
        if(groupBooking){
          groupBooking.material.push({name:booking.MATERIAL_NOMBRE,quantity:booking.CANTIDAD});
        } else {
          this.bookingFormated.push({
            user:booking.USUARIO_NOMBRE,
            material:[{name:booking.MATERIAL_NOMBRE,quantity:booking.CANTIDAD}],
            bDate:new Date(booking.FECHA_RESERVA).getDay().toString(),
            dDate:new Date(booking.FECHA_DEVOLUCION).getDay().toString()
          });
        }
      }
      console.log(this.bookingFormated);
 */
      });
      localStorage.setItem('materialBookings',JSON.stringify(this.userBooking));
      this.loading = false;
    };


  public formatDate(date : string) : string
  {
    // transforma la fecha en un objeto Date
    let splittedDate = date.split('/');
    let day = +splittedDate[0];
    let month = +splittedDate[1];
    let year = +splittedDate[2];
    let dateFormat = new Date(year, month - 1, day);

    // Formatear la fecha en "d mes"
    let dateOptions : Intl.DateTimeFormatOptions = { day: 'numeric', month: 'long' };
    let formatedDate = dateFormat.toLocaleDateString('es-ES', dateOptions);

    return formatedDate
  }

  public setCurrentDate() : {day:number ,month:string ,year:number} {
    let date = new Date()
    let dayNumber = date.getDate();
    let monthString = this.monthToName(date.getMonth());
    let year = date.getFullYear();

    return {day:dayNumber ,month:monthString ,year:year}
  }

  public monthToName(monthNumber: number): string {
    const arrMonths = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    return arrMonths[monthNumber];
  }

  public monthToNumber(monthName : string ) : number {
    const arrMonths = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    return arrMonths.indexOf(monthName) + 1;
  }

  public monthMaxDays (monthName : string, year: number) : number
  {
    const maxDays = new Date(year, this.monthToNumber(monthName) + 1, 0).getDate();
    return maxDays;
  }
  //{month:string,bDate:number,dDate:number}[]
  public getDatesForCalendar() : {month:string,bDate:number,dDate:number}[]
  {
    let output = this.userBooking.map((reserva) => {

      let splittedBookingDate =reserva.FECHA_RESERVA.split('/');
      let splittedDueDate = reserva.FECHA_DEVOLUCION.split('/');

      let month = this.monthToName(+(splittedBookingDate[1])-1);
      let bookingDay = +(splittedBookingDate[0]);
      let dueDay = +(splittedDueDate[0])

      return {
        month: month, bDate: bookingDay, dDate: dueDay
      }
    });

    console.log(output);
    return output;
  }


}


