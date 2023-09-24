import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { DashboardComponent } from './dashboard/dashboard.component';
import {HelpsComponent} from "./helps/helps.component";
import {IssuesComponent} from "./issues/issues.component";
import {NewFeaturesComponent} from "./new-features/new-features.component";

const routes: Routes = [
  {
    path: '',
    component: DashboardComponent
  },
  {
    path: 'catalogs', loadChildren: () => import('./catalog/catalog.module').then(m => m.CatalogModule)
  },
  {
    path: 'contacts', loadChildren: () => import('./contacts/contacts.module').then(m => m.ContactsModule)
  },
  {
    path: 'settings', loadChildren: () => import('./settings/settings.module').then(m => m.SettingsModule)
  },
  {
    path: 'help',
    component: HelpsComponent
  },
  {
    path: 'issues',
    component: IssuesComponent
  },
  {
    path: 'new-features',
    component: NewFeaturesComponent
  },
  {
    path: 'apps', loadChildren: () => import('./apps/apps.module').then(m => m.AppsModule)
  },
  {
    path: 'pages', loadChildren: () => import('./extraspages/extraspages.module').then(m => m.ExtraspagesModule)
  },
  {
    path: 'ui', loadChildren: () => import('./components/components.module').then(m => m.ComponentsModule)
  },
  {
    path: 'extended', loadChildren: () => import('./extended/extended.module').then(m => m.ExtendedModule)
  },
  {
    path: 'form', loadChildren: () => import('./form/form.module').then(m => m.FormModule)
  },
  {
    path: 'tables', loadChildren: () => import('./tables/tables.module').then(m => m.TablesModule)
  },
  {
    path: 'chart', loadChildren: () => import('./chart/chart.module').then(m => m.ChartModule)
  },
  {
    path: 'icons', loadChildren: () => import('./icons/icons.module').then(m => m.IconsModule)
  },
  {
    path: 'maps', loadChildren: () => import('./maps/maps.module').then(m => m.MapsModule)
  }

];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class PagesRoutingModule { }
