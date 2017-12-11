import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';

import { AppComponent } from './app.component';
import { EmailFormComponent } from './email-form/email-form.component';
import { DisplayEmailsComponent } from './display-emails/display-emails.component';
import { HeaderComponent } from './header/header.component';
import { FooterComponent } from './footer/footer.component';
import { ApiService } from './api-service.service';
@NgModule({
  declarations: [
    AppComponent,
    EmailFormComponent,
    DisplayEmailsComponent,
    HeaderComponent,
    FooterComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpModule
  ],
  providers: [ApiService],
  bootstrap: [AppComponent]
})
export class AppModule { }
