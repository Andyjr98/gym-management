import { Component, OnInit } from '@angular/core';
import { GymService } from '../../services/gym.service';

@Component({
  selector: 'app-sesiones',
  templateUrl: './sesiones.component.html',
  styleUrls: ['./sesiones.component.css']
})
export class SesionesComponent implements OnInit {
  sesiones: any[] = [];
  nuevaSesion = { miembro_id: null, entrenador_id: null, fecha: '', duracion: null };

  constructor(private gymService: GymService) {}

  ngOnInit(): void {
    this.getSesiones();
  }

  getSesiones() {
    this.gymService.getSesiones().subscribe(data => {
      this.sesiones = data;
    });
  }

  addSesion() {
    this.gymService.addSesion(this.nuevaSesion).subscribe(() => {
      this.getSesiones();
      this.nuevaSesion = { miembro_id: null, entrenador_id: null, fecha: '', duracion: null };
    });
  }
}
