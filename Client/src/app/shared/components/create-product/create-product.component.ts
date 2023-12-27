import {Component, OnInit} from '@angular/core';
import {NgbActiveModal, NgbModal} from "@ng-bootstrap/ng-bootstrap";

@Component({
  selector: 'app-create-product',
  templateUrl: './create-product.component.html',
  styleUrls: ['./create-product.component.scss']
})
export class CreateProductComponent implements OnInit{

  isEdit: boolean = false;
  isInvalid: boolean = false;
  isSubmitted: boolean = false;
  isError: boolean = false;
  formData: any = [];

  imgURL: any;
  formImage: File | null | undefined;
  public imagePath: any;

  constructor(
    public activeModal: NgbActiveModal
  ) {
  }

  ngOnInit(): void {

  }

  closeModal(){
    this.activeModal.close();
  }

  submitForm(){
    this.activeModal.close();
  }

  preview(files: any, event: Event)
  {

  }

  removeImage()
  {
    this.imgURL = '';
    this.formImage = null;
  }
}
