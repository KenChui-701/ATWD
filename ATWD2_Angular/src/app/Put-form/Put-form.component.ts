import { Component, Input, OnInit, Output, EventEmitter,OnChanges, DoCheck} from '@angular/core';
import { FormGroup, FormBuilder, Validators, FormControl} from '@angular/forms';
import { BusRecord } from '../BusRecord.model';
import { HttpClient, HttpResponse } from '@angular/common/http';

@Component({
  selector: 'app-Put-form',
  templateUrl: './Put-form.component.html',
  styleUrls: ['./Put-form.component.css']
})
export class PutFormComponent implements OnInit,OnChanges,DoCheck{
  resource:string=(<HTMLInputElement>document.getElementById('resource')).value;
  @Input() record!: BusRecord;
  Pass!: boolean;
  UpdateForm: FormGroup;
  serverData: Object | null = null;
  loading: boolean = false;
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
    this.UpdateForm = fb.group({
      //'studentInput': ['', Validators.compose([Validators.required, this.studentIdValidator])],
      //'studentName' : ['', Validators.compose([Validators.required,Validators.maxLength(15)])],
      //'studentemail': ['', Validators.compose([Validators.required,Validators.email])],
      'UPDATE_ROUTE_ID':['',Validators.required],
      'ROUTE_NAMEC':['',Validators.required],
      'ROUTE_NAMES':['',Validators.required],
      'ROUTE_NAMEE':['',Validators.required],

      'COMPANY_CODE':['',Validators.required],
      'ROUTE_TYPE':['',Validators.required],
      'SERVICE_MODE':['',Validators.required],

      'SPECIAL_TYPE':['',Validators.required],
      'JOURNEY_TIME':['',Validators.required],
      'FULL_FARE':['',Validators.required],

      'LOC_START_NAMEC':['',Validators.required],
      'LOC_START_NAMES':['',Validators.required],
      'LOC_START_NAMEE':['',Validators.required],

      'LOC_END_NAMEC':['',Validators.required],
      'LOC_END_NAMES':['',Validators.required],
      'LOC_END_NAMEE':['',Validators.required]
    });
  }

  getURL():any{
    let resource = (<HTMLInputElement>document.getElementById('resource')).value;
    console.log(resource)
    let url = 'http://localhost/ATWD/serverSide/Controller.php/';
    url += resource;
    console.log(url)
    return url
  }

  makeRequest(formValue: any ) :void { 
    var d = new Date();
    this.loading = true;
    this.serverData = null;
    this.http.put<any>(this.getURL()
    ,{
      ROUTE_NAMEC : formValue.ROUTE_NAMEC,
      ROUTE_NAMES : formValue.ROUTE_NAMES,
      ROUTE_NAMEE : formValue.ROUTE_NAMEE,

      COMPANY_CODE : formValue.COMPANY_CODE,
      ROUTE_TYPE   : formValue.ROUTE_TYPE,
      SERVICE_MODE : formValue.SERVICE_MODE,

      SPECIAL_TYPE : formValue.SPECIAL_TYPE,
      JOURNEY_TIME : formValue.JOURNEY_TIME,
      FULL_FARE    : formValue.FULL_FARE,

      LOC_START_NAMEC : formValue.LOC_START_NAMEC,
      LOC_START_NAMES : formValue.LOC_START_NAMES,
      LOC_START_NAMEE : formValue.LOC_START_NAMEE,
      
      LOC_END_NAMEC : formValue.LOC_END_NAMEC,
      LOC_END_NAMES : formValue.LOC_END_NAMES,
      LOC_END_NAMEE : formValue.LOC_END_NAMEE,
      
      LAST_UPDATE_DATE : d,
      ROUTE_ID : formValue.UPDATE_ROUTE_ID,
    })
    .subscribe(res=>{
        console.log(res);
        let res1:string = JSON.stringify(res);
        let res2:any = JSON.parse(res1);
        console.log(res2.code);
        alert(res2.code+" "+res2.message);  
        this.UloopGet(true)
        
      },res =>{
        console.log('error');
      },()=>{
        this.loading = false;
      }
    );
    this.UloopGet(false);
  }

  @Output() UloopEvent = new EventEmitter<boolean>();
  UloopGet(pass:boolean):void{
    if (pass == true){
      this.Pass = pass;
      
    }else{
      this.Pass = false;
    }
    this.UloopEvent.emit(this.Pass)
  }

  ngOnInit(): void {
  }
  ngOnChanges():void{ 
    this.busRecord = this.record;
    this.UpdateForm.patchValue({
      UPDATE_ROUTE_ID: this.record.ROUTE_ID,
      ROUTE_NAMEC: this.record.ROUTE_NAMEC,
      ROUTE_NAMES: this.record.ROUTE_NAMES,
      ROUTE_NAMEE: this.record.ROUTE_NAMEE,

      COMPANY_CODE: this.record.COMPANY_CODE,
      ROUTE_TYPE: this.record.ROUTE_TYPE,
      SERVICE_MODE: this.record.SERVICE_MODE,

      SPECIAL_TYPE: this.record.SPECIAL_TYPE,
      JOURNEY_TIME: this.record.JOURNEY_TIME,
      FULL_FARE: this.record.FULL_FARE,

      LOC_START_NAMEC: this.record.LOC_START_NAMEC,
      LOC_START_NAMES: this.record.LOC_START_NAMES,
      LOC_START_NAMEE: this.record.LOC_START_NAMEE,

      LOC_END_NAMEC: this.record.LOC_END_NAMEC,
      LOC_END_NAMES: this.record.LOC_END_NAMES,
      LOC_END_NAMEE: this.record.LOC_END_NAMEE,
    })
    console.log(this.busRecord.ROUTE_ID);
  }

  ngDoCheck():void{
    this.busRecord = this.record;
    let getcheck:string =  (<HTMLInputElement>document.getElementById('UPDATE_ROUTE_ID')).value;
    let check: number =+ getcheck;
    if(this.busRecord.ROUTE_ID!=check){
      this.UpdateForm.patchValue({
        UPDATE_ROUTE_ID: this.record.ROUTE_ID,
        ROUTE_NAMEC: this.record.ROUTE_NAMEC,
        ROUTE_NAMES: this.record.ROUTE_NAMES,
        ROUTE_NAMEE: this.record.ROUTE_NAMEE,
  
        COMPANY_CODE: this.record.COMPANY_CODE,
        ROUTE_TYPE: this.record.ROUTE_TYPE,
        SERVICE_MODE: this.record.SERVICE_MODE,
  
        SPECIAL_TYPE: this.record.SPECIAL_TYPE,
        JOURNEY_TIME: this.record.JOURNEY_TIME,
        FULL_FARE: this.record.FULL_FARE,
  
        LOC_START_NAMEC: this.record.LOC_START_NAMEC,
        LOC_START_NAMES: this.record.LOC_START_NAMES,
        LOC_START_NAMEE: this.record.LOC_START_NAMEE,
  
        LOC_END_NAMEC: this.record.LOC_END_NAMEC,
        LOC_END_NAMES: this.record.LOC_END_NAMES,
        LOC_END_NAMEE: this.record.LOC_END_NAMEE,
      })
      
    }
    
  }

  
}
