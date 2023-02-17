import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';
import { AppComponent } from './app.component';
import { GetFormComponent } from './Get-form/Get-form.component';
import { PutFormComponent } from './Put-form/Put-form.component';
import { PostFormComponent } from './Post-form/Post-form.component';
import { DeleteFormComponent } from './Delete-form/Delete-form.component';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
@NgModule({
  declarations: [
    AppComponent,
    GetFormComponent,
    PutFormComponent,
    PostFormComponent,
    DeleteFormComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
