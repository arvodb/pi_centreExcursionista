import { Component } from '@angular/core';
import { StorageService } from './services/storage.service';
import { UserList } from './interfaces/usersInterface';
import { Router } from '@angular/router';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  constructor(private userData : StorageService, private router: Router){

  }

  public log : boolean = false;
  public user : UserList = this.userData.getUser();
  public logIn() : void
  {
    this.log = true;
    this.router.navigate(['/dashboard']);
  }
  public reset() : void
  {
      this.log = false;
  }
  ngOnInit(){
    const data = localStorage.getItem('user');
    if(data){
      this.user = JSON.parse(data);
      this.userData.setUser(this.user);
      this.logIn();
    }
  }

}
