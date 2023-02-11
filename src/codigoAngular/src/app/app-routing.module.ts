import {  NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { AppComponent } from './app.component';
import { MainUserComponent } from './components/main-user/main-user.component';

const routes: Routes = [
  {path:'', redirectTo: '/login', pathMatch: 'full'},
  {path:'/login', component: AppComponent},
  {path:'/user',component:MainUserComponent},
  {path:'/user/dasboard', component: AppComponent},
  {path:'/user/material', component: AppComponent},
  {path:'/user/calendar', component: AppComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
