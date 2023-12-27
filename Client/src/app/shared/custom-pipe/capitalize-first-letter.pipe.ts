import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'capitalizeFirstLetter'
})
export class CapitalizeFirstLetterPipe implements PipeTransform {

  transform(value: string): string {
    if (!value) return value;
    return value.replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
  }

}
