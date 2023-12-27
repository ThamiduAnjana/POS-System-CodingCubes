import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { CatalogRoutingModule } from './catalog-routing.module';
import { ProductsComponent } from './products/products.component';
import {SharedModule} from "../../shared/shared.module";
import {
    NgbAlert,
    NgbDropdown,
    NgbDropdownMenu,
    NgbDropdownToggle,
    NgbInputDatepicker,
    NgbPagination
} from "@ng-bootstrap/ng-bootstrap";
import {FormsModule, ReactiveFormsModule} from "@angular/forms";
import {NgSelectModule} from "@ng-select/ng-select";
import { VariationsComponent } from './variations/variations.component';
import { UnitsComponent } from './units/units.component';
import { CategoriesComponent } from './categories/categories.component';
import { BrandsComponent } from './brands/brands.component';
import { ColorsComponent } from './colors/colors.component';
import { WarrantiesComponent } from './warranties/warranties.component';


@NgModule({
  declarations: [
    ProductsComponent,
    VariationsComponent,
    UnitsComponent,
    CategoriesComponent,
    BrandsComponent,
    ColorsComponent,
    WarrantiesComponent
  ],
    imports: [
        CommonModule,
        CatalogRoutingModule,
        SharedModule,
        NgbDropdown,
        NgbDropdownToggle,
        NgbDropdownMenu,
        FormsModule,
        NgbPagination,
        NgSelectModule,
        ReactiveFormsModule,
        NgbAlert,
        NgbInputDatepicker
    ]
})
export class CatalogModule { }
