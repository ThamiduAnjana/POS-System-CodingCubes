import {Component, TemplateRef} from '@angular/core';
import {FormBuilder, FormGroup} from "@angular/forms";
import {NgbModal, NgbModalRef} from "@ng-bootstrap/ng-bootstrap";

@Component({
  selector: 'app-products',
  templateUrl: './products.component.html',
  styleUrls: ['./products.component.scss']
})
export class ProductsComponent {

  breadCrumbItems!: Array<{}>;
  private modalInstances: { [key: string]: NgbModalRef } = {}; // Object to store modal instances

  page = 1;
  pageSize = 10;
  pageSizes = [10, 25, 50, 100];
  totalRecords = 0;
  settings = [];

  isEdit = false;
  isInvalid = false;
  isSubmitted = false;

  productList = [];

  filterForm!: FormGroup;

  constructor(private formBuilder: FormBuilder,private modalService: NgbModal)
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
      { label: 'Products', active: true }
    ];
    // document.body.setAttribute('loading', 'true');
  }

  getProducts()
  {

  }



  openModel(model: TemplateRef<any>, ref: string, options: Object = {size: 'lg'})
  {
    const modelInstance = this.modalService.open(model, options);
    this.modalInstances[ref] = modelInstance;
  }

  closeModal(ref: string)
  {
    if(this.modalInstances[ref])
    {
      this.modalInstances[ref].close(); // Close the modal instance
      if(Object.keys(this.modalInstances).length <= 1)
      {
        delete this.modalInstances[ref]; // Remove from the modalInstances object
      }
    }
  }
}
