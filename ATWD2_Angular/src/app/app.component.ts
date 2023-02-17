import { Component } from '@angular/core';
import { BusRecord } from './BusRecord.model';
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'ATWD2_Angular';
  deleteEventTriggered: boolean = false;
  updateEventTriggered: boolean = false;
  DeletePass:boolean = false;
  UpdatePass:boolean = false;
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

  deleteEventReceiver(busRecord: BusRecord) {
    console.log("App: delete event received");
    console.log("App: busRecord received from delete event:");

    // save busRecord received from SearchBusComponent via event
    this.busRecord = busRecord;

    console.log("routeNumber: " + this.busRecord.ROUTE_ID);
    console.log("fare: " + this.busRecord.FULL_FARE);
    console.log("startPoint: " + this.busRecord.LOC_START_NAMEE);
    console.log("endPoint: " + this.busRecord.LOC_END_NAMEE);
    this.deleteEventTriggered = true;
  }

  updateEventReceiver(busRecord: BusRecord) {
    console.log("App: update event received");
    console.log("App: busRecord received from update event:");
    // save busRecord received from SearchBusComponent via event
    this.busRecord = busRecord;
    console.log("routeNumber: " + this.busRecord.ROUTE_ID);
    console.log("fare: " + this.busRecord.FULL_FARE);
    console.log("startPoint: " + this.busRecord.LOC_START_NAMEE);
    console.log("endPoint: " + this.busRecord.LOC_END_NAMEE);
    this.updateEventTriggered = true;
  }
  UloopGet(Uloop:boolean){
    this.UpdatePass = Uloop;
  }
  loopGet(loopGet: boolean){
    this.DeletePass = loopGet;
  }
}
