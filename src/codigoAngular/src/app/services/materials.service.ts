import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Users } from '../interfaces/usersInterface';
import { Observable } from 'rxjs';
import { Reservas } from '../interfaces/ReservasInterface';
import { Materials } from '../interfaces/MaterialsInterface';
@Injectable({
  providedIn: 'root'
})
export class MaterialsService {

  constructor(public http: HttpClient) { }
  public prevUrl : string = 'http://localhost:8000/api/';
  public reservaUrl : string = this.prevUrl+'reservaMaterial';
  public materialUrl : string = this.prevUrl+'materiales';

  public getMaterialsList() : Observable<Materials>
  {
    return this.http.get<Materials>(this.materialUrl);
  }

  public getBookingMaterial() : Observable<Reservas>
  {
    return this.http.get<Reservas>(this.reservaUrl);
  }

  public insertReserva(body: string){
    return this.http.post(this.reservaUrl, body);
  }
  /*
  public getCharacter(): Observable<Characters> {
    return this.http.get<Characters>(this.character);
  }
  */
}
