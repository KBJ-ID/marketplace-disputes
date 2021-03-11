import { Component, OnInit, Input, OnDestroy } from '@angular/core';
import { Datepicker, ChartJs } from '../../../../functions';
import { OrdersService } from '../../../../services/orders.service';
import { SalesService } from '../../../../services/sales.service';
import { ActivatedRoute } from '@angular/router';
import { Subject } from 'rxjs';

@Component({
  selector: 'app-account-my-sales',
  templateUrl: './account-my-sales.component.html',
  styleUrls: ['./account-my-sales.component.css']
})
export class AccountMySalesComponent implements OnInit, OnDestroy {

  @Input() childItem:any;

  sales:any[] = [];

  storeProfits:number = 0;
  commissions:number = 0;
  totalSales:number = 0;

  graph:any[] = [];

  dataDate:any[] = [];
  dataProfit:any[] = [];

  dateFrom:any = null;
  dateTo:any = null;

  dtOptions: DataTables.Settings = {};
  dtTrigger: Subject<any> = new Subject();
  
  constructor(private ordersService: OrdersService,
              private salesService: SalesService,
              private activatedRoute: ActivatedRoute) { }

  ngOnInit(): void {
    // Capturamos parámetros URL
    this.dateFrom = this.activatedRoute.snapshot.params["param"].split("&")[1];
    this.dateTo = this.activatedRoute.snapshot.params["param"].split("&")[2];

    /*=============================================
    Agregamos opciones a DataTable
    =============================================*/

    this.dtOptions = {
      pagingType: 'full_numbers',
      processing: true
    }

    let load = 0;

    // Preguntamos si esta tienda tiene órdenes
    this.ordersService.getFilterData("store", this.childItem)
    .subscribe(resp=>{
      if(Object.keys(resp).length > 0){
        for(const i in resp){

          // Traemos la venta relacionada
          this.salesService.getFilterData("id_order", i)
          .subscribe(resp2=>{
            if(Object.keys(resp).length > 0){
              for(const f in resp2){
                load++;

                // Agregamos el array principal de la propiedad sales
                resp[i].sales = resp2[f];

                // Filtramos solo ventas finalizadas
                if(resp[i].sales.status == "success"){
                  this.sales.push(resp[i]);
                  
                  // Filtramos ventas por fechas
                  if(this.dateFrom != null && this.dateTo != null){
                    this.sales = this.sales.filter(sale => 
                      
                      sale.sales.date.substr(0,10) >= this.dateFrom && 
                      sale.sales.date.substr(0,10) <= this.dateTo
                      )
                      console.log(this.sales);
                  }

                }

                // Configuramos la informacion de las ventas
                if(load == Object.keys(resp).length){
                  if(this.sales.length > 0){
                    this.sales.forEach((sale,index) =>{
                      this.storeProfits += Number(sale.sales.unit_price);
                      this.commissions += Number(sale.sales.commission);
                      this.totalSales += Number(sale.sales.total);
                      
                      // Agrupamos los datos que mostraremos en el gráfico
                      this.graph.push({
                        "date": sale.sales.date.substr(0,10), 
                        "price": sale.sales.unit_price 
                      })
                    })

                    // Sumamos ventas realizadas en la misma fecha
                    let graph = [];
                    this.graph.reduce((res, value)=>{
                      if(!res[value.date]){
                        res[value.date] = { date:value.date, price:0 }
                        graph.push(res[value.date])
                      }
                      res[value.date].price += Number(value.price);
                      return res;
                    }, {})
                    
                    // Ordenamos el arreglo en fecha de menor a mayor
                    graph.sort((a, b)=>{
                      return new Date(a.date).getTime() - new Date(b.date).getTime()
                    })

                    // Separamos fecha y precios
                    graph.forEach((value, index)=>{
                      this.dataDate[index] = value.date;
                      this.dataProfit[index] = value.price.toFixed(2);
                    })

                    // Estraer el valor máximo de las ventas
                    let max = Math.max(...this.dataProfit);
                    
                    // Configuracion de ChartJs

                    let config = {
                      type: 'line',
                      data: {
                          labels: this.dataDate,
                          datasets: [{
                              label: 'Sales',
                              backgroundColor: 'rgba(0,255,255,.2)',
                              borderColor: '#0cf',
                              data: this.dataProfit,
                              fill: true,
                          }]
                      },
                      options: {
                          responsive: true,
                          scales: {
                              yAxes: [{
                                  ticks: {
                                      min: 0,
                                      max: Math.ceil(max/1000)*1000
                                  }
                              }]
                          }
                      }
                    };
                
                    ChartJs.fnc(config);

                    // Disparamos el trigger de Datatable
                    this.dtTrigger.next();
                  }
                  
                }
              }
            }
          })
        }
      }

    })

    Datepicker.fnc();
  }

  // Destruimos el trigger de angular
  ngOnDestroy():void{
    this.dtTrigger.unsubscribe();
  }
}
