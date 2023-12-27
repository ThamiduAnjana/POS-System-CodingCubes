import {Component, inject, TemplateRef} from '@angular/core';
import {FormBuilder, FormGroup} from "@angular/forms";
import {NgbCalendar, NgbDate, NgbDateParserFormatter, NgbModal, NgbModalRef} from "@ng-bootstrap/ng-bootstrap";
import {CreateProductComponent} from "../../../shared/components/create-product/create-product.component";
import {DATEFILTERS} from "../../../shared/utilities/date-filters";
import {SystemInformationComponent} from "../../../shared/components/system-information/system-information.component";

@Component({
  selector: 'app-products',
  templateUrl: './products.component.html',
  styleUrls: ['./products.component.scss']
})
export class ProductsComponent {

  breadCrumbItems!: Array<{}>;
  modelRef!: NgbModalRef;
  dateFilters: any = DATEFILTERS;

  calendar = inject(NgbCalendar);
  formatter = inject(NgbDateParserFormatter);
  hoveredDate: NgbDate | null = null;
  fromDate: NgbDate | null = this.calendar.getToday();
  toDate: NgbDate | null = null;

  page = 1;
  pageSize = 10;
  pageSizes = [10, 25, 50, 100];
  totalRecords = 0;
  formData = [];
  settings = [];
  productList = [];

  filterForm!: FormGroup;

  constructor(private formBuilder: FormBuilder,private modalService: NgbModal)
  {
    this.filterForm = this.formBuilder.group({
      keyword: [''],
      created_at: ['all'],
      date: {
        from: this.fromDate,
        to: this.toDate,
      },
      status: [1],
    });
  }

  ngOnInit(): void
  {
    this.breadCrumbItems = [
      { label: 'Catalogs' },
      { label: 'Products', active: true }
    ];
    // document.body.setAttribute('loading', 'true');
  }

  getProducts()
  {

  }



  openModel(data:any = null, isEdit = false)
  {
    this.modelRef = this.modalService.open(CreateProductComponent, {size: '2xl', backdrop: 'static', keyboard: false});
    this.modelRef.componentInstance.formData = { 'product_ref' : data , 'isEdit' : isEdit, 'form_data' : this.formData };
    this.modelRef.result.then((result) => {
      if(result)
      {
        this.getProducts();
      }
    }, (reason) => {
      console.log(reason);
    });
  }

  openInformationModel()
  {
    this.modelRef = this.modalService.open(SystemInformationComponent, {size: '2xl', backdrop: 'static', keyboard: false});
    this.modelRef.componentInstance.formData = { 'from' : 'products_screen' };
  }

  onDateSelection(date: NgbDate)
  {
    if (!this.fromDate && !this.toDate) {
      this.fromDate = date;
    } else if (this.fromDate && !this.toDate && date && date.after(this.fromDate)) {
      this.toDate = date;
    } else {
      this.toDate = null;
      this.fromDate = date;
    }
    this.updateDateRange();
  }

  updateDateRange()
  {
    this.filterForm.patchValue({
      date: {
        from: this.fromDate,
        to: this.toDate,
      },
    });
  }

  isHovered(date: NgbDate)
  {
    return (
      this.fromDate && !this.toDate && this.hoveredDate && date.after(this.fromDate) && date.before(this.hoveredDate)
    );
  }

  isInside(date: NgbDate)
  {
    return this.toDate && date.after(this.fromDate) && date.before(this.toDate);
  }

  isRange(date: NgbDate)
  {
    return (
      date.equals(this.fromDate) ||
      (this.toDate && date.equals(this.toDate)) ||
      this.isInside(date) ||
      this.isHovered(date)
    );
  }

  validateInput(currentValue: NgbDate | null, input: string): NgbDate | null
  {
    const parsed = this.formatter.parse(input);
    return parsed && this.calendar.isValid(NgbDate.from(parsed)) ? NgbDate.from(parsed) : currentValue;
  }

}
