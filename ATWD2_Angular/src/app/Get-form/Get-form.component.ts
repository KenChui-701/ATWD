import { Component, Input, OnInit, Output, EventEmitter, DoCheck, OnChanges} from '@angular/core';
import { FormGroup, FormBuilder, Validators, FormControl} from '@angular/forms';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { BusRecord } from '../BusRecord.model';
@Component({
  selector: 'app-Get-form',
  templateUrl: './Get-form.component.html',
  styleUrls: ['./Get-form.component.css']
})

export class GetFormComponent implements OnInit,DoCheck,OnChanges{
  @Input() DeletePass!: boolean;
  @Input() UpdatePass!: boolean;
  Pass!: boolean;
  UPass!: boolean;
  GetForm: FormGroup;
  serverData: Object | null = null;
  serverDataArr: any;
  loading: boolean = false;
  resourceID1: boolean = false;
  resourceID2: boolean = false;
  http: HttpClient;

  busRecord: BusRecord = {
    COMPANY_CODE: "",
    ROUTE_ID: 0,
    ROUTE_NAMEC: "",
    ROUTE_NAMES: "",
    ROUTE_NAMEE: "",
    JOURNEY_TIME: 0,
    ROUTE_TYPE: 0,
    SERVICE_MODE: 0,
    SPECIAL_TYPE: 0,
    LOC_START_NAMEC: "",
    LOC_END_NAMEC: "",
    LOC_START_NAMEE: "",
    LOC_END_NAMEE: "",
    LOC_START_NAMES: "",
    LOC_END_NAMES: "",
    FULL_FARE: 0,
    HYPERLINK_C: "",
    HYPERLINK_S: "",
    HYPERLINK_E: "",

    Bus: "",
    ROUTE_SEQ: "",
    STOP_SEQ: "",
    STOP_ID: 0,
    STOP_PICK_DROP: "",
    STOP_NAMEC: "",
    STOP_NAMEE: ""
  }
  constructor(fb: FormBuilder, http: HttpClient) {
    this.http = http;
    this.GetForm = fb.group({
      //'studentInput': ['', Validators.compose([Validators.required, this.studentIdValidator])],
      //'studentName' : ['', Validators.compose([Validators.required,Validators.maxLength(15)])],
      //'studentemail': ['', Validators.compose([Validators.required,Validators.email])],
      'Route_ID':['',Validators.required],
      'Bus':['',Validators.required],
      'COMPANY':['',Validators.required],
      'Start':['',Validators.required],
      'End':['',Validators.required],
      'Fee':['',Validators.required],
      'Fee1':['',Validators.required],
      'Stop_Location':['',Validators.required]
    });
  }
  ngOnChanges(){
    this.Pass = this.DeletePass;
    this.UPass = this.UpdatePass;
    
  }

  ngOnInit(): void {

  }

  ngDoCheck():void{
    
    if(this.Pass == true){
      let resource = (<HTMLInputElement>document.getElementById('resource')).value;
      let url = 'http://localhost/ATWD/serverSide/Controller.php/'+resource+"/";
      this.http.get(url)
      .subscribe(res=>{
          let res1:string = JSON.stringify(res);
          let res2:any = JSON.parse(res1);
          if(res2.code == 201 || res2.code == 200){
            this.serverData = res2.table;
            this.serverDataArr = JSON.parse(JSON.stringify(res)).table;
          }
        },res =>{
          console.log('error');
        },()=>{
          this.loading = false;
          this.Pass = false;
        }
      );
    }
    if(this.UPass == true){
      let resource = (<HTMLInputElement>document.getElementById('resource')).value;
      let url = 'http://localhost/ATWD/serverSide/Controller.php/'+resource+"/";
      this.http.get(url)
      .subscribe(res=>{
          let res1:string = JSON.stringify(res);
          let res2:any = JSON.parse(res1);
          if(res2.code == 201 || res2.code == 200){
            this.serverData = res2.table;
            this.serverDataArr = JSON.parse(JSON.stringify(res)).table;
          }
        },res =>{
          console.log('error');
        },()=>{
          this.loading = false;
          this.UPass = false;
        }
      );
    }
  }
  //onSubmit(formValue: any): void {
    //let resource = (<HTMLInputElement>document.getElementById('resource')).value;
    //console.log('you submitted value: ', formValue);
    //console.log(resource);
  //}
  //studentIdValidator(control: FormControl): {[s:string]:boolean} |null{
    //if (!control.value.match(/^20/)) {
      //return {invalidStudentId:true};
    //}
    //return null;
  //}
  getURL(formValue: any | null):string{
    let resource = (<HTMLInputElement>document.getElementById('resource')).value;
    console.log(resource)
    let url = 'http://localhost/ATWD/serverSide/Controller.php/';
    if(resource=="Routebus"){
      url += resource;
      //5key
      if(!!formValue.Start &&!!(<HTMLInputElement>document.getElementById("End")).value&&!!(<HTMLInputElement>document.getElementById("Bus")).value&&!!(<HTMLInputElement>document.getElementById("COMPANY")).value&&!!(<HTMLInputElement>document.getElementById("Fee")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword2 = (<HTMLInputElement>document.getElementById("End")).value;
        var keyword3= (<HTMLInputElement>document.getElementById("Bus")).value;
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        var keyword5= (<HTMLInputElement>document.getElementById("Fee")).value;
        var keyword6= (<HTMLInputElement>document.getElementById("Fee1")).value;
        url += "/Start"+"/"+keyword+"/End/"+keyword2+"/Bus/"+keyword3+"/COMPANY/"+keyword4+"/FEE/"+keyword5+"/"+keyword6;
      }else if(!!(<HTMLInputElement>document.getElementById("Start")).value &&!!(<HTMLInputElement>document.getElementById("End")).value&&!!(<HTMLInputElement>document.getElementById("Route_ID")).value&&!!(<HTMLInputElement>document.getElementById("COMPANY")).value&&!!(<HTMLInputElement>document.getElementById("Fee")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword2= (<HTMLInputElement>document.getElementById("End")).value;
        var keyword3= (<HTMLInputElement>document.getElementById("Route_ID")).value;
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        var keyword5= (<HTMLInputElement>document.getElementById("Fee")).value;
        var keyword6= (<HTMLInputElement>document.getElementById("Fee1")).value;
        url += "/Start"+"/"+keyword+"/End/"+keyword2+"/RID/"+keyword3+"/COMPANY/"+keyword4+"/FEE/"+keyword5+"/"+keyword6;
      //4 key
      }else if(!!(<HTMLInputElement>document.getElementById("Start")).value &&!!(<HTMLInputElement>document.getElementById("End")).value&&!!(<HTMLInputElement>document.getElementById("Route_ID")).value&&!!(<HTMLInputElement>document.getElementById("COMPANY")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword2= (<HTMLInputElement>document.getElementById("End")).value;
        var keyword3= (<HTMLInputElement>document.getElementById("Route_ID")).value;
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        url += "/Start"+"/"+keyword+"/End/"+keyword2+"/RID/"+keyword3+"/COMPANY/"+keyword4;
      }else if(!!(<HTMLInputElement>document.getElementById("Start")).value &&!!(<HTMLInputElement>document.getElementById("End")).value&&!!(<HTMLInputElement>document.getElementById("Route_ID")).value&&!!(<HTMLInputElement>document.getElementById("Fee")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword2= (<HTMLInputElement>document.getElementById("End")).value;
        var keyword3= (<HTMLInputElement>document.getElementById("Route_ID")).value;
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        var keyword5= (<HTMLInputElement>document.getElementById("Fee")).value;
        var keyword6= (<HTMLInputElement>document.getElementById("Fee1")).value;
        url += "/Start"+"/"+keyword+"/End/"+keyword2+"/RID/"+keyword3+"/FEE/"+keyword5+"/"+keyword6;
      }else if(!!(<HTMLInputElement>document.getElementById("Start")).value &&!!(<HTMLInputElement>document.getElementById("End")).value&&!!(<HTMLInputElement>document.getElementById("COMPANY")).value&&!!(<HTMLInputElement>document.getElementById("Fee")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword2= (<HTMLInputElement>document.getElementById("End")).value;
        var keyword3= (<HTMLInputElement>document.getElementById("Route_ID")).value;
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        var keyword5= (<HTMLInputElement>document.getElementById("Fee")).value;
        var keyword6= (<HTMLInputElement>document.getElementById("Fee1")).value;
        url += "/Start"+"/"+keyword+"/End/"+keyword2+"/COMPANY/"+keyword4+"/FEE/"+keyword5+"/"+keyword6;
      }else if(!!(<HTMLInputElement>document.getElementById("Start")).value &&!!(<HTMLInputElement>document.getElementById("Route_ID")).value&&!!(<HTMLInputElement>document.getElementById("COMPANY")).value&&!!(<HTMLInputElement>document.getElementById("Fee")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword2= (<HTMLInputElement>document.getElementById("End")).value;
        var keyword3= (<HTMLInputElement>document.getElementById("Route_ID")).value;
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        var keyword5= (<HTMLInputElement>document.getElementById("Fee")).value;
        var keyword6= (<HTMLInputElement>document.getElementById("Fee1")).value;
        url += "/Start"+"/"+keyword+"/RID/"+keyword3+"/COMPANY/"+keyword4+"/FEE/"+keyword5+"/"+keyword6;
      }else if(!!(<HTMLInputElement>document.getElementById("End")).value&&!!(<HTMLInputElement>document.getElementById("Route_ID")).value&&!!(<HTMLInputElement>document.getElementById("COMPANY")).value&&!!(<HTMLInputElement>document.getElementById("Fee")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword2= (<HTMLInputElement>document.getElementById("End")).value;
        var keyword3= (<HTMLInputElement>document.getElementById("Route_ID")).value;
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        var keyword5= (<HTMLInputElement>document.getElementById("Fee")).value;
        var keyword6= (<HTMLInputElement>document.getElementById("Fee1")).value;
        url += "/End/"+keyword2+"/RID/"+keyword3+"/COMPANY/"+keyword4+"/FEE/"+keyword5+"/"+keyword6

      }else if(!!(<HTMLInputElement>document.getElementById("Start")).value &&!!(<HTMLInputElement>document.getElementById("End")).value&&!!(<HTMLInputElement>document.getElementById("Bus")).value&&!!(<HTMLInputElement>document.getElementById("COMPANY")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword2= (<HTMLInputElement>document.getElementById("End")).value;
        var keyword3= (<HTMLInputElement>document.getElementById("Bus")).value;
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        url += "/Start"+"/"+keyword+"/End/"+keyword2+"/Bus/"+keyword3+"/COMPANY/"+keyword4;
      }else if(!!(<HTMLInputElement>document.getElementById("Start")).value &&!!(<HTMLInputElement>document.getElementById("End")).value&&!!(<HTMLInputElement>document.getElementById("Bus")).value&&!!(<HTMLInputElement>document.getElementById("Fee")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword2= (<HTMLInputElement>document.getElementById("End")).value;
        var keyword3= (<HTMLInputElement>document.getElementById("Bus")).value;
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        var keyword5= (<HTMLInputElement>document.getElementById("Fee")).value;
        var keyword6= (<HTMLInputElement>document.getElementById("Fee1")).value;
        url += "/Start"+"/"+keyword+"/End/"+keyword2+"/Bus/"+keyword3+"/FEE/"+keyword5+"/"+keyword6;
      }else if(!!(<HTMLInputElement>document.getElementById("Start")).value &&!!(<HTMLInputElement>document.getElementById("Bus")).value&&!!(<HTMLInputElement>document.getElementById("COMPANY")).value&&!!(<HTMLInputElement>document.getElementById("Fee")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword2= (<HTMLInputElement>document.getElementById("End")).value;
        var keyword3= (<HTMLInputElement>document.getElementById("Bus")).value;
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        var keyword5= (<HTMLInputElement>document.getElementById("Fee")).value;
        var keyword6= (<HTMLInputElement>document.getElementById("Fee1")).value;
        url += "/Start"+"/"+keyword+"/Bus/"+keyword3+"/COMPANY/"+keyword4+"/FEE/"+keyword5+"/"+keyword6;
      }else if(!!(<HTMLInputElement>document.getElementById("End")).value&&!!(<HTMLInputElement>document.getElementById("Bus")).value&&!!(<HTMLInputElement>document.getElementById("COMPANY")).value&&!!(<HTMLInputElement>document.getElementById("Fee")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword2= (<HTMLInputElement>document.getElementById("End")).value;
        var keyword3= (<HTMLInputElement>document.getElementById("Bus")).value;
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        var keyword5= (<HTMLInputElement>document.getElementById("Fee")).value;
        var keyword6= (<HTMLInputElement>document.getElementById("Fee1")).value;
        url += "/End/"+keyword2+"/RID/"+keyword3+"/COMPANY/"+keyword4+"/FEE/"+keyword5+"/"+keyword6
      //key3
      }else if(!!(<HTMLInputElement>document.getElementById("Start")).value &&!!(<HTMLInputElement>document.getElementById("End")).value&&!!(<HTMLInputElement>document.getElementById("Route_ID")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword2= (<HTMLInputElement>document.getElementById("End")).value;
        var keyword3= (<HTMLInputElement>document.getElementById("Route_ID")).value;
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        var keyword5= (<HTMLInputElement>document.getElementById("Fee")).value;
        var keyword6= (<HTMLInputElement>document.getElementById("Fee1")).value;
        url += "/Start"+"/"+keyword+"/End/"+keyword2+"/RID/"+keyword3;
      }else if(!!(<HTMLInputElement>document.getElementById("Start")).value &&!!(<HTMLInputElement>document.getElementById("End")).value&&!!(<HTMLInputElement>document.getElementById("Fee")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword2= (<HTMLInputElement>document.getElementById("End")).value;
        var keyword3= (<HTMLInputElement>document.getElementById("Route_ID")).value;
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        var keyword5= (<HTMLInputElement>document.getElementById("Fee")).value;
        var keyword6= (<HTMLInputElement>document.getElementById("Fee1")).value;
        url += "/Start"+"/"+keyword+"/End/"+keyword2+"/FEE/"+keyword5+"/"+keyword6;
      }else if(!!(<HTMLInputElement>document.getElementById("Start")).value &&!!(<HTMLInputElement>document.getElementById("COMPANY")).value&&!!(<HTMLInputElement>document.getElementById("Fee")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword2= (<HTMLInputElement>document.getElementById("End")).value;
        var keyword3= (<HTMLInputElement>document.getElementById("Route_ID")).value;
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        var keyword5= (<HTMLInputElement>document.getElementById("Fee")).value;
        var keyword6= (<HTMLInputElement>document.getElementById("Fee1")).value;
        url += "/Start"+"/"+keyword+"/COMPANY/"+keyword4+"/FEE/"+keyword5+"/"+keyword6;
      }else if(!!(<HTMLInputElement>document.getElementById("Route_ID")).value&&!!(<HTMLInputElement>document.getElementById("COMPANY")).value&&!!(<HTMLInputElement>document.getElementById("Fee")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword2= (<HTMLInputElement>document.getElementById("End")).value;
        var keyword3= (<HTMLInputElement>document.getElementById("Route_ID")).value;
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        var keyword5= (<HTMLInputElement>document.getElementById("Fee")).value;
        var keyword6= (<HTMLInputElement>document.getElementById("Fee1")).value;
        url += "/RID/"+keyword3+"/COMPANY/"+keyword4+"/FEE/"+keyword5+"/"+keyword6;
      }else if(!!(<HTMLInputElement>document.getElementById("End")).value&&!!(<HTMLInputElement>document.getElementById("Route_ID")).value&&!!(<HTMLInputElement>document.getElementById("COMPANY")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword2= (<HTMLInputElement>document.getElementById("End")).value;
        var keyword3= (<HTMLInputElement>document.getElementById("Route_ID")).value;
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        var keyword5= (<HTMLInputElement>document.getElementById("Fee")).value;
        var keyword6= (<HTMLInputElement>document.getElementById("Fee1")).value;
        url += "/End/"+keyword2+"/RID/"+keyword3+"/COMPANY/"+keyword4;
      }else if(!!(<HTMLInputElement>document.getElementById("Start")).value &&!!(<HTMLInputElement>document.getElementById("Route_ID")).value&&!!(<HTMLInputElement>document.getElementById("Fee")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword2= (<HTMLInputElement>document.getElementById("End")).value;
        var keyword3= (<HTMLInputElement>document.getElementById("Route_ID")).value;
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        var keyword5= (<HTMLInputElement>document.getElementById("Fee")).value;
        var keyword6= (<HTMLInputElement>document.getElementById("Fee1")).value;
        url += "/Start"+"/"+keyword+"/RID/"+keyword3+"/FEE/"+keyword5+"/"+keyword6;

      }else if(!!(<HTMLInputElement>document.getElementById("Start")).value &&!!(<HTMLInputElement>document.getElementById("Bus")).value&&!!(<HTMLInputElement>document.getElementById("Fee")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword2= (<HTMLInputElement>document.getElementById("End")).value;
        var keyword3= (<HTMLInputElement>document.getElementById("Bus")).value;
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        var keyword5= (<HTMLInputElement>document.getElementById("Fee")).value;
        var keyword6= (<HTMLInputElement>document.getElementById("Fee1")).value;
        url += "/Start"+"/"+keyword+"/Bus/"+keyword3+"/FEE/"+keyword5+"/"+keyword6;
      }else if(!!(<HTMLInputElement>document.getElementById("Bus")).value&&!!(<HTMLInputElement>document.getElementById("COMPANY")).value&&!!(<HTMLInputElement>document.getElementById("Fee")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword2= (<HTMLInputElement>document.getElementById("End")).value;
        var keyword3= (<HTMLInputElement>document.getElementById("Bus")).value;
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        var keyword5= (<HTMLInputElement>document.getElementById("Fee")).value;
        var keyword6= (<HTMLInputElement>document.getElementById("Fee1")).value;
        url += "/Bus/"+keyword3+"/COMPANY/"+keyword4+"/FEE/"+keyword5+"/"+keyword6;
      }else if(!!(<HTMLInputElement>document.getElementById("End")).value&&!!(<HTMLInputElement>document.getElementById("Bus")).value&&!!(<HTMLInputElement>document.getElementById("COMPANY")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword2= (<HTMLInputElement>document.getElementById("End")).value;
        var keyword3= (<HTMLInputElement>document.getElementById("Bus")).value;
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        var keyword5= (<HTMLInputElement>document.getElementById("Fee")).value;
        var keyword6= (<HTMLInputElement>document.getElementById("Fee1")).value;
        url += "/End/"+keyword2+"/Bus/"+keyword3+"/COMPANY/"+keyword4;
      }else if(!!(<HTMLInputElement>document.getElementById("Start")).value &&!!(<HTMLInputElement>document.getElementById("End")).value&&!!(<HTMLInputElement>document.getElementById("Bus")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword2= (<HTMLInputElement>document.getElementById("End")).value;
        var keyword3= (<HTMLInputElement>document.getElementById("Bus")).value;
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        var keyword5= (<HTMLInputElement>document.getElementById("Fee")).value;
        var keyword6= (<HTMLInputElement>document.getElementById("Fee1")).value;
        url += "/Start"+"/"+keyword+"/End/"+keyword2+"/Bus/"+keyword3;
      //key2
      }else if(!!(<HTMLInputElement>document.getElementById("Start")).value &&!!(<HTMLInputElement>document.getElementById("End")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword2= (<HTMLInputElement>document.getElementById("End")).value;
        url += "/Start"+"/"+keyword+"/End/"+keyword2;
      }else if(!!(<HTMLInputElement>document.getElementById("Start")).value &&!!(<HTMLInputElement>document.getElementById("Route_ID")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword3= (<HTMLInputElement>document.getElementById("Route_ID")).value;
        url += "/Start"+"/"+keyword+"/RID/"+keyword3;
      }else if(!!(<HTMLInputElement>document.getElementById("Start")).value &&!!(<HTMLInputElement>document.getElementById("COMPANY")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        url += "/Start"+"/"+keyword+"/COMPANY/"+keyword4;
      }else if(!!(<HTMLInputElement>document.getElementById("Start")).value &&!!(<HTMLInputElement>document.getElementById("Fee")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword5= (<HTMLInputElement>document.getElementById("Fee")).value;
        var keyword6= (<HTMLInputElement>document.getElementById("Fee1")).value;
        url += "/Start"+"/"+keyword+"/FEE/"+keyword5+"/"+keyword6;
      }else if(!!(<HTMLInputElement>document.getElementById("End")).value&&!!(<HTMLInputElement>document.getElementById("Route_ID")).value){
        var keyword2= (<HTMLInputElement>document.getElementById("End")).value;
        var keyword3= (<HTMLInputElement>document.getElementById("Route_ID")).value;
        url += "/End/"+keyword2+"/RID/"+keyword3;
      }else if(!!(<HTMLInputElement>document.getElementById("End")).value&&!!(<HTMLInputElement>document.getElementById("COMPANY")).value){
        var keyword2= (<HTMLInputElement>document.getElementById("End")).value;
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        url += "/End/"+keyword2+"/COMPANY/"+keyword4;
      }else if(!!(<HTMLInputElement>document.getElementById("End")).value&&!!(<HTMLInputElement>document.getElementById("Fee")).value){
        var keyword2= (<HTMLInputElement>document.getElementById("End")).value;
        var keyword5= (<HTMLInputElement>document.getElementById("Fee")).value;
        var keyword6= (<HTMLInputElement>document.getElementById("Fee1")).value;
        url += "/End/"+keyword2+"/FEE/"+keyword5+"/"+keyword6;
      }else if(!!(<HTMLInputElement>document.getElementById("Route_ID")).value&&!!(<HTMLInputElement>document.getElementById("COMPANY")).value){
        var keyword3= (<HTMLInputElement>document.getElementById("Route_ID")).value;
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        url += "/RID/"+keyword3+"/COMPANY/"+keyword4;
      }else if(!!(<HTMLInputElement>document.getElementById("Route_ID")).value&&!!(<HTMLInputElement>document.getElementById("Fee")).value){
        var keyword3= (<HTMLInputElement>document.getElementById("Route_ID")).value;
        var keyword5= (<HTMLInputElement>document.getElementById("Fee")).value;
        var keyword6= (<HTMLInputElement>document.getElementById("Fee1")).value;
        url += "/RID/"+keyword3+"/FEE/"+keyword5+"/"+keyword6;
      }else if(!!(<HTMLInputElement>document.getElementById("COMPANY")).value&&!!(<HTMLInputElement>document.getElementById("Fee")).value){
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        var keyword5= (<HTMLInputElement>document.getElementById("Fee")).value;
        var keyword6= (<HTMLInputElement>document.getElementById("Fee1")).value;
        url += "/COMPANY/"+keyword4+"/FEE/"+keyword5+"/"+keyword6;
      }else if(!!(<HTMLInputElement>document.getElementById("Start")).value &&!!(<HTMLInputElement>document.getElementById("Bus")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        var keyword3= (<HTMLInputElement>document.getElementById("Bus")).value;
        url += "/Start"+"/"+keyword+"/Bus/"+keyword3;
      }else if(!!(<HTMLInputElement>document.getElementById("End")).value&&!!(<HTMLInputElement>document.getElementById("Bus")).value){
        var keyword2 = (<HTMLInputElement>document.getElementById("End")).value;
        var keyword3= (<HTMLInputElement>document.getElementById("Bus")).value;
        url += "/End/"+keyword2+"/Bus/"+keyword3;
      }else if(!!(<HTMLInputElement>document.getElementById("Bus")).value&&!!(<HTMLInputElement>document.getElementById("COMPANY")).value){
        var keyword3= (<HTMLInputElement>document.getElementById("Bus")).value;
        var keyword4= (<HTMLInputElement>document.getElementById("COMPANY")).value;
        url += "/Bus/"+keyword3+"/COMPANY/"+keyword4;
      }else if(!!(<HTMLInputElement>document.getElementById("Bus")).value&&!!(<HTMLInputElement>document.getElementById("Fee")).value){
        var keyword3= (<HTMLInputElement>document.getElementById("Bus")).value;
        var keyword5= (<HTMLInputElement>document.getElementById("Fee")).value;
        var keyword6= (<HTMLInputElement>document.getElementById("Fee1")).value;
        url += "/Bus/"+keyword3+"/FEE/"+keyword5+"/"+keyword6;
      //key1
      }else if(!!(<HTMLInputElement>document.getElementById("Bus")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Bus")).value;
        url += "/Bus"+"/"+keyword;
      }else if(!!(<HTMLInputElement>document.getElementById("COMPANY")).value){
        var keyword = (<HTMLInputElement>document.getElementById("COMPANY")).value;
        url += "/COMPANY"+"/"+keyword;
      }else if(!!(<HTMLInputElement>document.getElementById("Start")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
        url += "/Start"+"/"+keyword;
      }else if(!!(<HTMLInputElement>document.getElementById("End")).value){
        var keyword = (<HTMLInputElement>document.getElementById("End")).value;
        url += "/End"+"/"+keyword;
      }else if(!!(<HTMLInputElement>document.getElementById("Route_ID")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Route_ID")).value;
        url += "/RID"+"/"+keyword;
      }else if(!!(<HTMLInputElement>document.getElementById("Fee")).value || !!(<HTMLInputElement>document.getElementById("Fee1")).value){
        var keyword = (<HTMLInputElement>document.getElementById("Fee")).value;
        var keyword1= (<HTMLInputElement>document.getElementById("Fee1")).value;
        url += "/FEE"+"/"+keyword+"/"+keyword1;
      }else{
        var keyword = "";
        url += "/"+keyword;
      }
    }if(resource=="Routestopbus"){
      url += resource;
      if(!!(<HTMLInputElement>document.getElementById("Route_ID")).value){
          var keyword = (<HTMLInputElement>document.getElementById("Route_ID")).value;
          url += "/RID"+"/"+keyword;
      }else if(!!(<HTMLInputElement>document.getElementById("Stop_Location")).value&&!!(<HTMLInputElement>document.getElementById("Start")).value&&!!(<HTMLInputElement>document.getElementById("End")).value){
          var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
          var keyword1= (<HTMLInputElement>document.getElementById("End")).value;
          var keyword2= (<HTMLInputElement>document.getElementById("Stop_Location")).value;
          url += "Loc"+keyword2+"/Start"+"/"+keyword+"/End/"+keyword1;
      }else if(!!(<HTMLInputElement>document.getElementById("Start")).value&&!!(<HTMLInputElement>document.getElementById("End")).value){
          var keyword = (<HTMLInputElement>document.getElementById("Start")).value;
          var keyword1= (<HTMLInputElement>document.getElementById("End")).value;
          url += "/Start"+"/"+keyword+"/End/"+keyword1;
      }else if(!!(<HTMLInputElement>document.getElementById("Stop_Location")).value){
          var keyword = (<HTMLInputElement>document.getElementById("Stop_Location")).value;
          url += "/Location"+"/"+keyword;
      }else{
          alert("Route Stop Bus can not empty!")
      }
    }
    console.log(url)
    return url;
  }

  makeRequest(formValue: any ) :void { 
    let resource = (<HTMLInputElement>document.getElementById('resource')).value;
    if(resource=="Routebus"){
      this.resourceID1 = true;
      this.resourceID2 = false;
    }else{
      this.resourceID2 = true;
      this.resourceID1 = false;
    }
    this.loading = true;
    this.serverData = null;
    this.http.get(this.getURL(formValue))
    .subscribe(res=>{
        let res1:string = JSON.stringify(res);
        let res2:any = JSON.parse(res1);
        console.log(res2.code);
        if(res2.code == 201 || res2.code == 200){
          this.serverData = res2.table;
          this.serverDataArr = JSON.parse(JSON.stringify(res)).table;

          console.log(res2.table);
        }
        if(res2.code == 404 || res2.code == 300){
          alert(res2.code+res2.message);
        }
        if(res2.code == 303||res2.code == 302||res2.code == 301 || res2.code == 403){
          alert(res2.code+res2.message);
        }
      },res =>{
        console.log('error');
      },()=>{
        this.loading = false;
      }
    );
  }
 
  @Output() deleteEvent = new EventEmitter<BusRecord>();

  deleteButtonHandler(routeNumber: string) {
    console.log("Search: delete button: " + routeNumber);
    console.log("Search: Emitting deleteEvent");

    for (let bus of this.serverDataArr) {
      if (routeNumber === bus.ROUTE_ID) {
        this.busRecord.ROUTE_ID = bus.ROUTE_ID;
        this.busRecord.ROUTE_NAMEC = bus.ROUTE_NAMEC;
        this.busRecord.ROUTE_NAMES = bus.ROUTE_NAMES;
        this.busRecord.ROUTE_NAMEE = bus.ROUTE_NAMEE;

        this.busRecord.COMPANY_CODE = bus.COMPANY_CODE;
        this.busRecord.ROUTE_TYPE = bus.ROUTE_TYPE;
        this.busRecord.SERVICE_MODE = bus.SERVICE_MODE;

        this.busRecord.SPECIAL_TYPE = bus.SPECIAL_TYPE;
        this.busRecord.JOURNEY_TIME = bus.JOURNEY_TIME;
        this.busRecord.FULL_FARE = bus.FULL_FARE;

        this.busRecord.LOC_START_NAMEC = bus.LOC_START_NAMEC;
        this.busRecord.LOC_START_NAMES = bus.LOC_START_NAMES;
        this.busRecord.LOC_START_NAMEE = bus.LOC_START_NAMEE;

        this.busRecord.LOC_END_NAMEC = bus.LOC_END_NAMEC;
        this.busRecord.LOC_END_NAMES = bus.LOC_END_NAMES;
        this.busRecord.LOC_END_NAMEE = bus.LOC_END_NAMEE;

        this.busRecord.HYPERLINK_C = bus.HYPERLINK_C;
        this.busRecord.HYPERLINK_S = bus.HYPERLINK_S;
        this.busRecord.HYPERLINK_E = bus.HYPERLINK_E;

        this.busRecord.Bus = bus.Bus;
        this.busRecord.ROUTE_SEQ = bus.ROUTE_SEQ;
        this.busRecord.STOP_SEQ = bus.STOP_SEQ;
        this.busRecord.STOP_ID = bus.STOP_ID;
        this.busRecord.STOP_PICK_DROP = bus.STOP_PICK_DROP;
        this.busRecord.STOP_NAMEC = bus.STOP_NAMEC;
        this.busRecord.STOP_NAMEE = bus.STOP_NAMEE;
      }
    }

    this.deleteEvent.emit(this.busRecord);
  }

  @Output() updateEvent = new EventEmitter<BusRecord>();

  updateButtonHandler(routeNumber: string) {
    console.log("Search: update button: " + routeNumber);
    console.log("Search: Emitting updateEvent");

    for (let bus of this.serverDataArr) {
      if (routeNumber === bus.ROUTE_ID) {
        this.busRecord.ROUTE_ID = bus.ROUTE_ID;
        this.busRecord.ROUTE_NAMEC = bus.ROUTE_NAMEC;
        this.busRecord.ROUTE_NAMES = bus.ROUTE_NAMES;
        this.busRecord.ROUTE_NAMEE = bus.ROUTE_NAMEE;

        this.busRecord.COMPANY_CODE = bus.COMPANY_CODE;
        this.busRecord.ROUTE_TYPE = bus.ROUTE_TYPE;
        this.busRecord.SERVICE_MODE = bus.SERVICE_MODE;

        this.busRecord.SPECIAL_TYPE = bus.SPECIAL_TYPE;
        this.busRecord.JOURNEY_TIME = bus.JOURNEY_TIME;
        this.busRecord.FULL_FARE = bus.FULL_FARE;

        this.busRecord.LOC_START_NAMEC = bus.LOC_START_NAMEC;
        this.busRecord.LOC_START_NAMES = bus.LOC_START_NAMES;
        this.busRecord.LOC_START_NAMEE = bus.LOC_START_NAMEE;

        this.busRecord.LOC_END_NAMEC = bus.LOC_END_NAMEC;
        this.busRecord.LOC_END_NAMES = bus.LOC_END_NAMES;
        this.busRecord.LOC_END_NAMEE = bus.LOC_END_NAMEE;

        this.busRecord.HYPERLINK_C = bus.HYPERLINK_C;
        this.busRecord.HYPERLINK_S = bus.HYPERLINK_S;
        this.busRecord.HYPERLINK_E = bus.HYPERLINK_E;

        this.busRecord.Bus = bus.Bus;
        this.busRecord.ROUTE_SEQ = bus.ROUTE_SEQ;
        this.busRecord.STOP_SEQ = bus.STOP_SEQ;
        this.busRecord.STOP_ID = bus.STOP_ID;
        this.busRecord.STOP_PICK_DROP = bus.STOP_PICK_DROP;
        this.busRecord.STOP_NAMEC = bus.STOP_NAMEC;
        this.busRecord.STOP_NAMEE = bus.STOP_NAMEE;
      }
    }

    this.updateEvent.emit(this.busRecord);
  }
}
