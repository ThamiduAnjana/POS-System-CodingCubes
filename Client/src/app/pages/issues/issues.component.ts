import { Component } from '@angular/core';

@Component({
  selector: 'app-issues',
  templateUrl: './issues.component.html',
  styleUrls: ['./issues.component.scss']
})
export class IssuesComponent {

  breadCrumbItems!: Array<{}>;

  constructor() { }

  ngOnInit(): void
  {
    this.breadCrumbItems = [
      { label: 'System' },
      { label: 'Issues', active: true }
    ];
  }

}
