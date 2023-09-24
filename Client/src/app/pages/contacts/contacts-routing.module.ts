import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {CustomersComponent} from "./customers/customers.component";
import {EmployeesComponent} from "./employees/employees.component";
import {SuppliersComponent} from "./suppliers/suppliers.component";
import {CustomerGroupsComponent} from "./customer-groups/customer-groups.component";

const routes: Routes = [
  {
    path: 'customers',
    component: CustomersComponent,
  },
  {
    path: 'customer-groups',
    component: CustomerGroupsComponent,
  },
  {
    path: 'suppliers',
    component: SuppliersComponent,
  },
  {
    path: 'employees',
    component: EmployeesComponent,
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ContactsRoutingModule { }
