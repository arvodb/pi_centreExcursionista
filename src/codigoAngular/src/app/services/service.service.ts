import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Users } from '../interfaces/usersInterface';
import { Observable } from 'rxjs';
import { Reservas } from '../interfaces/ReservasInterface';
@Injectable({
  providedIn: 'root'
})
export class ServiceService {

  constructor(public http: HttpClient) { }
  public prevUrl : string = 'http://localhost:8000/';
  public userUrl : string = this.prevUrl+'usuarios';
  public reservaUrl : string = this.prevUrl+'reservaMaterial';
  public getUsers(): Observable<Users>
  {
    return this.http.get<Users>(this.userUrl);
  }
  public getReservaMaterial() : Observable<Reservas>
  {
    return this.http.get<Reservas>(this.reservaUrl);
  }
  /*
  public getCharacter(): Observable<Characters> {
    return this.http.get<Characters>(this.character);
  }
  */
}
