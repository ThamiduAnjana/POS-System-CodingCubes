import { Component } from '@angular/core';
import {FormBuilder, FormGroup} from "@angular/forms";

@Component({
  selector: 'app-variations',
  templateUrl: './variations.component.html',
  styleUrls: ['./variations.component.scss']
})
export class VariationsComponent {

  breadCrumbItems!: Array<{}>;

  page = 1;
  pageSize = 10;
  pageSizes = [10, 25, 50, 100];
  totalRecords = 0;
  settings = [];

  variationList = [];

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
      { label: 'Variations', active: true }
    ];
  }

  getVariations()
  {

  }

}
