import { Component, Output, EventEmitter } from '@angular/core';
import { UserList } from 'src/app/interfaces/usersInterface';
import { ServiceService } from 'src/app/services/service.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {

  constructor(public userService : ServiceService) { }

  @Output() log = new EventEmitter<boolean>()

  public userName : string = '';
  public passWord : string = '';
  public validated : {userName:boolean,passWord:boolean} = {
    userName:false,passWord:false
  };
  public userData : UserList = {ID:0,NOMBRE_USUARIO:'',CONTRASEÑA:'',CORREO:'',PRIVILEGIO:''};
  public logIn() : void
  {
    this.validateUser();
    if(this.validated) {
      this.log.emit();
    }
  }

  public validateUser() : void
  {
    this.userService.getUsers().subscribe((response) => {
      console.log(response);
      let exist = response.userList.filter((user) => {
        if(user.NOMBRE_USUARIO === this.userName){
          this.validated.userName = true;
        }
        if(user.CONTRASEÑA === this.passWord){
          this.validated.passWord = true;
        }
        return user;
      });
      this.userData = exist[0];

    });
  }
}


