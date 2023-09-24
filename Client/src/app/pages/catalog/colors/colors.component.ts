import { Component } from '@angular/core';
import {FormBuilder, FormGroup} from "@angular/forms";

@Component({
  selector: 'app-colors',
  templateUrl: './colors.component.html',
  styleUrls: ['./colors.component.scss']
})
export class ColorsComponent {

  breadCrumbItems!: Array<{}>;

  page = 1;
  pageSize = 10;
  pageSizes = [10, 25, 50, 100];
  totalRecords = 0;
  settings = [];

  colorList = [];

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
      { label: 'Colors', active: true }
    ];
  }

  getColors()
  {

  }

}
