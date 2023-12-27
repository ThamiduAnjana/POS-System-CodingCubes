import { DateFilter } from './interfaces/date-filter';

// check local storage has settings or not
let settings = [];
if(localStorage.hasOwnProperty('settings')){
   settings = JSON.parse(<string>localStorage.getItem('settings'));
}

const date:Date = new Date();

const today = {
  from: { 'year': date.getFullYear(),  'month': date.getMonth() + 1,  'day': date.getDate() },
  to: { 'year': date.getFullYear(),  'month': date.getMonth() + 1,  'day': date.getDate() }
};

const yesterday = {
  from: { 'year': date.getFullYear(),  'month': date.getMonth() + 1,  'day': date.getDate() -1 },
  to: { 'year': date.getFullYear(),  'month': date.getMonth() + 1,  'day': date.getDate() -1 }
};

const last_7_days = {
  from: { 'year': date.getFullYear(),  'month': date.getMonth() + 1,  'day': date.getDate() - 7 },
  to: { 'year': date.getFullYear(),  'month': date.getMonth() + 1,  'day': date.getDate() }
};

const last_30_days = {
  from: { 'year': date.getFullYear(),  'month': date.getMonth() + 1,  'day': date.getDate() - 30 },
  to: { 'year': date.getFullYear(),  'month': date.getMonth() + 1,  'day': date.getDate() }
};

const current_month = {
  from: { 'year': date.getFullYear(),  'month': date.getMonth() + 1,  'day': 1 },
  to: { 'year': date.getFullYear(),  'month': date.getMonth() + 2,  'day': 0}
};

const last_month = {
  from: { 'year': date.getFullYear(),  'month': date.getMonth() - 2,  'day': 1 },
  to: { 'year': date.getFullYear(),  'month': date.getMonth() + 1,  'day': 0}
};

const current_year = {
  from: { 'year': date.getFullYear(),  'month': 0,  'day': 1 },
  to: { 'year': date.getFullYear(),  'month': 11,  'day': 31 }
};

const last_year = {
  from: { 'year': date.getFullYear() - 1,  'month': 0,  'day': 1 },
  to: { 'year': date.getFullYear() - 1,  'month': 11,  'day': 31 }
};

let current_financial_year;
if(settings){
  if(settings.financial_year == '1'){
    current_financial_year = {
      from: { 'year': date.getFullYear(),  'month': 3,  'day': 1 },
      to: { 'year': date.getFullYear() + 1,  'month': 2,  'day': 31 }
    };
  }
}else {
  current_financial_year = {
    from: { 'year': date.getFullYear(),  'month': 0,  'day': 1 },
    to: { 'year': date.getFullYear(),  'month': 11,  'day': 31 }
  };
}

let last_financial_year;
if(settings){
  if(settings.financial_year == '1'){
    last_financial_year = {
      from: { 'year': date.getFullYear() - 1,  'month': 3,  'day': 1 },
      to: { 'year': date.getFullYear(),  'month': 2,  'day': 31 }
    };
  }
}else {
  last_financial_year = {
    from: { 'year': date.getFullYear() - 1,  'month': 0,  'day': 1 },
    to: { 'year': date.getFullYear() - 1,  'month': 11,  'day': 31 }
  };
}

export const DATEFILTERS:DateFilter[] = [
  { id:1, title:'All', code:'all', date: [] },
  { id:2, title:'Custom Range', code:'custom_range', date: [] },
  { id:3, title:'Today', code:'today', date: today },
  { id:4, title:'Yesterday', code:'yesterday', date: yesterday },
  { id:5, title:'Last 7 Days', code:'last_7_days', date: last_7_days },
  { id:6, title:'Last 30 Days', code:'last_30_days', date: last_30_days },
  { id:7, title:'Current Month', code:'current_month', date: current_month },
  { id:8, title:'Last Month', code:'last_month', date: last_month },
  { id:9, title:'Current Year', code:'current_year', date: current_year },
  { id:10, title:'Last Year', code:'last_year', date: last_year },
  { id:11, title:'Current Financial Year', code:'current_financial_year', date: current_financial_year },
  { id:12, title:'Last Financial Year', code:'last_financial_year', date: last_financial_year },
];
