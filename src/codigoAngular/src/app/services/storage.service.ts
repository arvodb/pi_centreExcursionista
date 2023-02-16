import { Injectable } from '@angular/core';

import { HttpClient } from '@angular/common/http';
import { HeaderTitles } from '../interfaces/headerInterface';

@Injectable({
  providedIn: 'root'
})
export class StorageService {

  constructor(public http: HttpClient) { }

  private headerTitles : HeaderTitles[] = [
    {
      section:'dashboard',
      title: 'Panel de usuario',
      caption: 'Bienvenido'
    },
    {
      section:'calendar',
      title:'Calendario',
      caption:'No te pierdas nada'
    }
  ];
  private currentHeader : HeaderTitles = this.headerTitles[0];
  public setCurrentHeader (newSection:string) : void {
    for(let i = 0; i < this.headerTitles.length ; i++){
      if(this.headerTitles[i].section === newSection){
        this.currentHeader = this.headerTitles[i];
      }
    }
  }
  public getCurrentHeader() : HeaderTitles
  {
    return this.currentHeader;
  }
  public getAllHeaders() {
    return this.headerTitles;
  }

  /*
    public getPokemonList(): Observable<List>{
    return this.http.get<List>(this.apiUrlList);
  }
  */

}
