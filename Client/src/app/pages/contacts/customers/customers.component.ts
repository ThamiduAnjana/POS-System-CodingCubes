import { Component } from '@angular/core';
import {FormBuilder, FormGroup} from "@angular/forms";

@Component({
  selector: 'app-customers',
  templateUrl: './customers.component.html',
  styleUrls: ['./customers.component.scss']
})
export class CustomersComponent {

  breadCrumbItems!: Array<{}>;

  page = 1;
  pageSize = 10;
  pageSizes = [10, 25, 50, 100];
  totalRecords = 0;
  settings = [];

  customerList = [];

  filterForm!: FormGroup;

  constructor(private formBuilder: FormBuilder)
  {
    this.filterForm = this.formBuilder.group({
      keyword: [''],
      status: [1],
    });
  }

  ngOnInit(): void
  {
    this.breadCrumbItems = [
      { label: 'Contacts' },
      { label: 'Customers', active: true }
    ];
  }

  getCustomers()
  {

  }

}
