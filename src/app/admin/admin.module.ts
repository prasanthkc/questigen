import { NgModule } from '@angular/core';
import { AdminRoutingModule } from './admin-routing.module';
import { DashboardComponent } from './pages/dashboard/dashboard.component';
 
@NgModule({
  declarations: [DashboardComponent],
  imports: [
    AdminRoutingModule,
  ],
  providers: [],
})
export class AdminModule { }