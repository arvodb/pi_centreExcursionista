import { DashboardUserComponent } from './views/dashboard-user/dashboard-user.component';
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { BookingMaterialComponent } from './views/booking-material/booking-material.component';
import { EventsCalendarComponent } from './views/events-calendar/events-calendar.component';
import { LoginComponent } from './views/login/login.component';
import { MainUserComponent } from './components/main-user/main-user.component';
import { AppComponent } from './app.component';


const routes: Routes = [
  {path:'', redirectTo: 'login', pathMatch: 'full'},
  {path:'login', component: LoginComponent},
  {path:'dashboard',component: DashboardUserComponent},
  {path:'bookingMaterial',component: BookingMaterialComponent},
  {path:'calendar',component:EventsCalendarComponent},
  {path:'main',component:MainUserComponent},
  {path:'logout',component:AppComponent},
  { path: '**', pathMatch: 'full', component:  LoginComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
