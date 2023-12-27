import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'paginationText'
})
export class PaginationTextPipe implements PipeTransform {

  transform(page: number, pageSize: number, totalRecords: number): string {
    if (totalRecords === 0) {
      return 'No records found.';
    }
    const start = (page - 1) * pageSize + 1;
    const end = page * pageSize < totalRecords ? page * pageSize : totalRecords;
    return `Showing ${start} to ${end} of ${totalRecords} entries`;
  }

}
