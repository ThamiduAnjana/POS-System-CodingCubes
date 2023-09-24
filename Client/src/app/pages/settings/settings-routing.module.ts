import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {UsersComponent} from "./users/users.component";
import {OtherUnitsComponent} from "./other-units/other-units.component";
import {ShopsComponent} from "./shops/shops.component";
import {BillTemplatesComponent} from "./bill-templates/bill-templates.component";
import {NotificationTemplatesComponent} from "./notification-templates/notification-templates.component";
import {PermissionsComponent} from "./permissions/permissions.component";
import {SystemSettingsComponent} from "./system-settings/system-settings.component";

const routes: Routes = [
  {
    path: 'users',
    component: UsersComponent
  },
  {
    path: 'other-units',
    component: OtherUnitsComponent
  },
  {
    path: 'shops',
    component: ShopsComponent
  },
  {
    path: 'bill-templates',
    component: BillTemplatesComponent
  },
  {
    path: 'notifications-templates',
    component: NotificationTemplatesComponent
  },
  {
    path: 'permissions',
    component: PermissionsComponent
  },
  {
    path: 'system-settings',
    component: SystemSettingsComponent
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class SettingsRoutingModule { }
