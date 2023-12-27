import { Component } from '@angular/core';
import {NgbActiveModal} from "@ng-bootstrap/ng-bootstrap";

@Component({
  selector: 'app-system-information',
  templateUrl: './system-information.component.html',
  styleUrls: ['./system-information.component.scss']
})
export class SystemInformationComponent {

  formData: any = [];

  constructor(
    public activeModal: NgbActiveModal
  ) { }

  closeModal(){
    this.activeModal.close();
  }

}
