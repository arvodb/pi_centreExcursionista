import { Component } from '@angular/core';
import { InsertReserva } from 'src/app/interfaces/ReservasInterface';
import { MaterialsService } from 'src/app/services/materials.service';

@Component({
  selector: 'app-booking-material',
  templateUrl: './booking-material.component.html',
  styleUrls: ['./booking-material.component.css']
})
export class BookingMaterialComponent {

  currentYear: number = 0;

  constructor(private reservasService: MaterialsService){}

  days: number[] = Array.from({ length: 31 }, (_, i) => i + 1);
  months: string[] = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
  numberMonths: string[] = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
  years: number[] = Array.from({ length: 10 }, (_, i) => i + 2023);

  public dia1: string = "";
  public mes1: string = "";
  public anyo1: string = "";

  public dia2: string = "";
  public mes2: string = "";
  public anyo2: string = "";

  public arrayMateriales : {id:number, nombre: string, stock:number}[] = [
    
  ];
  public arrayReservados : {id:number, nombre: string, stock:number}[] = [
  ];

  modalStyle = {
    'display': 'none',
    'background-color' : ''
  }

  mostrarModal(){
    this.modalStyle = {
      'display' : 'flex',
      'background-color' : 'rgba(0, 0, 0, 0.7)'
    }
  }
  cerrarModal(){
    this.modalStyle = {
    'display': 'none',
    'background-color' : ''
    }
  }

  estiloMateriales = {
    'visibility': 'hidden'
  }
  estiloMateriales2 = {
    'visibility': 'hidden'
  }
  estiloBoton = {
    'background-color' : 'grey'
  }

  public cambiarEstilos(){
    this.estiloMateriales = {
      'visibility' : 'visible'
    }
  }
  public cambiarEstilos2(){
    this.estiloMateriales2 = {
      'visibility' : 'visible'
    }
  }

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
    if(materialReservado.stock !== 1){
      if(materialElegido === -1){
        this.arrayMateriales.push({ id: materialReservado.id, nombre: materialReservado.nombre, stock: 1});
      }
      materialReservado.stock--;
    } else {
      const indice = this.arrayReservados.findIndex(mat => mat.id === materialReservado.id);
      this.arrayReservados.splice(indice, 1);
    }
    this.arrayMateriales[materialElegido].stock++;
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

  public onDate(){
    let fechaReserva = this.anyo1+'-'+this.mes1+'-'+this.dia1;
    let fechaDevolucion = this.dia2+'-'+this.mes2+'-'+this.anyo2;

    let data = localStorage.getItem('user');
    let userId = (data) ? JSON.parse(data).ID : '';

    let reservasFormateadas : InsertReserva[] =[];
    for(let i = 0 ; i < this.arrayReservados.length ; i++){
      let array : InsertReserva = {
        USUARIO_ID:        userId,
        MATERIAL_ID:       this.arrayReservados[i].id,
        CANTIDAD:          this.arrayReservados[i].stock,
        ESTADO:           'Reservado',
        FECHA_RESERVA:     fechaReserva,
        FECHA_DEVOLUCION:  fechaDevolucion,
      };
      this.reservasService.insertReserva(JSON.stringify(array)).subscribe((response)=>{
        console.log(response);
      });
    }
  }

  ngOnInit(){
    this.reservasService.getMaterialsList().subscribe((response)=>{
      console.log(response);
      for (let i = 0; i < response.materials.length; i++) {
        let array : {id:number, nombre: string, stock:number} = {
        id:         response.materials[i].ID,
        nombre:     response.materials[i].NOMBRE,
        stock:      response.materials[i].STOCK
        };
        this.arrayMateriales.push(array);
      }
    });
  }
}
