import { HeaderTitles } from './../../interfaces/headerInterface';
import { Component, Input } from '@angular/core';
@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent {
  @Input() pageHeader : HeaderTitles = {
    section:'',
    title:'',
    caption: ''
  }
  @Input() userName = ''
}
