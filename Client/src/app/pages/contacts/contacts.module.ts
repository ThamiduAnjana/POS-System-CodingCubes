import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { ContactsRoutingModule } from './contacts-routing.module';
import { CustomersComponent } from './customers/customers.component';
import { SuppliersComponent } from './suppliers/suppliers.component';
import { EmployeesComponent } from './employees/employees.component';
import {NgbDropdown, NgbDropdownMenu, NgbDropdownToggle, NgbPagination} from "@ng-bootstrap/ng-bootstrap";
import {NgSelectModule} from "@ng-select/ng-select";
import {FormsModule, ReactiveFormsModule} from "@angular/forms";
import {SharedModule} from "../../shared/shared.module";
import { CustomerGroupsComponent } from './customer-groups/customer-groups.component';


@NgModule({
  declarations: [
    CustomersComponent,
    SuppliersComponent,
    EmployeesComponent,
    CustomerGroupsComponent
  ],
  imports: [
    CommonModule,
    ContactsRoutingModule,
    NgbPagination,
    NgSelectModule,
    ReactiveFormsModule,
    SharedModule,
    FormsModule,
    NgbDropdown,
    NgbDropdownToggle,
    NgbDropdownMenu
  ]
})
export class ContactsModule { }
