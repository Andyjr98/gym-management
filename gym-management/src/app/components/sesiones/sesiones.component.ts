import { Component, OnInit } from '@angular/core';
import { GymService } from '../../services/gym.service';

@Component({
  selector: 'app-sesiones',
  templateUrl: './sesiones.component.html',
  styleUrls: ['./sesiones.component.css']
})
export class SesionesComponent implements OnInit {
  sesiones: any[] = [];
  nuevaSesion = { id: null, idMiembro: '', idEntrenador: '', fecha: '', duracion: '' };

  constructor(private gymService: GymService) {}

  ngOnInit(): void {
    this.getSesiones();
  }

  getSesiones() {
    this.gymService.getSesiones().subscribe(data => {
      this.sesiones = data;
    }, error => {
      console.error('Error al obtener sesiones:', error);
    });
  }

  addSesion() {
    this.gymService.addSesion(this.nuevaSesion).subscribe(() => {
      this.getSesiones();
      this.nuevaSesion = { id: null, idMiembro: '', idEntrenador: '', fecha: '', duracion: '' };
    }, error => {
      console.error('Error al agregar sesión:', error);
    });
  }

  cargarSesion(sesion: any) {
    this.nuevaSesion = { ...sesion };
  }

  actualizarSesion() {
    this.gymService.updateSesion(this.nuevaSesion).subscribe(() => {
      this.getSesiones();
      this.nuevaSesion = { id: null, idMiembro: '', idEntrenador: '', fecha: '', duracion: '' };
    }, error => {
      console.error('Error al actualizar sesión:', error);
    });
  }

  eliminarSesion(sesionId: number) {
    this.gymService.deleteSesion(sesionId).subscribe(() => {
      this.getSesiones();
    }, error => {
      console.error('Error al eliminar sesión:', error);
    });
  }
}
