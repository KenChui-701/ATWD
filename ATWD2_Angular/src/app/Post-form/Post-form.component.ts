import { Component, Input, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators, FormControl} from '@angular/forms';
import { HttpClient, HttpResponse } from '@angular/common/http';

@Component({
  selector: 'app-Post-form',
  templateUrl: './Post-form.component.html',
  styleUrls: ['./Post-form.component.css']
})
export class PostFormComponent implements OnInit {
  InsertForm: FormGroup;
  serverData: Object | null = null;
  loading: boolean = false;
  http: HttpClient;

  constructor(fb: FormBuilder, http: HttpClient) {
    this.http = http;
    this.InsertForm = fb.group({
      //'studentInput': ['', Validators.compose([Validators.required, this.studentIdValidator])],
      //'studentName' : ['', Validators.compose([Validators.required,Validators.maxLength(15)])],
      //'studentemail': ['', Validators.compose([Validators.required,Validators.email])],
      'INSERT_ROUTE_ID':['',Validators.required],
      'INSERT_ROUTE_NAMEC':['',Validators.required],
      'INSERT_ROUTE_NAMES':['',Validators.required],
      'INSERT_ROUTE_NAMEE':['',Validators.required],

      'INSERT_COMPANY_CODE':['',Validators.required],
      'INSERT_ROUTE_TYPE':['',Validators.required],
      'INSERT_SERVICE_MODE':['',Validators.required],

      'INSERT_SPECIAL_TYPE':['',Validators.required],
      'INSERT_JOURNEY_TIME':['',Validators.required],
      'INSERT_FULL_FARE':['',Validators.required],

      'INSERT_LOC_START_NAMEC':['',Validators.required],
      'INSERT_LOC_START_NAMES':['',Validators.required],
      'INSERT_LOC_START_NAMEE':['',Validators.required],

      'INSERT_LOC_END_NAMEC':['',Validators.required],
      'INSERT_LOC_END_NAMES':['',Validators.required],
      'INSERT_LOC_END_NAMEE':['',Validators.required],

      'INSERT_HYPERLINK_C':['',Validators.required],
      'INSERT_HYPERLINK_S':['',Validators.required],
      'INSERT_HYPERLINK_E':['',Validators.required]
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
    this.http.post<any>(this.getURL()
    ,{
      ROUTE_NAMEC : formValue.INSERT_ROUTE_NAMEC,
      ROUTE_NAMES : formValue.INSERT_ROUTE_NAMES,
      ROUTE_NAMEE : formValue.INSERT_ROUTE_NAMEE,

      COMPANY_CODE : formValue.INSERT_COMPANY_CODE,
      ROUTE_TYPE   : formValue.INSERT_ROUTE_TYPE,
      SERVICE_MODE : formValue.INSERT_SERVICE_MODE,

      SPECIAL_TYPE : formValue.INSERT_SPECIAL_TYPE,
      JOURNEY_TIME : formValue.INSERT_JOURNEY_TIME,
      FULL_FARE    : formValue.INSERT_FULL_FARE,

      LOC_START_NAMEC : formValue.INSERT_LOC_START_NAMEC,
      LOC_START_NAMES : formValue.INSERT_LOC_START_NAMES,
      LOC_START_NAMEE : formValue.INSERT_LOC_START_NAMEE,
      
      LOC_END_NAMEC : formValue.INSERT_LOC_END_NAMEC,
      LOC_END_NAMES : formValue.INSERT_LOC_END_NAMES,
      LOC_END_NAMEE : formValue.INSERT_LOC_END_NAMEE,
      
      HYPERLINK_C : formValue.INSERT_HYPERLINK_C,
      HYPERLINK_S : formValue.INSERT_HYPERLINK_S,
      HYPERLINK_E : formValue.INSERT_HYPERLINK_E,

      LAST_UPDATE_DATE : d,
      ROUTE_ID : formValue.INSERT_ROUTE_ID,
    })
    .subscribe(res=>{
        console.log(res);
        let res1:string = JSON.stringify(res);
        let res2:any = JSON.parse(res1);
        console.log(res2.code);
        if(res2.code == 203){
          alert(res2.message); 
        }else{
          alert(res2.message);
        } 
      },res =>{
        console.log('error');
      },()=>{
        this.loading = false;
      }
    );
  }

  ngOnInit(): void {
  }

}
