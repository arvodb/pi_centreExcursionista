import { DashboardUserComponent } from './views/dashboard-user/dashboard-user.component';
import {  NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { AppComponent } from './app.component';
import { MainUserComponent } from './components/main-user/main-user.component';

const routes: Routes = [
  {path:'', redirectTo: 'dashboard', pathMatch: 'full'},
  /* {path:'/login', component: AppComponent}, */
   {path:'dashboard',component: DashboardUserComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
