import { Component } from '@angular/core';

@Component({
  selector: 'app-booking-material',
  templateUrl: './booking-material.component.html',
  styleUrls: ['./booking-material.component.css']
})
export class BookingMaterialComponent {

  public arrayMateriales : {id:number, nombre: string, stock:number}[] = [
    {id:1 , nombre:'martillo', stock: 23},
    {id:2 , nombre:'cuerda', stock: 20},
    {id:3 , nombre:'polea', stock: 3},
    {id:4 , nombre:'gancho', stock: 12},
    {id:5 , nombre:'pico', stock: 45},
    {id:6 , nombre:'arnes', stock: 24},
    {id:7 , nombre:'gato', stock: 2}
  ];
  public arrayReservados : {id:number, nombre: string, stock:number}[] = [

  ];

  public clickMaterial(material : any){
    const materialElegido = this.arrayReservados.findIndex(m => m.id === material.id);
    if(material.stock !== 0){
      if(materialElegido === -1){
        this.arrayReservados.push({ id: material.id, nombre: material.nombre, stock: 1});
      }else{
        this.arrayReservados[materialElegido].stock++;
      }
      material.stock--;
    } else {
      alert('No hay más stock');
    }

  }

  public restar(materialReservado: any){
    const materialElegido = this.arrayMateriales.findIndex(m => m.id === materialReservado.id);
    if(materialReservado.stock !== 0){
      if(materialElegido === -1){
        this.arrayMateriales.push({ id: materialReservado.id, nombre: materialReservado.nombre, stock: 1});
      }else{
        this.arrayMateriales[materialElegido].stock++;
      }
      materialReservado.stock--;
    } else {
      const indice = this.arrayReservados.findIndex(mat => mat.id === materialReservado.id);
      if(indice !== -1) {
        this.arrayReservados.splice(indice, 1);
      }
    }
  }

  public borrar(materialReservado: any){
    for(let i = 0; i < this.arrayMateriales.length ; i++){
      if(materialReservado.id === this.arrayMateriales[i].id){
        this.arrayMateriales[i].stock += materialReservado.stock;
        const indice = this.arrayReservados.findIndex(mat => mat.id === materialReservado.id);
        if(indice !== -1) {
          this.arrayReservados.splice(indice, 1);
        }
      }
    }
  }

}
