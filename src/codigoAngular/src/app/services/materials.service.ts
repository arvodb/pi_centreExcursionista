import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Users } from '../interfaces/usersInterface';
import { Observable } from 'rxjs';
import { Reservas } from '../interfaces/ReservasInterface';
@Injectable({
  providedIn: 'root'
})
export class MaterialsService {

  constructor(public http: HttpClient) { }
  public prevUrl : string = 'http://localhost:8000/api/';
  public reservaUrl : string = this.prevUrl+'reservaMaterial';

  public getBookingMaterial() : Observable<Reservas>
  {
    return this.http.get<Reservas>(this.reservaUrl);
  }
  /*
  public getCharacter(): Observable<Characters> {
    return this.http.get<Characters>(this.character);
  }
  */
}
