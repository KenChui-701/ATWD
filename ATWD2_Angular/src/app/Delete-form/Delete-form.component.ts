import { Component, Input, OnInit, Output, EventEmitter,OnChanges, DoCheck} from '@angular/core';
import { FormGroup, FormBuilder, Validators, FormControl} from '@angular/forms';
import { BusRecord } from '../BusRecord.model';
import { HttpClient, HttpResponse } from '@angular/common/http';
@Component({
  selector: 'app-Delete-form',
  templateUrl: './Delete-form.component.html',
  styleUrls: ['./Delete-form.component.css']
})
export class DeleteFormComponent implements OnInit,OnChanges,DoCheck {
  @Input() record!: BusRecord;
  DeleteForm: FormGroup;
  Pass!: boolean;
  serverData: Object | null = null;
  loading: boolean = false;
  http: HttpClient;
  resource:string=(<HTMLInputElement>document.getElementById('resource')).value;
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
    this.DeleteForm = fb.group({
      //'studentInput': ['', Validators.compose([Validators.required, this.studentIdValidator])],
      //'studentName' : ['', Validators.compose([Validators.required,Validators.maxLength(15)])],
      //'studentemail': ['', Validators.compose([Validators.required,Validators.email])],
      'DELETE_ROUTE_NAME':['',Validators.required],
      'DELETE_ROUTE_ID':[0,Validators.required]
    });
  }

  getURL(formValue: any):string{
    this.busRecord = this.record;
    let resource = this.resource;
    console.log(resource)
    let url = 'http://localhost/ATWD/serverSide/Controller.php/';
    if(resource=="Routebus"){
      url += resource;
      if(!!formValue.DELETE_ROUTE_NAME){
          let keyword = formValue.DELETE_ROUTE_NAME;
          url += "/Bus"+"/"+keyword;
      }else if(!!formValue.DELETE_ROUTE_ID){
          let keyword = formValue.DELETE_ROUTE_ID;
          url += "/RID"+"/"+keyword;
      }else
        console.log("Empty Input! Please Input the correct Values")

    }if(resource=="Routestopbus"){
      url += resource;
      if(!!formValue.DELETE_ROUTE_ID){
          var keyword = formValue.DELETE_ROUTE_ID;
          url += "/RID"+"/"+keyword;
      }else
        console.log("Empty Input! Please Input the correct Values")
    }
    console.log(url)
    return url
  }

  ngOnInit(): void {
  }

  ngOnChanges():void{ 
    this.busRecord = this.record;
    console.log(this.busRecord.ROUTE_ID);
    this.DeleteForm.patchValue({
      DELETE_ROUTE_NAME: this.busRecord.ROUTE_NAMEC,
      DELETE_ROUTE_ID: this.busRecord.ROUTE_ID
    })
  }

  ngDoCheck():void{
    this.busRecord = this.record;
    var x=(<HTMLInputElement>document.getElementById('DELETE_ROUTE_ID')).value
    var x1:number =+ x;
    if(this.busRecord.ROUTE_ID!=x1){
      console.log(this.busRecord.ROUTE_ID);
      this.DeleteForm.patchValue({
        DELETE_ROUTE_NAME: this.busRecord.ROUTE_NAMEC,
        DELETE_ROUTE_ID: this.busRecord.ROUTE_ID
      })
    }
  }

  makeRequest(formValue: any ) :void { 
    
    this.loading = true;
    this.serverData = null;
    this.http.delete<any>(this.getURL(formValue))
      .subscribe(res=>{
        console.log("the data "+this.busRecord.ROUTE_ID)
        console.log(res);
        let res1:string = JSON.stringify(res);
        let res2:any = JSON.parse(res1);
        console.log(res2.message);
        alert(res2.code+" "+res2.message);  
        if (res2.code == 201){
          this.loopGet(false);
        }
        if (res2.code == 200){
          this.loopGet(true)
        }
        },res =>{
          console.log('error');
          alert(res[1]);
        },()=>{
          this.loading = false;
        }
      );
    this.loopGet(false);
  }
  @Output() loopEvent = new EventEmitter<boolean>();
  loopGet(pass:boolean):void{
    if (pass == true){
      this.Pass = pass;
    }else{
      this.Pass = false;
    }
    this.loopEvent.emit(this.Pass)
  }
}
