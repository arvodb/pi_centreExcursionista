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
      this.bookingFormated = JSON.parse(data);
      this.getCurrentMonthBookings();
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
  public bookingFormated : any[] = [];
  public currentBookingDates : any[] = [];

  public calendarControl(isNext : boolean) : void
  {

  }

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
    return calendar;
  }

  public isEventDay(day : number) : boolean {
    for(const booking of this.currentBookingDates){
      if(day >= booking.bookingDay && day <= booking.dueDay){
        return true;
      }
    }
    return false
  }

  public getBooking() : void
  {
    this.loading = (this.userBooking[0].USUARIO_NOMBRE != '') ? false : true;
    this.materialsService.getBookingMaterial().subscribe((bookingList) => {
      this.userBooking = bookingList.reservas.filter((booking) => {
          return booking.USUARIO_NOMBRE === this.storageService.getUser().NOMBRE_USUARIO
      });

      this.organizeBookings();
      this.getCurrentMonthBookings();
      this.currentBookingDates = this.getDatesForCalendar();
      localStorage.setItem('materialBookings',JSON.stringify(this.bookingFormated));
      this.loading = false;

    });
  }

  public deleteBooking(bookingGroup : any[]) : void
  {
    let currentUser : any = localStorage.getItem('user');
        currentUser = (currentUser) ? JSON.parse(currentUser).ID : currentUser;
    for(const booking of bookingGroup){
      this.materialsService.getMaterials().subscribe((material) => {
        let materialId = material.materials.filter( m => m.NOMBRE === booking.MATERIAL_NOMBRE).pop()?.ID
            materialId = (materialId != undefined) ? materialId : 0;
          console.log(booking.MATERIAL_NOMBRE,materialId);
            //No funciona
            //this.materialsService.deleteBooking(parseInt(currentUser), materialId,booking.FECHA_RESERVA);
      });
    }
    this.getBooking();
  }

  public getCurrentMonthBookings() : void {
    let auxBookingFormated = this.bookingFormated;
    for(const bookingGroup of auxBookingFormated){
        //si se reservó este mes
        if(this.monthToNumber(this.currentDate.month) == bookingGroup[0].FECHA_RESERVA.split('/')[1]){
          const bookingDateNum = parseInt(bookingGroup[0].FECHA_RESERVA.split('/')[0]);

          let dueDateNum = parseInt(bookingGroup[0].FECHA_DEVOLUCION.split('/')[0]);
          //Si se devuelve el mes que viene
          dueDateNum = (dueDateNum >= 31) ? 31 : dueDateNum;

          this.currentBookingDates.push({bookingDay:bookingDateNum,dueDay:dueDateNum});
        }
        //Si se reservó el mes anterior pero se devuelve este
        if(this.monthToNumber(this.currentDate.month) == bookingGroup[0].FECHA_DEVOLUCION.split('/')[1] &&
           this.monthToNumber(this.currentDate.month) > bookingGroup[0].FECHA_RESERVA.split('/')[1])
        {
          this.currentBookingDates.push({bookingDay:1,dueDay:parseInt(bookingGroup[0].FECHA_DEVOLUCION.split('/')[0])});
        }
    }
    console.log('currentMonthBookings',this.currentBookingDates,'TotalBookings',this.bookingFormated);
  }

  public organizeBookings() : void
  {
    for(const booking of this.userBooking){
      const groupedBookings = [];
      for(let i = 0 ; i < this.userBooking.length ; i++){

        if(booking.FECHA_RESERVA === this.userBooking[i].FECHA_RESERVA &&
           booking.FECHA_DEVOLUCION === this.userBooking[i].FECHA_DEVOLUCION &&
           booking.MATERIAL_NOMBRE !== this.userBooking[i].MATERIAL_NOMBRE) {

            groupedBookings.push(this.userBooking[i]);
            this.userBooking.splice(i,1);
        }
      }
      groupedBookings.push(booking);
      this.bookingFormated.push(groupedBookings)
    }
    console.log('booking Formated', this.bookingFormated);
  }

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
    return output;
  }


}


