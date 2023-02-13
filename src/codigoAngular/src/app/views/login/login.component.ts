import { Component, Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {
  @Output() log = new EventEmitter<boolean>()
  public logIn() : void
  {
    this.log.emit();
  }
}
