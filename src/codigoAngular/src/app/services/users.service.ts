import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Users } from '../interfaces/usersInterface';
import { Observable } from 'rxjs';
@Injectable({
  providedIn: 'root'
})
export class UsersService {

  constructor(public http: HttpClient) { }
  public prevUrl : string = 'http://localhost:8000/api/';
  public userUrl : string = this.prevUrl+'usuarios';
  public getUsers(): Observable<Users>
  {
    return this.http.get<Users>(this.userUrl);
  }

  /*
  public getCharacter(): Observable<Characters> {
    return this.http.get<Characters>(this.character);
  }
  */
}
