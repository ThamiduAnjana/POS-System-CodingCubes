import { Injectable } from '@angular/core';
import {HttpHeaders} from "@angular/common/http";
import {ToastrService} from "ngx-toastr";

@Injectable({
  providedIn: 'root'
})
export class GlobalService {

  private serverUrl = 'http://127.0.0.1:8000/api/';

  constructor(private toastService: ToastrService) { }

  getAPIUrl(){
    return this.serverUrl;
  }

  getHttpOptions() {
    return {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        Authorization: 'Bearer ' + localStorage.getItem('access_token')
      }),
    };
  }

  getHttpOptionsWithOutJson() {
    return {
      headers: new HttpHeaders({
        Authorization: 'Bearer ' + localStorage.getItem('access_token')
      }),
    };
  }

  /**
   * Success message
   */
  showSuccess(message: String) {
    this.toastService.success(message.toString(),  'Success!', { timeOut: 5000,
      positionClass: 'toast-top-right'});
  }

  /**
   * Danger message
   */
  showError(message: String = 'Something went Wrong!') {
    this.toastService.error(message.toString(), 'Error!',{ timeOut: 5000,
      positionClass: 'toast-top-right' });
  }

  /**
   * Info message
   */
  showInfo(message: String, title: String = 'Information!') {
    this.toastService.info(message.toString(),  title.toString(),{ timeOut: 5000,
      positionClass: 'toast-top-right'});
  }

  /**
   * Warning message
   */
  showWarning(message: String) {
    this.toastService.warning(message.toString(),  'Warning!',{ timeOut: 5000,
      positionClass: 'toast-top-right'});
  }
}
