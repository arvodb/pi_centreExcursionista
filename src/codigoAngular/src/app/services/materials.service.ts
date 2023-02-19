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
  public deleteMaterialUrl : string = this.prevUrl+'/reservaMaterial/'; //delete=> '/reservaMaterial/{id}/{id2}/{fecha}'

  public getBookingMaterial() : Observable<Reservas>
  {
    return this.http.get<Reservas>(this.reservaUrl);
  }

  public getMaterials() : Observable<Materials>
  {
    return this.http.get<Materials>(this.materialUrl);
  }

  public deleteBooking(idUser : number, idMaterial : number, bookingDate : string)
  {
    this.http.delete(this.deleteMaterialUrl+'/'+idUser+'/'+idMaterial+'/'+bookingDate);
  }
}
