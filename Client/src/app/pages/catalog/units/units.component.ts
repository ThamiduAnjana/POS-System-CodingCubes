import { Component } from '@angular/core';
import {FormBuilder, FormGroup} from "@angular/forms";

@Component({
  selector: 'app-units',
  templateUrl: './units.component.html',
  styleUrls: ['./units.component.scss']
})
export class UnitsComponent {

  breadCrumbItems!: Array<{}>;

  page = 1;
  pageSize = 10;
  pageSizes = [10, 25, 50, 100];
  totalRecords = 0;
  settings = [];

  unitList = [];

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
      { label: 'Catalogs' },
      { label: 'Units', active: true }
    ];
  }

  getUnits()
  {

  }

}
