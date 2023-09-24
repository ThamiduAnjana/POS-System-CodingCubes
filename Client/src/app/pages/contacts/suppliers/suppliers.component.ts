import { Component } from '@angular/core';
import {FormBuilder, FormGroup} from "@angular/forms";

@Component({
  selector: 'app-suppliers',
  templateUrl: './suppliers.component.html',
  styleUrls: ['./suppliers.component.scss']
})
export class SuppliersComponent {

  breadCrumbItems!: Array<{}>;

  page = 1;
  pageSize = 10;
  pageSizes = [10, 25, 50, 100];
  totalRecords = 0;
  settings = [];

  supplierList = [];

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
      { label: 'Suppliers', active: true }
    ];
  }

  getSuppliers()
  {

  }

}
