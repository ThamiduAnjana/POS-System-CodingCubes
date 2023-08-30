import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { SettingsRoutingModule } from './settings-routing.module';
import { UsersComponent } from './users/users.component';
import { OtherUnitsComponent } from './other-units/other-units.component';
import { ShopsComponent } from './shops/shops.component';
import { BillTemplatesComponent } from './bill-templates/bill-templates.component';
import { NotificationTemplatesComponent } from './notification-templates/notification-templates.component';
import { PermissionsComponent } from './permissions/permissions.component';
import { SystemSettingsComponent } from './system-settings/system-settings.component';


@NgModule({
  declarations: [
    UsersComponent,
    OtherUnitsComponent,
    ShopsComponent,
    BillTemplatesComponent,
    NotificationTemplatesComponent,
    PermissionsComponent,
    SystemSettingsComponent
  ],
  imports: [
    CommonModule,
    SettingsRoutingModule
  ]
})
export class SettingsModule { }
