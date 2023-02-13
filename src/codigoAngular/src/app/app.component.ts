import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'codigoAngular';
  public switcher = 0;
  public log = ['out','in'];

  public logIn() : void
  {
    this.switcher = 1;
    console.log(this.log[this.switcher])
  }

  ngOnInit(){
    console.log(this.log[this.switcher])
  }
}
