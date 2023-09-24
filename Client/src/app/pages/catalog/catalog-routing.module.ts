import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {ProductsComponent} from "./products/products.component";
import {VariationsComponent} from "./variations/variations.component";
import {UnitsComponent} from "./units/units.component";
import {CategoriesComponent} from "./categories/categories.component";
import {BrandsComponent} from "./brands/brands.component";
import {ColorsComponent} from "./colors/colors.component";
import {WarrantiesComponent} from "./warranties/warranties.component";

const routes: Routes = [
  {
    path: 'products',
    component: ProductsComponent
  },
  {
    path: 'variations',
    component: VariationsComponent
  },
  {
    path: 'units',
    component: UnitsComponent
  },
  {
    path: 'categories',
    component: CategoriesComponent
  },
  {
    path: 'brands',
    component: BrandsComponent
  },
  {
    path: 'colors',
    component: ColorsComponent
  },
  {
    path: 'warranties',
    component: WarrantiesComponent
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class CatalogRoutingModule { }
