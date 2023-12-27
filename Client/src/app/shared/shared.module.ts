import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { WidgetModule } from './widget/widget.module';
import { PagetitleComponent } from './pagetitle/pagetitle.component';
import { CreateProductComponent } from './components/create-product/create-product.component';
import {NgbAlert} from "@ng-bootstrap/ng-bootstrap";
import { PaginationTextPipe } from './custom-pipe/pagination-text.pipe';
import { SystemInformationComponent } from './components/system-information/system-information.component';
import { CapitalizeFirstLetterPipe } from './custom-pipe/capitalize-first-letter.pipe';

@NgModule({
  declarations: [

    PagetitleComponent,
      CreateProductComponent,
      PaginationTextPipe,
      SystemInformationComponent,
      CapitalizeFirstLetterPipe
  ],
    imports: [
        CommonModule,
        WidgetModule,
        NgbAlert
    ],
  exports: [PagetitleComponent, PaginationTextPipe]
})
export class SharedModule { }
