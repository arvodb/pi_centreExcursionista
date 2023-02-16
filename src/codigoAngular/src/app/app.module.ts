import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';


import { DashboardUserComponent } from './views/dashboard-user/dashboard-user.component';
import { HeaderComponent } from './components/header/header.component';
import { BookingMaterialComponent } from './views/booking-material/booking-material.component';
import { NavComponent } from './components/nav/nav.component';
import { EventsCalendarComponent } from './views/events-calendar/events-calendar.component';
import { LoginComponent } from './views/login/login.component';
import { MainUserComponent } from './components/main-user/main-user.component';

@NgModule({
  declarations: [
    AppComponent,
    DashboardUserComponent,
    HeaderComponent,
    BookingMaterialComponent,
    NavComponent,
    EventsCalendarComponent,
    LoginComponent,
    MainUserComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule,
    BrowserAnimationsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
