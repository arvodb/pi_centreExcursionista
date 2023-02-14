import { DashboardUserComponent } from './views/dashboard-user/dashboard-user.component';
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { BookingMaterialComponent } from './views/booking-material/booking-material.component';
import { EventsCalendarComponent } from './views/events-calendar/events-calendar.component';


const routes: Routes = [
  {path:'', redirectTo: 'dashboard', pathMatch: 'full'},
  {path:'dashboard',component: DashboardUserComponent},
  {path:'bookingMaterial',component: BookingMaterialComponent},
  {path:'calendar',component:EventsCalendarComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
