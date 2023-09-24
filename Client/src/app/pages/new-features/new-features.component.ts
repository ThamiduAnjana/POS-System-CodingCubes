import { Component } from '@angular/core';

@Component({
  selector: 'app-new-features',
  templateUrl: './new-features.component.html',
  styleUrls: ['./new-features.component.scss']
})
export class NewFeaturesComponent {

  breadCrumbItems!: Array<{}>;

  constructor() { }

  ngOnInit(): void
  {
    this.breadCrumbItems = [
      { label: 'System' },
      { label: 'New Features', active: true }
    ];
  }

}
