import { Component, EventEmitter, Output } from '@angular/core';
import {  Router } from '@angular/router';
import { StorageService } from 'src/app/services/storage.service';

@Component({
  selector: 'app-nav',
  templateUrl: './nav.component.html',
  styleUrls: ['./nav.component.css']
})
export class NavComponent {
  constructor(private userData : StorageService,private router: Router){}
  @Output() reset = new EventEmitter<boolean>()
  public logout(){
    localStorage.clear();
    this.router.navigate(['/logout']);
    this.reset.emit()
  }

}
