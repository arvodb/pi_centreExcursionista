import { Router } from '@angular/router';
import { Component, Output, EventEmitter } from '@angular/core';
import { UserList } from 'src/app/interfaces/usersInterface';
import { ServiceService } from 'src/app/services/service.service';
import { ThisReceiver } from '@angular/compiler';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {

  constructor(public userService : ServiceService,private route : Router) { }

  @Output() log = new EventEmitter<boolean>()

  public userName : string = '';
  public passWord : string = '';
  public validated : {userName:boolean,passWord:boolean} = {
    userName:false,passWord:false
  };
  public userData : UserList = {ID:0,NOMBRE_USUARIO:'',CONTRASEÑA:'',CORREO:'',PRIVILEGIO:''};
  public logIn() : void
  {;
    console.log(this.validated)
    if(this.validated.passWord === true && this.validated.userName === true) {
      localStorage.setItem('validated','true')
      this.log.emit();

      //this.route.navigate(['/dashboad'])
    } else {
      alert('Algo a ido mal')
    }
  }

  public validateUser() : void
  {
    this.userService.getUsers().subscribe((response) => {
      console.log(response.userList);
      let existName = response.userList.filter((user) => (user.NOMBRE_USUARIO === this.userName));
      let existPassword = response.userList.filter((user)=>(user.NOMBRE_USUARIO === this.userName && user.CONTRASEÑA === this.passWord));
      if(existName.length < 1){
        this.validated.userName = false;
        this.validated.passWord = false;
        this.passWord = '';
        this.userName = '';

      }

      if(existName.length > 0){
        this.validated.userName = true;
        this.userData = existName[0];

        if(existPassword.length > 0) {
          this.validated.passWord = true;
          this.userData = existPassword[0];

        } else {
          this.validated.passWord = false;
          this.passWord = '';
        }
        console.log(this.validated)
        this.logIn();
      }




    });
  }

  ngOnInit(){
    const data = localStorage.getItem('validated');
    let local =  data ? JSON.parse(data) : '';

    if(JSON.parse(local) === true){
      this.log.emit();
    } else {
      localStorage.setItem('validated','false');
    }
  }
}


